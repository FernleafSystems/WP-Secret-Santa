<?php

/**
 * Created by PhpStorm.
 * User: Work
 * Date: 20/02/2017
 * Time: 12:12
 * is unuesed and unfinished
 * validates a given input for a name feild on a given form
 */
class ValidateNames {


	/**
	 * ValidateNames constructor.
	 */
	public function __construct() {
	}

	/**
	 * @param String $sNames
	 * @return bool
	 */
	public function ValidateName( $sNames ){
		$sNames = urldecode ( $sNames );
		if ( strpos( $sNames , ' ' ) == false && $sNames != null ) {
			$bValid = true;
		}
		else {
			$bValid = false;
		}
		return $bValid;
	}
}