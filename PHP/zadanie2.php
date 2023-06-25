<?php

class TextInput {
    protected $value = '';
  
    public function add($text) {
      $this->value .= $text;
    }
  
    public function getValue() {
      return $this->value;
    }
  }
  class NumericInput extends TextInput {
    public function add($text) {
      if (is_numeric($text)) {
        parent::add($text);
      }
    }
  }
  
$textInput = new TextInput();
$textInput->add('Hello ');
$textInput->add('123 ');
$textInput->add('World');
echo $textInput->getValue();

echo "<br>";

$numericInput = new NumericInput();
$numericInput->add('Hello');
$numericInput->add('123');
$numericInput->add('World');
echo $numericInput->getValue();

?>