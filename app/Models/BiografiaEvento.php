<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BiografiaEvento extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'biography_timeline';

    protected $fillable = [
        'year',
        'title',
        'description',
        'image_url',
        'created_by',
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