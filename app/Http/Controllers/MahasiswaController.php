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

    // Ardhi Wahyu Hidayat - 215150707111038
    public function getMahasiswaByNim(Request $request)
    {
        $mahasiswa = Mahasiswa::find($request->nim);

        // Apabila mahasiswa tidak ditemukan
        if (!$mahasiswa) {
            return response()->json([
                'success' => false,
                'message' => 'Mahasiswa not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Mahasiswa exist',
            'mahasiswa' => [
                'nim' => $mahasiswa->nim,
                'nama' => $mahasiswa->nama,
                'matakuliah' => $mahasiswa->matakuliahs
            ]
        ], 200);
    }

    // Ardhi Wahyu Hidayat - 215150707111038
    public function getMahasiswaProfile(Request $request)
    {
        // Mendapatkan credentials token
        $token = $request->header('token') ?? $request->query('token');
        $credentials = JWT::decode($token, new Key(env('JWT_SECRET'), 'HS256'));
        $nim = $credentials->sub;

        $mahasiswa = Mahasiswa::with('prodi')->where("nim", $nim)->first();

        return response()->json([
            'success' => true,
            'message' => 'Get Mahasiswa Profile',
            'mahasiswa' => [
                'nim' => $mahasiswa->nim,
                'nama' => $mahasiswa->nama,
                'angkatan' => $mahasiswa->angkatan,
                'prodi' => $mahasiswa->prodi
            ]
        ], 200);
    }
}
