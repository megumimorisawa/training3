<?php
    require_once 'human.php';
    session_start();
    
    $errors = array();

    if($_SESSION['errors'] !== null){
        $errors = $_SESSION['errors'];
        $_SESSION['errors'] = null;
    }

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>新規投稿</title>
</head>
<body>
    <h1>新規投稿</h1>
    <ul>
        <?php foreach($errors as $error): ?>
            <li><?= $error ?></li>
        <?php endforeach; ?>
        </ul>
    <form action="check.php" method="post" enctype="multipart/form-data">
        名前
        <div><input type="text" name="name"></div><br/>
        タイトル
        <div><input type="text" name="title"></div><br/>
        メッセージ
        <div><input type="text" name="message"></div><br/>
        画像
        <div><input type="file" name="image" style="width:400px"></div><br/>
        <br/>
        <input type="button" onclick="history.back()" value="戻る">
        <input type="submit" value="投稿">
    </form>
</body>
</html>
    
    

    