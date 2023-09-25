<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\pusherController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('upload',[App\Http\Controllers\TaskController::class, 'upload']);
Route::get('/csv', [App\Http\Controllers\ProfileController::class, 'destroy']);
Route::post('/upload_csv', [App\Http\Controllers\ProfileController::class, 'upload_csv']);
Route::get('test1', function () {
    event(new App\Events\MessageSent('Finn'));
    return "Event has been sent!";
});
Route::view('chat','chat');
Route::post('sendMessage', [pusherController::class,'sendMessage']);





Route::get('/home', 'App\Http\Controllers\pusherController@index');
Route::post('/broadcast', 'App\Http\Controllers\pusherController@broadcast');
Route::post('/receive', 'App\Http\Controllers\pusherController@receive');
