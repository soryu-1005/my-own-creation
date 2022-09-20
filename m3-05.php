<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_3-05</title>
</head>
<body>
    <h1>現在やっているミッション</h1>
    
    <?php
    $commentfile = "mission_3-5_comment.txt";
    $passfile = "mission_3-5_pass.txt";
    //投稿処理
    if(!empty($_POST["name"]) && !empty($_POST["comment"])){    

        $name = $_POST["name"];
        $str = $_POST["comment"];
        $date = date("Y/m/d H:i:s");
        $pass = $_POST["pass"];
        
        //editがないとき新規投稿処理
        if(empty($_POST["edit"])){
            if(!empty($_POST["pass"])){
                if(file_exists($commentfile)){
                    $num = count(file($commentfile)) + 1;
                }else{
                    $num = 1;
                }
            
            $data = $num."<>".$name."<>".$str."<>".$date;
        
            $fp = fopen($commentfile, "a");
            fwrite($fp, $data.PHP_EOL);
            fclose($fp);
                
            $fp1 = fopen($passfile, "a");
            $pas = $num."<>".$pass;
            fwrite($fp1, $pas.PHP_EOL);
            fclose($fp1);
            }
        }else{
            //編集機能
            $edit = $_POST["edit"];
            $lines = file($commentfile);
            $com = $edit."<>".$name."<>".$str."<>".$date;
            $fp = fopen($commentfile, "w");
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
    if(!empty($_POST["delete"]) && !empty($_POST["delpass"])){
        $delete = $_POST["delete"];
        $delpass = $_POST["delpass"];
        $dellines = file($commentfile, FILE_IGNORE_NEW_LINES);
        $paslines = file($passfile,FILE_IGNORE_NEW_LINES);
        $fp = fopen($commentfile, "w");
        $fp1 = fopen($passfile, "w");
        $flg = 0;
        //パスワードファイル
        for($i = 0; $i < count($paslines); $i++){
            $pasline = explode("<>", $paslines[$i]);
            if($pasline[0] == $delete && $pasline[1] == $delpass){
                $flg = 1;
            }
        }
        //投稿リスト
        for($j = 0; $j < count($dellines); $j++){
            $delline = explode("<>", $dellines[$j]);
            if($flg == 1){
                if($delline[0] != $delete){
                    fwrite($fp, $dellines[$j].PHP_EOL);
                    fwrite($fp1, $paslines[$j].PHP_EOL);
                }
            }
        }
        fclose($fp1);
        fclose($fp);
    }
    
    //編集選択
    if(!empty($_POST["edit"]) && !empty($_POST["editpass"])){
        $edit = $_POST["edit"];
        $editpass = $_POST["editpass"];
        $lines = file($commentfile,FILE_IGNORE_NEW_LINES);
        $paslines = file($passfile,FILE_IGNORE_NEW_LINES);
        for($i = 0; $i < count($paslines); $i++){
            $paslin = explode("<>", $paslines[$i]);
            if($paslin[0] == $edit && $paslin[1] == $editpass){
                foreach ($lines as $line){
                    $lin = explode("<>", $line);
                    if($edit == $lin[0]){
                        $editnum = $lin[0];
                        $editname = $lin[1];
                        $editcomment = $lin[2];
                    }
                }
            }
        }
    }
    
    
    ?>
    
    <form action="" method="post">
        <input type="text" name="name" placeholder="名前を入力してください" value=<?php  if(!empty($editname)){echo $editname;} ?>>
        <br>
        <input type="text" name="comment" placeholder="現在やっているミッションを入力してください" value=<?php if(!empty($editcomment)) {echo $editcomment;} ?>>
        <br>
        <input type="password" name="pass" placeholder="パスワードを入力してください">
        <input type="submit" name="submit" value="投稿">
        <br>
        <input type="text" name="delete" placeholder="削除対象番号を入力">
        <br>
        <input type="password" name="delpass" placeholder="パスワードを入力してください">
        <input type="submit" name="submit" value="削除">
        <br>
        <input type ="text" name="edit" placeholder="編集対象番号を入力" value=<?php if(!empty($editnum)) {echo $editnum;} ?>>
        <input type="hidden" value="<?php echo "{$_POST['edit']}" ?>" name="blank">
        <br>
        <input type="password" name="editpass" placeholder="パスワードを入力してください">
        <input type="submit" name="submit" value="編集">
    </form>
    
    <?php
 
    if(file_exists($commentfile)){
            $file = fopen($commentfile, "r");
            while ($line = fgets($file)) {
                $str = explode("<>", $line);
                foreach ($str as $lin){
                    echo $lin;
                }
                echo "<br>";
            }
        fclose($file);
    }
 
    
    ?>
    
</body>
</html> 