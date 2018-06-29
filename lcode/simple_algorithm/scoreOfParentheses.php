<?php

function scoreOfParentheses($s) {
    $length = strlen($s);

    $tail = [];
    $top = 0;

    for ($i = 0; $i < $length - 1; $i++) {
        echo substr($s, $i, 1) . " " . substr($s, $i + 1, 1) . "\n";
    }
}

echo scoreOfParentheses("(()(()))");
