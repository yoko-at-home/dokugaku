<?php
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>読書ログの登録</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>読書ログ</h1>
    <form action="create.php" method="post">
        <div>
            <label for="title">書籍名</label>
            <input type="text" id="title" name="title">
        </div>
        <div>
            <label for="author">著者名</label>
            <input type="text" id="author" name="author">
        </div>
        <div>
            <label>読書状況</label>
            <div>
                <div>
                    <input type="radio" name="status" id="status1" value="未読">
                    <label for="status1">未読</label>
                </div>
                <div>
                    <input type="radio" name="status" id="status1" value="読んでる">
                    <label for="status2">読んでる</label>
                </div>
                <div>
                    <input type="radio" name="status" id="status1" value="読了">
                    <label for="status3">読了</label>
                </div>
            </div>
        </div>
        <div>
            <label for="rating">評価（5点満点の整数）</label>
            <input type="number" id="rating" name="rating" vmax="5" min="1">
        </div>
        <div>
            <label for="comment">感想</label>
            <textarea type="text" id="comment" name="comment" rows="10"></textarea>
        </div>
        <div class="button">
            <button type='submit'>
                登録する
            </button>
        </div>
    </form>
</body>

</html>
