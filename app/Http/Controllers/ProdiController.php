<?php

namespace App\Http\Controllers;

use App\Models\Prodi;

use Illuminate\Http\Request;

class ProdiController extends Controller
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

    // Bagas Mahda Dhani - 215150700111038
    public function getAllProdi(Request $request)
    {
        $prodi = Prodi::all();
        
        return response()->json([
            'success' => true,
            'message' => 'All Program Studi',
            'data' => $prodi 
        ]);
    }
}
