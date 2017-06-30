<?php

return array(
	# Account credentials from developer portal
	'Account' => array(
		'ClientId' => env('PAYPAL_CLIENT_ID',
			'AcV2SmaYI2s8iUUkY0dL8EHMrXvSnd8nvjSdfM7xf7vrxn428TDul1Wprsl-ct-B7J-Dvbeyvt33DaG1'),
		'ClientSecret' => env('PAYPAL_CLIENT_SECRET',
			'EDuVrIGF8PR8pxbimjCZAlwIsgaBkf6ac_nxl-uVej12zZlQX_975Ib4XZgki7BXaCh3RolgxOkH6ydr'),
	),

	# Connection Information
	'Http' => array(
		// 'ConnectionTimeOut' => 30,
		'Retry' => 1,
		//'Proxy' => 'http://[username:password]@hostname[:port][/path]',
	),

	# Service Configuration
	'Service' => array(
		# For integrating with the live endpoint,
		# change the URL to https://api.paypal.com!
		'EndPoint' => 'https://api.sandbox.paypal.com',
	),


	# Logging Information
	'Log' => array(
		//'LogEnabled' => true,

		# When using a relative path, the log file is created
		# relative to the .php file that is the entry point
		# for this request. You can also provide an absolute
		# path here
		'FileName' => '../PayPal.log',

		# Logging level can be one of FINE, INFO, WARN or ERROR
		# Logging is most verbose in the 'FINE' level and
		# decreases as you proceed towards ERROR
		//'LogLevel' => 'FINE',
	),
);
