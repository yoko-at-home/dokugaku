<?php
require_once __DIR__ . '/lib/mysqli.php';

function createReview($link, $review)
{
    $sql = <<<EOT
INSERT INTO reviews (
  title,
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

//$head = __DIR__ . '/views/head.php';
//$content = __DIR__ . '/views/new.php';
include __DIR__ . '/views/layout.php';
