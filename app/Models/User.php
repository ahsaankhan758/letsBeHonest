<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable; 

    protected $fillable = [
        'email',
        'password',
        'name',
        'age',
        'gender',
        'bio',
        'location',
        'height',
        'weight',
        'vibe_id',
        'interested',
        'brings_you_here',
        'see_yourself',
        'gets_you_excited',
        'open_to',
        'instagram_url',
        'profile_photo',
        'is_active',
        'email_verified_at'
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_active' => 'boolean',
    ];
}
