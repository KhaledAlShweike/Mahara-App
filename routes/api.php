<?php

use App\Http\Controllers\Api\V1\AcceptJoinRequest;
use App\Http\Controllers\Api\V1\GetNewestClubs;
use App\Http\Controllers\Api\V1\GetNewestStadiums;
use App\Http\Controllers\Api\V1\GetPlayerReservation;
use App\Http\Controllers\Api\V1\GetTeamtoPlayerMatches;
use App\Http\Controllers\Api\V1\GetTeamtoTeamMatches;
use App\Http\Controllers\Api\V1\GetTopReservedStadiums;
use App\Http\Controllers\Api\V1\TeamManagement;
use App\Http\Controllers\Api\V1\TeamtoPlayer_Matching;
use App\Http\Controllers\Api\V1\TeamtoTeamMatching;
use App\Http\Controllers\Api\V1\UpdateActorInformations;
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



Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'PlayerSignup']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/Reservations', [ReservationController::class, 'index']);  //works


Route::post('/signup', [AuthController::class, 'signup']);


Route::post('/upload-Image', [ImageController::class, 'upload']);

Route::get('/Clubs/{id}', [ClubController::class, 'show']);
Route::get('/stadiam/{id}', [StadiumController::class, 'show']);

Route::post('/ToTmatching', [TeamtoTeamMatching::class, 'TeamtoTeamMatching']);
Route::post('/ToPmatching', [TeamtoPlayer_Matching::class, 'TeamtoPlayerMatching']);

Route::get('/sports', [SportTypeController::class, 'index']);     //works
Route::get('/cities', [LocationController::class, 'index']);     //works
Route::get('/Clubs', [ClubController::class, 'index']);         //not working
Route::get('/Stadiums', [StadiumController::class, 'index']);      //not working
Route::get('/Locations', [LocationController::class, 'index']);  // works
Route::get('/PlayertoTeammatches', [PlayerToTeamMatchingController::class, 'getPlayertoTeammatching']);// not working
Route::get('/TeamtoTeammatches', [TeamtoTeamMatchingController::class, 'getTeamtoTeamMatching']);// not working
Route::get('/PlayerReservation', [GetPlayerReservation::class, 'GetPlayerReservation']);  // not working
Route::get('/NewestStadiums', [GetNewestStadiums::class, 'GetNewestStadiums']);    //works
Route::get('/NewestClubs', [GetNewestClubs::class, 'GetNewestClubs']);    //works
Route::get('/Notificationcount',[NotificationController::class, 'index']);  //works
Route::get('/TopStadiums',[GetTopReservedStadiums::class, 'getTopReservedStadiums']);  // not working
Route::get('/TeamtoTeamMatches',[GetTeamtoTeamMatches::class , 'GetTeamtoTeamMatches']);
Route::get('/teamtoPlayermatches',[GetTeamtoPlayerMatches::class, 'GetTeamtoPlayerMatches']);
Route::get('/clubreservation',[ReservationController::class, 'ClubReservation']);

Route::post('/change-password', [UpdateActorInformations::class, 'changePassword']);
Route::post('/change-firstname', [UpdateActorInformations::class, 'changeFirstName']);
Route::post('/change-lastname', [UpdateActorInformations::class, 'changeLastName']);
Route::post('/change-email', [UpdateActorInformations::class, 'changeEmail']);
Route::post('/change-birthdate', [UpdateActorInformations::class, 'changeBirthdate']);
Route::post('/create-team', [UpdateActorInformations::class, 'createTeam']);

Route::post('/acceptplayer', [TeamManagement::class, 'AcceptPlayer']);
Route::post('/removePlayer', [TeamManagement::class, 'removePlayer']);
Route::post('/makecaptin', [TeamManagement::class, 'MakeCaptin']);
Route::post('/removecaptin', [TeamManagement::class, 'RemoveCaptin']);


