<?php

use App\Http\Controllers\Api\V1\TeamtoPlayer_Matching;
use App\Http\Controllers\Api\V1\TeamtoTeamMatching;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\StadiumController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\PlayerToTeamMatchingController;
use App\Http\Controllers\SportTypeController;
use App\Http\Controllers\TeamtoTeamMatchingController;
use App\Models\Pending_TeamtoTeam_matching;
use App\Models\SportType;
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

Route::post('/login', [AuthController::class, 'login']);
Route::post('/login/ClubManager', [AuthController::class, 'ClubManagerLogin']);
Route::post('/register', [AuthController::class, 'PlayerSignup']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/Reservations', [ReservationController::class, 'index']);


Route::post('/signup', [AuthController::class, 'signup']);


Route::post('/upload-Image', [ImageController::class, 'upload']);

Route::get('/Clubs/{id}', [ClubController::class, 'show']);
Route::get('/stadiam/{id}', [StadiumController::class, 'show']);

Route::post('/ToTmatching', [TeamtoTeamMatching::class, 'TeamtoTeamMatching']);
Route::post('/ToPmatching', [TeamtoPlayer_Matching::class, 'TeamtoPlayerMatching']);

Route::get('/sports',[SportTypeController::class,'getSports']);
Route::get('/cities',[LocationController::class,'index']);
Route::get('/Clubs',[ClubController::class,'getClub']);
Route::get('Stadiums',[StadiumController::class,'getStadiums']);
Route::get('/P2Tmatches',[PlayerToTeamMatchingController::class,'getPlayertoTeammatching']);
Route::get('/T2Tmatches',[TeamtoTeamMatchingController::class,'getTeamtoTeamMatching']);

