<?php

use Illuminate\Support\Facades\Route;
use \App\Services\Game;

Route::get('/', function () {
    $game = new Game();
    $game->start();
    $results = $game->getResults();

    $message = $results[0];
    $turns = $results[1];

    echo $message;

    foreach($turns as $turn) {
        echo $turn;
    }
})->name('game');
