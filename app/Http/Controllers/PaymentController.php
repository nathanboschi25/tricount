<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\GroupUser;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function create(Group $group, GroupUser $groupUser) {
        // TODO: the connected user pays to the $groupUser an amount (create form with 'to' and 'amount' fields)
        return view('payments.create', compact('group', 'groupUser'));
    }

    public function store(Request $request, Group $group, GroupUser $groupUser) {
        // TODO: the amount in $request is created between the connected user to the $groupUser
    }

}
