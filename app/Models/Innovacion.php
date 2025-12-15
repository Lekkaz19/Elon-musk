<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Innovacion extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'blog_innovations';

    protected $fillable = [
        'title',
        'description',
        'image_url',
        'created_by',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function comentarios()
    {
        return $this->morphMany(Comentario::class, 'commentable');
    }
}