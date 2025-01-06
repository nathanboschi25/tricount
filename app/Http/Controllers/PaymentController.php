<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\GroupUser;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function create(Group $group, GroupUser $groupUser) {
        // TODO: the connected user pays to the $groupUser an amount (create form with 'to' and 'amount' fields)
        return view('payments.create', compact('group', 'groupUser'));
    }

    public function store(Request $request, Group $group, GroupUser $groupUser) {
        $request->validate([
            'amount' => 'numeric|required',
            'date' => 'date|required',
        ]);

        $groupuser = GroupUser::where('group_id', $group->id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $payment = Payment::create([
            'group_id' => $group->id,
            'paid_by' => $groupuser->id,
            'paid_to' => $request->paid_to,
            'amount' => $request->amount,
            'date' => $request->date
        ]);

        return redirect()->route('groups.show', [$group]);
    }

}
