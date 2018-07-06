[https://leetcode-cn.com/explore/interview/card/top-interview-questions-easy/5/strings/32/](https://leetcode-cn.com/explore/interview/card/top-interview-questions-easy/5/strings/32/)

反转字符串
请编写一个函数，其功能是将输入的字符串反转过来。

示例：

	输入：s = "hello"
	返回："olleh"

```
class Solution {
    public String reverseString(String s) {
        char[] a=s.toCharArray();
        int start=0;
        int end=a.length-1;
        while(start<end){
            char temp=a[start];
            a[start]=a[end];
            a[end]=temp;
            start++;
            end--;
        }
        return new String(a);
    }
}
```