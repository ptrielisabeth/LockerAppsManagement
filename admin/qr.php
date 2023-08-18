<?php
require_once 'phpqrcode/qrlib.php';
$path = 'imgqr/';
$qrcode = $path.time().".png";

QRcode::png('1001,PUTRI ELISABETH,tcc', $qrcode, 'H');
echo "<img src='".$qrcode."'>";