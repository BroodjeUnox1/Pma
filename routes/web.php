<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CursusController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\planningController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\KlassenController;
use App\Http\Controllers\VoortgangController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth']], function(){
    Route::get('/dashboard', [DashboardController::class, 'index']);
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';




Route::group(['middleware' => ['auth']], function(){
    Route::get('/create-cursus', [CursusController::class, 'show']);
});


Route::group(['middleware' => ['auth']], function(){
    Route::post('/create-cursus', [CursusController::class, 'create']);
});


Route::group(['middleware' => ['auth']], function(){
    Route::get('/cursussen', [CursusController::class, 'show_cursus']);
});

Route::group(['middleware' => ['auth']], function(){
    Route::post('/cursussen', [CursusController::class, 'search']);
});

Route::group(['middleware' => ['auth']], function(){
    Route::get('/planningen', [planningController::class, 'show_planning']);
});

Route::group(['middleware' => ['auth']], function(){
    Route::post('/planningen', [planningController::class, 'search']);
});

// Route::group(['middleware' => ['auth']], function(){
//     Route::get('singel-cursus/{id}', [CursusController::class, 'specific']);
// });

Route::group(['middleware' => ['auth']], function(){
    Route::get('studenten', [StudentController::class, 'show']);
});

Route::group(['middleware' => ['auth']], function(){
    Route::post('studenten', [StudentController::class, 'update']);
});

// Route::group(['middleware' => ['auth']], function(){
//     Route::get('update-studenten/{id}', [StudentController::class, 'show_single']);
// });

Route::group(['middleware' => ['auth']], function(){
    Route::post('update-studenten/{id}', [StudentController::class, 'update']);
});

Route::group(['middleware' => ['auth']], function(){
    Route::get('update-cursus/{id}', [CursusController::class, 'show_update']);
});

Route::group(['middleware' => ['auth']], function(){
    Route::post('update-cursus/{id}', [CursusController::class, 'update']);
});

Route::group(['middleware' => ['auth']], function(){
    Route::get('klassen', [KlassenController::class, 'show']);
});

Route::group(['middleware' => ['auth']], function(){
    Route::get('create-klassen', [KlassenController::class, 'show_create']);
});

Route::group(['middleware' => ['auth']], function(){
    Route::post('create-klassen', [KlassenController::class, 'insert']);
});

Route::group(['middleware' => ['auth']], function(){
    Route::get('/planningen/{id}', [planningController::class, 'oneitem']);
});

Route::group(['middleware' => ['auth']], function(){
    Route::post('/planningen/{id}', [planningController::class, 'progress']);
});

Route::group(['middleware' => ['auth']], function(){
    Route::get('voortgang', [VoortgangController::class, 'show']);
});

Route::group(['middleware' => ['auth']], function(){
    Route::post('voortgang', [VoortgangController::class, 'search']);
});


Route::group(['middleware' => ['auth']], function(){
    Route::get('voortgang/{id}', [VoortgangController::class, 'show_one']);
});

Route::group(['middleware' => ['auth']], function(){
    Route::post('voortgang/{id}', [VoortgangController::class, 'show_one_search']);
});







// last one for unidentified links
Route::group(['middleware' => ['auth']], function(){
    Route::get('{link}/{data?}', [DashboardController::class, 'index']);
});

