<?php

class Test extends AppModel {
	public $actsAs = array('Converter');
	public $validate = array(
	    'currency_amount' => array(
	        'formatCheck' => array (
	        	'rule' => 'money',
	        	'allowEmpty' => false,
		        'message' => "__('CurrencyError')"
	        )
    	),
    	'date_input' => array(
	        'rule' => 'date',
	        'allowEmpty' => false,
	        'message' => "__('DateError')"
    	)
	);
}