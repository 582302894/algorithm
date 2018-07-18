<?php

/*
字符串中的第一个唯一字符
给定一个字符串，找到它的第一个不重复的字符，并返回它的索引。如果不存在，则返回 -1。
[https://leetcode-cn.com/explore/interview/card/top-interview-questions-easy/5/strings/34/](https://leetcode-cn.com/explore/interview/card/top-interview-questions-easy/5/strings/34/)
 */

function firstUniqChar($s) {
    $map = [];
    $loc = [];
    $index = 0;
    for ($i = 0; $i < strlen($s); $i++) {
        $gap = ord(substr($s, $i, 1)) - ord('a');
        if (!isset($map[$gap])) {
            $map[$gap] = 0;
        }
        $map[$gap]++;
        if ($map[$gap] == 1) {
            $loc[$index] = $gap;
            $loc1[$index] = $i;
            $index++;
        }
    }
    for ($i = 0; $i < count($loc); $i++) {
        if ($map[$loc[$i]] == 1) {
            return $loc1[$i];
        }
    }
    return -1;
}

?>

```java
class Solution {
    public int firstUniqChar(String s) {
        int map[]=new int[26];
        int loc[]=new int[26];
        int loc1[]=new int[26];
        int index=0;
        for(int i=0;i<s.length();i++){
            int gap=s.charAt(i)-'a';
            map[gap]++;
            if(map[gap]==1){
                loc[index]=gap;
                loc1[index]=i;
                index++;
            }
        }
        for(int i=0;i<loc.length;i++){
            if(map[loc[i]]==1){
                return loc1[i];
            }
        }
        return -1;
    }
}
```

```
class Solution {
    public int firstUniqChar(String s) {
        int result = -1;
        for(char c = 'a';c<='z';c++){
            int index = s.indexOf(c);
            if(index != -1 && index == s.lastIndexOf(c)){
                result = result != -1?Math.min(result,index):index;
            }
        }
        return result;
    }
}
```