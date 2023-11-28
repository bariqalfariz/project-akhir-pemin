<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;

use Illuminate\Http\Request;

class MataKuliahController extends Controller
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
    public function getAllMataKuliah(Request $request)
    {
        $mataKuliah = MataKuliah::all();
        
        return response()->json([
            'success' => true,
            'message' => 'All Mata Kuliah',
            'data' => $mataKuliah 
        ]);
    }
}
