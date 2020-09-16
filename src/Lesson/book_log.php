<?php
function dbConnect()
{
    $link = mysqli_connect('db', 'book_log', 'pass', 'book_log');
    if (!$link) {
        echo 'Error: データベースに接続できませんでした' . PHP_EOL;
        echo 'Debugging error:' . mysqli_connect_error() . PHP_EOL;
        exit;
    }

    echo 'データベースに接続できました' . PHP_EOL;
    return $link;
}
function createReview($link)
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
    // 入力した値をSQLに渡す処理

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

    $results = mysqli_query($link, $sql);
    if ($results) {
        echo 'データを追加しました' . PHP_EOL;
    } else {
        echo 'データの追加に失敗しました' . PHP_EOL;
        echo 'Debugging error: ' . mysqli_error($link) . PHP_EOL;
    }

    echo '登録が完了しました' . PHP_EOL;
    return [
        'title' => $review['title'],
        'author' => $review['author'],
        'status' => $review['status'],
        'rating' => $review['rating'],
        'comment' => $review['comment']
    ];
}

function listReviews($link)
{
    echo '--------------------------'  . PHP_EOL;
    echo '読書ログを表示します' . PHP_EOL;

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
}

$link = dbConnect();
while (true) {
    echo '1. 読書ログを登録' . PHP_EOL;
    echo '2. 読書ログを表示' . PHP_EOL;
    echo '9. アプリケーションを終了' . PHP_EOL;
    echo '番号を選択してください（1, 2, 9）：';
    $num = trim(fgets(STDIN));
    if ($num === '1') {
        createReview($link);
        echo '---------------------------' . PHP_EOL;
    } elseif ($num === '2') {
        listReviews($link);
    } elseif ($num === '9') {
        echo '---------------------------' . PHP_EOL;
        mysqli_close($link);
        echo 'データベースとの接続を切断できました' . PHP_EOL;
        break;
    }
}
