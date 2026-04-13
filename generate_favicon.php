<?php
$srcPath = 'public/image/logo_dark.png';
$dstPath = 'public/image/favicon.png';

$src = imagecreatefrompng($srcPath);
if (!$src) {
    echo "Fail to load image\n";
    exit(1);
}

$w = imagesx($src);
$h = imagesy($src);
$size = max($w, $h);

$dst = imagecreatetruecolor($size, $size);
imagealphablending($dst, false);
imagesavealpha($dst, true);
$transparent = imagecolorallocatealpha($dst, 255, 255, 255, 127);
imagefilledrectangle($dst, 0, 0, $size, $size, $transparent);

$dst_x = ($size - $w) / 2;
$dst_y = ($size - $h) / 2;

imagecopy($dst, $src, $dst_x, $dst_y, 0, 0, $w, $h);

if (imagepng($dst, $dstPath)) {
    echo "Favicon generated!\n";
} else {
    echo "Failed to save.\n";
}
