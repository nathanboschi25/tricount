<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'group_id',
        'user_id',
    ];


    /**
     * Expenses made by the user in the group
     */
    public function expenses()
    {
        return $this->hasMany(Expense::class, 'paid_by');
    }

    /**
     * Expenses to be paid by the user in the group
     */
    public function debts()
    {
        return $this->hasMany(ExpensePart::class, 'due_by');
    }

    /**
     * Payments made by other users in the group to the user
     */
    public function reiceivedPayments()
    {
        return $this->hasMany(Payment::class, 'paid_to');
    }

    /**
     * Payments made by the user to other users in the group
     */
    public function sentPayments()
    {
        return $this->hasMany(Payment::class, 'paid_by');
    }

    /**
     * Group of this registration
     */
    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    /**
     * User of this registration
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
