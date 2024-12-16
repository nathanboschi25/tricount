<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpensePart extends Model
{
    use HasFactory;
    //
    protected $fillable = ['amount', 'expense_id', 'due_by'];
}
