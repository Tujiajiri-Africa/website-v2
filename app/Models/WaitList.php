<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaitList extends Model
{
    use HasFactory;
    public const CONFIRMED_WAITLIST = 1;
    public const UNCONFORMED_WAITLIST = 0;

    protected $table = 'user_waitlist';

    protected $fillable = [
        'email',
        'invite_token',
        'confirmed'
    ];
}
