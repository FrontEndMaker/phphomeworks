<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>ДЗ</title>

    <link href="css/style.css" rel="stylesheet">

</head>

<body>
    <h1>Комментарии</h1>
    <?php include_once __DIR__."/../app/bootstrap.php"; ?>
    <?php include_once __DIR__."/../app/controller.php"; ?>

    <div class="row marketing">
        <div class="col-lg-10">
            <?php foreach($comments as $comment){ ?>
            <h4><?= $comment['name'];?></h4>
            <p><?= $comment['comment'];?></p>
            <?php } ?>
        </div>
    </div>

    <div class="col-lg-12">
        <?php include_once __DIR__."/../app/save_form.php"; ?>
        <form method="post">
            <div class="form-group">
                <input class="form-control" name="name" placeholder="Your name">
            </div>
            <div class="form-group">
                <textarea class="form-control" name="comment" rows="3"></textarea>
            </div>
            <button class="btn btn-default">Отправить</button>
        </form>
    </div>

</body>
</html>
