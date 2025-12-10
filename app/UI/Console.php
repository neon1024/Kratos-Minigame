<?php

namespace App\UI;

use App\Services\Game;

class Console
{
    private Game $game;

    public function __construct(Game $game)
    {
        $this->game = $game;
    }

    public function run(): void {
        while(true) {
            // TO DO start game

            $this->game->start();
            echo $this->game->getResults();
        }
    }
}
