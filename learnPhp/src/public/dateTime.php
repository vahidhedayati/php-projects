<?php
$br="<br>";
$currentTime = time();

echo "$currentTime".$br;
$nextWeek = $currentTime + 7 * 24 * 60 * 60;
$yesterday = $currentTime -24 * 60 * 60 ;
//echo date_timezone_set( date('d/m/Y g:ia', $yesterday), 'GMT');
echo date_default_timezone_get().$br;
echo date('d/m/Y g:ia', $yesterday).$br;
echo date('d/m/Y g:ia', $currentTime).$br;
echo date('d/m/Y g:ia', $nextWeek).$br;


date_default_timezone_set('UTC');
echo date_default_timezone_get().$br;
echo date('d/m/Y g:ia', $yesterday).$br;
echo date('d/m/Y g:ia', $currentTime).$br;
echo date('d/m/Y g:ia', $nextWeek).$br;
        
?>