<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password', 'role'];

    protected $hidden = ['password', 'remember_token'];

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isMerchant()
    {
        return $this->role === 'merchant';
    }

    public function stores(): HasMany
    {
        return $this->hasMany(Store::class);
    }
}
