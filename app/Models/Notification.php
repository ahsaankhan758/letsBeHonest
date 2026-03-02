<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'notifications';

    protected $fillable = [
        'user_id',
        'actor_id',
        'type',
        'reference_id',
        'reference_type',
        'message',
        'is_read',
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'created_at' => 'datetime',
    ];

    public function follower()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function following()
    {
        return $this->belongsTo(User::class, 'actor_id');
    }
}
