<?php
$br="<br>";

$x=doSomething();
echo $x;

function doSomething() {
    return "doing it";
}



$x= doSomethingNested();
echo $x;
$y = part2();
echo $y;
function doSomethingNested() {
    function part2() {
        return "functon within function";
    }
    return "doing something Nested";
}

//enforce strict types for below options to work properly
function doSomeBoundToReturnType():int {

    return 1;
}
$x = doSomeBoundToReturnType();
echo $x;


function doVoid():void {


}


//php8+ -below types

function doMixed():mixed {

    return 'l';
}

/*
function doMixedTypes():int|string {

    return 'l';
}

function mixedInputTypes(int|float $x, float $y=10):int|float {
    if ($x%2===0) {
        $x /=2;
    }
    return $x * $y;
}
$a=6.0;
$y=7;
echo mixedInputTypes($a, $y)." <br/>";
var_dump($a, $b);
*/

//$x changes passed in $a value as it calculates 
function mixedInputTypes(float &$x, int $y=10):float {
    if ($x%2===0) {
        $x /=2;
    }
    return $x * $y;
}
$a=6.0;
$b=7;
echo mixedInputTypes($a, $b)." <br/>";
echo "------";
var_dump($a, $b);

//PHP 8 change order of named arguments 
// mixedInputTypes($y: $a, $x: $b)." <br/>";
// 

//unpacking 
function mixed(float $x, int $y,...$numbers):float {
    if ($x%2===0) {
        $x /=2;
    }
    
    $sum=0;
    foreach ($numbers as $number) {
        $sum += $number;
    }
    
    return $x * $y+ array_sum($numbers);
}


function setArrayType(int ...$numbers) {
    
}

setArrayType(1,2,3,4);
$inputArray = [1,2,3,4];
setArrayType(...$inputArray);



$globalVar = 4;

//inside an included file we can update the variables from this page 
include 'hello.php';
echo "------";



//Avoid doing things this way 
function doSomethingWithVar() {
    //or call global in function    
    global $globalVar;
    $globalVar = 10;
    
    // OR
    $xx = $GLOBALS['globalVar'];
       
}
 
 //We can pass in the variable like so this is a better way 
function doSomethingWithGlobalVar($globalVar) {
    
    $globalVar = 5;
}

 doSomethingWithGlobalVar($globalVar);
 echo "<br>------";

 function getSomethingExpensive() {
     $value = null; 
             
     if ($value===null) {
         $value = doSomethingExpensive();
     }
     return $value;
 }
 

 function getSomethingExpensiveOnce() {
     static $value = null; 
             
     if ($value===null) {
         $value = doSomethingExpensive();
     }
     return $value;
 }
 
function doSomethingExpensive() {
    sleep(1);
    echo "processing";
    return 10;
}
echo $br;
echo getSomethingExpensive()."<br>";
echo getSomethingExpensive()."<br>";
//echo getSomethingExpensive()."<br>";

echo getSomethingExpensiveOnce()."<br>";
echo getSomethingExpensiveOnce()."<br>";
//echo getSomethingExpensiveOnce()."<br>";
echo $br;



function doSum(float ...$numbers):float {
    
    return array_sum($numbers);
}

$x = 'doSum';
if (is_callable($x)) {
    echo $x(1,2,3);
} else {
    echo "$x is not callable";
}

echo $br;

$y = 'doSum1';
 if (is_callable($y)) {
    echo $y(1,2,3);
} else {
    echo "$y is not callable";
}
echo $br;

// Anonymous function has to end with semicolon
$externalVar = 10;
//this vs 
$xx = function(float ...$numbers) use ($externalVar, $br):float {  
// this which updates externalVar within function
//$xx = function(float ...$numbers) use (&$externalVar, $br):float {  
    $externalVar = 15;

    echo "externalVar in anonymous function {$externalVar} ";
        echo $br;
    return array_sum($numbers);
};
echo $br;
echo $xx(1,2,3);
echo $br;
echo "externalVar globally {$externalVar}";
  
  
  
  
  $array = [1,2,3,4];
  //Callable  / clojures 
  //
  //Way 1
  $array2=array_map(function($element) {
        return     $element *2;
  }, $array);
  
  //way 2 Via anonymouse function
  $anonymousFunction = function($element) {
        return     $element *2;
  };
  $array3=array_map($anonymousFunction, $array);
  
  
  //way 3 
  function fooBar($element) {
        return     $element *2;
  }
  $array4=array_map('fooBar', $array);
  echo '<pre>';
  print_r($array);
  print_r($array2);
  print_r($array3);
  print_r($array4);
  echo '</pre>';
  
  
  $sum = function(callable $callback, float ...$numbers) {
          return $callback(array_sum($numbers));
  };
  
  echo '----'.$sum('fooBar', 1,2,3,4);
  
  
  $y = 5;
  $array5 = array_map(fn($number)=> $number * $number * ++$y, $array);
  echo '<pre>';
  print_r($array5);
  echo '</pre>';
  
  echo "y is: ".$y;
  
          
  
?>