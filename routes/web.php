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

$router->group(['prefix' => 'auth'], function () use ($router) {
    $router->post('/register', ['uses'=> 'AuthController@register']);
    $router->post('/login', ['uses'=> 'AuthController@login']); // route login
});

$router->group(['prefix' => 'mahasiswa'], function () use ($router) {
    $router->get('/', [ 'uses' => 'MahasiswaController@getAllMahasiswa']);
    $router->get('/profile', [ 'middleware' => 'jwt.auth' , 'uses' => 'MahasiswaController@getMahasiswaProfile']);
    $router->get('/{nim}', [ 'uses' => 'MahasiswaController@getMahasiswaByNim']);
    $router->post('/matakuliah/{mkId}', ['middleware' => 'jwt.auth', 'uses' => 'MahasiswaController@addMataKuliah']);
    $router->put('/matakuliah/{mkId}', ['middleware' => 'jwt.auth', 'uses' => 'MahasiswaController@deleteMataKuliah']);
});

$router->get('/prodi', ['uses' => 'ProdiController@getAllProdi']);
$router->get('/matakuliah', ['uses' => 'MataKuliahController@getAllMataKuliah']);