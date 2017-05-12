<?php

/**
 * Created by PhpStorm.
 * User: Work
 * Date: 16/02/2017
 * Time: 09:31
 * Called from SecretSanta.php
 */
class SecretSantaClass {


	/**
	 * SecretSantaClass constructor.
	 */
	public function __construct() {
	}

	/**
	 * @param $aPeopleObjects
	 * @return int
	 */
	public function runSecretSantaClass( $aPeopleObjects ){

		require_once( 'NumberOfPresetsExchanged.php' );
		require_once( 'FinalValidation.php' );

		$nNumGives = 1;
		$nCount = 0;

		$oFindPairs = new FindPairs();
		$oFullValidation = new FinalValidation();
		$oDisplay = new DisplayAll();
		$oNumPresentsExchanged = new NumberOfPresetsExchanged();
		$oWhipe = new Whipe();

		do {

			$nPresentCount = $oFindPairs->FindPairs( $aPeopleObjects, $nNumGives );
			$bFullValidation = $oFullValidation->finalValidation( $aPeopleObjects );

			if ( $bFullValidation == true ) {
				$sSecretSantaOutputString = $oDisplay->displayAll( $aPeopleObjects, $nNumGives );
				$bNumPresentsExchanged = $oNumPresentsExchanged->NumberOfPresentsExchanged( $aPeopleObjects, 1);
				break;
			}

			$oWhipe->Whipe( $aPeopleObjects );
			$nCount++;

		} while( true );
		return $sSecretSantaOutputString;
	}
}