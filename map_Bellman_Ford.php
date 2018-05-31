<?php
define('MAX', 999);
// Bellman Ford    解决负权边

$args = [
    [2, 3, 2],
    [1, 2, -3],
    [1, 5, 5],
    [4, 5, 2],
    [3, 4, 3],
    [3, 4, 3],
];
//图顶点数
$m = 5;
//图边数
$n = 6;
//出发顶点
$u;
//到达顶点
$v;
//权值
$w;
//开始边数
$start;
//下一个边数
$next;

for ($i = 1; $i <= $m; $i++) {
    $start[$i] = -1;
}

for ($i = 1; $i <= $n; $i++) {
    $u[$i] = $args[$i - 1][0];
    $v[$i] = $args[$i - 1][1];
    $w[$i] = $args[$i - 1][2];
    $next[$i] = $start[$u[$i]];
    $start[$u[$i]] = $i;
}

$dis[1] = 0;
for ($i = 2; $i <= $n; $i++) {
    $dis[$i] = MAX;
}

for ($i = 1; $i < $m; $i++) {
    for ($j = 1; $j <= $n; $j++) {
        $weight = $dis[$u[$j]] + $w[$j];
        if ($dis[$v[$j]] > $weight) {
            $dis[$v[$j]] = $weight;
        }
    }
}
$flag = 0;
for ($i = 1; $i <= $n; $i++) {
    $weight = $dis[$u[$i]] + $w[$i];
    if ($dis[$v[$i]] > $weight) {
        $flag = 1;
    }
}
if ($flag == 1) {
    die('含有负环路')
}
print_r($dis);
