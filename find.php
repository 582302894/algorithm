<?php
$number = 10;
// $basic = rand(200, 10000);
$basic = 3000;
//有序数组
for ($i = 0; $i < $number; $i++) {
    $arr[$i] = $basic + intval($basic / 200) * $i;
}
//无序数组
for ($i = 0; $i < $number; $i++) {
    $key = array_rand($arr);
    $unArr[$i] = $arr[$key];
}

function dump($arr) {
    $str = implode("\t", $arr);
    echo $str . "\n";
}
function timeStart() {
    $_SESSION['time1'] = microtime(true);
}
function timeEnd() {
    $_SESSION['time2'] = microtime(true);
    echo $_SESSION['time2'] - $_SESSION['time1'] . "\n";
}

/**
 * 顺序查找    无序查找
 */
function search($arr, $key) {
    $length = count($arr);
    for ($i = 0; $i < $length; $i++) {
        if ($arr[$i] == $key) {
            return $i;
        }
    }
    return -1;
}
/**
 * 二分查找 有序数组查找
 */
function binSearch($arr, $key) {
    $max = count($arr);
    $min = 1;
    while (($mid = intval(($max + $min) / 2)) > 0) {
        if ($arr[$mid - 1] == $key) {
            return $mid - 1;
        }
        if ($arr[$mid - 1] > $key) {
            $max = $mid - 1;
            continue;
        }
        $min = $mid + 1;
    }
    return -1;
}

/**
 * 插值查找    有序查找 根据查找的值在有序数组中的比例决定查找中位数
 */
function insertSearch($arr, $key) {
    $min = 1;
    $max = count($arr);
    // $mid = $min+intval(($key-$arr[$min])/($arr[$max]-$arr[$min])*($max-$min));
    while (
        ($mid = $min + intval(($key - $arr[$min - 1]) / ($arr[$max - 1] - $arr[$min - 1]) * ($max - $min)))
        >
        0
    ) {
        if ($arr[$mid - 1] == $key) {
            return $mid - 1;
        }
        if ($arr[$mid - 1] > $key) {
            $max = $mid - 1;
            continue;
        }
        $min = $mid + 1;
    }
    return -1;
}
/**
 * 斐波那查找    黄金比例查找 0.618:1 / 1:1.618     有序查找 begin
 */
// function fibonacciSearch($arr, $key) {
//     $min = 0;
//     $max = count($arr) - 1;
//     $k = 0;
//     //找出k值
//     while ($max > fibonacci($k)) {
//         $k++;
//     }
//     while ($min <= $max) {
//         $mid = $min + fibonacci($k - 1);
//         echo "$min $max $mid $k ".fibonacci($k - 1)."\n";
//         if ($key < $arr[$mid]) {
//             $max = $mid - 1;
//             $k--;
//             continue;
//         }
//         if ($key > $arr[$mid]) {
//             $min = $mid + 1;
//             $k -= 2;
//             continue;
//         }
//         if ($mid <= $max) {
//             return $mid;
//         }
//         return $max;
//     }
//     return -1;
// }
// function fibonacci($k) {
//     if ($k < 2) {
//         return $k;
//     }
//     $i = 0;
//     $j = 1;
//     $key = 2;
//     while ($key <= $k) {
//         $temp = $i + $j;
//         $i = $j;
//         $j = $temp;
//         $key++;
//     }
//     return $j - 1;
// }
/**
 * 斐波那查找 end
 */



dump($arr);
// $value = rand($basic, $basic + $number * 10);
$value = 3120;
timeStart();
// $res = search($arr, $value);
// $res = binSearch($arr, $value);
// $res = insertSearch($arr, $value);
// $res = fibonacciSearch($arr, $value);
echo "find $value : $res \n";
timeEnd();
