<?php

	// -------------------------------- constants

	// logging status
	define('POSTMAN_ACTIVE_LOGGING', true);

	// create base path
	define('POSTMAN_BASEPATH', dirname(__FILE__) . '/');

	// log base path
	define('POSTMAN_BASEPATH_LOG', '/tmp/log/');

    // business model base path
	define('POSTMAN_BASEPATH_BUSINESS_MODEL', dirname(__FILE__) . '/business_model/');

	// data model base path
	define('POSTMAN_BASEPATH_DATA_MODEL', dirname(__FILE__) . '/data_model/');

	// system base path
	define('POSTMAN_BASEPATH_SYSTEM', dirname(__FILE__) . '/system/');

	// helper base path
	define('POSTMAN_BASEPATH_HELPER', dirname(__FILE__) . '/system/helper/');


    defined('POSTMAN_DB_CONNECTION')    OR define('POSTMAN_DB_CONNECTION', 'developement');

	if ( (POSTMAN_DB_CONNECTION == 'production') || (isset($_SERVER['PM_STATUS']) && ($_SERVER['PM_STATUS'] == 'production')) ) {
		ini_set('display_errors', 0);
        defined('POSTMAN_RESOURCE_TYPE')	OR define('POSTMAN_RESOURCE_TYPE', 'production');
	} else if ( (POSTMAN_DB_CONNECTION == 'staging') || (isset($_SERVER['PM_STATUS']) && ($_SERVER['PM_STATUS'] == 'staging')) ) {
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
        defined('POSTMAN_RESOURCE_TYPE')	OR define('POSTMAN_RESOURCE_TYPE', 'staging');
	} else {
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
        defined('POSTMAN_RESOURCE_TYPE')	OR define('POSTMAN_RESOURCE_TYPE', 'developement');
	}

	// ------------------------------ begin

	// security class
	// require_once OSQ_DB_BASEPATH_SYSTEM.'security/OSQ_Encrypt.php';

	// base function helper call
	// require_once OSQ_DB_BASEPATH_HELPER.'Helper.php';


	// load the business model base class
	require_once POSTMAN_BASEPATH_SYSTEM.'BusinessModel.php';

	// load the data model base class
	require_once POSTMAN_BASEPATH_SYSTEM.'DataModel.php';

	// load the postman class
	require_once POSTMAN_BASEPATH_SYSTEM.'Postman.php';

    /* **
     * Time to load all models
     */
    // get list of models in the model directory
    $business_model_file_list = array_diff(scandir(POSTMAN_BASEPATH_BUSINESS_MODEL), array('..','.'));

    // go through list of models and include each file
    foreach($business_model_file_list as $model_file) {
        include POSTMAN_BASEPATH_BUSINESS_MODEL . $model_file;
    }

	// get list of models in the model directory
    $data_model_file_list = array_diff(scandir(POSTMAN_BASEPATH_DATA_MODEL), array('..','.'));

    // go through list of models and include each file
    foreach($data_model_file_list as $model_file) {
        include POSTMAN_BASEPATH_DATA_MODEL . $model_file;
    }


	// lets go!
	Postman::init();
