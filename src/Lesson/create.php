<?php
require_once __DIR__ . '/lib/mysqli.php';

function createReview($link, $review)
{
    $sql = <<<EOT
INSERT INTO review (
  book_title,
  author,
  status,
  rating,
  comment
  ) VALUES (
      "{$review['title']}",
      "{$review['author']}",
      "{$review['status']}",
      "{$review['rating']}",
      "{$review['comment']}"
  )
EOT;
    $result = mysqli_query($link, $sql);
    if (!$result) {
        error_log('Error: fail to create review');
        error_log('Debugging Error:' . mysqli_error($link));
    }
}

function validate($review)
{
    $errors = [];

    if (!strlen($review['title'])) {
        $errors['title'] = '書籍名を入力してください';
    } elseif (strlen($review['title']) > 255) {
        $errors['title'] = '書籍名は255文字以内で入力してください';
    }
    //著者名のバリデーション
    if (!strlen($review['author'])) {
        $errors['author'] = '著者名を入力してください';
    } elseif (strlen($review['author']) > 100) {
        $errors['author'] = '著者名は100文字以内で入力してください';
    }
    //読書状況のバリデーション
    if (!in_array($review['status'], ['未読', '読んでる', '読了'])) {
        $errors['status'] = '読書状況は「未読」「読んでる」「読了」のいずれかを入力してください';
    }

    //評価のバリデーション
    if (!strlen($review['rating'])) {
        $errors['rating'] = "評価してください";
    } elseif ($review['rating'] < 1 || $review['rating'] > 5) {
        $errors['rating'] = "1~5の整数で評価してください";
    }
    if (!strlen($review['comment'])) {
        $errors['comment'] = '感想を入力してください';
    } elseif (strlen($review['comment']) > 1000) {
        $errors['comment'] = '感想は1000文字以内で入力してください';
    }
    return $errors;
}

$status = '';
if (array_key_exists('status', $_POST)) {
    $status = $_POST['status'];
}
//HTTPメソッドがPOSTだったら
// var_dump($_SERVER['REQUEST_METHOD']);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $review = [
        'title' => $_POST['title'],
        'author' => $_POST['author'],
        'status' => $status,
        'rating' => $_POST['rating'],
        'comment' => $_POST['comment']
    ];
    //バリデーション処理する
    $errors = validate($review);
    if (!count($errors)) {
        $link = dbConnect();
        createReview($link, $review);
        mysqli_close($link);
        header("Location:index.php");
    }
    // もしエラーがあれば
}
//以下はのちに統合されて削除する
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>読書ログの登録</title>
</head>

<body>
    <h1>読書ログ</h1>
    <form action="create.php" method="post">
        <!-- ここにエラー処理 begins-->
        <?php if (count($errors)) : ?>
            <ul>
                <?php foreach ($errors as $error) : ?>
                    <li><?php echo $error; ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        <!-- ここにエラー処理 ends-->
        <div>
            <label for="title">書籍名</label>
            <input type="text" name="title" id="title">
        </div>
        <div>
            <label for="author">著者名</label>
            <input type="text" name="author" id="author">
        </div>
        <div>
            <label>読書状況</label>
            <div>
                <div>
                    <input type="radio" name="status" id="status1" value="未読">
                    <label for="status1">未読</label>
                </div>
                <div>
                    <input type="radio" name="status" id="status2" value="読んでる">
                    <label for="status2">読んでる</label>
                </div>
                <div>
                    <input class="form-check-input" type="radio" name="status" id="status3" value="読了">
                    <label for="status3">読了</label>
                </div>
            </div>
        </div>
        <div>
            <label for="rating">評価（5点満点の整数）</label>
            <input type="number" name="rating" id="rating">
        </div>
        <div>
            <label for="comment">感想</label>
            <textarea type="text" name="comment" id="comment" rows="10"></textarea>
        </div>
        <button type="submit">登録する</button>
    </form>
</body>

</html>
