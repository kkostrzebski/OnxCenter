<?php

$thesaurus = array(
    "market" => array("trade"),
    "small" => array("little", "compact")
  );

  function getSynonyms($word) {
    global $thesaurus;

    if (array_key_exists($word, $thesaurus)) {
        $synonyms = $thesaurus[$word];
    } else {
        $synonyms = array();
    }

    
}

?>