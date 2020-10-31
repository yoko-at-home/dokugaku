<?php
// 接続
$link = mysqli_connect('db', 'book_log', 'pass', 'book_log');
if (!$link) {
    echo 'データベースに接続できませんでした' . PHP_EOL;
    echo 'Debugging error' . mysqli_connect_error() . PHP_EOL;
}

echo 'データベースに接続できました' . PHP_EOL;
// return $link;

// MySQL文の命令
$sql = 'SELECT id, book_title, author, status, rating, comment, created_at FROM review';
$results = mysqli_query($link, $sql); //成功したらmysqli_resultオブジェクトを返す
while ($review = mysqli_fetch_assoc($results)) //mysqli_queryの結果行を連想配列で取得する
{
    // var_export($review);
    echo '書籍名：' . $review['book_title'] . PHP_EOL;
    echo '著者名：' . $review['author'] . PHP_EOL;
    echo '読書状況（1＝未読,2＝読んでる,3＝読了）：' . $review['status'] . PHP_EOL;
    echo '評価（5点満点の整数）：' . $review['rating'] . PHP_EOL;
    echo '感想：' . $review['comment'] . PHP_EOL;
}

mysqli_free_result($results); //メモリの解放
// 切断
mysqli_close($link);
echo 'データベースとの接続を切断できました' . PHP_EOL;
