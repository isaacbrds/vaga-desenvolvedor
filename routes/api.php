<?php

use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/users', [UserController::class, 'index']);   // Listar todos os usuários
Route::get('/users/{user}', [UserController::class, 'show']);  // Mostrar um usuário específico
Route::post('/users', [UserController::class, 'store']);  // Criar um novo usuário
Route::put('/users/{user}', [UserController::class, 'update']); // Atualizar um usuário
Route::delete('/users/{user}', [UserController::class, 'destroy']); // Deletar um usuário
