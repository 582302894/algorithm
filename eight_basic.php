<?php

function dump($arr, $i = null, $j = null, $start = null, $end = null, $pivot = null, $pivotPoint = null) {
    $str = '';
    foreach ($arr as $key => $value) {
        if ($i !== null && $key == $i) {
            if ($key == $pivotPoint) {
                $value = $pivot;
            }
            $str .= "[" . $value . "]\t";
            continue;
        }
        if ($j !== null && $key == $j) {
            if ($key == $pivotPoint) {
                $value = $pivot;
            }
            $str .= "[" . $value . "]\t";
            continue;
        }
        $str .= $value . "\t";
    }
    if ($i !== null) {
        echo $str . "i:$i\tj:$j\tstart:$start\tend:$end\tpivot:$pivot\n";
    } else {
        echo $str . "\n";
    }
}

/**
 * begin 冒泡排序
 *  S1：从待排序序列的起始位置开始，从前往后依次比较各个位置和其后一位置的大小并执行S2。
 *  S2：如果当前位置的值大于其后一位置的值，就把他俩的值交换（完成一次全序列比较后，序列最后位置的值即此序列最大值，所以其不需要再参与冒泡）。
 *  S3：将序列的最后位置从待排序序列中移除。若移除后的待排序序列不为空则继续执行S1，否则冒泡结束。
 */
// function bubbleSort(&$arr) {
//     $length = count($arr);
//     //第一层循环与第二层循环方向相反
//     for ($i = 0; $i < $length; $i++) {
//         $flag = false;
//         for ($j = $length - 1; $j > $i; $j--) {
//             if ($arr[$j] < $arr[$j - 1]) {
//                 $temp = $arr[$j - 1];
//                 $arr[$j - 1] = $arr[$j];
//                 $arr[$j] = $temp;
//                 $flag = true;
//             }
//         }
//         if ($flag == false) {
//             break;
//         }
//     }
// }
function bubbleSort(&$arr) {
    $length = count($arr);
    $flag = true;
    while ($flag) {
        $flag = false;
        for ($i = 0; $i < $length - 1; $i++) {
            // 正序
            // if ($arr[$i] > $arr[$i + 1]) {
            // 倒序
            if ($arr[$i] < $arr[$i + 1]) {
                $temp = $arr[$i + 1];
                $arr[$i + 1] = $arr[$i];
                $arr[$i] = $temp;
                $flag = true;
            }
        }
        if ($flag == false) {
            break;
        }
        $length--;
    }
}
/**
 * end 冒泡排序
 */

/**
 * quickSort($arr, 0, count($arr) - 1);
 * begin 快速排序
 * 速排序是对冒泡排序的一种改进。基本思想是：通过一趟排序将要排序的数据分割成独立的两部分，其中一部分的所有数据都比另外一部分的所有数据都要小，然后再按此方法对这两部分数据分别进行快速排序，整个排序过程可以递归进行，以此实现整个数据变成有序序列。
 */
function quickSort(&$arr, $min, $max) {
    if ($min >= $max) {
        return;
    }
    $mid = $arr[$min];
    $left = $min;
    $right = $max;
    while ($left < $right) {
        // 正序
        // while ($left < $right && $arr[$right] >= $mid) {
        // 倒序
        while ($left < $right && $arr[$right] <= $mid) {
            $right--;
        }
        $arr[$left] = $arr[$right];
        // 正序
        // while ($left < $right && $arr[$left] <= $mid) {
        // 倒序
        while ($left < $right && $arr[$left] >= $mid) {
            $left++;
        }
        $arr[$right] = $arr[$left];
    }
    $arr[$left] = $mid;
    quickSort($arr, $min, $left - 1);
    quickSort($arr, $left + 1, $max);
}
/**
 * end 快速排序
 */

/**
 * begin 直接插入排序
 * 将数组中的所有元素依次跟前面已经排好的元素相比较，如果选择的元素比已排序的元素小，则交换，直到全部元素都比较过。
 */
function insertSort(&$arr) {
    $length = count($arr);
    for ($i = 1; $i < $length; $i++) {
        //倒序
        // if ($arr[$i] > $arr[$i - 1]) {
        // 正序
        if ($arr[$i] < $arr[$i - 1]) {
            $temp = $arr[$i];
            for ($j = $i - 1; $j >= 0; $j--) {
                //倒序
                // if ($arr[$j] > $temp) {
                // 正序
                if ($arr[$j] < $temp) {
                    break;
                }
                $arr[$j + 1] = $arr[$j];
            }
            $arr[$j + 1] = $temp;
        }
    }
}
/**
 * end 直接插入排序
 */

/**
 * begin shell排序
 * 将待排序数组按照步长gap进行分组，然后将每组的元素利用直接插入排序的方法进行排序；每次将gap折半减小，循环上述操作；当gap=1时，利用直接插入，完成排序。
 */
function shellSort(&$arr) {
    $length = count($arr);
    $gap = intval($length / 2);
    while ($gap > 0) {
        for ($i = $gap; $i < $length; $i++) {
            for ($j = $i - $gap; $j >= 0; $j -= $gap) {
                // if ($arr[$j + $gap] < $arr[$j]) {
                if ($arr[$j + $gap] > $arr[$j]) {
                    $temp = $arr[$j + $gap];
                    $arr[$j + $gap] = $arr[$j];
                    $arr[$j] = $temp;
                }
            }
        }
        $gap = intval($gap / 2);
    }
}
/**
 * end shell排序
 */

