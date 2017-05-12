<?php

/**
 * Created by PhpStorm.
 * creates people useing an array of strings and assighning each eliment within the array to the name of a person object within an array of people
 * the array of people is then returned
 * Called in SecretSanta
 */
class GetPeople {


	/**
	 * GetPeople constructor.
	 */
	public function __construct() {
	}

	/**
	 * @param $aNames
	 * @param $aEmails
	 * @return array
	 */
	public function getPeople( $aNames, $aEmails ){

		$aPeople = array();
		$nIterate = 0;

		do {
			$aPeople[ $nIterate ] = new Person();
			$aPeople[ $nIterate ]->setName( $aNames[ $nIterate ] )->setId( $aEmails[ $nIterate ] );
			$nIterate++;

		} while ( $nIterate < sizeof( $aNames ) );

		return $aPeople;
	}
}