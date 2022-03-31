<?php
require 'PrettyPrintArray.php';
  
$x = [1,2,3];

prettyPrint($x);

$y = ['a'=>1, 'b'=>2, 'c'=>3, 'd'=>4, 'e'=>5, 'f'=>6 ];
prettyPrint($y);

prettyPrint(array_chunk($y, 2));
prettyPrint(array_chunk($y, 2, true));


$a= ['a','b','c'];
prettyPrint(array_combine($a, $x));

echo "array filter";

$array=[1,2,3,4,5,6,7,8,9,10];
prettyPrint(array_filter($array, fn($number) => $number % 2 === 0 ));
//prettyPrint(array_filter($array, fn($number, $key) => $number % 2 === 0. ARRAY_FILTER_USE_BOTH));
prettyPrint(array_values(array_filter($array, fn($number) => $number % 2 === 0 )));
//$even = array_filter($array, fn($number) => $number % 2 === 0 );


echo "array map";
prettyPrint(array_map(fn($number)=> $number *2, $array));

prettyPrint(array_map(fn($number, $number2)=> $number * $number2, $y,$y));


echo "array merge";
$c=[1,2,3];
$d=[4,5,6];
$e=[7,8,'x'=> 9];
prettyPrint(array_merge($c,$d,$e));


$invoiceItems=[
    ['price'=> 9.99, 'title'=>'logo1', 'id'=> 4, 'qty'=>2],
    ['price'=> 4.99, 'title'=>'logo2', 'id'=> 3, 'qty'=>4],
];

$total = array_reduce($invoiceItems, fn($sum, $item)=> $sum += $item['price'] * $item['qty']);      

echo "total ${total}";
echo "<br>";
$total = array_reduce($invoiceItems, fn($sum, $item)=> $sum += $item['price'] * $item['qty'], 100);      
echo "with an existing sum of 100 = new total ${total}";
echo "<br>";

prettyPrint($a);
$arraySearchFind = array_search('b', $a);
echo "arraySearchFind for b =".$arraySearchFind;
  echo "<br>";      
if (!in_array('x', $a)) {
    echo "x no found in array";
}
 

$a1 = ['a'=>1, 'b'=>2, 'c'=>3, 'd'=>4, 'e'=>5, 'f'=>6 ];
$a2 = ['d'=>4, 'j'=>7, 'h'=>3, 'i'=>6,  'k'=>8, 'l'=>9 ];
$a3 = ['m'=>3, 'n'=>9, 'o'=>10];
  echo "<br>";
    echo "<br>";
echo "array diff";
prettyPrint(array_diff($a1,$a2,$a3));
prettyPrint(array_diff_assoc($a1,$a2,$a3));
prettyPrint(array_diff_key($a1,$a2,$a3));
echo "array sort";
prettyPrint($a2);
asort($a2);
prettyPrint($a2);
ksort($a2);
prettyPrint($a2);

usort($a2, fn($a, $b)=> $b<=>$a);
prettyPrint($a2);

$array = [1,2,3,4];
[$a,$b,$c,$d]=$array;
echo "- $a ${b} ${c}";

$array = [1,2,[3,4]];
[$a,$b,[$c,$d]]=$array;
echo "- $a ${b} ${c}";


$array = [1,2,3,4];
[1=>$a,4=>$b,6=>$c,8=>$d]=$array;
echo "- $a ${b} ${c}";

?>

