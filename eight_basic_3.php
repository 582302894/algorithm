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

function swap(&$i, &$j) {
    $temp = $i;
    $i = $j;
    $j = $temp;
}

/**
 * begin 冒泡排序
 *  S1：从待排序序列的起始位置开始，从前往后依次比较各个位置和其后一位置的大小并执行S2。
 *  S2：如果当前位置的值大于其后一位置的值，就把他俩的值交换（完成一次全序列比较后，序列最后位置的值即此序列最大值，所以其不需要再参与冒泡）。
 *  S3：将序列的最后位置从待排序序列中移除。若移除后的待排序序列不为空则继续执行S1，否则冒泡结束。
 */
function bubbleSort(&$arr) {
    $length = count($arr);
    $flag = true;
    while ($flag) {
        $flag = false;
        for ($i = 0; $i < $length; $i++) {
            for ($j = $i + 1; $j < $length; $j++) {
                if ($arr[$j] > $arr[$j - 1]) {
                    swap($arr[$j], $arr[$j - 1]);
                    $flag = true;
                }
            }
        }
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
function quickSort(&$arr, $low, $high) {
    if ($low >= $high) {
        return;
    }
    $left = $low;
    $right = $high;
    $mid = $arr[$left];
    while ($left < $right) {
        while ($left < $right && $arr[$right] >= $mid) {
            $right--;
        }
        $arr[$left] = $arr[$right];
        while ($left < $right && $arr[$left] <= $mid) {
            $left++;
        }
        $arr[$right] = $arr[$left];
    }
    $arr[$left] = $mid;
    quickSort($arr, $low, $left - 1);
    quickSort($arr, $left + 1, $high);
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
        $value = $arr[$i];
        for ($j = $i - 1; $j >= 0; $j--) {
            if ($arr[$j] > $value) {
                break;
            }
            $arr[$j + 1] = $arr[$j];
        }
        $arr[$j + 1] = $value;
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
        for ($i = $gap; $i < $length; $i += $gap) {
            for ($j = $i - $gap; $j >= 0; $j -= $gap) {
                if ($arr[$j] < $arr[$j + $gap]) {
                    swap($arr[$j], $arr[$j + $gap]);
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
        for ($j = $i + 1; $j < $length; $j++) {
            if ($arr[$j] < $arr[$key]) {
                $key = $j;
            }
        }
        if ($key != $i) {
            swap($arr[$key], $arr[$i]);
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
    for ($i = 0; $i < 10; $i++) {
        $order[$i] = 0;
    }
    $maxLength = 4;
    $length = count($arr);
    $basicNum = 1;
    $loop = 0;
    while ($loop < $maxLength) {
        for ($i = 0; $i < $length; $i++) {
            $lsp = intval($arr[$i] / $basicNum) % 10;
            $temp[$lsp][$order[$lsp]] = $arr[$i];
            $order[$lsp]++;
        }
        $k = 0;
        for ($i = 0; $i < 10; $i++) {
            if ($order[$i] != 0) {
                for ($j = 0; $j < $order[$i]; $j++) {
                    $arr[$k++] = $temp[$i][$j];
                }
                $order[$i] = 0;
            }
        }
        $basicNum *= 10;
        $loop++;
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
function heapSort(&$arr) {
    $length = count($arr);
    for ($i = $length - 1; $i >= 0; $i--) {
        maxHeap($arr, $i);
        swap($arr[0], $arr[$i]);
    }

}
//建立大根堆
function maxHeap(&$arr, $max) {
    $mid = intval(($max + 1) / 2) - 1;
    while ($mid >= 0) {
        $maxKey = $mid;
        $left = 2 * $mid + 1;
        $right = 2 * $mid + 2;
        if ($left <= $max && $arr[$left] > $arr[$maxKey]) {
            $maxKey = $left;
        }
        if ($right <= $max && $arr[$right] > $arr[$maxKey]) {
            $maxKey = $right;
        }
        if ($maxKey != $mid) {
            swap($arr[$mid], $arr[$maxKey]);
        }
        $mid--;
    }
}

/**
 * end 堆排序
 */

/**
 * begin 归并排序
 * 分组——>最小元素 -> 两两归并排序
 */
//分组
function mergeSort(&$arr, $low, $high) {

}
//归并排序
function merge(&$arr, $low, $high, $mid) {

}
/**
 * end 归并排序
 */

for ($i = 0; $i < 10; $i++) {
    $arr[] = rand(0, 1000);
}
dump($arr);
// bubbleSort($arr);
// quickSort($arr, 0, count($arr) - 1);
// insertSort($arr);
// shellSort($arr);
// selectSort($arr);
// radixSort($arr);
heapSort($arr);
// mergeSort($arr, 0, count($arr) - 1);
dump($arr);
