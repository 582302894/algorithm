<?php

define('WALL', 1);
define('ROAD', 0);
define('MAP_SIZE', 51);
define('MAP_IMG_POINT_SIZE', 10);
define('FILE_DIR', __DIR__ . '/temp/');

function createMap($size) {
    for ($i = 0; $i <= $size + 1; $i++) {
        for ($j = 0; $j <= $size + 1; $j++) {
            if ($i == 0 || $j == 0 || $i == ($size + 1) || $j == ($size + 1)) {
                $map[$i][$j] = WALL;
            } else {
                $rand = rand(1, 100);
                if ($rand < 45) {
                    $map[$i][$j] = WALL;
                } else {
                    $map[$i][$j] = ROAD;
                }
            }
        }
    }
    return $map;
}

function createMapImg($map, $order = '') {
    $width = (MAP_SIZE + 2) * MAP_IMG_POINT_SIZE;
    $height = $width;
    $img = imagecreate($width, $height);
    imagecolorallocate($img, 255, 255, 255);
    $black = imagecolorresolve($img, 0, 0, 0);
    $red = imagecolorresolve($img, 255, 0, 0);

    for ($i = 0; $i < MAP_SIZE + 2; $i++) {
        for ($j = 0; $j < MAP_SIZE + 2; $j++) {
            if ($map[$i][$j] == WALL) {
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

    imagepng($img, FILE_DIR . 'cave' . $order . '.png');
    imagedestroy($img);
}

function draw($map) {
    for ($i = 0; $i < MAP_SIZE + 2; $i++) {
        for ($j = 0; $j < MAP_SIZE + 2; $j++) {
            echo $map[$i][$j] . ' ';
        }
        echo "\n";
    }
}

function improveMap1(&$map) {
    $change = [];
    for ($i = 1; $i <= MAP_SIZE; $i++) {
        for ($j = 1; $j <= MAP_SIZE; $j++) {
            $neighbor = getNeighbor([$i, $j]);
            $count = 0;
            for ($m = 0; $m < 8; $m++) {
                if ($map[$neighbor[$m][0]][$neighbor[$m][1]] == WALL) {
                    $count++;
                }
            }
            if ($map[$i][$j] == WALL) {
                if ($count <= 3) {
                    $map[$i][$j] = ROAD;
                }
            } elseif ($map[$i][$j] == ROAD) {
                if ($count >= 5) {
                    $map[$i][$j] = WALL;
                }
            }
        }
    }
}

function improveMap2(&$map) {
    $change = [];
    for ($i = 1; $i <= MAP_SIZE; $i++) {
        for ($j = 1; $j <= MAP_SIZE; $j++) {
            $count = getNeighborWallNum($map, [$i, $j]);
            $count2 = getNeighborWallNum($map, [$i, $j], 2);
            if ($count >= 4 || $count2 > 7) {
                $change[$i][$j] = WALL;
            } else {
                $map[$i][$j] = ROAD;
            }
        }
    }
    foreach ($change as $i => $value) {
        foreach ($value as $j => $k) {
            $map[$i][$j] = $k;
        }
    }
}

function getNeighborWallNum($map, $point, $loop = 1) {
    $x = $point[0];
    $y = $point[1];
    $length = $loop * 2 + 1;
    $center = $loop + 1;
    $count = 0;
    for ($i = 1; $i <= $length; $i++) {
        for ($j = 1; $j <= $length; $j++) {
            if ($j % $length <= 1 || $i % $length <= 1) {
                if (isset($map[$x - $center + $i][$y - $center + $j]) && $map[$x - $center + $i][$y - $center + $j] == WALL) {
                    $count++;
                }
            }
        }
    }
    return $count;
}

// $map = createMap(MAP_SIZE);
// createMapImg($map);
// improveMap2($map);
// improveMap2($map);
// improveMap2($map);
// createMapImg($map, 1);
// draw($map);
