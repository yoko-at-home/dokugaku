<?php
function createNote()
{
    echo PHP_EOL . '------------------' . PHP_EOL;
    echo 'メモを登録してください' . PHP_EOL;
    echo '(作成日時をメモに追加するよ♪';
    $today = date("Y-m-d H:i:s");
    echo ')' . PHP_EOL;
    echo '------------------' . PHP_EOL;
    echo 'カテゴリ（p＝プライベート/b＝ビジネス）：';
    $category = trim(fgets(STDIN));
    echo 'タイトル：';
    $title = trim(fgets(STDIN));
    echo 'メモ：';
    $memo = trim(fgets(STDIN));
    echo 'url：';
    $url = trim(fgets(STDIN));
    echo '登録が完了しました' . PHP_EOL . PHP_EOL;
    return [
        'today' => $today,
        'category' => $category,
        'title' => $title,
        'memo' => $memo,
        'url' => $url,
    ];
    echo PHP_EOL . '------------------' . PHP_EOL;
}

function noteList($memos)
{
    if (empty($memos)) {
        echo '-------------------' . PHP_EOL;
        echo 'メモはありません' . PHP_EOL;
        echo '-------------------' . PHP_EOL;
    } else {
        echo '登録されているメモを表示します' . PHP_EOL;
        echo '-------------------' . PHP_EOL;
        foreach ($memos as $memo) {
            echo '作成日時：' . $memo['today'] . PHP_EOL;
            echo 'カテゴリ(p＝プライベート/b＝ビジネス)：' . $memo['category'] . PHP_EOL;
            echo 'タイトル：' . $memo['title'] . PHP_EOL;
            echo 'メモ：' . $memo['memo'] . PHP_EOL;
            echo 'URL：' . $memo['url'] . PHP_EOL;
            echo '-------------------' . PHP_EOL;
        }
    }
}

$memos = [];

while (true) {
    echo '1. メモを登録' . PHP_EOL;
    echo '2. メモを表示' . PHP_EOL;
    echo '9. アプリケーションを終了' . PHP_EOL;
    echo '番号を選択してください（1, 2, 9）：';
    $num = trim(fgets(STDIN));

    if ($num === '1') {
        $memos[] = createNote();
    } elseif ($num === '2') {
        noteList($memos);
    } elseif ($num === '9') {
        break;
    }
}
