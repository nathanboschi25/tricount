<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\GroupUser;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index()
    {
        // all groups where a GroupUser exists with the connected user
        $groups_id = GroupUser::where('user_id', auth()->id())->pluck('group_id');
        $groups = Group::whereIn('id', $groups_id)->get();

        return view('groups.index', compact('groups'));
    }

    public function create()
    {
        return view('groups.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'currency' => 'nullable|string|max:3',
        ]);

        $group = Group::create([
            'name' => $request->name,
            'currency' => $request->currency ?? 'EUR',
            'owner_id' => auth()->id(),
            'invitation_token' => bin2hex(random_bytes(3)),
        ]);

        $groupUser = GroupUser::create([
            'user_id' => auth()->id(),
            'group_id' => $group->id,
        ]);

        return redirect()->route('groups.index');
    }

    public function edit(Group $group)
    {
        return view('groups.edit', compact('group'));
    }

    public function update(Request $request, Group $group)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'currency' => 'nullable|string|max:3',
        ]);

        $group->update([
            'name' => $request->name,
            'currency' => $request->currency ?? 'EUR',
        ]);

        return redirect()->route('groups.index');
    }

    public function destroy(Group $group)
    {
        $group->delete();

        return redirect()->route('groups.index');
    }

    public function show(Group $group)
    {
        $groupuser = GroupUser::where('group_id', $group->id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        // parts of made payments by other users
        $debts = $groupuser->debts()
            ->with('expense');
        $made_payments = $groupuser->sentPayments();
        $received_payments = $groupuser->receivedPayments();
        $made_expenses = $groupuser->expenses();

        $expenses = $made_expenses->get();

        $user_debts = [];
        foreach ($debts->get() as $debt) {
            if ($debt->expense->paid_by != auth()->id()) {
                $user_debts[] = $debt;
            }
        }



        // load the user relation to avoid n+1 queries
        $made_payments = $made_payments
            ->where('paid_to', '!=', $groupuser->id)
            ->with('receiver.user')->get();
        $received_payments = $received_payments
            ->where('paid_by', '!=', $groupuser->id)
            ->with('sender.user')->get();

        $debts_to_others = [];

        foreach ($group->groupUsers()->get() as $index => $groupUser) {
            $debts_to_others[$index-1]['user'] = $groupUser->user;
            $debts_to_others[$index-1]['groupUser'] = $groupUser;
            $debts_to_others[$index-1]['amount'] = 0;
            // filter with expense.paid_by
            foreach ($debts->get() as $debt) {
                if ($debt['expense']['paid_by'] === $groupUser->id) {
                    $debts_to_others[$index-1]['amount'] += $debt['amount'];
                }
            }
            foreach ($made_payments as $made_payment) {
                if ($made_payment['receiver']['id'] === $groupUser->id) {
                    $debts_to_others[$index-1]['amount'] -= $made_payment['amount'];
                }
            }
        }

        $due_total = $debts->sum('amount') - $made_payments->sum('amount') + $received_payments->sum('amount') - $made_expenses->sum('amount');

        return view('groups.view', compact('group', 'due_total', 'debts_to_others', 'expenses', 'made_payments', 'received_payments', 'user_debts'));
    }

    public function showMembers(Group $group) {
        // TODO:
        return view('groups.members', compact('group'));
    }

    public function setMembers(Group $group, Request $request) {
        // TODO:
    }
}
