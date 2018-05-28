<?php

//图的广度遍历
$map = [
    [0, 1, 1, 9, 1],
    [1, 0, 9, 1, 9],
    [1, 9, 0, 9, 1],
    [9, 1, 9, 0, 9],
    [1, 9, 1, 9, 0],
];

//队列
for ($i = 0; $i < 100; $i++) {
    $queue[$i] = -1;
}
$head = 0;
$tail = 0;
$book;

$n = 5;

$queue[$tail] = 0;
$tail++;
$book[0] = 1;

while ($head < $tail && $tail < $n) {
    //当前结点编号
    $cur = $queue[$head];
    for ($i = 0; $i < $n; $i++) {
        if ($map[$cur][$i] == 1 && (!isset($book[$i]) || $book[$i] == 0)) {
            $queue[$tail++] = $i;
            $book[$i] = 1;
        }
        if ($tail > $n) {
            break;
        }
    }
    $head++;
}

for ($i = 0; $i < $tail; $i++) {
    echo ($queue[$i] + 1) . "\t";
}