<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Muzaki extends Model
{
    use HasFactory;
    protected $table = 'tbl_muzaki';

    protected $fillable = [
        'name',
        'phone',
        'address',
        'id_masjid'
    ];

    public function masjid()
    {
        return $this->belongsTo(Masjid::class, 'id_masjid ');
    }
}
