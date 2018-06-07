<?php

//深度搜索染色岛屿，标记相邻相关属性

$map = [
    [1, 2, 1, 0, 0, 0, 0, 0, 2, 3],
    [3, 0, 2, 0, 1, 2, 1, 0, 1, 2],
    [4, 0, 1, 0, 1, 2, 3, 2, 0, 1],
    [3, 2, 0, 0, 0, 1, 2, 4, 0, 0],
    [0, 0, 0, 0, 0, 0, 1, 5, 3, 0],
    [0, 1, 2, 1, 0, 1, 5, 4, 3, 0],
    [0, 1, 2, 3, 1, 3, 6, 2, 1, 0],
    [0, 0, 3, 4, 8, 9, 7, 5, 0, 0],
    [0, 0, 0, 3, 7, 8, 6, 0, 1, 2],
    [0, 0, 0, 0, 0, 0, 0, 0, 1, 0],
];

function showMap() {
    global $map;
    for ($i = 0; $i < count($map); $i++) {
        for ($j = 0; $j < count($map[0]); $j++) {
            echo $map[$i][$j] . "\t";
        }
        echo "\n";
    }
}
//顺时针 右、下、左、上
$next = [
    [0, 1],
    [1, 0],
    [0, -1],
    [-1, 0],
];
$book;
$min = 9999;

class Node {
    public $x, $y;
    public $color;

    public function Node($x = 0, $y = 0, $color = 0) {
        $this->x = $x;
        $this->y = $y;
        $this->color = $color;
    }
}

class Queue {
    public $head = 0;
    public $tail = 0;
    public $data = null;

    public function in($x, $y, $color) {
        $this->data[$this->tail] = new Node($x, $y, $color);
        $this->data[$this->tail]->f = $this->head;
        $this->tail++;
    }

    public function out() {
        $this->head++;
    }
}

$queue = new Queue();

$color = 0;
for ($x = 0; $x < count($map); $x++) {
    for ($y = 0; $y < count($map[0]); $y++) {
        if ($map[$x][$y] > 0) {
            $color--;
            $book[$x][$y] = 1;
            dfs($x, $y, $color);
        }
    }
}

function dfs($x, $y, $color) {
    global $map, $next;
    if ($map[$x][$y] <= 0) {
        return;
    }
    $map[$x][$y] = $color;
    for ($i = 0; $i < 4; $i++) {
        $nextX = $x + $next[$i][0];
        $nextY = $y + $next[$i][1];
        if ($nextX > 9 || $nextX < 0 || $nextY > 9 || $nextY < 0) {
            continue;
        }
        if (
            !isset($book[$nextX][$nextY])
            ||
            $book[$nextX][$nextY] == 0
        ) {
            $book[$nextX][$nextY] = 1;
            dfs($nextX, $nextY, $color);
        }
    }
}
showMap();

echo -$color;