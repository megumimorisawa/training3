<?php
    require_once 'Post.php';
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP">
    <link rel="stylesheet" href="new.css">
    <title>新規投稿</title>
</head>
<body>
    <div class="new-post">
        <h1 class="new-post-ttl">NEW POST</h1>
        <ul class="new-post-error">
            <?php foreach($errors as $error): ?>
            <li><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
        <div class="new-post-inner">
            <form action="check.php" method="post" enctype="multipart/form-data">
                <p>name</p>
                <div class="new-post-name"><input type="text" name="name" style="height:25px"></div><br/>
                <p>title</p>
                <div class="new-post-title"><input type="text" name="title" style="height:25px"></div><br/>
                <p>message</p>
                <div class="new-post-message"><input type="text" name="message" style="height:25px;width:40%"></div><br/>
                <p>image</p>
                <div class="new-post-image"><input type="file" name="image" style="width:400px"></div><br/>
                <br/>
                <input class="back-btn" type="button" onclick="history.back()" value="BACK">
                <input class="post-btn" type="submit" value="POST">
            </form>
        </div>
    </div>
</body>
</html>
    
    

    