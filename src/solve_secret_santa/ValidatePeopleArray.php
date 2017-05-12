<?php

/**
 * Created by PhpStorm.
 * This class Fully validates an array of people
 * The class ensures that non of the people in the array are swapping gifts with eachouther
 * The class also ensures that no members of an array of people are buying presents for themselves
 * class is currently unused
 */
class ValidatePeopleArray {


	/**
	 * ValidatePeopleArray constructor.
	 */
	public function __construct() {
	}

	/**
	 * @param $aPeople
	 * @return bool
	 */
	function ValidateAPeople( $aPeople ) {

		$bValid = true;

		foreach ( $aPeople as $oPersons ) {

			$oSwaps = new Swaps();
			$oGiveingToSelf = new GiveingToSelf();

			$bSwaps = $oSwaps->swaps( $oPersons );
			$bGiveingToSelf = $oGiveingToSelf->giveingToSelf( $oPersons );


			if ( $bSwaps === true || $bGiveingToSelf === true ) {
				return false;
				break;
			}
			else {
				$bValid = true;
			}
  		}
 		return $bValid;
	}
}