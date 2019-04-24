<?php
App::uses('CakeTime', 'Utility');
App::uses('CakeNumber', 'Utility');
class ConverterBehavior extends ModelBehavior {
	private $timezone;
	private $locale;
	private $currency;

	function hellow(Model $model, $text) {
		debug ("Hellow from behavior : ". $text);
	}

	function initConverter(Model $model, $locale, $timezone, $currency) {
		$this->locale = $locale;
		$this->timezone = $timezone;
		$this->currency = $currency;
		setlocale(LC_ALL, $locale);
	}

	public function getCurrentLocale() {
		return $this->locale;
	}

	function convertCurrency(Model $model, $currencyAmount) {
		return CakeNumber::currency($currencyAmount, $this->currency);
	}

	function convertDate(Model $model, $date) {
		return CakeTime::i18nFormat($date, null, false, $this->timezone);
	}

}
?>

