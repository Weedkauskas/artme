<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MagicController;

//Add phrase api endpoint
Route::post('add-phrase', [MagicController::class, 'addPhrase'])->name('add_phrase');

//View phrase api endpoint
Route::get('view-phrase/{id}', [MagicController::class, 'viewPhrase'])->name('view_phrase');

//Delete phrase
Route::delete('delete-phrase/{id}', [MagicController::class, 'deletePhrase'])->name('delete_phrase');
