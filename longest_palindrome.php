<?php

//最长回文子串

$s = 'asdkljlaksdkabcbakdskalxzjchvsadfsdfoiw3elas';
// $s = 'abcbd';

function longestPalindrome($s) {
    $length = strlen($s);
    $end = $start = 0;
    for ($i = 0; $i < $length; $i++) {
        $len1 = expandAroundCenter($s, $i, $i);
        $len2 = expandAroundCenter($s, $i, $i + 1);
        $len = max($len1, $len2);
        if ($len > ($end - $start)) {
            $start = $i - intval(($len - 1) / 2);
            $end = $i + intval($len / 2);
        }
    }
    return substr($s, $start, $end - $start + 1);
}

function expandAroundCenter($s, $left, $right) {
    $L = $left;
    $R = $right;
    while (
        $L >= 0 &&
        $R < strlen($s) &&
        substr($s, $L, 1) == substr($s, $R, 1)
    ) {
        $L--;
        $R++;
    }
    return $R - $L - 1;
}

echo longestPalindrome($s);