<?php

$maze = [
    [0, 0, 2, 0],
    [0, 0, 0, 0],
    [0, 0, 2, 0],
    [0, 2, 9, 0],
    [0, 0, 0, 2],
];
//顺时针 右、下、左、上
$next = [
    [0, 1],
    [1, 0],
    [0, -1],
    [-1, 0],
];
$book;
$min = 9999;

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

function dfs($x, $y, $step) {
    global $book, $min, $next, $maze, $path;
    if ($maze[$x][$y] == 9) {
        $path->show();
        if ($step < $min) {
            $min = $step;
        }
        return;
    }
    for ($i = 0; $i < 4; $i++) {
        $nextX = $x + $next[$i][0];
        $nextY = $y + $next[$i][1];
        if ($nextX > 4 || $nextX < 0 || $nextY > 3 || $nextY < 0) {
            continue;
        }
        if (
            (
                $maze[$nextX][$nextY] == 0
                ||
                $maze[$nextX][$nextY] == 9
            )
            &&
            (
                !isset($book[$nextX][$nextY])
                ||
                $book[$nextX][$nextY] == 0
            )
        ) {
            $path->in([$nextX, $nextY]);
            $book[$nextX][$nextY] = 1;
            dfs($nextX, $nextY, $step + 1);
            $path->out();
            $book[$nextX][$nextY] = 0;
        }
    }
}

function main() {
    global $book, $path;
    $book[0][0] = 1;
    $path->in([0, 0]);
    dfs(0, 0, 0);
}

main();
echo $min;