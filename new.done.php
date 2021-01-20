<?php
    require_once "HumanDAO.php";
    session_start();
    
    $human = $_SESSION['human'];
    
    $human = HumanDAO::insert($human);
    

    
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

