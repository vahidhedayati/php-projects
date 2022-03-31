<?php declare(strict_types=1);

function getFiles(string $dirPath):array {
    $files = [];
    foreach(scandir($dirPath) as $path) {
        if (!is_dir($path)) {
            //continue;
            $files[] = $dirPath.$path;
        }
        //$files[] = $dirPath.$path;
    }
    return $files;
}


function getTransactions(string $fileName, ?callable $transactionHandler=null ):array {
    if (!file_exists($fileName)) {
        trigger_error(' File "'.$fileName.'" not found.', E_USER_ERROR);
    }
    $file = fopen($fileName, 'r');
    fgetcsv($file);
    $transactions=[];
    
    while (($transaction = fgetcsv($file)) !== false) {
        if ($transactionHandler !== null) {
            $transaction = $transactionHandler($transaction);
        }
        $transactions[] = $transaction;
    }
    return $transactions;
}

function extraTransaction(array $transactionRow):array {
    [$date, $checkNumber, $description, $amount] = $transactionRow;
    $amount = (float) str_replace(['$', ','], '', $amount);
    return [
        'date'=> $date,
        'checkNumber'=> $checkNumber,
        'description'=> $description,
        'amount'=> $amount
    ];
}

function calculateTotals(array $transactions):array {
    $totals = ['net'=>0, 'income'=>0,  'expense'=>0];
    foreach ($transactions as $transaction) {
        $totals['net']+=$transaction['amount'];
        $totals[$transaction['amount'] >= 0 ? 'income' : 'expense']+=$transaction['amount'];
        /*    
        if ($transaction['amount']>=0) {
            $totals['income']+=$transaction['amount'];
        } else {
            $totals['expense']+=$transaction['amount'];
        }

        */
    }
    return $totals;
}
 
?>