<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Bagas Mahda Dhani - 215150700111038
class Mahasiswa extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    
    protected  $primaryKey = 'nim';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'nim', 'nama', 'angkatan', 'prodiId', 'token', "password"
    ];
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var string[]
     */
    protected $hidden = [];

    // fungsi prodis
    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodiId');
    }

    // funsgi matakuliahs
    public function matakuliahs()
    {            
        return $this->belongsToMany(Matakuliah::class, 'mahasiswa_matakuliah', 'mhsNim', 'mkId');
    }
}
