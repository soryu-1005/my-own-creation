<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_2-01</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="comment" placeholder="コメント">
        <input type="submit" name="submit">
    </form>
    <?php
    $comment = filter_input(INPUT_POST,"comment");
    if(!empty($comment)){
        $comment = $_POST["comment"];
        echo $comment. "受け付けました";
    }    
    ?>
</body>
</html> 