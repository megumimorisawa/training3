<?php
    require_once 'HumanDAO.php';
    
    $name = $_POST['name'];
    $title = $_POST['title'];
    $mes = $_POST['message'];
    $image = $_FILES['image'];
    $code = $_POST['id'];
    

    HumanDAO::update($code, $name, $title,$mes,$image);

    ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>詳細更新</title>
</head>
<body>
    <p>更新しました。</p>
    
    <a href="index.php">投稿一覧へ</a>
    
</body>
</html>