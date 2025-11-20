<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MapController;

Route::redirect('/', '/admin');

Route::get('/api/tower-locations', [MapController::class, 'towerLocations'])->name('api.tower-locations');
