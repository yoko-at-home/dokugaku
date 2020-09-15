<?php
function createReview()
{
    echo '読書ログを追加してください' . PHP_EOL;
    echo '書籍名：';
    $review['title'] = trim(fgets(STDIN));
    echo '著者名：';
    $review['author'] = trim(fgets(STDIN));
    echo '読書状況（未読、読んでる、読了）：';
    $review['status'] = trim(fgets(STDIN));
    echo '評価（5点満点の整数）：';
    $review['rating'] = trim(fgets(STDIN));
    echo '感想：';
    $review['comment'] = trim(fgets(STDIN));
    echo '登録が完了しました' . PHP_EOL;

    return [
        'title' => $review['title'],
        'author' => $review['author'],
        'status' => $review['status'],
        'rating' => $review['rating'],
        'comment' => $review['comment']
    ];
}

function listReviews($reviews)
{
    echo '--------------------------'  . PHP_EOL;
    echo '読書ログを表示します' . PHP_EOL;

    foreach ($reviews as $review) {
        echo '書籍名：' . $review['title'] . PHP_EOL;
        echo '著者名：' . $review['author'] . PHP_EOL;
        echo '読書状況：' . $review['status'] . PHP_EOL;
        echo '評価（5点満点の整数）：' . $review['rating'] . PHP_EOL;
        echo '感想：' . $review['comment'] . PHP_EOL;
        echo '--------------------------'  . PHP_EOL;
    }
}

$reviews = [];

while (true) {
    echo '1. 読書ログを登録' . PHP_EOL;
    echo '2. 読書ログを表示' . PHP_EOL;
    echo '9. アプリケーションを終了' . PHP_EOL;
    echo '番号を選択してください（1,2,9）:';
    $num = trim(fgets(STDIN));
    if ($num === '1') {
        $reviews[] = createReview();
        echo '---------------------------' . PHP_EOL;
    } elseif ($num === '2') {
        listReviews($reviews);
    } elseif ($num === '9') {
        echo '---------------------------' . PHP_EOL;
        break;
    }
}
