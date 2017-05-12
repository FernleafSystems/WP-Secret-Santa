<?php

/**
 * Created by PhpStorm.
 * User: Work
 * Date: 16/02/2017
 * Time: 15:34
 * Called from SecretSanta class
 */
class FinalValidation {

	/**
	 * FinalValidation constructor.
	 */
	public function __construct() {
	}

	/**
	 * @param $aPeopleObjects
	 * @return bool
	 */
	public function finalValidation( $aPeopleObjects ){

		require_once( 'HasGivenAndRecived.php' );

		$bValid = true;

		foreach ( $aPeopleObjects as $oPersons ) {

			$oSwaps = new Swaps();

			$oGiveingToSelf = new GiveingToSelf();

			$oHasGivenAndRecived = new HasGivenAndRecived();

			$bHasGivenAndRecived = $oHasGivenAndRecived->HasGivenAndRecived( $oPersons );

			$bSwaps = $oSwaps->swaps( $oPersons );

			$bGiveingToSelf = $oGiveingToSelf->giveingToSelf( $oPersons );

			if ( $bSwaps == true || $bGiveingToSelf == true || $bHasGivenAndRecived == false ) {

				return false;

				break;
			}
		}
		return $bValid;
	}
}