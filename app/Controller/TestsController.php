<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

App::uses('AppController', 'Controller');
App::uses('ConverterUtil', 'Lib'.DS.'Utils');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link https://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class TestsController extends AppController {

/**
 * This controller does not use a model
 *
 * @var array
 */
	var $uses = ['Test'];
	public $components = ['Converter'];	
	public $helpers = ['Converter'];

	public $myConverter;	
	public $myLocale = 'en_US';
	public $myTimezone =  'America/New_York';
	public $myCurr = 'USD';


	public function index() {
		$this->Converter->init('ja_JP', 'Asia/Tokyo', 'JPY');
		$test = $this->Converter->convertCurrency(123456.788);
		debug($test);
		$date = new DateTime;
		$today = CakeTime::isToday($date);
		$this->log("today status : ". $today);

		setlocale(LC_ALL, "ja_JP");
		$localeDate = CakeTime::i18nFormat($date, null, false, 'Asia/Tokyo');

		$this->set('jpnDate', $localeDate);

		setlocale(LC_ALL, "id_ID");
		$localeDate = CakeTime::i18nFormat($date, null, false, 'Asia/Jakarta');

		$this->set('JktDate', $localeDate);

		setlocale(LC_ALL, "en_US");
		$localeDate = CakeTime::i18nFormat($date, null, false, 'America/New_York');

		$this->set('UsDate', $localeDate);

		$jpnCurrency = CakeNumber::currency(123456789.01234567, 'JPY');
		$this->set('jpnCurr', $jpnCurrency);

		$usCurrency = CakeNumber::currency(123456789.01234567, 'USD');
		$this->set('usCurr', $usCurrency);

		$idrCurrency = CakeNumber::currency(123456789.01234567, 'IDR');
		$this->set('idrCurr', $idrCurrency);


		$fmt = new NumberFormatter( 'en_US', NumberFormatter::CURRENCY );
		$us1 =  $fmt->formatCurrency(1234567.891234567890000, "USD")."<br>";
		$us2 =  $fmt->formatCurrency(1234567.891234567890000, "EUR")."<br>";
		$this->set('us1', $us1);
		$this->set('us2', $us2);
	}

	public function converterTest() {
		$this->Converter->init('ja_JP', 'Asia/Tokyo', 'JPY');	
		$test = $this->Converter->convertCurrency(123456.788);
		$this->set('jpCurr', $test);
		$this->set('jpDate', $this->Converter->convertDate(new DateTime));

		$this->Converter->init('id_ID', 'Asia/Jakarta', 'IDR');		
		$this->set('idCurr', $this->Converter->convertCurrency(23456789901.123456));
		$this->set('idDate', $this->Converter->convertDate(new DateTime));

		$this->Converter->init('en_US', 'America/New_York', 'USD');	
		$this->set('usCurr', $this->Converter->convertCurrency(23456789901.123456));
		$this->set('usDate', $this->Converter->convertDate(new DateTime));

	}

	public function helperTest() {

	}

	public function converterModel() {
		$this->Test->initConverter('ja_JP', 'Asia/Tokyo', 'JPY');
		$this->set('jpCurr', $this->Test->convertCurrency(23456789901.123456));
		$this->set('jpDate', $this->Test->convertDate(new DateTime));


		$this->Test->initConverter('id_ID', 'Asia/Jakarta', 'IDR');	
		$this->set('idrCurr', $this->Test->convertCurrency(23456789901.123456));
		$this->set('idrDate', $this->Test->convertDate(new DateTime));


		$this->Test->initConverter('en_US', 'America/New_York', 'USD');	
		$this->set('usCurr', $this->Test->convertCurrency(23456789901.123456));
		$this->set('usDate', $this->Test->convertDate(new DateTime));
	}

	public function converterUtil() {
		$this->myConverter = new ConverterUtil();
		if (!empty($this->params['pass'][0])) {
			switch ($this->params['pass'][0]) {
				case 'jpn':
					Configure::write('Config.language','jpn');
					$this->myLocale = 'ja_jp';
					$this->myTimezone =  'Asia/Tokyo';
					$this->myCurr = 'JPY';
					break;
				case 'idn':
					Configure::write('Config.language','idn');
					$this->myLocale = 'id_ID';
					$this->myTimezone =  'Asia/Jakarta';
					$this->myCurr = 'IDR';
					break;
				case 'eng':
					Configure::write('Config.language','eng');
					$this->myLocale = 'en_US';
					$this->myTimezone =  'America/New_York';
					$this->myCurr = 'USD';
					break;	
				default:
					Configure::write('Config.language','eng');
					$this->myLocale = 'en_US';
					$this->myTimezone =  'America/New_York';
					$this->myCurr = 'USD';
					break;
			}
			$this->myConverter->init($this->myLocale, $this->myTimezone, $this->myCurr);

		}else {
			// debug('empty');
		}
		$testData = $this->Test->find('all');
		// debug($this->myLocale);

		$this->set('test_data', $testData);
		$this->set('locale', $this->myLocale);
		$this->set('timezone', $this->myTimezone);
		$this->set('curr', $this->myCurr);
	}

	public function changeLanguage(){
		$this->log("bahasa ========================= " .$this->request->data('locale'));
		Configure::write('Config.language', $this->request->data('locale'));
		// setlocale(LC_ALL, $this->request->data('locale'));
		sleep(3);
		$this->response->body('ok');
		$this->response->send();
		debug(Configure::read('Config.language'));
		$this->_stop();
	}

	public function saveTests() {
		$msg = [];

		$this->myConverter = new ConverterUtil();
		$this->myConverter->init(
			$this->request->data('content')['locale'], 
			$this->request->data('content')['timezone'], 
			$this->request->data('content')['curr']);

		$this->Test->set($this->request->data('content'));
		$this->response->type('json');
		if ($this->Test->validates()) {
			$tempData = [
				'date_input' => $this->request->data('content')['date_input'],
				'currency_amount' => $this->myConverter->saveCurrencyWithRate($this->request->data('content')['currency_amount'])
			];
			$this->log($tempData);
			if ($this->Test->save($tempData)) {
				$this->response->statusCode(200);
				$msg = [
					'date_input' => $this->myConverter->convertDate($this->request->data('content')['date_input']),
					'currency_amount' => $this->myConverter->displayCurrencyWithRate($tempData['currency_amount'])
				];
			} else {
				$this->response->statusCode(400);
				$msg = [
					'save_error' => ''
				];
			}
		} else {
			// $this->Session->setFlash($this->Device->validationErrors);
			$msg = $this->Test->validationErrors;
			$this->response->statusCode(400);
		}
		$this->response->body(json_encode($msg));
		$this->response->send();
		$this->_stop();
	}

	public function utilView() {

	}


	public function utilConverterFromComponent() {
		$this->Converter->init('ja_JP', 'Asia/Tokyo', 'JPY');	
		$this->set('jpCurr', $this->Converter->utilConverterCurrency(123456.788));
		$this->set('jpDate', $this->Converter->utilConverterDate(new DateTime));

		$this->Converter->init('id_ID', 'Asia/Jakarta', 'IDR');		
		$this->set('idCurr', $this->Converter->utilConverterCurrency(23456789901.123456));
		$this->set('idDate', $this->Converter->utilConverterDate(new DateTime));

		$this->Converter->init('en_US', 'America/New_York', 'USD');	
		$this->set('usCurr', $this->Converter->utilConverterCurrency(23456789901.123456));
		$this->set('usDate', $this->Converter->utilConverterDate(new DateTime));
	}


	public function utilConverterFromHelper() {

	}

	public function utilConverterFromBehavior() {
		$this->Test->initConverter('ja_JP', 'Asia/Tokyo', 'JPY');
		$this->set('jpCurr', $this->Test->utilConverterCurrency(23456789901.123456));
		$this->set('jpDate', $this->Test->utilConverterDate(new DateTime));


		$this->Test->initConverter('id_ID', 'Asia/Jakarta', 'IDR');	
		$this->set('idrCurr', $this->Test->utilConverterCurrency(23456789901.123456));
		$this->set('idrDate', $this->Test->utilConverterDate(new DateTime));


		$this->Test->initConverter('en_US', 'America/New_York', 'USD');	
		$this->set('usCurr', $this->Test->utilConverterCurrency(23456789901.123456));
		$this->set('usDate', $this->Test->utilConverterDate(new DateTime));
	}
}


















