<?php

use Illuminate\Support\Str; // import library Str

/** @var \Laravel\Lumen\Routing\Router $router */
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/mahasiswa', ['uses' => 'MahasiswaController@getAllMahasiswa']);
$router->get('/prodi', ['uses' => 'ProdiController@getAllProdi']);
$router->get('/matakuliah', ['uses' => 'MataKuliahController@getAllMataKuliah']);