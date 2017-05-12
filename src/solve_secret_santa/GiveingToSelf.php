<?php

/**
 * Created by PhpStorm.
 * Ensures that a person is not giveing a present to themselves
 * Called from FinalValidation
 */
class GiveingToSelf {

	/**
	 * GiveingToSelf constructor.
	 */
	public function __construct() {
	}

	/**
	 * @param Person $oPerson
	 * @return bool
	 */
	public function giveingToSelf( $oPerson ){

		if( $oPerson->hasGiven() && $oPerson->hasRecived() ) {

			$nReciver = $oPerson->getReceivedFrom()->getId();

			$oGiveingTo = $oPerson->getGivingTo();

			return $oPerson->getId() === $nReciver || $oPerson->getId() === $oGiveingTo;

		}
		else{
			return false;
		}
	}
}