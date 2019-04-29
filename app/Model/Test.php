<?php

class Test extends AppModel {
	public $actsAs = array('Converter');
	public $validate = array(
	    'currency_amount' => array(
	        'formatCheck' => array (
	        	'rule' => 'money',
	        	'allowEmpty' => false,
		        'message' => 'Please supply a valid monetary amount.'
	        )
    	),
    	'date_input' => array(
	        'rule' => 'date',
	        'allowEmpty' => false,
	        'message' => 'Please input a valid date.'
    	)
	);
}