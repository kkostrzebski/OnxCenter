<?php 

class Pipeline {

    public static function make(...$functions) {
        return function ($arg) use ($functions) {
            $result = $arg;
            foreach ($functions as $function) {
                $result = $function($result);
            }
            return $result;
        };
    }
  
  };
  
  $function1 = function($arg) {
    return $arg * 3;
  };
  
  $function2 = function($arg) {
    return $arg + 1;
  };
  
  $function3 = function($arg) {
    return $arg / 2;
  };
  
  $numbers = Pipeline::make($function1,$function2,$function3);
  
  $result = $numbers(3);
  echo "$result";
  
  
  ?>
  
?>