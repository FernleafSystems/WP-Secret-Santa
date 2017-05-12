<?php

/**
 * Created by PhpStorm.
 * User: Work
 * Date: 20/02/2017
 * Time: 12:14
 * Validates the users input for an email on a given feild
 */
class ValidateEmails {


	/**
	 * ValidateEmails constructor.
	 */
	public function __construct() {
	}

	/**
	 * @param String $sEMails
	 * @return bool
	 */
	public function ValidateEmail( $sEMails ){
		$sEMails = urldecode ( $sEMails );
		if ( filter_var($sEMails, FILTER_VALIDATE_EMAIL) !== false && $sEMails != null ) {
			$bValid = true;
		}
		else if( $sEMails == null){
			$bValid = false;
		}
		else {
			$bValid = false;
		}
		return $bValid;
	}

}