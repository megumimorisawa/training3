<?php
    
    require_once "PostDAO.php";
    
    $code = $_GET['id'];
    $post = PostDAO::get_post_by_id($code);
    
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP">
    <link rel="stylesheet" href="edit.css">
    <title>個別編集</title>
</head>
<body>
    <div class="edit">
        <h1 class="edit-ttl">EDIT</h1>
        <div class="edit-form">
            <form action="edit.done.php?id=<?= $post->id ?>" method="post" enctype="multipart/form-data">
            <p>name</p>
            <div class="edit-name"><input type="text" name="name" value="<?= $post->name ?>" style="height:25px"></div><br/>
            <p>title</p>
            <div class="edit-title"><input type="text" name="title" value="<?= $post->title ?>" style="height:25px"></div><br/>
            <p>message</p>
            <div class="edit-message"><input type="text" name="message" value="<?= $post->message ?>" style="height:25px;width:40%"></div><br/>
            <p>now image</p>
            <img src='upload/<?= $post->image ?>'>
            <p>new image</p>
            <div class="edit-image"><input type="file" name="image"></div><br/>
            
            <input class="back-btn" type="button" onclick="history.back()" value="戻る"> 
            <input class="update-btn" type="submit" value="更新">   
            </form>
        </div>
    </div>
    
</body>
</html>