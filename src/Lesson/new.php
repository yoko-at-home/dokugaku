<?php
$review = [
    'title' => '',
    'author' => '',
    'status' => '未読',
    'rating' => '',
    'comment' => ''
];
$errors = [];

$title = "ブックログの登録";
$content = __DIR__ . '/views/new.php';
include __DIR__ . '/views/layout.php';
