<?php

namespace App\UI;

use App\Services\Game;

class Console
{
    private Game $game;
    private string $user_input;

    public function run(): void {
        while(true) {
            $this->show_menu();

            $this->user_input = readline();

            // read input
        }
    }

    private function show_menu(): void {
        echo "Start game? [y]: ";
    }
}
