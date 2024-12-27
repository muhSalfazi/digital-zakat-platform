<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Masjid extends Model
{
    use HasFactory;

    protected $table = 'tbl_msjd';

    protected $fillable = [
        'name',
        'address',
        'RT',
        'RW'
    ];

    public function muzaki()
    {
        return $this->hasMany(Muzaki::class, 'id_masjid');
    }
}