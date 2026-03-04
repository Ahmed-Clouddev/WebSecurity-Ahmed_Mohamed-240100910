<?php

use App\Http\Controllers\TestController;
use App\Http\Controllers\LabExController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello', function () {
    return view('greeting');
});

Route::get('/test',[TestController::class, "post"]);
Route::get('/test/great',[TestController::class, "great"]);
// ── Exercises ─────────────────────────────────────────────────────────────

Route::get('/exercises', function () {
    return view('exercises.index');
});

Route::get('/exercises/even-numbers', function () {
    return view('exercises.even-numbers');
});

Route::get('/exercises/prime-numbers', function () {
    return view('exercises.prime-numbers');
});

Route::get('/exercises/multiplication/{number}', function ($number) {
    // Clamp to 1–20 and ensure it is an integer
    $number = max(1, min(20, (int) $number));
    return view('exercises.multiplication', compact('number'));
})->where('number', '[0-9]+');

// ── Lab Exercises ──────────────────────────────────────────────────────────

Route::get('/lab-exercises', [LabExController::class, 'index']);
Route::get('/lab-exercises/mini-test', [LabExController::class, 'miniTest']);
Route::get('/lab-exercises/transcript', [LabExController::class, 'transcript']);
Route::get('/lab-exercises/products', [LabExController::class, 'products']);
