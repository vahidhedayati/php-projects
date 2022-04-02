<?php declare(strict_types=1);
 ob_start();
 include 'layout/nav.php';
 $nav = ob_get_clean();
 $nav = str_replace('Types', 'Ahha types', $nav);
 echo $nav;
   //         ini_set('display_errors', "1");
            
            function sum2(int $a, int $b) {
                return $a+b;
            }
            $result4= sum2(1,2);
            //$result4= sum2(1,'2');
            echo $result4;
            
?>
