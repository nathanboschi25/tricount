<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'amount',
        'date',
        'group_id',
        'paid_by',
    ];

    /**
     * Group of this expense
     */
    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    /**
     * User who paid this expense
     */
    public function paidBy()
    {
        return $this->belongsTo(GroupUser::class, 'paid_by');
    }

    /**
     * Parts of this expense
     */
    public function parts()
    {
        return $this->hasMany(ExpensePart::class);
    }
}
