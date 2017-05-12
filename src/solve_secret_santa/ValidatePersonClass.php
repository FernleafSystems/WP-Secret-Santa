<?php

/**
 * Created by PhpStorm.
 * This class is used to test weather an a person is swapping presents with anouther person or is buying a preset for themselves
 * class is curretly unused
 */
class ValidatePersonClass {

	/**
	 * ValidatePersonClass constructor.
	 */
	public function __construct() {
	}

	/**
	 * @param $oPerson
	 * @return bool
	 */
	public function ValidateAll( $oPerson ){

		$oSwaps = new Swaps();

		$bPreValidPersonSwaps = $oSwaps->swaps( $oPerson );

		$oGiveingToSelf = new GiveingToSelf();

		$bPreValidPersionGiveingToSelf = $oGiveingToSelf->giveingToSelf( $oPerson );

		if( $bPreValidPersionGiveingToSelf && $bPreValidPersonSwaps ){

			return false;
		}
		else {

			return true;
		}
	}
}