<?php
    $str = "Hello World";
    $filename="mission_1-24.txt";
    $fp = fopen($filename,"a");
    fwrite($fp, $str.PHP_EOL);
    fclose($fp);
    echo "書き込み成功！"."<br>";
    
    if(file_exists($filename)){
        $lines = file($filename, FILE_IGNORE_NEW_LINES);
        foreach($lines as $line){
            echo $line . "<br>";
        }
    }
?>