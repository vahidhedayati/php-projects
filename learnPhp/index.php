<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php include 'layout/nav.php';?>
        
        <?php echo "hello world";?>
        <br/>
        <?=  "hello world 2";?>
        <br/>
        <?php
        // put your code here
        
            echo('echo hello');
            print 'print hello';
            echo print 'print hello';

            echo('echo hello');
            echo 'echo', '-',' hello';

            $name="fred";
            echo $name;

            // Not allowed
            // $this = ''

            $x=1;
            $y=$x;
            $x=3;
            echo $y;

            $x=1;
            //By reference now value changes
            $y=&$x;

            $x=3;
            echo $y;

            $firstName="fred";
            echo "hello $firstName vs correctly way hello {$firstName}";
            //or
            echo 'hello ', $firstName;
           
            echo '<p>'.$x . ",". $y.'</p>';
            
            //constant 
            define('USERNAME','fred');
            //USERNAME='jo';
            echo USERNAME;
            
            echo defined('USERNAME');
            
            //method 2 of constants 
            const USER = 'fred';
            echo USER;
                    
            if (true) {
                //const not possible in control structure  
                //const USER1 = 'fred';
                define('USERNAME1','fred');
            }
            
            echo '<p></p>';
            
            //dynamic constants 
            $foo ='BAR';
            define('STATUS_'.$foo,'STATUS_BAR is the current define constant');
            
            echo STATUS_BAR;
            
            echo PHP_VERSION;
           
            echo "Magic Constants";
            echo __FILE__;
            echo __LINE__;
              echo '<p></p>';
              
            //variable variable
            $food='beans';
            $$food='kidney_beans';
            //$bar='baz';
            //
           echo $food." - ".$beans;
           //another way to do above
           echo "$food , $$food vs {$$food} vs ${$food} ";
           
           echo $food." - ".$$food;
                   
            //echo 
                    
        ?>
    </body>
</html>
