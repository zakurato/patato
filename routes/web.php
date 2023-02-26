<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[HomeController::class, "index"] )->name("index");

Route::get("/verificarLogin",[HomeController::class,"verificarLogin"])->name("verificarLogin");

Route::get("/paginaPrincipal",[HomeController::class,"paginaPrincipal"])->name("paginaPrincipal")->middleware("auth");

Route::post("/deslogueo",[HomeController::class,"deslogueo"])->name("deslogueo")->middleware("auth");

Route::get("/formRegistrarUsuario",[UsuarioController::class,"formRegistrarUsuario"])->name("formRegistrarUsuario")->middleware("auth");

Route::post("/storeUsuario",[UsuarioController::class,"storeUsuario"])->name("storeUsuario")->middleware("auth");

Route::delete("/eliminarUsuario",[UsuarioController::class,"eliminarUsuario"])->name("eliminarUsuario")->middleware("auth");

Route::get("/actualizarUsuario",[UsuarioController::class,"actualizarUsuario"])->name("actualizarUsuario")->middleware("auth");

Route::get("/storeActualizarUsuario",[UsuarioController::class,"storeActualizarUsuario"])->name("storeActualizarUsuario")->middleware("auth");

Route::get("/aplicarAbono",[UsuarioController::class,"aplicarAbono"])->name("aplicarAbono")->middleware("auth");

Route::post("/storeAbono",[UsuarioController::class,"storeAbono"])->name("storeAbono")->middleware("auth");
