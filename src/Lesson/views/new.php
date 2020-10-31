<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>読書ログの登録</title>
    <link rel="stylesheet" href="../vendor/twbs/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="stylesheets/css/app.css">
</head>

<body>
    <header>
        <h1>読書ログ</h1>
    </header>
    <div class="container">
        <h1 class="h2 text-dark mt-4 mb-4">読書ログの登録</h1>
        <form action="create.php" method="POST">
            <!-- ここにエラー処理 begins-->
            <?php if (count($errors)) : ?>
                <ul class="alert alert-danger ml-4" role="alert">
                    <?php foreach ($errors as $error) : ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            <!-- ここにエラー処理 ends-->
            <div class="form-group">
                <label for="title">書籍名</label>
                <input type="text" name="title" id="title" class="form-control" value="<?php echo $review['title'] ?>">
            </div>
            <div class="form-group">
                <label for="author">著者名</label>
                <input type="text" name="author" id="author" class="form-control" value="<?php echo $review['author'] ?>">
            </div>
            <div class="form-group">
                <label>読書状況</label>
                <div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="status" id="status1" value="未読" <?php echo ($review['status'] === '未読' ? 'checked' : '') ?>>
                        <label for="status1">未読</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="status" id="status2" value="読んでる" <?php echo ($review['status'] === '読んでる' ? 'checked' : '') ?>>
                        <label for="status2">読んでる</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="status" id="status3" value="読了" <?php echo ($review['status'] === '読了' ? 'checked' : '') ?>>
                        <label for="status3">読了</label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="rating">評価（5点満点の整数）</label>
                <input type="number" name="rating" id="rating" class="form-control" value="<?php echo $review['rating'] ?>">
            </div>
            <div class="form-group">
                <label for="comment">感想</label>
                <textarea type="text" name="comment" id="comment" rows="10" class="form-control" value="<?php echo $review['comment'] ?>"></textarea>
            </div>
            <button type="submit" class="btn btn-primary mt-4">登録する</button>
        </form>
    </div>
</body>

</html>
