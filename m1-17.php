<?php
 $num = 8;
 if($num % 3 == 0 && $num % 5 == 0){
     echo"Fizzbuzz"."<br>";
 }elseif($num % 3 == 0){
     echo"Fizz"."<br>";
 }elseif($num % 5 == 0){
     echo"Buzz". "<br>";
 }else{
     echo "$num" . "<br>";
 }
?>
