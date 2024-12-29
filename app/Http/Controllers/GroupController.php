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

        $group->users()->attach(auth()->id());

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

        $debts = $groupuser->debts();

        $made_payments = $groupuser->sentPayments();

        $made_expenses = $groupuser->expenses();

        $due_total = $debts->sum('amount') - $made_payments->sum('amount') - $made_expenses->sum('amount');

        $expenses = $made_expenses->get();

        return view('groups.view', compact('group', 'due_total', 'expenses'));
    }
}
