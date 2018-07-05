[https://leetcode-cn.com/explore/interview/card/top-interview-questions-easy/1/array/31/](https://leetcode-cn.com/explore/interview/card/top-interview-questions-easy/1/array/31/)

旋转图像
给定一个 n × n 的二维矩阵表示一个图像。
将图像顺时针旋转 90 度。
<?php

function rotate($matrix) {
    $length = count($matrix);

    $num = intval(($length + 1) / 2);
    if ($length % 2 == 0) {
        $xMax = $num + 1;
    } else {
        $xMax = $num;
    }
    $yMax = $num + 1;
    $length++;
    for ($i = 1; $i < $xMax; $i++) {
        for ($j = 1; $j < $yMax; $j++) {
            $temp = $matrix[$i - 1][$j - 1];

            $x = $length - $j;
            $y = $i;
            $matrix[$i - 1][$j - 1] = $matrix[$x - 1][$y - 1];

            $tempX = $x;
            $tempY = $y;
            $x = $length - $tempY;
            $y = $tempX;
            $matrix[$tempX - 1][$tempY - 1] = $matrix[$x - 1][$y - 1];

            $tempX = $x;
            $tempY = $y;
            $x = $length - $tempY;
            $y = $tempX;
            $matrix[$tempX - 1][$tempY - 1] = $matrix[$x - 1][$y - 1];

            $matrix[$x - 1][$y - 1] = $temp;
        }
    }

    return $matrix;
}

function tranSingle($matrix, $length) {
    // if ($length % 2 == 0) {
    //     $num = $length / 2 + 1;
    //     $xMax = $num;
    //     $yMax = $num;
    // } else {
    //     $num = ($length + 1) / 2;
    //     $xMax = $num;
    //     $yMax = $num + 1;
    // }
    $num = intval(($length + 1) / 2);
    if ($length % 2 == 0) {
        $xMax = $num + 1;
    } else {
        $xMax = $num;
    }
    $yMax = $num + 1;
    $length++;
    for ($i = 1; $i < $xMax; $i++) {
        for ($j = 1; $j < $yMax; $j++) {
            $temp = $matrix[$i - 1][$j - 1];

            $x = $length - $j;
            $y = $i;
            $matrix[$i - 1][$j - 1] = $matrix[$x - 1][$y - 1];

            $tempX = $x;
            $tempY = $y;
            $x = $length - $tempY;
            $y = $tempX;
            $matrix[$tempX - 1][$tempY - 1] = $matrix[$x - 1][$y - 1];

            $tempX = $x;
            $tempY = $y;
            $x = $length - $tempY;
            $y = $tempX;
            $matrix[$tempX - 1][$tempY - 1] = $matrix[$x - 1][$y - 1];

            $matrix[$x - 1][$y - 1] = $temp;
        }
    }
    return $matrix;
}

$a = rotate([
    [1, 2, 3, 4, 5],
    [6, 7, 8, 9, 10],
    [11, 12, 13, 14, 15],
    [16, 17, 18, 19, 20],
    [21, 22, 23, 24, 25],
]);

// $a = rotate([
//     [1, 2, 3, 4],
//     [5, 6, 7, 8],
//     [9, 10, 11, 12],
//     [13, 14, 15, 16],
// ]);

foreach ($a as $value) {
    foreach ($value as $v) {
        echo "$v\t";
    }
    echo "\n";
}

?>
````
function rotate(int[][] matrix) {
    int length=matrix.length;

    int num = (length+1)/2;
    if (length % 2 == 0) {
        int xMax = num + 1;
    } else {
        int xMax = num;
    }
    int yMax = num + 1;
    length++;
    for (int i = 1; i < xMax; i++) {
        for (int j = 1; j < yMax; j++) {
            int temp = matrix[i - 1][j - 1];

            int x = length - j;
            int y = i;
            matrix[i - 1][j - 1] = matrix[x - 1][y - 1];

            int tempX = x;
            int tempY = y;
            x = length - tempY;
            y = tempX;
            matrix[tempX - 1][tempY - 1] = matrix[x - 1][y - 1];

            tempX = x;
            tempY = y;
            x = length - tempY;
            y = tempX;
            matrix[tempX - 1][tempY - 1] = matrix[x - 1][y - 1];

            matrix[x - 1][y - 1] = temp;
        }
    }

    // } else {
    //     $matrix = tranDouble($matrix, $length);
    // }
    return $matrix;
}
```