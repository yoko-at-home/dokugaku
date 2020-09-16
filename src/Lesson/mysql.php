<?php
// 接続
$link = mysqli_connect('db', 'book_log', 'pass', 'book_log');
if (!$link) {
    echo 'データベースに接続できませんでした' . PHP_EOL;
    echo 'Debugging error' . mysqli_connect_error() . PHP_EOL;
}

echo 'データベースに接続できました' . PHP_EOL;
return $link;

// MySQL文の命令

// 切断
mysqli_close($link);
echo 'データベースとの接続を切断できました' . PHP_EOL;
