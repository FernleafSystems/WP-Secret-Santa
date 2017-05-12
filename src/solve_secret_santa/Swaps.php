<?php

/**
 * Created by PhpStorm.
 * This class is used to test weather a given person Give feild is the same as thair Recive feild
 * Called from FinalValidation
 */
class Swaps {

	/**
	 * Swaps constructor.
	 */
	public function __construct() {
	}

	/**
	 * @param Person $oPerson
	 * @return bool
	 */
	public function swaps( $oPerson ){

		if( $oPerson->hasGiven() && $oPerson->hasRecived() ){
			return $oPerson->getGivingTo()->getId() == $oPerson->getReceivedFrom()->getId();
		}
		else {
			return false;
		}
	}
}