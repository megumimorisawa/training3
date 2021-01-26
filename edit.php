<?php
    
    require_once "HumanDAO.php";
    
    $code = $_GET['id'];
    $human = HumanDAO::get_human_by_id($code);
    
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>個別編集</title>
</head>
<body>
    <h1>投稿の編集</h1>
    
    
    <form action="edit.done.php?id=<?= $human->id ?>" method="post" enctype="multipart/form-data">
    <div>名前</div>
    <div><input type="text" name="name" value="<?= $human->name ?>"></div><br/>
    <div>タイトル</div>
    <div><input type="text" name="title" value="<?= $human->title ?>"></div><br/>
    <div>メッセージ</div>
    <div><input type="text" name="message" value="<?= $human->message ?>"></div><br/>
    <div>現在の画像</div>
    <img src='upload/<?= $human->image ?>'>
    <div><input type="file" name="image"></div><br/>
    
    <input type="button" onclick="history.back()" value="戻る"> 
    <input type="submit" value="更新">   
    </form>
    
</body>
</html>