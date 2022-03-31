<?php


 
 ob_start();
 include 'layout/nav.php';
 $nav = ob_get_clean();
 $nav = str_replace('Expressions', 'Ahhha Expressionist', $nav);
 echo $nav;
 
$br='<br/>';
#----------------------------------------------------
# expressions
#----------------------------------------------------
                    
echo "expressions:".$br;

//5 is an expression
$x = 5;

//y is an expression of x 
$y = $x;

// Anything after assignment or = is an expression


$z = $x === $y;

$z1 = $x+$y;

    //this part in brackets $x <= 10 is an express
if ($x <= 10) {
   
    echo 'do something';  
}
        
        
#----------------------------------------------------
# operators
#----------------------------------------------------

# 1. Maths 
# (+ - * / % **)
# 
#-------------
# 2. Assignment
# (= += -= *= /= %= **=)

##-------------
# 3. String operators
# . .=
$x='a';
$x = $x.'|b';
// simplified
$x .= '|b';

#-------------
# 4. comparison Operators
# == === != <> !== <==> ?? ?:

//Strict data type + value
$z = $x === $y;
$z1 = $x != $y;

$x="Hello";
$y=strpos($x,'H');

if ($y == false) {
    echo "H Not found";
} else {
    echo "H found at index: ".$y;
}
        
if ($y === false) {
    echo "H Not found";
} else {
    echo "H found at index: ".$y;
}
$result = $y === false ? "H Not found" : "H found at index: ".$y;
echo $result;

$x=null;
//If x is null set y = hello otherwise y = x 
$y= $x ?? 'hello';
//same as undefined 
$y= $z ?? 'hello';



#-------------
# 5. Error type operators
# @

$x = file('nonexistent.txt');

//This will remove error warning don't use this 
$x = @file('nonexistent.txt');


#-------------
# 6 Increment / Decrement operators
# ++ --
$X=2;
//return value then increment / decrement
$x++;
$x--;

//increment / decrement then return value
++$x;
--$x;

echo $x++;
echo "X incremented: ". $x;
echo "vs ".++$X;
        

#-------------
# 7 Logical operators
# && || ! and or xor 
$x=false;
$y=true;
if (!x && $y) {
    echo "both true";
}


#-------------
# 8 Bitwise operators
# & | ^ ~ << >>
# for binary calc
$x=3;
$y=5;
$z = $x & $y;
$z = $x >> $y;


#-------------
# 8 Array operators
# ( + == === != <> !==)
$x=[3,4,5];
$y=[5,6,7];
$z=$x+$y;

$x=['a'=>3,'b'=>4,'c'=>5];
$y=['b'=>4,'c'=>5,'a'=>3];

echo $x==$y;
echo $x===$y;


#9 Execution operator 
# ``  `doSomething`

#10 Type operator 
# instanceof

#11 Nullsafe operator 
# PHP8 ?


        

?>

