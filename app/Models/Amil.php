<?php
// app/Models/Amil.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Amil extends Model
{
    protected $table = 'tbl_amil';

    protected $fillable = [

        'name',
        'phone',
        'address',
        'imageProfile',
        'id_amil',
        'amil'
    ];

    // Relationship to User model
    public function user()
    {
        return $this->belongsTo(User::class, 'id_amil');
    }
}