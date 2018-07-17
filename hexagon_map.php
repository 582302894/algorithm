<?php

define('ANGEL_OFFSET', 30);
// define('ANGEL_OFFSET', 60);
define('MAP_SIZE', 10);
define('MAP_LENGTH', 50);
define('BASE_X', 75);
define('BASE_Y', 75);

class Point {
    public $x;
    public $y;

    public function Point($x, $y) {
        $this->x = $x;
        $this->y = $y;
    }
}

class SixHexagon {
    public $center;
    public $one;
    public $two;
    public $three;
    public $four;
    public $five;
    public $six;

    public function __construct($x, $y, $size) {
        $this->center = new Point($x, $y);
        $this->one = getPoint($this->center, $size, 0);
        $this->two = getPoint($this->center, $size, 1);
        $this->three = getPoint($this->center, $size, 2);
        $this->four = getPoint($this->center, $size, 3);
        $this->five = getPoint($this->center, $size, 4);
        $this->six = getPoint($this->center, $size, 5);
    }
}

function getPoint($center, $size, $i, $offset = ANGEL_OFFSET) {
    $angel_deg = 60 * ($i + 1) - $offset;
    $angel_reg = M_PI / 180 * $angel_deg;
    //精度到8位
    $x = round($center->x + $size * cos($angel_reg), 8);
    $y = round($center->y + $size * sin($angel_reg), 8);
    return new Point($x, $y);
}

class PointV {
    public $start;
    public $end;
    public $key;
    public function PointV($start, $end) {
        if ($start->x > $end->x) {
            $this->start = $end;
            $this->end = $start;
        } elseif ($start->x != $end->x) {
            $this->start = $start;
            $this->end = $end;
        } else {
            if ($start->y > $end->y) {
                $this->start = $end;
                $this->end = $start;
            } else {
                $this->start = $start;
                $this->end = $end;
            }
        }
        $this->key = implode("_", [
            $this->start->x,
            $this->start->y,
            $this->end->x,
            $this->end->y,
        ]);
    }
}

function getVList($centers) {
    $v = [];
    foreach ($centers as $center) {
        $pointv = new PointV($center->one, $center->two);
        $v[$pointv->key] = $pointv;
        $pointv = new PointV($center->two, $center->three);
        $v[$pointv->key] = $pointv;
        $pointv = new PointV($center->three, $center->four);
        $v[$pointv->key] = $pointv;
        $pointv = new PointV($center->four, $center->five);
        $v[$pointv->key] = $pointv;
        $pointv = new PointV($center->five, $center->six);
        $v[$pointv->key] = $pointv;
        $pointv = new PointV($center->six, $center->one);
        $v[$pointv->key] = $pointv;
    }
    return $v;
}

function draw($v, $number = null) {
    if ($number !== null) {
        $file = __DIR__ . '/temp/temp/hexagon' . $number . '.png';
    } else {
        $file = __DIR__ . '/temp/hexagon.png';
    }
    $img = imagecreate(1000, 1000);
    imagecolorallocate($img, 255, 255, 255);
    $black = imagecolorresolve($img, 0, 0, 0);
    $white = imagecolorresolve($img, 255, 255, 255);
    foreach ($v as $border) {
        imageline($img, $border->start->x, $border->start->y, $border->end->x, $border->end->y, $black);
    }
    imagepng($img, $file);
    imagedestroy($img);
}

function createMap() {
    $base = new SixHexagon(BASE_X, BASE_Y, MAP_LENGTH);
    for ($i = 0; $i < MAP_SIZE; $i++) {
        for ($j = 0; $j < MAP_SIZE; $j++) {
            if ($i % 2 == 0) {
                if ($i == 0 && $j == 0) {
                    $map[$i][$j] = $base;
                } else {
                    $map[$i][$j] = new SixHexagon(BASE_X + $j * cos(30 * M_PI / 180) * MAP_LENGTH * 2, BASE_Y + $i * MAP_LENGTH * 1.5, MAP_LENGTH);
                }
            } else {
                $map[$i][$j] = new SixHexagon(BASE_X + MAP_LENGTH * cos(30 * M_PI / 180) + $j * MAP_LENGTH * 2 * cos(30 * M_PI / 180), BASE_Y + $i * MAP_LENGTH * 1.5, MAP_LENGTH);
            }
        }
    }
    return $map;
}

function printVList($v) {
    $count = 0;
    foreach ($v as $key => $pointV) {
        $str[] = sprintf("%' 2d start:%' 23.17f %' 19.17f\tend:%' 19.17f %' 19.17f\tkey:%s", $count, $pointV->start->x, $pointV->start->y, $pointV->end->x, $pointV->end->y, $pointV->key);
        $count++;
    }
    sort($str);
    echo implode("\n", $str);
}

$map = createMap();
foreach ($map as $x) {
    foreach ($x as $y) {
        $centers[] = $y;
    }
}
$v = getVList($centers);
draw($v);
