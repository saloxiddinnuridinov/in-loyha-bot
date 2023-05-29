<?php

use Illuminate\Support\Facades\Route;

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

Route::post('telegramBot', [\App\Http\Controllers\TelegramBotController::class, 'handle'])->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);

//Route::post('telegramBot', [\App\Http\Controllers\TelegramBotController::class, 'handle'])->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);



Route::get('/webhook', function () {
    return file_get_contents("https://api.telegram.org/bot" . env('TELEGRAM_BOT_TOKEN') . "/setwebhook?url=" . env('WEBHOOK_URL') . "/telegramBot");
});
Route::get('/', function () {
    return view('welcome');
});

Route::post('store', [\App\Http\Controllers\UserController::class, 'store'])->name('store');
