<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>producto index</h1>
   <ul>
    <?php

    foreach($data as $key => $value){
        if (!is_array($value)) {
            
            echo "<li>$key : $value</li>";
        }
        //echo "<li>$key : $value</li>";
       /* if (condition) {
            # code...
        }*/
       // echo "$key : $value";echo "<br>";


        if(is_array($value)){
            foreach($value as $key2 => $value2){
                echo "$key2 : $value2";echo "<br>";
            }
            echo "<br>";
        }
    }
    ?>
    
   </ul>
   <h1><?php echo $name?></h1>
   <h1><?php echo $arreglo['nombre2']?></h1>
    
    
</body>
</html>

<?php
echo "<pre>";
print_r($data);
?>