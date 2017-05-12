<?php

/**
 * Created by PhpStorm.
 * User: Work
 * Date: 24/02/2017
 * Time: 11:24
 */
class PassToSecretSanta {

	/**
	 * GetEmailPassIn constructor.
	 */
	public function __construct() {
	}

	/**
	 * @param $aValidPairs array of valid pairs is validated to ensure that the array is not to small for secret santa to use
	 * @return String
	 */
	public function passToSecretSanta( $aValidPairs ){

		$oSecretSanta = new SolveSecretSanta();
		$aEmailPassIn = array();
		$aNamePassIn = array();

			$nPos = 0;
			foreach( $aValidPairs as $sEmail => $sNames ) {
				$aEmailPassIn[ $nPos ] = $sEmail;
				$aNamePassIn[ $nPos ] = $sNames;
				$nPos++;
			}
			return $oSecretSanta->solveSecretSanta( $aNamePassIn, $aEmailPassIn );
	}
}