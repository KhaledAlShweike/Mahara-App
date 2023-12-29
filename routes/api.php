<?php

use App\Http\Controllers\ClubController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\StadiumController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Models\Pending_TeamtoTeam_matching;
use App\Models\Team_to_Team_matching;
use App\Models\Team_toPlayer_matching;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login', [AuthController::class, 'playerLogin']);
Route::post('/login/club_manager', [AuthController::class, 'clubManagerLogin']);
Route::post('/register', [AuthController::class, 'playerSignup']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/reservations', [ReservationController::class, 'index']);


Route::post('/signup', [AuthController::class, 'signup']);


Route::post('/upload-image', [ImageController::class, 'upload']);



Route::get('/clubs/{id}', [ClubController::class, 'show']);
Route::get('/stadiam/{id}', [StadiumController::class, 'show']);

Route::post('/ToTmatching', [Team_to_Team_matching::class, 'Teamtoteam_Matching']);

Route::post('/ToPmatching', [Team_toPlayer_matching::class, 'Teamtoplayer_Matching']);
