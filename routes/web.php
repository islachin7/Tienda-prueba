<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\FeedBackController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrdenController;
use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/contacto', [HomeController::class, 'contacto'])->name('contacto');
Route::get('/filtroNombre', [HomeController::class, 'filtroNombre'])->name('filtroNombre');
Route::get('/filtroPrecio', [HomeController::class, 'filtroPrecio'])->name('filtroPrecio');
Route::get('/filtroCategoria', [HomeController::class, 'filtroCategoria'])->name('filtroCategoria');
Route::get('/cambiaCiudad', [HomeController::class, 'ciudad'])->name('cambiaCiudad');
Route::get('/cambiaDistrito', [HomeController::class, 'distrito'])->name('cambiaDistrito');

Route::view('/login', 'auth.login')->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('post-login');

Route::view('/register', 'auth.register')->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('post-register');
Route::post('/update', [AuthController::class, 'update'])->name('post-update');

Route::get('/politicas', function(){
    $file = storage_path('/app/POLITICAS.pdf'); 
    return \Response::make(file_get_contents($file), 200, [
        'Content-Type' => 'application/pdf',
        'Content-Disposition' => 'inline; filename="'.$file.'"'
    ]); 
})->name('politicas');

Route::resource('producto', ProductoController::class);

Route::group(['middleware' => ['auth']], function() {

    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::get('/mis/pedidos', [OrdenController::class, 'mis_pedidos'])->name('mis_pedidos');

    Route::resource('categoria', CategoriaController::class)->except(['edit']);;
    Route::resource('orden', OrdenController::class);
    Route::resource('auth', AuthController::class);
    Route::resource('feedback', FeedBackController::class);

});