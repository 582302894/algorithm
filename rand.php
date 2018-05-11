<?php
// header('Content-type:image/png');
// $width = 500;
// $height = 500;
// $im = imagecreatetruecolor($width, $height);
// for ($i = 0; $i < $width; $i++) {
//     for ($j = 0; $j < $height; $j++) {
//         $color = imagecolorallocate($im, 0, 0, 0);
//         if ($i > 252) {
//             if (rand(0, 1) == 1) {
//                 $color = imagecolorallocate($im, 255, 255, 255);
//             }
//         } elseif ($i < 248) {
//             if (mt_rand(0, 1) == 1) {
//                 $color = imagecolorallocate($im, 255, 255, 255);
//             }
//         } else {
//             $color = imagecolorallocate($im, 255, 255, 255);
//         }
//         imagesetpixel($im, $i, $j, $color);
//     }
// }
// // $color = imagecolorallocate($im, 200, 200, 200);
// // imagefill($im, 0, 0, $color);
// // imagecolorset($im, 100, 0, 0, 0);
// // imagecolorallocate($im, 200, 200, 200);
// imagepng($im);
// imagedestroy($im);

// header("Content-type: image/png");
// $im = imagecreatetruecolor(512, 512)
// or die("Cannot Initialize new GD image stream");
// $white = imagecolorallocate($im, 255, 255, 255);
// for ($y = 0; $y < 512; $y++) {
//     for ($x = 0; $x < 512; $x++) {
//         if (rand(0, 1) === 1) {
//             imagesetpixel($im, $x, $y, $white);
//         }
//     }
// }
// imagepng($im);
// imagedestroy($im);