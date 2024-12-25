<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'tbl_kategori_penerima' ;

    protected $fillable = [

        'name',
    ];

    public function mustahik()
    {
        return $this->hasMany(Mustahik::class, 'id_kategori');
    }
}