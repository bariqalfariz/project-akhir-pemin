<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'nama', 'angkatan', 'prodiId'
    ];
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var string[]
     */
    protected $hidden = [];

    // fungsi prodis
    public function prodis()
    {
        return $this->belongsTo(Prodi::class, 'prodiId');
    }

    // funsgi matakuliahs
    public function matakuliahs()
    {            
        return $this->belongsToMany(Matakuliah::class, 'mahasiswa_matakuliah', 'mhsNim', 'mkId');
    }
}