[https://leetcode-cn.com/explore/interview/card/top-interview-questions-easy/1/array/28/](https://leetcode-cn.com/explore/interview/card/top-interview-questions-easy/1/array/28/)

移动零
给定一个数组 nums，编写一个函数将所有 0 移动到数组的末尾，同时保持非零元素的相对顺序。

    输入: [0,1,0,3,12]
    输出: [1,3,12,0,0]

```
class Solution {
    public void moveZeroes(int[] nums) {
        int space=0;
        int i=0;
        while(i<nums.length){
            if(nums[i]==0){
                space++;
            }else{
                nums[i-space]=nums[i];
            }
            i++;
        }
        while(space>0){
            nums[nums.length-space]=0;
            space--;
        }
    }
}
```

```
class Solution {
    public void moveZeroes(int[] nums) {
        int j=0;
        for(int i=0;i<nums.length;i++){
            if(nums[i]!=0){
                if(i!=j){
                    nums[j]=nums[i];
                    nums[i]=0;
                }
                j++;
            }
        }
    }
}
```