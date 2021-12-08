<?php
define('ROOT_URL', $_SERVER['DOCUMENT_ROOT'] . '/handcraft-store');

// localhost db setting
define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'handprodb');
define('DB_USER', 'root');

// paypal config
define('PAYPAL_ID', 'sb-ju51r2591117@business.example.com'); 
define('PAYPAL_SANDBOX', TRUE); 
define('PAYPAL_RETURN_URL', ''); 
define('PAYPAL_CANCEL_URL', ''); 
define('PAYPAL_NOTIFY_URL', ''); 
define('PAYPAL_CURRENCY', 'MYR'); 
define('PAYPAL_URL', (PAYPAL_SANDBOX == true)?"https://www.sandbox.paypal.com/cgi-bin/webscr":"https://www.paypal.com/cgi-bin/webscr");
?>