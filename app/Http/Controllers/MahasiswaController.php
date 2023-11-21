<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;

use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
    */
    public function __construct()
    {
        //
    }
        //
    public function getAllMahasiswa(Request $request)
    {
        $mahasiswa = Mahasiswa::all();
        
        return response()->json([
            'success' => true,
            'message' => 'All Mahasiswa',
            'data' => $mahasiswa 
        ]);
    }
}
