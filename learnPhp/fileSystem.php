<?php
require 'PrettyPrintArray.php';
//mkdir('test/1/2', recursive: true );

mkdir('test/1/2', 0777, true );
sleep(1);
rmdir('test/1/2');
rmdir('test/1');
sleep(1);
rmdir('test');

$welcome = <<< EOF
hi there, 
this is a file with multiple lines
line 3 of the file is this line
our last line now
EOF;    

$filename='text.txt';
if (file_exists($filename)) {
    file_put_contents($filename,$welcome );
    clearstatcache();
    echo filesize($filename);
} else {
    echo "file ${filename} not found ";
}

if (!file_exists($filename)) {
    echo "file ${filename} not found ";
    return;
}

$file = fopen($filename, 'r');

while (($line = fgets($file))!== false) {
    echo $line."<br>";
}
fclose($file);


// Write to file
//fwrite($stream, $filename)
// get CSV 
//fgetcsv($stream)

$content = file_get_contents($filename);
echo "----".$content;
        
//$content2 = file_get_contents($filename, offset; 3, length: 2);
//echo "----".$content;
 
copy($filename, 'text1.txt');
sleep(2);
rename('text1.txt', 'text2.txt');
// To remove file
sleep(2);
unlink('text2.txt');


prettyPrint(pathinfo($filename));
        
        
?>
