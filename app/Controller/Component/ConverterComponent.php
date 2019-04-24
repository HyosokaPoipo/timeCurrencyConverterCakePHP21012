<?php
App::uses('ConverterUtil', 'Lib'.DS.'Utils');
App::uses('CakeTime', 'Utility');
App::uses('CakeNumber', 'Utility');
class ConverterComponent extends Component
{
	private $timezone;
	private $locale;
	private $currency;
	private $utilConverter;

	public function init($locale, $timezone, $currency) {
		$this->locale = $locale;
		$this->timezone = $timezone;
		$this->currency = $currency;
		setlocale(LC_ALL, $locale);

		$this->utilConverter = new ConverterUtil();
		$this->utilConverter->init($locale, $timezone, $currency);	
	}

	public function convertCurrency($currencyAmount) {
		return CakeNumber::currency($currencyAmount, $this->currency);
	}

	public function convertDate($date) {
		return CakeTime::i18nFormat($date, null, false, $this->timezone);
	}

	public function utilConverterCurrency($currencyAmount) {
		return $this->utilConverter->convertCurrency($currencyAmount);
	}

	public function utilConverterDate($date) {
		return $this->utilConverter->convertDate($date);
	}

	public function getCurrentTimezone() {
		return $this->timezone;
	}

	public function getCurrentLocale() {
		return $this->locale;
	}

	public function getCurrentCurrency() {
		return $this->currency;
	}

}

?>