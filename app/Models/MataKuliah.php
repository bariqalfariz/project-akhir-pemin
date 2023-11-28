<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Bagas Mahda Dhani - 215150700111038
class MataKuliah extends Model
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

    // fungsi mahasiswa
    public function mahasiswas()
    {
        return $this->belongsToMany(Mahasiswa::class, 'mahasiswa_matakuliah', 'mhsNim', 'mkId');
    }
}
