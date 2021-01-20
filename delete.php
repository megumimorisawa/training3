<?php
    require_once "HumanDAO.php";
    
    $code = $_GET['id'];
        
    HumanDAO::delete($code);
    
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>削除</title>
    <p>削除しました</p>
    
    <a href="index.php">投稿一覧へ</a>
</head>
<body>
    
</body>
</html>