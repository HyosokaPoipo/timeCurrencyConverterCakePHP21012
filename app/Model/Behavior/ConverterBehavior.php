<?php
App::uses('CakeTime', 'Utility');
App::uses('CakeNumber', 'Utility');
App::uses('ConverterUtil', 'Lib'.DS.'Utils');
class ConverterBehavior extends ModelBehavior {
	private $timezone;
	private $locale;
	private $currency;
	private $utilConverter;

	function hellow(Model $model, $text) {
		debug ("Hellow from behavior : ". $text);
	}

	function initConverter(Model $model, $locale, $timezone, $currency) {
		$this->locale = $locale;
		$this->timezone = $timezone;
		$this->currency = $currency;
		setlocale(LC_ALL, $locale);

		$this->utilConverter = new ConverterUtil();
		$this->utilConverter->init($locale, $timezone, $currency);	
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

	public function utilConverterCurrency(Model $model, $currencyAmount) {
		return $this->utilConverter->convertCurrency($currencyAmount);
	}

	public function utilConverterDate(Model $model, $date) {
		return $this->utilConverter->convertDate($date);
	}

}
?>

