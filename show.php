<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>詳細表示</title>
</head>
<body>
    <h1>詳細</h1>

<?php
    require_once "HumanDAO.php";
     
    $code = $_GET['code'];
    $human = HumanDAO::get_human_by_id($code);
?>

<br/>
<br/>
<input type="button" onclick="history.back()" value="投稿一覧へ">

</body>
</html>

