<?php

define('ANGEL_OFFSET', 30);

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
    return new Point(
        $center->x + $size * cos($angel_reg),
        $center->y + $size * sin($angel_reg)
    );
}

class PointV {
    public $start;
    public $end;
    public $key;
    public function PointV($start, $end) {
        if ($start->x > $end->x) {
            $this->start = $end;
            $this->end = $start;
        } else {
            $this->start = $start;
            $this->end = $end;
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

function draw($v) {
    $file = __DIR__ . '/temp/hexagon.png';
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

$base = new SixHexagon(75, 75, 50);
$v = getVList([$start]);
draw($v);
