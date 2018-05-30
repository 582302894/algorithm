<?php

//图的邻接表

$args = [
    [1, 4, 9],
    [4, 3, 8],
    [1, 2, 5],
    [2, 4, 6],
    [1, 3, 7],
];
//图顶点数
$m = 4;
//图边数
$n = 5;
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

print_r($start);
print_r($next);

die;
?>

```

```