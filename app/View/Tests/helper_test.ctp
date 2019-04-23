<?php
	$this->Converter->init('ja_JP', 'Asia/Tokyo', 'JPY');
	echo "Japan Currency : <br>";
	echo $this->Converter->convertCurrency(23456789901.123456);
	echo "<br>";
	echo $this->Converter->convertDate(new DateTime);
	echo "<br><br>";

	$this->Converter->init('id_ID', 'Asia/Jakarta', 'IDR');
	echo "IDR Currency : <br>";
	echo $this->Converter->convertCurrency(23456789901.123456);
	echo "<br>";
	echo $this->Converter->convertDate(new DateTime);
	echo "<br><br>";


	$this->Converter->init('en_US', 'America/New_York', 'USD');	
	echo "US Currency : <br>";
	echo $this->Converter->convertCurrency(23456789901.123456);
	echo "<br>";
	echo $this->Converter->convertDate(new DateTime);
	echo "<br><br>";


?>