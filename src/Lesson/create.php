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
        // echo '登録が完了しました' . PHP_EOL;
        error_log('Error: fail to create review');
        error_log('Debugging Error:' . mysqli_error($link));
        // } else {
        // echo 'Error: データの追加に失敗しました' . PHP_EOL;
        // echo 'Debugging Error:' . mysqli_error($link) . PHP_EOL;
    }
}
//HTTPメソッドがPOSTだったら
// var_dump($_SERVER['REQUEST_METHOD']);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //POSTされた会社情報を変数に格納する
    // var_export($_POST);
    $review = [
        'title' => $_POST['title'],
        'author' => $_POST['author'],
        'status' => $_POST['status'],
        'rating' => $_POST['rating'],
        'comment' => $_POST['comment']
    ];
    //バリデーション処理する
    //データベースに接続する
    $link = dbConnect();
    //データベースにデータを登録する
    createReview($link, $review);
    //データベースとの処理を切断する
    mysqli_close($link);
    // var_export(100);
}
header("Location:index.php");
