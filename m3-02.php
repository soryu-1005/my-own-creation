<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_3-02</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="name" placeholder="名前を入力してください">
        <input type="text" name="comment" placeholder="コメントを入力してください">
        <input type="submit" name="submit" value="投稿">
    </form>
    <?php
    
    if(!empty($_POST["name"]) && !empty($_POST["comment"])){    

        $name = $_POST["name"];
        $str = $_POST["comment"];
        $date = date("Y/m/d H:i:s");
        $filename = "mission_3-2.txt";
    
        if(file_exists($filename)){
            $num = count(file($filename)) + 1;
        }else{
            $num = 1;
        }
        
        $comment = $num."<>".$name."<>".$str."<>".$date;
        
        $fp = fopen($filename, "a");
        fwrite($fp, $comment.PHP_EOL);
        fclose($fp);
        
        $file = fopen($filename, "r");
 
        if($file){
            while ($line = fgets($file)) {
                $str = explode("<>", $line);
                foreach ($str as $lin){
                    echo $lin;
                }
                echo "<br>";
            }
    }
 
    fclose($file);
    }
    

    
    ?>
    
    
    
</body>
</html> 