<?php

$x = -1.3;

if ($x > 0) {
    if ($x % 2 === 0) {
        echo '正の整数です';
    } else {
        echo '正の奇数です';
    }
} else if ($x < 0) {
    if ($x % 2 === 0) {
        echo '負の偶数です';
    } else {
        echo '負の奇数です';
    }
} else {
    echo 'ゼロです';
}
// var_dump(1 < 2);
// var_dump(2 < 2);


// $a = 1;

// if (@a < 2) {
//     echo '$aは2より小さい' . PHP_EOL;
// } else {
//     echo '$aは2以上' . PHP_EOL;
// }
