<?php
    require_once "CommentDAO.php";
    session_start();
    
    $name = $_POST['name'];
    $message = $_POST['message'];
    $id = $_POST['id'];
    $comment = new Comment($id, $name, $message);
    $errors = $comment->validate();
    if(count($errors) === 0){
        CommentDAO::insert_comment($comment);
        
    }else {
        $_SESSION['errors'] = $errors;
        header('Location: show.php?id=' . $id);
        exit;
        // var_dump($errors);
    }
    
    
        
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>コメント投稿完了</title>
</head>
<body>
    <p>コメントが投稿されました</p>
    
    <a href="show.php?id=<?= $id ?>">戻る</a>
    
</body>
</html>
        
           
         