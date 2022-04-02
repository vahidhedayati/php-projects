<?php 
 
            # 1. Scalar Types
            # boolean, integer, float, string
           
            #----------------------------------------------------
            # boolean
            #---------------------------------------------------- 
            echo "<p></p>";
        
            $someBoolean = true;
            $isBool = is_bool($someBoolean);
            echo "Is it a boolean? ". $isBool+' - '.var_dump($isBool);
            
            #----------------------------------------------------
            # integer
            #----------------------------------------------------
                       
            $someNumber = 2;
            $max = PHP_INT_MAX;
            $min = PHP_INT_MIN;
            
            $x = 42;
            $y = 0X2A; // = 42 above in hex
            $yy = 055; // octal = 45;
            $biy= 0b11;  //binary = 3
            $underScoreNum = 200_222;
            
            $float = PHP_INT_MAX+1;
            //by taking number above max it changes type
            echo gettype($float);
            
            $isInt =is_int($min);
            echo "Is it an int? ". $isInt.' -> '.var_dump($isInt);
            
            
            #----------------------------------------------------
            # float
            #----------------------------------------------------
            echo "<p></p>";
            $someFloat = 2.0;
            //exponential numbers
            $someFloat1 = 2.0e3;
            $someFloat2 = 2.0e-3;
            $someFloat3 = 12_2000_32.0e-3;
            echo "SomeFloat1 ".$someFloat1;
            $floatMax = PHP_FLOAT_MAX;
            $floatMin = PHP_FLOAT_MIN;
            
            $floorNum = floor((0.1 + 0.7) * 10);
            $ceilNum = ceil((0.1 + 0.7) * 10);
            
            $isFloat =is_float($someFloat);
            echo "Is it an int? ". $isFloat.' -> '.var_dump($isFloat);
            
            $floatMaxInfinite = PHP_FLOAT_MAX * 2;
            $infiniteNum = is_infinite($floatMaxInfinite);
            $isitValidFloat = is_finite($floatMaxInfinite);
            $isNumber = is_nan(log(-1));
            
            
            $x=4;
            //call function
            $floatval=floatval($x);
            //cast
            $floatvalcast=(float)$x;
              
            #----------------------------------------------------
            # string
            #----------------------------------------------------
            echo "<p></p>";
            $someString = 'Freddie';
            
            echo "Hello $someString | Hello  ${someString} | hello {$someString}  ";
            echo "e = ${someString[2]} ||i backwards = ${someString[-2]} ";
            $someString[2]='E';
            $someString[-2]='I';
            echo "Hello $someString ";
            
            
            #Heredoc
            $test = <<< EOF
             line1 $someString \n
                    <div>
                        <p>PPP</p>
                    </div>
             line2
            EOF;
            echo $test;
            echo nl2br($test);
            
            #NowDoc
            $test1 = <<< 'NOWDOC'
             line1 $someString \n
             line2
            NOWDOC;
            echo nl2br($test1);
            
            #----------------------------------------------------
            #----------------------------------------------------
            
            
            #----------------------------------------------------
            # 2 Arrays
            #----------------------------------------------------
            
            
            #----------------------------------------------------
            #----------------------------------------------------
            
            # 3. Compound Types
            # array,object,callable,iterable
            $someArray = [true, false, 1, 1.4, 'Fred'];
            print_r($someArray);
            $someArray2 = array('apple','b','c');
            $b= $someArray2[1];
            $isValueSet = isset($someArray2[1]);
            $isNotValueSet = isset($someArray2[3]);
            $someArray2[1]='cc';
            
            echo '<pre>';
            print_r($someArray2);
            echo '</pre>';
            
            echo "Array size =".count($someArray2);
            
            //push to array
            $someArray2[]='d';
            
            array_push($someArray2, 'e','f','g');
            echo '<pre>';
            print_r($someArray2);
            echo '</pre>';
            
            echo "Array size =".count($someArray2);
            
            $languages = [
                'php'=> [
                            creator =>     'Tom Jones', 
                            versions =>       [
                                [ version=> 1.10, date => '20-2-2022'],
                                [ version=> 1.11, date => '20-2-2023'],
                             ],
                            available =>    true
                        ],
                'python'=>'2.2'
            ];
            $languages['java']='6.5';
            $newLang = 'javaScript';
            $languages[$newLang] = '22.2.0';
               echo '<pre>';
            print_r($languages);
            echo '</pre>';
            
            echo var_dump($languages['php']['versions'][1]);
            echo var_dump($languages[$newLang]);
          
            //increment Number of b onwards in array is 50,51 and so on so newArray[0]=a, newArray[50]=b
            
            $newArray = ['a', 50 => 'b', 60=> 'd','e' ];
            //remove last entry in array
            array_pop($newArray);
            
            // remove first entry in array - this will re-index array 
            // and 50 is no longer key of b but d will keep id of 60
            array_shift($newArray);
            
            //empty entire array
            //unset($newArray)
            
            // Remove a specific element in array or in this 
            // case 2 different items at given positions
            unset($newArray[60],$newArray[1]);
            
            # Using unset method array is not re-indexed so if first entry was removed
            # 50 would still remain id of 50 compared to array_shift which would re-index
                    
                    
            $array3=[1,2,3];
            unset($array3[0], $array3[1],$array3[2]);
            //id will become 3 
            $array3[]=4;
            echo '<pre>';
            print_r($array3);
            echo '</pre>';
            
            $testArrayFromVar = (int)3;
            $testArray = (array)$testArrayFromVar;
            echo '<pre>';
            print_r($testArray);
            echo '</pre>';
            
            $keyArray = ['keyA'=> 'yes', 'keyB'=>null];
            //this tells you if it exists or not
            echo var_dump(array_key_exists('keyA', $keyArray));
            
            //this tells you key exists and is not null
            echo var_dump(isset(keyArray['keyA']));
            
            
            #----------------------------------------------------
            # special types
            #----------------------------------------------------
            
            #special types
            # resource, null
            
            $nullVar = NULL;
            $isNull = is_null($nullVar);
            $isNull1 = $nullVar === null;
            $isNull3 = is_null($undefinedVariable);
            
            $emptyArray = (array) $nullVar;
            
            unset($nullVar);
            $isNull4 = is_null($nullVar);
            
            
            
            
            #----------------------------------------------------
            
            
            echo "<p></p>";
            
            echo gettype($someBoolean).'<br/>';
            echo var_dump($someFloat).'<br/>';
            
            
            
            
            function sum(int $a, int $b) {
                $a=2.5;
                var_dump($a,$b);
                return $a+b;
            }
            $result = sum(1.1,2);
            $result2= sum(1,'2');
            echo $result." - ".$result;
            
            //Cast as integer 
            $x=(int) '4';
            echo gettype($x)
                        
            
?>

