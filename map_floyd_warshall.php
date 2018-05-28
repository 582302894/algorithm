<?php

//Floyd-Warshall 求任意两点之间的最短路径

define('MAX', 1000);

$map = [
    [0, 2, 6, 4],
    [MAX, 0, 3, MAX],
    [7, MAX, 0, 1],
    [5, MAX, 12, 0],
];

for ($i = 0; $i < 4; $i++) {
    for ($m = 0; $m < 4; $m++) {
        for ($n = 0; $n < 4; $n++) {
            if ($map[$m][$n] > ($map[$m][$i] + $map[$i][$n])) {
                $map[$m][$n] = $map[$m][$i] + $map[$i][$n];
            }
        }
    }
}

for ($i = 0; $i < 4; $i++) {
    for ($j = 0; $j < 4; $j++) {
        echo $map[$i][$j] . "\t";
    }
    echo "\n";
}