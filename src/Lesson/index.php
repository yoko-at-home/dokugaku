<?php
require_once __DIR__ . '/lib/escape.php';
require_once __DIR__ . '/lib/mysqli.php';

function listReviews($link)
{
    $reviews = [];
    $sql = 'SELECT id, title, author, status, rating, comment, created_at FROM reviews;
    ';
    $results = mysqli_query($link, $sql);
    while ($review = mysqli_fetch_assoc($results)) {
        $reviews[] = $review;
    }
    mysqli_free_result($results);
    return $reviews;
}

$link = dbConnect();
$reviews = listReviews($link);


$title = "読書ログ一覧";
$head = __DIR__ . '/views/head.php';
$content = __DIR__ . '/views/index.php';
include  __DIR__ . '/views/layout.php';
