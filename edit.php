<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>個別編集</title>
</head>
<body>
    <h1>投稿の編集</h1>
</body>
</html>

<?php
    require_once "HumanDAO.php";
    $code = $_GET['id'];
    $human = HumanDAO::start_update($code);
?>


    

    