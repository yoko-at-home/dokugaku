<?php

function validate($review)
{
    $errors = [];
    // 書籍名のチェック
    if (!strlen($review['title'])) {
        $errors['title'] = "書籍名を入力してください";
    } elseif (strlen($review['title']) > 255) {
        $errors['title'] = "書籍名は255文字以内にしてください";
    }
    // 著者名のチェック
    if (!strlen($review['author'])) {
        $errors['author'] = "著者名を入力してください";
    } elseif (strlen($review['author']) > 255) {
        $errors['author'] = "著者名は255文字以内にしてください";
    }
    // Statusのチェック
    if (!in_array($review['status'], ['1', '2', '3'], true)) {
        $errors['status'] = "1＝未読,2＝読んでる,3＝読了の番号で読書状況を選択してください。";
    }
    // Ratingのチェック
    if (!strlen($review['rating'])) {
        $errors['rating'] = "評価してください";
    } elseif ($review['rating'] < 1 || $review['rating'] > 5) {
        $errors['rating'] = "1~5の整数で評価してください";
    }
    // Commentのチェック
    if (!strlen($review['comment'])) {
        $errors['comment'] = "感想を入力してください";
    } elseif (strlen($review['comment']) > 500) {
        $errors['comment'] = "感想は500文字以内にしてください";
    }
    return $errors;
}
function dbConnect()
{
    $link = mysqli_connect('db', 'book_log', 'pass', 'book_log');
    if (!$link) {
        echo 'Error: データベースに接続できませんでした' . PHP_EOL;
        echo 'Debugging error: ' . mysqli_connect_error() . PHP_EOL;
        exit;
    }

    echo 'データベースに接続できました' . PHP_EOL;
    return $link;
}

function createReview($link)
{
    $review = [];
    echo '読書ログを登録してください' . PHP_EOL;
    echo '書籍名：';
    $review['title'] = trim(fgets(STDIN));
    echo '著者名：';
    $review['author'] = trim(fgets(STDIN));
    echo '読書状況（1＝未読,2＝読んでる,3＝読了）：';
    $review['status'] = trim(fgets(STDIN));
    echo '評価（5点満点の整数）：';
    $review['rating'] = (int)trim(fgets(STDIN));
    echo '感想：';
    $review['comment'] = trim(fgets(STDIN));
    //
    $validated = validate($review);
    if (count($validated) > 0) {
        foreach ($validated as $error) {
            echo $error . PHP_EOL;
        }
        return;
    }
    //
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
    if ($result) {
        echo 'データを追加しました' . PHP_EOL;
    } else {
        echo 'データの追加に失敗しました' . PHP_EOL;
        echo 'Debugging error: ' . mysqli_error($link) . PHP_EOL;
    }
    //
    echo '登録が完了しました' . PHP_EOL . PHP_EOL;
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
    echo '登録されている読書ログを表示します' . PHP_EOL;
    echo '-------------------' . PHP_EOL;

    $sql = 'SELECT id, book_title, author, status, rating, comment FROM review';
    $results = mysqli_query($link, $sql);

    while ($review = mysqli_fetch_assoc($results)) {
        echo '書籍名：' . $review['book_title'] . PHP_EOL;
        echo '著者名：' . $review['author'] . PHP_EOL;
        echo '読書状況（1＝未読,2＝読んでる,3＝読了）：' . $review['status'] . PHP_EOL;
        echo '評価（5点満点の整数）：' . $review['rating'] . PHP_EOL;
        echo '感想：' . $review['comment'] . PHP_EOL;
        echo '-------------------' . PHP_EOL;
    }
    mysqli_free_result($results);
}

$link = dbConnect();

while (true) {
    echo '1. 読書ログを登録' . PHP_EOL;
    echo '2. 読書ログを表示' . PHP_EOL;
    echo '9. アプリケーションを終了' . PHP_EOL;
    echo '番号を選択してください（1, 2, 9）：';
    $num = trim(fgets(STDIN));

    if ($num === '1') {
        // $reviews[] = createReview();
        createReview($link);
    } elseif ($num === '2') {
        listReviews($link);
    } elseif ($num === '9') {
        /*アプリケーション終了時にデータベースとの接続を切断する */
        mysqli_close($link);
        break;
    }
}
