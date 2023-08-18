<?php
require_once 'phpqrcode/qrlib.php';
$path = 'imgqr/';
$qrcode = $path.time().".png";

QRcode::png('HALOOOO', $qrcode, 'H');
echo "<img src='".$qrcode."'>";
?>