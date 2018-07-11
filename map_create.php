<?php

define('WALL', 1);
define('ROAD', 0);
define('NOTHING', 2);
define('MAP_SIZE', 49);
define('MAP_IMG_POINT_SIZE', 10);
define('FILE_DIR', __DIR__ . '/temp/');

$map = [];
$size = MAP_SIZE;

$start = [
    'x' => 1,
    'y' => 1,
];
$end = [
    'x' => $size,
    'y' => $size,
];

// throughMap($map);
// draw($map);
// createMapImg($map);

function draw($map) {
    $file = FILE_DIR . 'map';

    $fp = fopen($file, 'w+');
    foreach ($map as $value) {
        foreach ($value as $v) {
            if ($v == 0) {
                fwrite($fp, '  ');
            } else {
                fwrite($fp, $v . ' ');
            }
        }
        fwrite($fp, "\n");
    }
    fclose($fp);
    echo shell_exec('cat ' . $file);
}

function createMap($size) {
    $xSingle = 0;
    for ($i = 0; $i <= $size + 1; $i++) {
        $ySingle = 0;
        for ($j = 0; $j <= $size + 1; $j++) {
            if ($i == 0 || $j == 0 || $i == ($size + 1) || $j == ($size + 1)) {
                $map[$i][$j] = WALL;
            } else {
                $ySingle++;
                if ($ySingle % 2 == 1 && $xSingle % 2 == 1) {
                    $map[$i][$j] = ROAD;
                } else {
                    if ($xSingle % 2 == 0 && $ySingle % 2 == 0) {
                        $map[$i][$j] = NOTHING;
                    } else {
                        $map[$i][$j] = WALL;
                    }
                }
            }
        }
        $xSingle++;
    }
    return $map;
}

function createMapImg($map) {
    $width = (MAP_SIZE + 2) * MAP_IMG_POINT_SIZE;
    $height = $width;
    $img = imagecreate($width, $height);
    imagecolorallocate($img, 255, 255, 255);
    $black = imagecolorresolve($img, 0, 0, 0);

    for ($i = 0; $i < MAP_SIZE + 2; $i++) {
        for ($j = 0; $j < MAP_SIZE + 2; $j++) {
            if ($map[$i][$j] == WALL || $map[$i][$j] == NOTHING) {
                imagefilledrectangle(
                    $img,
                    $i * MAP_IMG_POINT_SIZE,
                    $j * MAP_IMG_POINT_SIZE,
                    ($i + 1) * MAP_IMG_POINT_SIZE,
                    ($j + 1) * MAP_IMG_POINT_SIZE,
                    $black
                );
            }
        }
    }
    imagepng($img, FILE_DIR . 'map.png');
    imagedestroy($img);
}

/*
边的集合
 */
class EList {
    //所有点的list集合,
    public $e;
    public $eX;
    public $eY;

    public function __construct($map) {
        $vNum = (MAP_SIZE + 2);
        $sum = $vNum * $vNum;
        for ($i = 1; $i < $vNum - 1; $i++) {
            for ($j = 1; $j < $vNum - 1; $j++) {
                if ($i % 2 == 1 && $j % 2 == 1) {
                    $key = $i * $vNum + $j + 1;
                    $this->e[
                        $key
                    ] = 0;
                    $this->eX[$key] = $i;
                    $this->eY[$key] = $j;
                }
            }
        }
    }
}
/*
边的集合
 */
class VList {
    //边集合
    public $v;
    //边的纵坐标
    public $vX;
    //边的横坐标
    public $vY;
    // start e point
    public $vSE;
    // end e point
    public $vEE;

    public function __construct($map) {
        $vNum = (MAP_SIZE + 2);
        $sum = $vNum * $vNum;
        for ($i = 1; $i < $vNum - 1; $i++) {
            for ($j = 1; $j < $vNum - 1; $j++) {
                //横向边
                if ($i % 2 == 1 && $j % 2 == 0) {
                    $key = $i * $vNum + $j + 1;
                    $this->v[$key] = 0;
                    $this->vX[$key] = $i;
                    $this->vY[$key] = $j;
                    $this->vSE[$key] = $i * $vNum + $j;
                    $this->vEE[$key] = $i * $vNum + $j + 1 + 1;
                }
                //竖向边
                if ($i % 2 == 0 && $j % 2 == 1) {
                    $key = $i * $vNum + $j + 1;
                    $this->v[$key] = 0;
                    $this->vX[$key] = $i;
                    $this->vY[$key] = $j;
                    $this->vSE[$key] = ($i - 1) * $vNum + $j + 1;
                    $this->vEE[$key] = ($i + 1) * $vNum + $j + 1;
                }
            }
        }
    }
}

function throughMap(&$map) {

    $eList = new \EList($map);
    $e = $eList->e;
    $eX = $eList->eX;
    $eY = $eList->eY;
    $vList = new \VList($map);
    $v = $vList->v;
    $vX = $vList->vX;
    $vY = $vList->vY;
    $vSE = $vList->vSE;
    $vEE = $vList->vEE;

    $randE = array_rand($e);
    $e[$randE] = 1;
    $randV = [];
    addEV($randE, $randV, $v);

    $count = 1;
    $eCount = count($e);

    while ($count < $eCount) {
        if (empty($randV)) {
            break;
        }

        //边集合中随机出一条边
        $randVKey = array_rand($randV);
        $vKey = $randV[$randVKey];

        //获取边相邻两点判断是否连通
        $pointS = $vSE[$vKey];
        $pointE = $vEE[$vKey];
        if ($e[$pointS] ^ $e[$pointE] == 1) {
            $count++;
            //连通 打通边 设置点已使用 将未使用的点相邻的边合入边集合
            if ($e[$pointS] == 0) {
                $e[$pointS] = 1;
                addEV($pointS, $randV, $v);
            }
            if ($e[$pointE] == 0) {
                $e[$pointE] = 1;
                addEV($pointE, $randV, $v);
            }
            $map[$vX[$vKey]][$vY[$vKey]] = ROAD;
        }
        unset($randV[$randVKey]);
    }
}

function addEV($e, &$randV, &$v) {
    $eV = [
        //up
        $e - MAP_SIZE - 2,
        //down
        $e + MAP_SIZE + 2,
        //left
        $e - 1,
        //right
        $e + 1,
    ];

    $vSingleNum = MAP_SIZE + 2;
    foreach ($eV as $vKey) {
        if (!isset($v[$vKey])) {
            continue;
        }
        if ($v[$vKey] == 1) {
            continue;
        }
        //边界
        $y = $vKey % $vSingleNum;
        if ($y <= 1) {
            continue;
        }
        $x = intval($vKey / $vSingleNum) + 1;
        if ($x == 1 || $x == $vSingleNum) {
            continue;
        }
        $randV[] = $vKey;
        $v[$vKey] = 1;
    }
}

$map = createMap($size);
throughMap($map);
createMapImg($map);