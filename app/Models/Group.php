<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'currency', 'picture', 'invitation_token', 'owner_id'];

    public function groupUsers()
    {
        return $this->hasManyThrough(User::class, GroupUser::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function balance()
    {
        return number_format($this->payments()->sum('amount') - $this->expenses()->sum('amount'), 2);
    }

    public function balanceForUser(User $user)
    {
        return $this->groupUsers()->where('user_id', $user->id)->first()->balance();
    }
}
