<?php

echo "This page is for testing purpose<br><br>";
echo "LANGUAGE : <br>";
echo __('goodDay');
echo "<br><br>";


// $dt = new DateTime;
// echo "TIME ZONE: <br>";
// date_default_timezone_set('Asia/Tokyo');
// setlocale(LC_ALL, "ja_JP");
// echo "Time zone : ".date_default_timezone_get().'<br/>';
// echo strftime("%c", $dt->getTimestamp());
// echo "<br><br>";

// date_default_timezone_set('Asia/Jakarta');
// setlocale(LC_ALL,"id_ID");
// echo "Time zone : ".date_default_timezone_get().'<br/>';
// echo strftime("%c", $dt->getTimestamp());
// echo "<br><br>";

// setlocale(LC_ALL, "en_US");
// date_default_timezone_set('America/New_York');
// echo "Time zone : ".date_default_timezone_get().'<br/>';
// echo strftime("%c", $dt->getTimestamp());
// echo "<br><br><br>";

echo "Japan date : <br>";
echo $jpnDate;
echo "<br><br><br>";

echo "Jkt date : <br>";
echo $JktDate;
echo "<br><br><br>";

echo "Us date : <br>";
echo $UsDate;
echo "<br><br><br>";

echo "CURRENCY : <br>";
$number = 12340.5672;
// setlocale(LC_MONETARY, 'en_US');
// setlocale(LC_MONETARY, 'it_IT');
// echo money_format('%i ', $number) . "<br><br>";
echo "Japan Currency : <br>";
echo $jpnCurr;
echo "<br><br>";

echo "US Currency : <br>";
echo $usCurr;
echo "<br><br>";

echo "Idr Currency : <br>";
echo $idrCurr;
echo "<br><br>";


setlocale(LC_MONETARY, 'ja_JP');
echo money_format('%i ', $number) . "<br><br>";

echo $us1;
echo $us2;

$fmt = new NumberFormatter( 'ja_JP', NumberFormatter::CURRENCY );
echo $fmt->formatCurrency(1234567.891234567890000, "JPY")."<br>";

$fmt = new NumberFormatter( 'id_ID', NumberFormatter::CURRENCY );
echo $fmt->formatCurrency(1234567.891234567890000, "IDR")."<br><br>";
?>
