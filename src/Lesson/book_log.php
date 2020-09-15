<?php

echo '読書ログを追加してください' . PHP_EOL;
echo '書籍名：';
$title = trim(fgets(STDIN)) ;
echo '著者名：';
$author = trim(fgets(STDIN)) ;
echo '読書状況（未読、読んでる、読了）：';
$status = trim(fgets(STDIN));
echo '評価（5点満点の整数）：';
$rating = trim(fgets(STDIN)) ;
echo '感想：';
$comment = trim(fgets(STDIN));
echo '登録が完了しました' . PHP_EOL;

echo '読書ログを表示します' . PHP_EOL;
echo '書籍名：' . $title . PHP_EOL;
echo '著者名：' . $author . PHP_EOL;
echo '読書状況：' . $status . PHP_EOL;
echo '評価：' . $rating . PHP_EOL;
echo '感想：' . $comment . PHP_EOL;
