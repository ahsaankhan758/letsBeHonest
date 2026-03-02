<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    protected $table = 'user_profiles';
    
    protected $fillable = [
        'user_id',
        'photo_url',
        'is_profile'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}