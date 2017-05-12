<?php

/**
 * Created by PhpStorm.
 * Sets the give feild of first peramiter to the second peramiter
 * and sets the recive feild of the second peramiter to the give feild of the first peramiter
 * Called from FindPairs
 */
class AGivesToB {

	/**
	 * AGivesToB constructor.
	 */
	public function __construct() {
	}

	/**
	 * @param Person $oPersonA
	 * @param Person $oPersonB
	 * @param $nPresentsGiven
	 * @return Person
	 */
	public function aGivesToB( $oPersonA, $oPersonB, $nPresentsGiven ) {
		$nCount = 0;

		while( $nCount < $nPresentsGiven ) {

			$oPersonA->setGivingTo( $oPersonB );
			$oPersonB->setReceivedFrom( $oPersonA );

			$nCount++;
		}
		return $nPresentsGiven;
	}
}