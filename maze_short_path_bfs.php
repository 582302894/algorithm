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

class Node {
    public $x, $y;
    public $f = null;
    public $step;

    public function Node($x = 0, $y = 0, $f = null, $step = 0) {
        $this->x = $x;
        $this->y = $y;
        $this->f = $f;
        $this->step = $step;
    }

    public function f($f) {
        $this->f = $f;
    }
}

class Queue {
    public $head = null;
    public $tail = null;
    public $data = null;

    public function in($x, $y, $step) {
        $this->data[$this->tail] = new Node($x, $y, null, $step);
        $this->data[$this->tail]->f = $this->head;
        $this->tail++;
    }

    public function out() {
        $this->head++;
    }
}

$step = 0;
$x = 0;
$y = 0;
$queue = new Queue();
$queue->head = 0;
$queue->tail = 0;
$queue->in(0, 0, 0);
$head = $queue->head;
$tail = $queue->tail;

$book[0][0] = 1;
while ($head < $tail) {
    $now = $queue->data[$head];
    $x = $now->x;
    $y = $now->y;
    $step = $now->step;
    if ($x == 3 && $y == 2) {
        break;
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
            $book[$nextX][$nextY] = 1;
            $queue->in($nextX, $nextY, $step + 1);
        }
    }
    $queue->out();
    $head = $queue->head;
    $tail = $queue->tail;
}
while ($now) {
    $path[] = ($now->x + 1) . ',' . ($now->y + 1);
    if ($now->f == 0) {
        break;
    }
    $now = $queue->data[$now->f];
}
echo implode("\t", array_reverse($path));