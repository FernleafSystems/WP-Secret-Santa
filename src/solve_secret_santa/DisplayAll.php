<?php

/**
 * Created by PhpStorm.
 * Displays all details on all people in an array of people objects
 * Called from SecretSantaClass
 */
class DisplayAll {

	/**
	 * DisplayAll constructor.
	 */
	public function __construct() {
	}

	/**
	 * @param $aPeopleObjects
	 * @param $nNumGives
	 * @return int
	 */
	public function displayAll( $aPeopleObjects, $nNumGives ) {
		$sSecretSantaWordpressOutput = '';
		$nIndex = 0;

			do {
				$oDisplay = new Display();
				$sSecretSantaWordpressOutput .= $oDisplay->display( $aPeopleObjects [ $nIndex ] );
				$nIndex++;

			} while ( $nIndex < sizeof( $aPeopleObjects ) * $nNumGives );

			return $sSecretSantaWordpressOutput;
		}
}