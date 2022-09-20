<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_2-02</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="text" placeholder="テキストを入力してください">
        <input type="submit" name="submit" value="送信">
    </form>
    <?php
    $text = filter_input(INPUT_POST,"text");
    if(!empty($text)){
        $text = $_POST["text"];
        $filename = "mission_2-3.txt";
        $fp = fopen($filename, "a");
        fwrite($fp, $text.PHP_EOL);
        fclose($fp);
    }
    ?>
</body>
</html> 