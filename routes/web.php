<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Services\Game;

Route::get('/', function () {
    if (request()->query('start') == 1) {
        $game = new Game();
        $game->start();
        $results = $game->getResults();

        return Inertia::render('GameResults', [
            'message' => $results['message'],
            'turns' => $results['turns'],
            'gameStarted' => true
        ]);
    }

    return Inertia::render('GameResults', [
        'message' => null,
        'turns' => [],
        'gameStarted' => false,
    ]);

})->name('game');
