<?php declare (strict_types=1);
$DS=DIRECTORY_SEPARATOR;
$root = dirname(__DIR__).$DS.proceduralProject.$DS;

define('APP_PATH', $root.'app'.$DS);
define('FILE_PATH', $root.'files'.$DS);
define('VIEW_PATH', $root.'views'.$DS);
        
require APP_PATH.'MainApp.php';
require APP_PATH.'Helper.php';

$files = getFiles(FILE_PATH);

$transactions=[];
foreach($files as $file) {
    $transactions = array_merge($transactions, getTransactions($file, 'extraTransaction'));
}

$totals = calculateTotals($transactions);


require VIEW_PATH.'transactions.php';

?>