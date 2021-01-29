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
    <h1 class="show-ttl">DETAILS</h1>
    
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
        <ul>
            <?php foreach($errors as $error): ?>
            <li><?= $error ?></li><br/>
            <?php endforeach; ?>
        </ul>
    </div>
    <form class="comment-form" action="comment.done.php" method="post">
        <span>name</span>
        <div><input class="comment-form-name" type="text" name="name"></div>
        
        <span>comment</span>
        <div><input class="comment-form-message" type="text" name="message"></div>
        <br/>
        <input type="hidden" name="id" value="<?= $code ?>">
        <input class="comment-btn" type="submit" value="REPLY">
    </form>
    <div class="comment-inner">
        <?php foreach($comments as $comment): ?>
        <div class="comment-box">
            <div class="comment-box-top">
                <spam class="comment-id"><?= $comment['id']; ?></spam>
                <span class="comment-name"><?= $comment['name']; ?></span>
            </div>
            
            <div class="comment-message">
                <div class="comment-icon">
                    <img src="comment_user.png">
                </div>
                <div class="comment-talk">
                    <div class="comment-says">
                        <p><?= $comment['message']; ?></p>
                    </div>
                </div>
            </div>
            
            <div class="comment-date">
                <?= $post->created_at ?>
            </div>
        </div>   
        <?php endforeach; ?>
    </div>
    <div class="home-btn">
        <a href="index.php"><img src="home.png"></a>
    </div>
    
    
    <script src="jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="main.js"></script>

</body>
</html>

