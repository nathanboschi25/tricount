<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExpensePart extends Model
{
    //
    protected $fillable = ['amount', 'expense_id', 'due_by'];
}
