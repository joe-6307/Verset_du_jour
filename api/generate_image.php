<?php
header('Content-Type: image/png; charset=utf-8');
$text = isset($_GET['text']) ? urldecode($_GET['text']) : 'Verset du jour';
$ref = isset($_GET['ref']) ? urldecode($_GET['ref']) : '';
$width = 1200; $height = 630;
$im = imagecreatetruecolor($width, $height);
$blue = imagecolorallocate($im, 0, 74, 173);
$white = imagecolorallocate($im, 255, 255, 255);
$black = imagecolorallocate($im, 20, 20, 20);
imagefilledrectangle($im, 0, 0, $width, $height, $blue);
$panel_x=80; $panel_y=70; $panel_w=$width-160; $panel_h=480;
imagefilledrectangle($im, $panel_x, $panel_y, $panel_x+$panel_w, $panel_y+$panel_h, $white);
// font
$font = __DIR__ . '/assets/DejaVuSans.ttf';
if (file_exists($font)) {
    $fontSize = 28;
    $maxWidth = $panel_w - 60;
    $words = explode(' ', $text);
    $lines = []; $current='';
    foreach ($words as $w) {
        $trial = trim(($current===''?'':$current.' ') . $w);
        $box = imagettfbbox($fontSize, 0, $font, $trial);
        $wbox = $box[2]-$box[0];
        if ($wbox > $maxWidth && $current !== '') { $lines[] = $current; $current = $w; } else { $current = $trial; }
    }
    if ($current !== '') $lines[] = $current;
    $y = $panel_y + 60;
    foreach ($lines as $line) {
        imagettftext($im, $fontSize, 0, $panel_x+30, $y, $black, $font, $line);
        $y += $fontSize + 10;
    }
    if ($ref !== '') imagettftext($im, 20, 0, $panel_x+30, $y+10, imagecolorallocate($im,120,120,120), $font, $ref);
} else {
    imagestring($im, 5, $panel_x+30, $panel_y+30, $text, $black);
    if ($ref !== '') imagestring($im, 3, $panel_x+30, $panel_y+80, $ref, imagecolorallocate($im,120,120,120));
}
imagepng($im); imagedestroy($im);
?>