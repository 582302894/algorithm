[https://leetcode-cn.com/explore/interview/card/top-interview-questions-easy/1/array/27/](https://leetcode-cn.com/explore/interview/card/top-interview-questions-easy/1/array/27/)


加一
给定一个非负整数组成的非空数组，在该数的基础上加一，返回一个新的数组。

	输入: [4,3,2,1]
	输出: [4,3,2,2]
	解释: 输入数组表示数字 4321。



```
class Solution {
    public int[] plusOne(int[] digits) {
        int[] temp=new int[digits.length+1];
        int sum=11;
        for(int i=digits.length-1;i>=0;i--){
            sum=sum/10+digits[i];
            temp[i+1]=sum%10;
        }
        temp[0]=sum/10;
        if(temp[0]==1){
            return temp;
        }else{
            for(int i=0;i<digits.length;i++){
                digits[i]=temp[i+1];
            }
            return digits;
        }
    }
}
```