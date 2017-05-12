<?php

/**
 * Created by PhpStorm.
 * This class will assighn the Give and Recive feilds of a given person to null
 * Called from SecretSantaClass
 */
class Whipe {


	/**
	 * Whipe constructor.
	 */
	public function __construct() {
	}

	/**
	 * @param Person[] $aPeople
	 */
	public function Whipe( $aPeople ){
		foreach ( $aPeople as $oPerson ){
			$oPerson->setGivingTo( null )->setReceivedFrom( null );
		}
	}
}