<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RssFeedController;

Route::get('/rss-feed', [RssFeedController::class, 'fetchFeed']);