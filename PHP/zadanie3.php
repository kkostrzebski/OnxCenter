<?php


class RankingTable {
    private $players = [];
  
    public function __construct($playerNames) {
      foreach ($playerNames as $name) {
        $this->players[$name] = [
          'score' => 0,
          'gamesPlayed' => 0
        ];
      }
    }
  
}

?>