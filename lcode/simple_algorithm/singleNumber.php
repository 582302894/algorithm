
只出现一次的数字
给定一个非空整数数组，除了某个元素只出现一次以外，其余每个元素均出现两次。找出那个只出现了一次的元素。


```
class Solution {
    public int singleNumber(int[] nums) {
        for(int i=1;i<nums.length;i++){
            nums[0]=nums[0]^nums[i];
        }
        return nums[0];
    }
}
```
```
class Solution {
    public int singleNumber(int[] nums) {
       	int i = 0;
    	int ret = 0;
        //一个数字异或它自己结果为0，异或0结果为它自己即a^a=0，a^0=a，且异或满足a^b^c=a^(b^c)
        //a^b^a = b
	    for(i = 0; i<nums.length; i++) {
	        ret = nums[i]^ret;
	    }
    	return ret;
    }
}
```

异或是非进位的加法运算
所有数相加后只留下不重复的数