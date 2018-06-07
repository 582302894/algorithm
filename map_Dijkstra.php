<?php
//单源最短路算法

define('MAX', 9999);

$map = [
    [0, 1, 12, MAX, MAX, MAX],
    [MAX, 0, 9, 3, MAX, MAX],
    [MAX, MAX, 0, MAX, 5, MAX],
    [MAX, MAX, 4, 0, 13, 15],
    [MAX, MAX, MAX, MAX, 0, 4],
    [MAX, MAX, MAX, MAX, MAX, 0],
];

$sign = 0;
$m = 6;

for ($i = 0; $i < 6; $i++) {
    $book[$i] = 0;
}

$dis = $map[$sign];
$book[$sign] = 1;

for ($i = 0; $i < $m - 1; $i++) {
    $min = MAX;
    $minKey = 0;
    for ($j = 0; $j < $m; $j++) {
        if ($book[$j] == 0 && $dis[$j] < $min) {
            $minKey = $j;
            $min = $dis[$j];
        }
    }

    for ($j = 0; $j < $m; $j++) {
        if ($map[$minKey][$j] != MAX) {
            $sum = $map[$minKey][$j] + $dis[$minKey];
            if ($dis[$j] > $sum) {
                $dis[$j] = $sum;
            }
        }
    }
    $book[$minKey] = 1;
    for ($k = 0; $k < $m; $k++) {
        echo $dis[$k] . "\t";
    }
    echo "\n";
}