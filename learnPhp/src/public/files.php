<?php

//include 'somefile.php';


//this falls over if file does not exist
//require 'somefile.php';
echo "--------------<br>";
$x=5;
require_once 'hello.php';
$x++;
echo "$x";
require_once 'hello.php';
echo "$x";

echo "--------------<br>";
$x=5;
require 'hello.php';
$x++;
echo "$x";
require 'hello.php';
echo "$x";

$y = include 'hello.php';
$w = require 'hello.php';
        
?>