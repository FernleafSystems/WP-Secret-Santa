<?php

/**
 * Created by PhpStorm.
 * User: Work
 * Date: 15/02/2017
 * Time: 12:58
 * Called from FinalValidation
 */
class HasGivenAndRecived {


	/**
	 * HasGivenAndRecived constructor.
	 */
	public function __construct() {
	}

	/**
	 * @param Person $oPerson
	 * @return bool
	 */
	public function HasGivenAndRecived( $oPerson ){
		return $oPerson->hasRecived() && $oPerson->hasGiven();
	}
}