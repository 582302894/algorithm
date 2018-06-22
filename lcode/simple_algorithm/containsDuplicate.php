<?php
/*
[https://leetcode-cn.com/explore/interview/card/top-interview-questions-easy/1/array/24/]
存在重复

输入: [1,2,3,1]
输出: true

 */

;?>

```
19ms
class Solution {
    public boolean containsDuplicate(int[] nums) {
        Map<Integer,Integer> m=new HashMap<Integer,Integer>();
        for(int i=0;i<nums.length;i++){
            if(m.get(nums[i])==null){
                m.put(nums[i],1);
            }else{
                return true;
            }
        }
        return false;
    }
}
```

```
2ms
class Solution {
    public boolean containsDuplicate(int[] nums) {
        for (int i = 1; i < nums.length; i++) {
            for (int j = i - 1; j >= 0; j--) {
                if (nums[i] > nums[j]) {
                    break;
                }
                if(nums[i] == nums[j]) {
                    return true;
                }
            }
        }
        return false;
    }
}

5ms
class Solution {
    public boolean containsDuplicate(int[] nums) {
		Arrays.sort(nums);
		for(int i = 0; i < nums.length - 1; i ++) {
			if(nums[i] == nums[i + 1]) return true;
		}
    	return false;
    }
}
```