/**
 * begin 简单选择排序
 * 从待排序序列中，找到关键字最小的元素；
 * 如果最小元素不是待排序序列的第一个元素，将其和第一个元素互换；
 * 从余下的 N - 1 个元素中，找出关键字最小的元素，重复(1)、(2)步，直到排序结束。
 * 因此我们可以发现，简单选择排序也是通过两层循环实现。
 * 第一层循环：依次遍历序列当中的每一个元素
 * 第二层循环：将遍历得到的当前元素依次与余下的元素进行比较，符合最小元素的条件，则交换。
 */
function selectSort(&$arr) {
    $length = count($arr);
    for ($i = 0; $i < $length; $i++) {
        $key = $i;
        for ($j = $i; $j < $length; $j++) {
            // if ($arr[$j] > $arr[$key]) {
            if ($arr[$j] < $arr[$key]) {
                $key = $j;
            }
        }
        if ($key != $i) {
            $temp = $arr[$key];
            $arr[$key] = $arr[$i];
            $arr[$i] = $temp;
        }
    }
}
/**
 * end 简单选择排序
 */

/**
 * begin 基数排序
 */
function radixSort(&$arr) {
    $length = count($arr);
    for ($i = 0; $i < 10; $i++) {
        $order[] = 0;
    }
    $max = $arr[0];
    for ($i = 1; $i < $length; $i++) {
        if ($arr[$i] > $max) {
            $max = $arr[$i];
        }
    }
    $maxTime = strlen('' . $max);
    $time = 0;
    $number = 1;
    while ($time < $maxTime) {
        for ($i = 0; $i < $length; $i++) {
            $left = intval($arr[$i] / $number) % 10;
            $pos[$left][$order[$left]] = $arr[$i];
            $order[$left]++;
        }
        $k = 0;
        for ($i = 0; $i < 10; $i++) {
            // for ($i = 9; $i >= 0; $i--) {
            if ($order[$i] != 0) {
                for ($j = 0; $j < $order[$i]; $j++) {
                    $arr[$k++] = $pos[$i][$j];
                }
                $order[$i] = 0;
            }
        }
        $number *= 10;
        $time++;
    }
}
/**
 * end 基数排序
 */

/**
 * begin 堆排序
 * 建立大根堆，摘除堆顶 重新调整大根堆 继续摘除堆顶 直至最后一个元素
 */
//堆排序
// function heapSort(&$arr) {
//     $length = count($arr);
//     for ($i = 0; $i < $length; $i++) {
//         maxHeap($arr, $length - $i);
//         $max = $arr[0];
//         $min = $arr[$length - $i - 1];
//         $arr[0] = $min;
//         $arr[$length - $i - 1] = $max;
//     }
// }
// //建立大根堆
// function maxHeap(&$arr, $max) {
//     $length = intval($max / 2);
//     for ($i = $length - 1; $i >= 0; $i--) {
//         $key = $i;
//         $left = $i * 2 + 1;
//         if ($left < $max && $arr[$left] > $arr[$key]) {
//             $key = $left;
//         }
//         $right = $i * 2 + 2;
//         if ($right < $max && $arr[$right] > $arr[$key]) {
//             $key = $right;
//         }
//         if ($key != $i) {
//             $temp = $arr[$key];
//             $arr[$key] = $arr[$i];
//             $arr[$i] = $temp;
//         }
//     }
// }

/**
 * end 堆排序
 */

/**
 * begin 归并排序
 * 分组——>最小元素 -> 两两归并排序
 */
//分组
function mergeSort(&$arr, $low, $high) {
    if ($low < $high) {
        $mid = intval(($low + $high) / 2);
        mergeSort($arr, $low, $mid);
        mergeSort($arr, $mid + 1, $high);
        merge($arr, $low, $high, $mid);
    }
}
//归并排序
function merge(&$arr, $low, $high, $mid) {
    $minLow = $low;
    $maxHigh = $mid + 1;
    while ($minLow <= $mid && $maxHigh <= $high) {
        if ($arr[$minLow] <= $arr[$maxHigh]) {
            $temp[] = $arr[$minLow];
            $minLow++;
        } else {
            $temp[] = $arr[$maxHigh];
            $maxHigh++;
        }
    }
    while ($minLow <= $mid) {
        $temp[] = $arr[$minLow++];
    }
    while ($maxHigh <= $high) {
        $temp[] = $arr[$maxHigh++];
    }
    $length = count($temp);
    for ($i = 0; $i < $length; $i++) {
        $arr[$i + $low] = $temp[$i];
    }
}
/**
 * end 归并排序
 */

function timeStart() {
    $_SESSION['time1'] = microtime(true);
}
function timeEnd() {
    $_SESSION['time2'] = microtime(true);
    echo $_SESSION['time2'] - $_SESSION['time1'] . "\n";
}

set_time_limit(600);

// $function[] = 'bubbleSort';
// $function[] = 'insertSort';
// $function[] = 'selectSort';
$function[] = 'quickSort';
$function[] = 'shellSort';

$function[] = 'radixSort'; //基数排序
$function[] = 'mergeSort'; //归并排序
$function[] = 'heapSort'; //堆排序


ini_set('memory_limit','256M');
for ($i = 0; $i < 10; $i++) {
    $arr[] = rand(1, 100);
}
dump($arr);
quickSort($arr, 0, count($arr) - 1);
dump($arr);
// session_start();
// $_SESSION['time1'] = microtime(true);
// quickSort($arr, 0, count($arr) - 1);
// // shellSort($arr);
// // radixSort($arr); 
// // heapSort($arr,count($arr));
// // mergeSort($arr,0,count($arr)-1);
// $_SESSION['time2'] = microtime(true);
// var_dump($_SESSION['time2'] - $_SESSION['time1']);
