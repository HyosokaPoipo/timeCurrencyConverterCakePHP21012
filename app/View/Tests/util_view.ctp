<?php
	App::import('Utils', 'ConverterUtil');


	$converter = new ConverterUtil();
	$converter->init('ja_JP', 'Asia/Tokyo', 'JPY');	
	echo "Japan Currency : <br>";
	echo $converter->convertCurrency(1234898956.788);
	echo "<br>";
	echo $converter->convertDate(new DateTime);
	echo "<br><br>";


	$converter->init('id_ID', 'Asia/Jakarta', 'IDR');
	echo "IDR Currency : <br>";
	echo $converter->convertCurrency(12345689898.788);
	echo "<br>";
	echo $converter->convertDate(new DateTime);
	echo "<br><br>";


	$converter->init('en_US', 'America/New_York', 'USD');
	echo "US Currency : <br>";
	echo $converter->convertCurrency(1234588786.788);
	echo "<br>";
	echo $converter->convertDate(new DateTime);
	echo "<br><br>";

?>