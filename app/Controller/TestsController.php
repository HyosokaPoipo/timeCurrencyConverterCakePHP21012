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


/**
 * Displays a view
 *
 * @return CakeResponse|null
 * @throws ForbiddenException When a directory traversal attempt.
 * @throws NotFoundException When the view file could not be found
 *   or MissingViewException in debug mode.
 */
	public function display() {
		$path = func_get_args();

		$count = count($path);
		if (!$count) {
			return $this->redirect('/');
		}
		if (in_array('..', $path, true) || in_array('.', $path, true)) {
			throw new ForbiddenException();
		}
		$page = $subpage = $title_for_layout = null;

		if (!empty($path[0])) {
			$page = $path[0];
		}
		if (!empty($path[1])) {
			$subpage = $path[1];
		}
		if (!empty($path[$count - 1])) {
			$title_for_layout = Inflector::humanize($path[$count - 1]);
		}
		$this->set(compact('page', 'subpage', 'title_for_layout'));

		try {
			$this->render(implode('/', $path));
		} catch (MissingViewException $e) {
			if (Configure::read('debug')) {
				throw $e;
			}
			throw new NotFoundException();
		}
	}

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
}


















