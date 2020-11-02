<?php
$review = [
    'title' => '',
    'author' => '',
    'status' => '',
    'rating' => '',
    'comment' => ''
];
$errors = [];

$title = "ブックログの登録";
$head = __DIR__ . '/views/head.php';
$content = __DIR__ . '/views/new.php';
include __DIR__ . '/views/head.php';
include __DIR__ . '/views/layout.php';
