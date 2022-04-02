<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require_once 'Transaction.php';
        $transaction = (new Transaction(15.0,'ahh'))->addTax(5.2)->discount(1.0);
        $transaction1 = (new Transaction(12.0,'ahh'))->addTax(6.2)->discount(2.0);
        
        //$transaction = new Transaction(15.0,'ahh');
        //$transaction->addTax1(12.2);
        //$transaction->discount1(12.0);
        
        
        var_dump($transaction->getAmount(), $transaction1->getAmount());
        ?>
    </body>
</html>
