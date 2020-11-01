<?php

require_once __DIR__ . '/lib/mysqli.php';

function dropTable($link)
{
  $dropTableSql = 'DROP TABLE IF EXISTS reviews';
  $result = mysqli_query($link, $dropTableSql);
  if ($result) {
    echo 'デーブルを削除しました' . PHP_EOL;
  } else {
    echo 'Error: テーブルの削除に失敗しました' . PHP_EOL;
    echo 'Debugging Error: ' . mysqli_error($link) . PHP_EOL;
  }
}

function createTable($link)
{
  $createTableSql = <<<EOT
CREATE TABLE reviews (
    id INTEGER AUTO_INCREMENT NOT NULL PRIMARY KEY,
    title VARCHAR(255),
    author VARCHAR(100),
    status VARCHAR(10),
    rating INTEGER,
    comment VARCHAR(1000),
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) DEFAULT CHARSET=utf8mb4;
EOT;

  $result = mysqli_query($link, $createTableSql);
  if ($result) {
    echo 'デーブルを作成しました' . PHP_EOL;
  } else {
    echo 'Error: テーブルの作成に失敗しました' . PHP_EOL;
    echo 'Debugging Error: ' . mysqli_error($link) . PHP_EOL;
  }
}

$link = dbConnect();
dropTable($link);
createTable($link);
mysqli_close($link);
