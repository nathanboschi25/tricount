<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\GroupUser;
use App\Models\Payment;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function create(Group $group)
    {
        $group->load('groupUsers.user');

        return view('expenses.create', compact('group'));
    }

    public function store(Request $request, Group $group)
    {
        // participants.amount doit etre egal a la somme des montants
        $request->validate([
            'description' => 'required',
            'date' => 'required|date',
            'amount' => 'required|numeric',
            'participants' => 'required|array',
        ]);

        $totalAmount = collect($request->participants)->sum('amount');
        if ($totalAmount != $request->amount) {
            return back()->withInput()->withErrors(['participants' => 'The sum of the participants amount must be equal to the total amount']);
        }

        $paid_by = GroupUser::where('group_id', $group->id)
            ->where('user_id', auth()->id())
            ->first();

        $expense = $group->expenses()->create([
            'description' => $request->description,
            'amount' => $request->amount,
            'date' => $request->date,
            'paid_by' => $paid_by->id,
        ]);

        $expenseParts = [];

        foreach ($request->participants as $participant) {
            $expenseParts[] = [
                'expense_id' => $expense->id,
                'amount' => $participant['amount'],
                'due_by' => $participant['id'],
            ];

            if ($participant['id'] == $paid_by->id) {
                Payment::create([
                    'group_id' => $group->id,
                    'paid_by' => $paid_by->id,
                    'paid_to' => $paid_by->id,
                    'amount' => $participant['amount'],
                    'date' => $request->date,
                ]);
            }
        }

        $expense->parts()->createMany($expenseParts);

        return redirect()->route('groups.show', $group);
    }
}
