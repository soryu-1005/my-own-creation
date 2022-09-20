<?php
 for ($i = 0; $i < 100; $i++){
     if($i % 3 ==0 && $i % 5 == 0){
         echo"FizzBuzz"."<br>";
     }elseif($i % 3 == 0){
         echo"Fizz"."<br>";
     }elseif($i % 5 == 0){
         echo"Buzz"."<br>";
     }else{
         echo"$i"."<br>";
     }
 }
?>