<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_2-04</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="text" placeholder="おめでとう！by （メンバー名）">
        <input type="submit" name="submit" value="送信">
    </form>
    <?php
        $text = filter_input(INPUT_POST,"text");
        $text = $_POST["text"];
        $filename = "mission_2-4.txt";
        $fp = fopen($filename, "a");
        fwrite($fp, $text.PHP_EOL);
        fclose($fp);
        $lines = file($filename);
    
    ?>
    
    <ul>
        <?php foreach ((array)$lines as $text) : ?>
            <li><?php echo $text; ?></li>
        <?php endforeach ; ?>
    </ul>
</body>
</html> 