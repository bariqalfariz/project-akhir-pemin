<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Bagas Mahda Dhani - 215150700111038
class Prodi extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'nama'
    ];
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var string[]
     */
    protected $hidden = [];

    // fungsi prodis
    public function mahasiswas()
    {
        return $this->hasMany(Mahasiswa::class, 'prodiId');
    }
}
