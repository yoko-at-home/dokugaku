<?php

$link = mysqli_connect('db', 'book_log', 'pass', 'book_log');
if (!$link) {
    echo 'Error:データベースに接続できませんでした' . PHP_EOL;
    echo 'Debugging error: ' . mysqli_connect_error() . PHP_EOL;
    exit;
}

echo 'データベースに接続できました' . PHP_EOL;

$sql = 'SELECT id, book_title, author, status, rating, comment FROM review';
$results = mysqli_query($link, $sql);
while ($review = mysqli_fetch_assoc($results)) {
    echo '書籍名：' . $review['book_title'] . PHP_EOL;
    echo '著者名：' . $review['author'] . PHP_EOL;
    echo '読書状況（1＝未読,2＝読んでる,3＝読了）：' . $review['status'] . PHP_EOL;
    echo '評価（5点満点の整数）：' . $review['rating'] . PHP_EOL;
    echo '感想：' . $review['comment'] . PHP_EOL;
}

mysqli_free_result($results);

// $sql = <<<EOT
// INSERT INTO review (
//     book_title,
//     author,
//     status,
//     rating,
//     comment
// ) VALUES (
//     '{$title}',
//     '{$author}',
//     '{$status}',
//     '{$rating}',
//     '{$comment}'
// )
// EOT;

// $result = mysqli_query($link, $sql);
// if ($result) {
//     echo 'データを追加しました' . PHP_EOL;
// } else {
//     echo 'データの追加に失敗しました' . PHP_EOL;
//     echo 'Debugging error: ' . mysqli_error($link) . PHP_EOL;
// }

mysqli_close($link);
echo 'データベースとの接続を切断できました' . PHP_EOL;
