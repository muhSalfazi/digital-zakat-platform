<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'tbl_users';

    protected $fillable = [
        'username',
        'email',
        'password',
        'role',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Relasi ke model Amil
    public function amil()
    {
        return $this->hasOne(Amil::class, 'id_amil');
    }

    // Accessor untuk gambar profil
    public function getProfileImageAttribute()
    {
        if ($this->amil && $this->amil->imageProfile && file_exists(public_path($this->amil->imageProfile))) {
            return asset($this->amil->imageProfile);
        }
        return asset('img/undraw_profile.svg');  // Gambar default jika tidak ada
    }
}