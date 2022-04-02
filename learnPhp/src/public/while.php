<?php
###############################################
#1 while
$i=0;
while ($i < 15) {
    echo $i;
    $i++;
}
$i=0;
while (true) {
    while ($i >10) {
        break 2;
    }
    if ($i>15) {
        break;
    }
    $i++;
    //if ($i % 2 ===0) {
      //  continue;
        //this will miss the i++ below
        //inifinite loop
    //}
   // $i++;
}


$i=0;
while ($i < 15):
    if ($i % 2 ===0) {
       $i++;
        continue;
    }
    echo $i++.',';
    //$i++;
endwhile;

###############################################
# 2 do while

//it will still execute before it gets to while even though value 
//is out of while remit
$i=25;
do {
    echo $i++.',';
}while($i<=15);


###############################################
# 3 for
$arrayT=['a','b','c','d'];
for ($i=0, $length=count($arrayT); $i < $length; $i++) {
    echo $arrayT[$i];
}


###############################################
# 4 foreach
foreach($arrayT as $entry) {
    echo $entry."<br>";;
}

foreach($arrayT as $key=>$entry):
    echo $entry ."+ ".$key."<br>";
endforeach;

echo "-- {$entry}";

unset($entry);

$user = ['name'=>'a', 'age'=>'15', 'skills'=>['surfing', 'sleeping', 'reading']];
foreach ($user as $key=>$value) {
    echo $key." ".json_encode($value)."<br>";
    //or
    if (is_array($value)) {
        echo "...".implode('<br>',$value)."---<br>";
        foreach ($value as $skill) {
            echo "--> ".$skill."<br>";
        }
    } else {
        echo "$value";
    }
}
 
$status="1";
//switch = == double equals
switch($status) {
    case 1:
        echo "release";
        break;
     case 2:
        echo 'outstanding';
        //break;
        continue;// '2';
    case 3:
        echo 'done';
        break;
   
    
    default:
        echo "do something else";

}

//match ==== triple equal has to find it.

//Version 8 
/*
$status='1';
$finalStatus = match($status) {
    1=>'outstanding',
    2,3=>'release',
    4=>'done'
};

echo $finalStatus;
  */      
            

function sum(int $x, int $y){
    return $x+$y;
}

echo $sum(1,2);
echo "hello";

//return;
//echo "will not execute if return above unreachable statement";
function onTick() {
    echo "Tick<br>";
}
register_tick_function('onTick');
declare(ticks=3);
$i=0;
$length=10;
while ($i < $length) {
    echo $i."--<br>";
}
?>