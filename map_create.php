<?php

define('WALL', 1);
define('ROAD', 0);
define('NOTHING', 2);
define('MAP_SIZE', 15);
define('MAP_IMG_POINT_SIZE', 10);
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

$map = createMap($size);
throughMap($map);
draw($map);
createMapImg($map);

function draw($map) {
    $file = __DIR__ . '/map';
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

/*
获得点集合
 */
function getMapE($map) {
    for ($i = 1; $i <= MAP_SIZE; $i++) {
        for ($j = 1; $j <= MAP_SIZE; $j++) {
            if ($map[$i][$j] == ROAD) {
                $e[] = [$i, $j];
            }
        }
    }
    return $e;
}

/*
获得边集合
 */
function getMapV($map) {
    for ($i = 1; $i <= MAP_SIZE; $i++) {
        for ($j = 1; $j <= MAP_SIZE; $j++) {
            if ($map[$i][$j] == WALL) {
                if ($map[$i][$j - 1] == ROAD && $map[$i][$j + 1] == ROAD) {
                    $v[] = [
                        [$i, $j - 1, $i . "_" . ($j - 1)],
                        [$i, $j + 1, $i . "_" . ($j + 1)],
                        [$i, $j]];
                }
                if ($map[$i + 1][$j] == ROAD && $map[$i - 1][$j] == ROAD) {
                    $v[] = [
                        [$i - 1, $j, ($i - 1) . "_" . $j],
                        [$i + 1, $j, ($i + 1) . "_" . $j],
                        [$i, $j],
                    ];
                }
            }
        }
    }
    return $v;
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
    imagepng($img, 'map.png');
    imagedestroy($img);
}

function throughMap(&$map) {
    $e = getMapE($map);
    $v = getMapV($map);
    $trees = [];
    $rand = array_rand($e);

    $eW = [];
    for ($i = 0; $i < count($e); $i++) {
        $x = $e[$i][0];
        $y = $e[$i][1];
        $key = $x . "_" . $y;
        $eW[$key] = [
            'w' => 0,
            'e' => $e[$i],
        ];
    }
    $vW = [];
    for ($i = 0; $i < count($v); $i++) {
        $key = $v[$i][0][2] . "_" . $v[$i][1][2];
        $vW[$key] = $v[$i];
        $vW[$key][2]['w'] = 0;
    }
    $randPoint = array_rand($e);
    $vs = getPointFourV($e[$randPoint]);
    $eW[$e[$randPoint][0] . "_" . $e[$randPoint][1]]['w'] = 1;
    $randV = [];
    addPointV($randV, $vs, $vW);
    $count = 1;
    $eCount = count($e);
    while ($count < $eCount) {
        $vKey = array_rand($randV);
        $point1Key = $vW[$vKey][0][2];
        $point2Key = $vW[$vKey][1][2];
        if ($eW[$point1Key]['w'] ^ $eW[$point2Key]['w'] == 1) {
            if ($eW[$point1Key]['w'] == 0) {
                $count++;
                addPointV($randV, getPointFourV($vW[$vKey][0]), $vW);
                $eW[$point1Key]['w'] = 1;
            }
            if ($eW[$point2Key]['w'] == 0) {
                $count++;
                addPointV($randV, getPointFourV($vW[$vKey][1]), $vW);
                $eW[$point2Key]['w'] = 1;
            }
            $map[$vW[$vKey][2][0]][$vW[$vKey][2][1]] = ROAD;
            continue;
        }
        unset($randV[$vKey]);
    }
}

function getPointFourV($point) {
    $x = $point[0];
    $y = $point[1];
    return [
        //上
        implode('_', [$x - 2, $y, $x, $y]),
        //下
        implode('_', [$x, $y, $x + 2, $y]),
        //左
        implode('_', [$x, $y - 2, $x, $y]),
        //右
        implode('_', [$x, $y, $x, $y + 2]),
    ];
}

function addPointV(&$randV, $vs, $vW) {
    for ($i = 0; $i < count($vs); $i++) {
        $key = $vs[$i];
        if (isset($randV[$key])) {
            continue;
        }
        if (!isset($vW[$key])) {
            continue;
        }
        $randV[$key] = 1;
    }
}