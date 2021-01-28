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
    <h1>投稿の編集</h1>
    
    
    <form action="edit.done.php?id=<?= $post->id ?>" method="post" enctype="multipart/form-data">
    <div>名前</div>
    <div><input type="text" name="name" value="<?= $post->name ?>"></div><br/>
    <div>タイトル</div>
    <div><input type="text" name="title" value="<?= $post->title ?>"></div><br/>
    <div>メッセージ</div>
    <div><input type="text" name="message" value="<?= $post->message ?>"></div><br/>
    <div>現在の画像</div>
    <img src='upload/<?= $post->image ?>'>
    <div><input type="file" name="image"></div><br/>
    
    <input type="button" onclick="history.back()" value="戻る"> 
    <input type="submit" value="更新">   
    </form>
    
</body>
</html>