<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'content_comments';

    protected $fillable = [
        'user_id',
        'guest_name',
        'commentable_id',
        'commentable_type',
        'content',
        'approved',
        'approved_by',
        'approved_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the parent commentable model (curiosidad, innovacion, or biografiaEvento).
     */
    public function commentable()
    {
        return $this->morphTo();
    }
}
