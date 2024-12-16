<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index()
    {
        // all groups where a GroupUser exists with the connected user
        $groups = Group::whereHas('users', function ($query) {
            $query->where('id', auth()->id());
        })->get();

        return view('groups.index', ['groups' => $groups]);
    }
}
