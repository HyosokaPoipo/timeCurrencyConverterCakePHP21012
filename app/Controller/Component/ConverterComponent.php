<?php

App::uses('CakeTime', 'Utility');
App::uses('CakeNumber', 'Utility');
class ConverterComponent extends Component
{
	private $timezone;
	private $locale;
	private $currency;

	public function test() {
		debug("hellow from compoennt");
	}

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