<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    protected function jwt(Mahasiswa $mahasiswa)
    {
        $payload = [
            'iss' => 'lumen-jwt', //issuer of the token
            'sub' => $mahasiswa->nim, //subject of the token
            'iat' => time(), //time when JWT was issued.
            'exp' => time() + 60 * 60 //time when JWT will expire
        ];
        return JWT::encode($payload, env('JWT_SECRET'), 'HS256');
    }

    public function register(Request $request)
    {
        $nim = $request->nim;
        $nama = $request->nama;
        $angkatan = $request->angkatan;
        $prodiId = $request->prodiId;

        $password = Hash::make($request->password);
        
        $mahasiswa = Mahasiswa::create([
            'nim' => $nim,
            'nama' => $nama,
            'angkatan' => $angkatan,
            'prodiId' => $prodiId,
            'password' => $password
        ]);

        return response()->json([
            'status' => 'Success',
            'message' => 'new mahasiswa created',
            'data' => $mahasiswa
        ],200);
    }

    public function login(Request $request)
    {
        $nim = $request->nim;
        $password = $request->password;

        $mahasiswa = Mahasiswa::where('nim', $nim)->first();
        
        if (!$mahasiswa) {
            return response()->json([
                'status' => false,
                'message' => 'mahasiswa not exist',
            ],404);
        }

        if (!Hash::check($password, $mahasiswa->password)) {
            return response()->json([
                'status' => false,
                'message' => 'wrong password',
            ],400);
        }

        $mahasiswa->token = $this->jwt($mahasiswa);
        
        $mahasiswa->save(); 

        return response()->json([
            'status' => true,
            'message' => 'successfully login',
            'token' => $mahasiswa->token
        ],200);
    }

    private function base64url_encode(String $data): String
    {
        $base64 = base64_encode($data); // ubah json string menjadi base64
        $base64url = strtr($base64, '+/', '-_'); // ubah char '+' -> '-' dan '/' -> '_'
        
        return rtrim($base64url, '='); // menghilangkan '=' pada akhir string
    }

    private function sign(String $header, String $payload, String $secret): String
    {
        $signature = hash_hmac('sha256', "{$header}.{$payload}", $secret, true);
        $signature_base64url = $this->base64url_encode($signature);

        return $signature_base64url;
    }
}