<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MagicController;
use App\Http\Controllers\SubscriptionController;
use App\Facades\EmailHelperFacade;


//Home page
Route::get('/', [MagicController::class, 'welcome'])->name('welcome');

//Inner magic page
Route::get('/visualise/{magic}', [MagicController::class, 'find'])->name('visualise');

//Simple add form
Route::post('/add-magic', [MagicController::class, 'add'])->name('add_magic');

//Subscribe
Route::get('/subscribe', [SubscriptionController::class, 'subscription'])->name('subscribe_view');
Route::post('/subscribe', [SubscriptionController::class, 'subscribe'])->name('subscribe_post');

Route::get('/unsubscribe/{email}/{hash}', [SubscriptionController::class, 'unsubscribe'])->name('unsubscribe');

//Facade demonstration
Route::get('/test-facade', [SubscriptionController::class, 'facade']);
