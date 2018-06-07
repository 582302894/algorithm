<?php
//深度优先搜索 查询水管工游戏路径

$map = [
    [5, 3, 5, 3],
    [1, 5, 3, 0],
    [2, 3, 5, 1],
    [6, 1, 1, 5],
    [1, 5, 5, 4],
];

$start = [0, 0];
$end = [4, 3];
//顺时针 右、下、左、上
$next = [
    2 => [0, 1],
    3 => [1, 0],
    4 => [0, -1],
    1 => [-1, 0],
];
//直管 5 6
//弯管 1 2 3 4
//方向 1 上 2 右 3 下 4 左

class Path {
    public $top = 0;
    public $data = null;

    public function in($data) {
        $this->data[$this->top] = ($data[0] + 1) . ',' . ($data[1] + 1);
        $this->top++;
    }
    public function out() {
        $this->top--;
    }
    public function show() {
        for ($i = 0; $i < $this->top; $i++) {
            echo $this->data[$i] . "\t";
        }
        echo "\n";
    }
}
$path = new Path();
$path->in([0, 0]);
dfs(0, 0, 2);
function dfs($x, $y, $front) {
    global $map;
    switch ($map[$x][$y]) {
        case 5:
        case 6:
            goStraightTube($x, $y, $front);
            break;
        case 1:
        case 2:
        case 3:
        case 4:
            goLoopTube($x, $y, $front);
            break;
        default:
            break;
    }
}

function goStraightTube($x, $y, $front) {
    global $next;
    switch ($front) {
        case 1:
            $goFront = 1;
            break;
        case 2:
            $goFront = 2;
            break;
        case 3:
            $goFront = 3;
            break;
        case 4:
            $goFront = 4;
            break;
    }
    $nextX = $x + $next[$goFront][0];
    $nextY = $y + $next[$goFront][1];
    goNext($nextX, $nextY, $goFront);
}

function goLoopTube($x, $y, $front) {
    global $next;
    switch ($front) {
        case 1:
            $goFront = [2, 4];
            break;
        case 2:
            $goFront = [1, 3];
            break;
        case 3:
            $goFront = [2, 4];
            break;
        case 4:
            $goFront = [1, 3];
            break;
    }
    for ($i = 0; $i < 2; $i++) {
        $nextX = $x + $next[$goFront[$i]][0];
        $nextY = $y + $next[$goFront[$i]][1];
        goNext($nextX, $nextY, $goFront[$i]);
    }
}

function goNext($nextX, $nextY, $goFront) {
    global $book, $path;
    if ($nextX == 4 && $nextY == 4) {
        $path->show();
        var_dump('end');
        return;
    }
    if ($nextX > 4 || $nextX < 0 || $nextY > 3 || $nextY < 0) {
        return;
    }
    if (
        (
            !isset($book[$nextX][$nextY])
            ||
            $book[$nextX][$nextY] == 0
        )
    ) {
        $path->in([$nextX, $nextY]);
        $book[$nextX][$nextY] = 1;
        dfs($nextX, $nextY, $goFront);
        $path->out();
        $book[$nextX][$nextY] = 0;
    }
}