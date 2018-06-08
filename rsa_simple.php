<?php

$p = '106697219132480173106064317148705638676529121742557567770857687729397446898790451577487723991083173010242416863238099716044775658681981821407922722052778958942891831033512463262741053961681512908218003840408526915629689432111480588966800949428079015682624591636010678691927285321708935076221951173426894836169';
$q = '144819424465842307806353672547344125290716753535239658417883828941232509622838692761917211806963011168822281666033695157426515864265527046213326145174398018859056439431422867957079149967592078894410082695714160599647180947207504108618794637872261572262805565517756922288320779308895819726074229154002310375209';

$N = gmp_mul($q, $p);

//最大公约数
$p1 = gmp_add($p, "-1");
$q1 = gmp_add($q, "-1");
// $temp = gmp_gcd($p1, $q1);
// $p1 = 48;
// $q1 = 54;
$temp = extGcd(3889, gmp_mul($q1, $p1), $x, $y);
$D = $x;

$temp = extGcd($q1, $p1, $x, $y);
$L = gmp_mul(gmp_div_q($p1, $temp), gmp_mul(gmp_div_q($q1, $temp), $temp));

$E = 3889; //选取e   一般选取65537

// $D=

//扩展欧几里得算法 最大公约数
function extGcd($a, $b, &$x, &$y) {
    if ($b == 0) {
        $x = 1;
        $y = 0;
        return $a;
    }
    $r = extGcd($b, gmp_mod($a, $b), $x, $y);
    $x1 = $x;
    $y1 = $y;
    $x = $y1;
    $y = gmp_sub($x1, gmp_mul(gmp_div_q($a, $b), $y1));
    return $r;
}

$publicKey = [
    'n' => $N,
    'e' => $E,
];

$privateKey = [
    'n' => $N,
    'd' => $D,
];

$m = '123';

$c = encrypt($m, $publicKey);

// $d=decrypt($c,$privateKey);

function encrypt($m, $publicKey) {
    return extMode($m, $publicKey['e'], $publicKey['n']);
}
function decrypt($m, $privateKey) {
    return extMode($m, $privateKey['d'], $privateKey['n']);
}

//大整数冪取模算法  蒙哥马利算法
function extMode($base, $exponent, $n) {
    if (!$exponent instanceof GMP) {
        $exponent = gmp_strval(gmp_init($exponent), 2);
    } else {
        $exponent = gmp_strval($exponent, 2);
    }
    if (!$base instanceof GMP) {
        $base = gmp_init($base);
    }
    $length = strlen($exponent);
    for ($i = 0; $i < $length; $i++) {
        if ($i == 0) {
            $baseArray[] = gmp_mod($base, $n);
        } else {
            $baseArray[] = gmp_mod(gmp_mul($baseArray[$i - 1], $baseArray[$i - 1]), $n);
        }
        $binArray[] = substr($exponent, $length - $i - 1, 1);
    }
    $res = 1;
    for ($i = 0; $i < count($binArray); $i++) {
        if ($binArray[$i] == 1) {
            $res = gmp_mod(gmp_mul($res, $baseArray[$i]), $n);
        }
    }
    return gmp_strval($res);
}

// $base = '2106';
// $exponent = $str;
// $n = 2537;

// $res = extMode($base, 13, $n);
// var_dump($res);
// $res = extMode($res, 937, $n);
// var_dump($res);

// var_dump($publicKey);
// var_dump($privateKey);
$text = '654698454';
$res = decrypt(encrypt($text, $publicKey), $privateKey);
var_dump($res);

//加密字符串
//将字符串分割为一个个字符转化为数字后密文拼接，解密将数字转换回字符再拼接
//暂时只想到这个方法