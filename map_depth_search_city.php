<?php

define('MAX', 99);

//有向图的深度遍历
$map = [
    [0, 2, MAX, MAX, 10],
    [MAX, 0, 3, MAX, 7],
    [4, MAX, 0, 4, MAX],
    [MAX, MAX, MAX, 0, 5],
    [MAX, MAX, 3, MAX, 0],
];

$path;
$top = 0;
$n = 5;
$book;
$min = MAX;

$path[0] = 0;
$dis = 0;
$top = 1;
$book[0] = 1;
dfs(0, 0);

function dfs($cur, $dis) {
    global $book, $n, $path, $top, $min, $map;
    if ($dis > $min) {
        return;
    }
    if ($cur == ($n - 1)) {
        if ($dis < $min) {
            $min = $dis;
        }
        for ($i = 0; $i < $top; $i++) {
            echo ($path[$i] + 1) . "\t";
        }
        echo "\n$min\n";
        return;
    }
    for ($i = 0; $i < $n; $i++) {
        if ($map[$cur][$i] != MAX && (!isset($book[$i]) || $book[$i] == 0)) {
            $book[$i] = 1;
            $path[$top] = $i;
            $top++;
            dfs($i, $dis + $map[$cur][$i]);
            $top--;
            $book[$i] = 0;
        }
    }
}