<?php

//图的深度遍历
$map = [
    [0, 1, 1, 9, 1],
    [1, 0, 9, 1, 9],
    [1, 9, 0, 9, 1],
    [9, 1, 9, 0, 9],
    [1, 9, 1, 9, 0],
];

$book;

function main() {
    global $book;
    $book[0] = 1;
    dfs(0);
}

$m = 5;
$n = 5;
$sum = 0;
function dfs($cur) {
    global $book, $map, $sum, $n, $m;
    $sum++;
    echo ($cur + 1) . "\t";
    if ($sum >= $n) {
        return;
    }
    for ($i = 0; $i < $n; $i++) {
        if ($map[$cur][$i] == 1 && (!isset($book[$i]) || $book[$i] == 0)) {
            $book[$i] = 1;
            dfs($i);
        }
    }
}
main();