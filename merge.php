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

function heapSort(&$arr) {
    $length = count($arr);
    maxHeap($arr, $length);
    dump($arr);
    for ($i = 0; $i < $length - 1; $i++) {
        singleHeap($arr, $length - $i - 1);
        dump($arr);
    }
}
//建立大根堆
function maxHeap(&$arr, $max) {
    $length = intval($max / 2);
    for ($i = $length - 1; $i >= 0; $i--) {
        $key = $i;
        $left = $i * 2 + 1;
        if ($left < $max && $arr[$left] > $arr[$key]) {
            $key = $left;
        }
        $right = $i * 2 + 2;
        if ($right < $max && $arr[$right] > $arr[$key]) {
            $key = $right;
        }
        if ($key != $i) {
            $temp = $arr[$key];
            $arr[$key] = $arr[$i];
            $arr[$i] = $temp;
        }
    }
}
function singleHeap(&$arr, $maxKey) {
    $max = $arr[0];
    $arr[0] = $arr[$maxKey];
    echo "----\n";
    dump($arr);
    echo "----\n";
    for ($i = 0; $i < $maxKey; $i = $key) {
        $key = $i;
        $left = $i * 2 + 1;
        if ($left < $maxKey && $arr[$left] > $arr[$key]) {
            $key = $left;
        }
        $right = $i * 2 + 2;
        if ($right < $maxKey && $arr[$right] > $arr[$key]) {
            $key = $right;
        }
        if ($key != $i) {
            $temp = $arr[$key];
            $arr[$key] = $arr[$i];
            $arr[$i] = $temp;
        } else {
            break;
        }

        echo "$i\t$left\t$right\t$key\t$maxKey\t$max\t\n";

    }
    $arr[$maxKey] = $max;
    echo "----\n";
    dump($arr);
    echo "----\n";
}

/**
 * 使用异或交换2个值，原理：一个值经过同一个值的2次异或后，原值不变
 * @param int $a
 * @param int $b
 */
function swap(&$a, &$b) {
    $a = $a ^ $b;
    $b = $a ^ $b;
    $a = $a ^ $b;
}

/**
 * 整理当前树节点（$n），临界点$last之后为已排序好的元素
 * @param int $n
 * @param int $last
 * @param array $arr
 *
 */
function adjustNode($n, $last, &$arr) {
    $l = $n << 1; // 左孩子
    if (!isset($arr[$l]) || $l > $last) {
        return;
    }
    $r = $l + 1; // 右孩子
    // 如果右孩子比左孩子大，则让父节点与右孩子比
    if ($r <= $last && $arr[$r] > $arr[$l]) {
        $l = $r;
    }
    // 如果其中子节点$l比父节点$n大，则与父节点$n交换
    if ($arr[$l] > $arr[$n]) {
        swap($arr[$l], $arr[$n]);
        // 交换之后，父节点($n)的值可能还小于原子节点($l)的子节点的值，所以还需对原子节点($l)的子节点进行调整，用递归实现
        adjustNode($l, $last, $arr);
    }
}

/**
 * 堆排序（最大堆）
 * @param array $arr
 */
function heapSort1(&$arr) {
    // 最后一个蒜素位
    $last = count($arr);
    // 堆排序中常忽略$arr[0]
    array_unshift($arr, 0);
    // 最后一个非叶子节点
    $i = $last >> 1;
    // 整理成最大堆，最大的数放到最顶，并将最大数和堆尾交换，并在之后的计算中，忽略数组最后端的最大数(last)，直到堆顶（last=堆顶）
    while (true) {
        adjustNode($i, $last, $arr);
        if ($i > 1) {
            // 移动节点指针，遍历所有节点
            $i--;
        } else {
            // 临界点$last=1，即所有排序完成
            if ($last == 1) {
                break;
            }
            swap($arr[$last], $arr[1]);
            $last--;
        }
    }
    // 弹出第一个元素
    array_shift($arr);
}

for ($i = 0; $i < 100000; $i++) {
    $arr[] = rand(1, 10000);
}

function timeStart() {
    $_SESSION['time1'] = microtime(true);
}
function timeEnd() {
    $_SESSION['time2'] = microtime(true);
    echo $_SESSION['time2'] - $_SESSION['time1'] . "\n";
}

// dump($arr);
timeStart();
heapSort1($arr);
timeEnd();
// dump($arr);
