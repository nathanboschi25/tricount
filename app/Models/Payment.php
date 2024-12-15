<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //
    protected $fillable = [
        'group_id',
        'paid_by',
        'paid_to',
        'amount',
        'date',
    ];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function sender()
    {
        return $this->belongsTo(GroupUser::class, 'paid_by');
    }

    public function receiver()
    {
        return $this->belongsTo(GroupUser::class, 'paid_to');
    }
}
