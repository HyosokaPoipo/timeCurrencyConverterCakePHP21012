<?php

class Test extends AppModel {
	public $actsAs = array('Converter');
	public $validate = array(
	    'currency_amount' => array(
	        'formatCheck' => array (
	        	'rule' => 'money',
	        	'allowEmpty' => false,
		        'message' => 'CurrencyError'
	        )
    	),
    	'date_input' => array(
	        'rule' => 'datetime',
	        'allowEmpty' => false,
	        'message' => 'DateError'
    	)
	);
}