<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_3-03</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="name" placeholder="名前を入力してください">
        <input type="text" name="comment" placeholder="コメントを入力してください">
        <input type="submit" name="submit" value="投稿">
        <br>
        <input type="text" name="delete" placeholder="削除対象番号を入力">
        <input type="submit" name="submit" value="削除">
    </form>
    
    <?php
    $filename = "mission_3-3.txt";
    if(!empty($_POST["delete"])){
        $delete = $_POST["delete"];
        $lines = file($filename,FILE_IGNORE_NEW_LINES);
        $fp = fopen($filename, "w");
        for($i = 0; $i < count($lines); $i++){
            $line = explode("<>", $lines[$i]);
            $postnum = $line[0];
            if($postnum != $delete){
                fwrite($fp, $lines[$i].PHP_EOL);
            }
        }
        fclose($fp);
        
        $file = fopen($filename, "r");
 
        if($file){
            while ($line = fgets($file)) {
                $str = explode("<>", $line);
                foreach ($str as $lin){
                    echo $lin."\n";
                }
                echo "<br>";
            }
        }
        fclose($file);
    }
    
    
    
    if(!empty($_POST["name"]) && !empty($_POST["comment"])){    

        $name = $_POST["name"];
        $str = $_POST["comment"];
        $date = date("Y/m/d H:i:s");
    
        if(file_exists($filename)){
            $num = count(file($filename)) + 1;
        }else{
            $num = 1;
        }
        
        $comment = $num."<>".$name."<>".$str."<>".$date;
        
        $fp = fopen($filename, "a");
        fwrite($fp, $comment.PHP_EOL);
        fclose($fp);
        echo $comment;
    }
        
    

    
    ?>
    
    
    
</body>
</html> 