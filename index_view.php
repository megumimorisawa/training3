<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>投稿一覧</title>
</head>
<body>
    <h1>投稿一覧</h1>
    <a href="new.php">新規投稿</a><br/>
    <br/>
    <?php foreach($humans as $human): ?>
    <a href='show.php?id=<?= $human->id ?>'><?= $human->id ?></a>　<?= $human->name ?>　<?= $human->title ?><br/>
    <br/>
    <?= $human->message ?><br/>
    <img src='upload/<?= $human->image ?>'><br/>
    <?= $human->created_at ?><br/>
    <hr/>
    <?php endforeach; ?>

    
    <br/>
    <br/>
    <br/>
</body>
</html>