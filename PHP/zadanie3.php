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
    
    public function recordResult($playerName, $score) {
        if (array_key_exists($playerName, $this->players)) {
          $this->players[$playerName]['score'] += $score;
          $this->players[$playerName]['gamesPlayed']++;
        }
      }
   
}

?>