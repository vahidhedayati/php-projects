<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php $score=50 ?>
        <?php if ($score>90): ?>
        <strong style="color: red;">A</strong>
        <?php elseif ($score>80): ?>
        <strong style="color: green;">B</strong>
        <?php elseif ($score>40): ?>
        <strong style="color: orange;">C</strong>
        <?php else: ?>
        <strong style="color: blue;">D</strong>
        <?php endif ?>
        
            <?php 
                   if ($score>20) {
                       echo "Hello";
                   } else {
                       echo "GoodBye";
                   }
            
            ?>
        
    </body>
</html>