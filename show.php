<?php
    require_once "PostDAO.php";
    require_once "CommentDAO.php";
    session_start();
    
    $errors = $_SESSION['errors'];
    $_SESSION['errors'] = null;
    
    $code = $_GET['id'];
    $post = PostDAO::get_post_by_id($code);
    
    $comments = CommentDAO::get_all_comments($code);
    
?>    

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP">
    <link rel="stylesheet" href="show.css">
    <title>詳細表示</title>
</head>
<body>
    <h1 class="show-ttl">Post Details</h1>
    
    <div class="show">
        <div class="show-box">
            <div class="show-top">
                <span class="show-name"><?= $post->name ?></span>　
                <span class="show-title">「<?= $post->title ?>」</span>
            </div>
                    
            <div class="show-message">
                <div class="show-icon">
                    <img src="user_icon.png">
                </div>
                <div class="show-talk">
                    <div class="show-says">
                        <p><?= $post->message ?></p>
                    </div>
                </div>
            </div>
            <img src='upload/<?= $post->image ?>'>
            <div class="show-date"><?= $post->created_at ?></div>
        </div>
    </div>
    <div class="show-btn">
        <a class="edit-btn" href='edit.php?id=<?= $post->id ?>'><img src="edit.png"></a>
        <a class="delete-btn" href='delete.php?id=<?= $post->id ?>'><img src="delete.png"></a>
    </div>
    
    <h2 class="comment-ttl">COMMENTS</h2>
    <div class="comment-error">
        <?php foreach($errors as $error): ?>
        <?= $error ?><br/>
        <?php endforeach; ?>
    </div>
    
    <?php foreach($comments as $comment): ?>
    <?= $comment['id']; ?>　<?= $comment['name']; ?><br/>
    <br/>
    <?= $comment['message']; ?><br/><br/>
    <?= $comment['created_at']; ?><br/>
    <hr/>
    <?php endforeach; ?>
    
    <br/>
    <br/>
    <form class="comment-form" action="comment.done.php" method="post">
        <span>name</span>
        <div><input type="text" name="name"></div>
        
        <span>comment</span>
        <div><input type="text" name="message"></div>
        <br/>
        <input type="hidden" name="id" value="<?= $code ?>">
        <input type="submit" value="コメントを投稿">
    </form>
    <br/>
    <br/>
    <a href="index.php">HOME</a>
    
    

</body>
</html>

