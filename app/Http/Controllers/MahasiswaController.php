<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
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
        $mahasiswa = Mahasiswa::with('prodi')->get();
        
        return response()->json([
            'success' => true,
            'message' => 'All Mahasiswa',
            'mahasiswa' => $mahasiswa 
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

    // Bariq Alfariz - 215150700111042
    public function addMataKuliah(Request $request)
    {
        // Mendapatkan credentials token
        $token = $request->header('token') ?? $request->query('token');
        $credentials = JWT::decode($token, new Key(env('JWT_SECRET'), 'HS256'));
        $nim = $credentials->sub;

        $mahasiswa = Mahasiswa::find($nim);
        
        // Cek apakah mahasiswa sudah terdaftar pada mata kuliah
        if ($mahasiswa->matakuliahs()->where('mkId', $request->mkId)->exists()) {
            return response()->json([
                'status' => false,
                'message' => 'Mata Kuliah exist',
            ], 400);
        }
        
        $matakuliah = MataKuliah::find($request->mkId);

        // Cek Apakah ditemukan Kode Mata Kuliah
        if (!$matakuliah) {
            return response()->json([
                'success' => false,
                'message' => 'Mata Kuliah not found' 
            ],404);
        }

        $mahasiswa->matakuliahs()->attach($matakuliah->id);

        return response()->json([
            'success' => true,
            'message' => 'Mata Kuliah added',
        ], 200);
    }

    // Bariq Alfariz - 215150700111042
    public function deleteMataKuliah(Request $request)
    {
        // Mendapatkan credentials token
        $token = $request->header('token') ?? $request->query('token');
        $credentials = JWT::decode($token, new Key(env('JWT_SECRET'), 'HS256'));
        $nim = $credentials->sub;
        
        $mahasiswa = Mahasiswa::find($nim);

        $matakuliah = MataKuliah::find($request->mkId);

        // cek apakah ada id Mata Kuliah
        if (!$matakuliah) {
            return response()->json([
                'success' => false,
                'message' => 'Mata Kuliah not found' 
            ],404);
        }

        $mahasiswa->matakuliahs()->detach($matakuliah->id);

        return response()->json([
            'success' => true,
            'message' => 'Mata Kuliah Removed',
        ], 200);
    }
}
