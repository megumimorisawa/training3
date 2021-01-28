<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap">
    <link rel="stylesheet" href="index.css">
    <title>投稿一覧</title>
</head>
<body>
    <section class="header">
        <div class="header-inner">
            <h1 class="header-ttl">HOME</h1>
        </div>
    </section>
    
    <section class="now">
        <div class="now-inner">
            <img class="now-img"src="profile_icon.png" style="width:60px;height:60px"></img>
            <p class="now-ttx">今どうしてる？</p>
            <a class="now-btn" href="new.php">POST</a>
        </div>
    </section>
    
    <section class="main">
        <div class="main-inner">
        <?php foreach($posts as $post): ?>
        <div class="main-box">
            <div class="main-box-top">
                <a class="main-id" href='show.php?id=<?= $post->id ?>'><?= $post->id ?></a>　
                <span class="main-name"><?= $post->name ?></span>　
                <span class="main-title">「<?= $post->title ?>」</span>
            </div>
            
            <div class="main-message">
                <div class="main-icon">
                    <img src="user_icon.png">
                </div>
                <div class="main-talk">
                    <div class="main-says">
                        <p><?= $post->message ?></p>
                    </div>
                </div>
            </div>
            
            <div class="main-img">
                <img src='upload/<?= $post->image ?>'>
            </div>
            
            <div class="main-date">
                <?= $post->created_at ?>
            </div>
        </div>
        <?php endforeach; ?>
        </div>
    </section>
</body>
</html>
