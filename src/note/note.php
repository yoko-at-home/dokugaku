<?php

// ここにデバッグ処理
function validate($note)
{
    $errors = [];
    if (!strlen($note['category'])) {
        $errors['category'] = "p(プライベート)またはb(ビジネス)を入力してください";
    } elseif ($note['category'] !== 'p' && $note['category'] !== 'b') {
        $errors['category'] = "p(プライベート)またはb(ビジネス)を入力してください";
    }
    if (!strlen($note['title'])) {
        $errors['title'] = "タイトルを入力してください";
    } elseif (strlen($note['title']) > 255) {
        $errors['title'] = "タイトルは255文字以内にしてください";
    }
    if (!strlen($note['memo'])) {
        $errors['memo'] = "メモを入力してください";
    } elseif (strlen($note['memo']) > 1000) {
        $errors['memo'] = "メモは1000文字以内にしてください";
    }
    return $errors;
}

// ここに接続処理
function dbConnect()
{
    $link = mysqli_connect('db', 'book_log', 'pass', 'book_log');
    if (!$link) {
        echo 'Error:データベースに接続できなかったよ(>_<)' . PHP_EOL;
        echo 'Debugging error: ' . mysqli_connect_error() . PHP_EOL;
        exit;
    }
    echo 'データベースに接続できたよ☆*:.｡. o(≧▽≦)o .｡.:*☆' . PHP_EOL;
    return $link;
}

function createNote($link)
{
    $note = [];

    echo 'メモを登録してください' . PHP_EOL;
    echo 'カテゴリ（p＝プライベート/b＝ビジネス）：';
    $note['category'] = trim(fgets(STDIN));
    echo 'タイトル：';
    $note['title'] = trim(fgets(STDIN));
    echo 'メモ：';
    $note['memo'] = trim(fgets(STDIN));
    echo 'URL：';
    $note['site_address'] = trim(fgets(STDIN));
    echo 'created_at：';
    $note['created_at'] = trim(fgets(STDIN));

    // debug処理
    $validated = validate($note);
    if (count($validated) > 0) {
        foreach ($validated as $error) {
            echo $error . PHP_EOL;
        }
        return;
    }
    // debug処理
    // sqlの挿入
    $sql = <<<EOT
INSERT INTO note (
    category,
    title,
    memo,
    site_address,
    created_at
) VALUES (
    "{$note['category']}",
    "{$note['title']}",
    "{$note['memo']}",
    "{$note['site_address']}",
    "{$note['created_at']}"
)
EOT;
    // sqlの挿入
    $result = mysqli_query($link, $sql);
    if ($result) {
        echo 'データを追加しました' . PHP_EOL;
    } else {
        echo 'データの追加に失敗しました' . PHP_EOL;
        echo 'Debugging error: ' . mysqli_error($link) . PHP_EOL;
    }

    echo '登録が完了しました☆*:.｡. o(≧▽≦)o .｡.:*☆' . PHP_EOL . PHP_EOL;
    return [
        'category' => $note['category'],
        'title' => $note['title'],
        'memo' => $note['memo'],
        'site_address' => $note['site_address'],
        'created_at' => $note['created_at']
    ];
    echo PHP_EOL . '------------------' . PHP_EOL;
}

function listNote($link)
{
    echo '登録されているメモを表示します' . PHP_EOL;
    echo '-------------------' . PHP_EOL;

    $sql = 'SELECT id, category, title, memo, site_address, created_at from note';
    $results = mysqli_query($link, $sql);
    if (empty($results)) {
        echo 'メモはありません。最初のメモを作成しましょう！' . PHP_EOL;
        while (true) {
            echo '1. メモを登録' . PHP_EOL;
            echo '9. メモアプリを終了' . PHP_EOL;
            echo '番号を選択してください（1, 9）：';
            $num = trim(fgets(STDIN));

            if ($num === '1') {
                createNote($link);
            } elseif ($num === '9') {
                echo 'アプリを終了しました(^○^)' . PHP_EOL;
                exit;
            }
        }
    } else {
        $results = mysqli_query($link, $sql);
    }
    while ($note = mysqli_fetch_assoc($results)) {
        echo 'カテゴリ（p＝プライベート/b＝ビジネス）：' . $note['category'] . PHP_EOL;
        echo 'タイトル(255文字以内)：' . $note['title'] . PHP_EOL;
        echo 'メモ(1000文字以内)：' . $note['memo'] . PHP_EOL;
        echo 'URL：' . $note['site_address'] . PHP_EOL;
        echo 'created_at：' . $note['created_at'] . PHP_EOL;
        echo '-------------------' . PHP_EOL;
    }
    mysqli_free_result($results);
    // var_export($note['category']);
}

$link = dbConnect();

while (true) {
    echo '1. メモを登録' . PHP_EOL;
    echo '2. メモを表示' . PHP_EOL;
    echo '9. メモアプリを終了' . PHP_EOL;
    echo '番号を選択してください（1, 2, 9）：';
    $num = trim(fgets(STDIN));

    if ($num === '1') {
        createNote($link);
    } elseif ($num === '2') {
        listNote($link);
    } elseif ($num === '9') {
        /*アプリケーション終了時にデータベースとの接続を切断する */
        mysqli_close($link);
        echo 'データベースとの接続を切断しました(^○^)' . PHP_EOL;
        break;
    }
}
