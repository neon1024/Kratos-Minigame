<?php

use Illuminate\Support\Facades\Route;
use \App\UI\Console;
use \App\Services\Game;

Route::get('/', function () {
    $console = new Console(new Game());
    $console->run();
})->name('game');
