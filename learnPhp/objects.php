<?php

$str='{"a":1,"b":2, "c":3  }';
//$arr = json_decode($str, true);
$arr = json_decode($str);
var_dump($arr->a);

$obj = new \stdClass();
$obj->a=1;
$obj->b=2;

$arr = [1,2,3,];
$object = (object) $arr;
var_dump($object->{1});

$object2 = (object) 1;
var_dump($object2->scalar);

?>