<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'is_active',
        'last_login_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'last_login_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    // RELACIONES
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class); 
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
    
    public function curiosidades(): HasMany
    {
        return $this->hasMany(Curiosidad::class, 'created_by');
    }
    public function innovaciones(): HasMany
    {
        return $this->hasMany(Innovacion::class, 'created_by');
    }
    public function biografiaEventos(): HasMany
    {
        return $this->hasMany(BiografiaEvento::class, 'created_by');
    }

    // HELPERS
    public function isAdmin(): bool
    {
        return $this->role->name === 'admin';
    }

    public function isUser(): bool
    {
        return $this->role->name === 'user';
    }
}