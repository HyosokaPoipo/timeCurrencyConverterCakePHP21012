<?php
	App::uses('CakeTime', 'Utility');
	App::uses('CakeNumber', 'Utility');
	class ConverterUtil {
		private $timezone;
		private $locale;
		private $currency;

		public function init($locale, $timezone, $currency) {
			$this->locale = $locale;
			$this->timezone = $timezone;
			$this->currency = $currency;
			setlocale(LC_ALL, $this->locale);		
			CakeNumber::AddFormat('IDR', array('before' => 'Rp ', 'thousands' => '.', 'decimals' => ','));
		}

		public function convertCurrency($currencyAmount) {		
			return CakeNumber::currency($currencyAmount, $this->currency);
		}

		public function convertDate($date) {
			return CakeTime::i18nFormat($date, null, false, $this->timezone);
		}

		public function saveCurrencyWithRate($currencyAmount) {
			$res = 0;
			switch ($this->currency) {
				case 'JPY':
					$res = $currencyAmount;
					break;
				case 'IDR':
					$res = ($currencyAmount / 130); //round(($currencyAmount / 130), 2);
					break;
				case 'USD':
					$res = round(($currencyAmount / 0.009), 2); 
					break;
				default:
					$res = $currencyAmount;
					break;
			}
			return $res;
		}

		public function displayCurrencyWithRate($currencyAmount) {
			$res = 0;
			switch($this->currency) {
				case 'JPY':
					$res = $currencyAmount;
					break;
				case 'IDR':
					$res = $currencyAmount * 130;
					break;
				case 'USD':
					$res = $currencyAmount * 0.009;
					break;
				default:
					$res = $currencyAmount;
					break;
			}
			return $this->convertCurrency($res);
		}

		public function getCurrency() {
			return $this->currency;
		}
	}
?>