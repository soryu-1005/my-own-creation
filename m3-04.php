<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_3-04</title>
</head>
<body>
    
    
    <?php
    $filename = "mission_3-4.txt";
    
    //投稿処理
    if(!empty($_POST["name"]) && !empty($_POST["comment"])){    

        $name = $_POST["name"];
        $str = $_POST["comment"];
        $date = date("Y/m/d H:i:s");
        
        //editがないとき新規投稿処理
        if(empty($_POST["edit"])){
            if(file_exists($filename)){
                $num = count(file($filename)) + 1;
            }else{
                $num = 1;
            }
        
            $comment = $num."<>".$name."<>".$str."<>".$date;
        
            $fp = fopen($filename, "a");
            fwrite($fp, $comment.PHP_EOL);
            fclose($fp);
        }else{
            //編集機能
            $edit = $_POST["edit"];
            $lines = file($filename);
            $com = $edit."<>".$name."<>".$str."<>".$date;
            $fp = fopen($filename, "w");
            foreach($lines as $line){
                $lin = explode("<>", $line);
                if($lin[0] == $edit){
                    fwrite($fp, $com.PHP_EOL);
                }else{
                    fwrite($fp, $line);
                }
            }
            fclose($fp);
        }    
    }
        
    //削除処理
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
        
    }
    
    //編集選択
    if(!empty($_POST["edit"])){
        $edit = $_POST["edit"];
        $lines = file($filename,FILE_IGNORE_NEW_LINES);
        foreach ($lines as $line){
            $lin = explode("<>", $line);
            if($edit == $lin[0]){
                $editnum = $lin[0];
                $editname = $lin[1];
                $editcomment = $lin[2];
            }
        }
    }
    
    
    ?>
    
    <form action="" method="post">
        <input type="text" name="name" placeholder="名前を入力してください" value=<?php  if(!empty($editname)){echo $editname;} ?>>
        <br>
        <input type="text" name="comment" placeholder="コメントを入力してください" value=<?php if(!empty($editcomment)) {echo $editcomment;} ?>>
        <input type="submit" name="submit" value="投稿">
        <input type="hidden" value="<?php echo "{$_POST['edit']}" ?>" name="blank">
        <br>
        <input type="text" name="delete" placeholder="削除対象番号を入力">
        <input type="submit" name="submit" value="削除">
        <br>
        <input type ="text" name="edit" placeholder="編集対象番号を入力" value=<?php if(!empty($editnum)) {echo $editnum;} ?>>
        <input type="submit" name="submit" value="編集">
    </form>
    
    <?php
 
    if(file_exists($filename)){
            $file = fopen($filename, "r");
            while ($line = fgets($file)) {
                $str = explode("<>", $line);
                foreach ($str as $lin){
                    echo $lin."\n";
                }
                echo "<br>";
            }
        fclose($file);
    }
 
    
    ?>
    
</body>
</html> 