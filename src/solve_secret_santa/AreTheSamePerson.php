<?php

/**
 * Created by PhpStorm.
 * compares to people object and determins weather thay are the same
 * Called from SecretSantaClass
 */
class AreTheSamePerson {


	/**
	 * AreTheSamePerson constructor.
	 */
	public function __construct() {
	}

	/**
	 * @param Person $oPerson1
	 * @param Person $oPerson2
	 * @return bool
	 */
	public function sameAs( $oPerson1, $oPerson2 ){
		if( $oPerson1->getId() === $oPerson2->getId() ){
			$bReturnVal = true;
		}
		else{
			$bReturnVal = false;
		}
		return $bReturnVal;
	}
}