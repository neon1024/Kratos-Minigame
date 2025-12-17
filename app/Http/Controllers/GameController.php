<?php

namespace App\Http\Controllers;

use App\Services\GameService;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class GameController extends Controller
{
    public function index()
    {
        if (request()->query('start') == 1) {
            $game = new GameService();
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
    }

    public function databaseResults()
    {
        $games = DB::select("SELECT * FROM Games");

        return Inertia::render("DatabaseResults", ["data" => $games]);
    }
}
