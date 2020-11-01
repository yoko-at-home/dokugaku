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
$content = __DIR__ . '/views/new.php';
include __DIR__ . '/views/layout.php';
