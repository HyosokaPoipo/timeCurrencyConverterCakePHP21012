<?php
class ConverterHelper extends AppHelper {
	private $timezone;
	private $locale;
	private $currency;


	public function init($locale, $timezone, $currency) {
		$this->locale = $locale;
		$this->timezone = $timezone;
		$this->currency = $currency;
		setlocale(LC_ALL, $locale);
	}

	public function convertCurrency($currencyAmount) {
		return CakeNumber::currency($currencyAmount, $this->currency);
	}

	public function convertDate($date) {
		return CakeTime::i18nFormat($date, null, false, $this->timezone);
	}
}

?>