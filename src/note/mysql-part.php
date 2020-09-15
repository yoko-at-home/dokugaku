<?php

    $link = mysqli_connect('db', 'book_log', 'pass', 'book_log');
    if (!$link) {
        echo 'Error:データベースに接続できなかったよ(>_<)' . PHP_EOL;
        echo 'Debugging error: ' . mysqli_connect_error() . PHP_EOL;
        exit;
    }
    echo 'データベースに接続できたよ☆*:.｡. o(≧▽≦)o .｡.:*☆' . PHP_EOL;

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
    "{$note['site_address']}"
)
EOT;
// sqlの挿入
$results = mysqli_query($link, $sql);
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
    'url' => $note['url'],
    'created_at' => $note['created_at']
];
echo PHP_EOL . '------------------' . PHP_EOL;

mysqli_close($link);
