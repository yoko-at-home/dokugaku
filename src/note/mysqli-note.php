<?php

$link = mysqli_connect('db', 'book_log', 'pass', 'book_log');
if (!$link) {
    echo 'Error:データベースに接続できなかったよ(>_<)' . PHP_EOL;
    echo 'Debugging error:' . mysqli_connect_error() . PHP_EOL;
    exit;
}
echo 'データベースに接続できたよ☆*:.｡. o(≧▽≦)o .｡.:*☆' . PHP_EOL;
    return $link;
$sql = 'SELECT
id,
create_at,
category,
title,
memo,
site_address
FROM note';

$results = mysqli_query($link, $sql);
while ($note = mysqli_fetch_assoc($results)) {
    echo 'カテゴリ（p＝プライベート/b＝ビジネス）：' . $note['category'] . PHP_EOL;
    echo 'タイトル(255文字以内)：' . $note['title'] . PHP_EOL;
    echo 'メモ(1000文字以内)：' . $note['memo'] . PHP_EOL;
    echo 'url：' . $note['site_address'] . PHP_EOL;
}
mysqli_free_result($results);

mysqli_close($link);
echo 'データベースとの接続を切断しました(^○^)' . PHP_EOL;
