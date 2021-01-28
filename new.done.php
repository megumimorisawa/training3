<?php
    require_once "PostDAO.php";
    session_start();
    
    $post = $_SESSION['post'];
    
    $post = PostDAO::insert($post);
    

    
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>完了</title>
</head>
<body>
    <h1>投稿しました</h1>
    
    <a href="index.php">投稿一覧へ</a>
    
</body>
</html>

