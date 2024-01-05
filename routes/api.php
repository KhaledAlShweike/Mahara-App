<?php

use App\Http\Controllers\Api\V1\GetNewestClubs;
use App\Http\Controllers\Api\V1\GetNewestStadiums;
use App\Http\Controllers\Api\V1\GetPlayerReservation;
use App\Http\Controllers\Api\V1\GetTopReservedStadiums;
use App\Http\Controllers\Api\V1\TeamtoPlayer_Matching;
use App\Http\Controllers\Api\V1\TeamtoTeamMatching;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\NotificationController;
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

Route::get('/sports', [SportTypeController::class, 'index']);
Route::get('/cities', [LocationController::class, 'index']);
Route::get('/Clubs', [ClubController::class, 'index']);
Route::get('/Stadiums', [StadiumController::class, 'index']);
Route::get('/Locations', [LocationController::class, 'index']);
Route::get('/PlayertoTeammatches', [PlayerToTeamMatchingController::class, 'getPlayertoTeammatching']);
Route::get('/TeamtoTeammatches', [TeamtoTeamMatchingController::class, 'getTeamtoTeamMatching']);
Route::get('/PlayerReservation', [GetPlayerReservation::class, 'GetPlayerReservation']);
Route::get('/NewestStadiums', [GetNewestStadiums::class, 'GetNewestStadiums']);
Route::get('/NewestClubs', [GetNewestClubs::class, 'GetNewestClubs']);
Route::get('/Notificationcount',[NotificationController::class, 'index']);
Route::get('/TopStadiums',[GetTopReservedStadiums::class, 'getTopReservedStadiums']);
