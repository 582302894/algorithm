<?php
/*
旋转数组
给定一个数组，将数组中的元素向右移动 k 个位置，其中 k 是非负数。

输入: [1,2,3,4,5,6,7] 和 k = 3
输出: [5,6,7,1,2,3,4]
解释:
向右旋转 1 步: [7,1,2,3,4,5,6]
向右旋转 2 步: [6,7,1,2,3,4,5]
向右旋转 3 步: [5,6,7,1,2,3,4]
 */

//[https://leetcode-cn.com/explore/interview/card/top-interview-questions-easy/1/array/23/]

function rotate(&$nums, $k) {
    if (count($nums) < 2) {
        return;
    }
    $k = $k % count($nums);
    $length = count($nums);
    for ($i = 0; $i < (($length - $k) / 2); $i++) {
        $temp = $nums[$i];
        $nums[$i] = $nums[$length - $k - $i - 1];
        $nums[$length - $k - $i - 1] = $temp;
    }
    for ($i = 0; $i < ($k / 2); $i++) {
        $temp = $nums[$length - $k + $i];
        $nums[$length - $k + $i] = $nums[$length - $i - 1];
        $nums[$length - $i - 1] = $temp;
    }
    for ($i = 0; $i < ($length / 2); $i++) {
        $temp = $nums[$i];
        $nums[$i] = $nums[$length - 1 - $i];
        $nums[$length - 1 - $i] = $temp;
    }
}

$nums = [1, 2, 3, 4, 5, 6, 7];
$k = 1;

rotate($nums, $k);
print_r($nums);

?>



```
4ms
class Solution {
    public void rotate(int[] nums, int k) {
        if (nums.length < 2) {
            return;
        }
        k = k % nums.length;

        int temp=0;

        for (int i = 0; i < ((nums.length - k) / 2); i++) {
            temp = nums[i];
            nums[i] = nums[nums.length - k - i - 1];
            nums[nums.length - k - i - 1] = temp;
        }

        for (int i = 0; i < (k / 2); i++) {
            temp = nums[nums.length - k + i];
            nums[nums.length - k + i] = nums[nums.length - i - 1];
            nums[nums.length - i - 1] = temp;
        }

        for (int i = 0; i < (nums.length / 2); i++) {
            temp = nums[i];
            nums[i] = nums[nums.length - 1 - i];
            nums[nums.length - 1 - i] = temp;
        }
    }
}
```

```
0ms
class Solution {
    public void rotate(int[] nums, int k) {
        int n = nums.length;
        k = k % n;
        //三次反转
        reverse(nums,0,n-k-1);
        reverse(nums,n-k,n-1);
        reverse(nums,0,n-1);
    }
    public void reverse(int[] nums,int start,int end){
        while(start < end){
            int tmp = nums[start];
            nums[start] = nums[end];
            nums[end] = tmp;
            start++;end--;
        }
    }
}
```