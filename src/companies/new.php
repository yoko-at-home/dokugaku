<?php
$company = [
    'name' => '',
    'establishment_date' => '',
    'founder' => ''
];
$errors = [];

$title = "会社情報の登録";
$head = __DIR__ . '/views/head.php';
$content = __DIR__ . '/views/new.php';
// include __DIR__ . '/views/head.php';
include __DIR__ . '/views/layout.php';
