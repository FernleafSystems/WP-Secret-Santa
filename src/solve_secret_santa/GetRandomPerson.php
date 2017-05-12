<?php

/**
 * Created by PhpStorm.
 * Gets a random eliment of an array
 * Called from FindPairs
 */
class getRandomPerson {


	/**
	 * getRandomPerson constructor.
	 */
	public function __construct() {
	}

	/**
	 * @param Person[] $aPeople
	 * @return Person
	 */
	public function getRandomPerson( $aPeople ){

			$oRandom = $aPeople[ array_rand( $aPeople ) ];

		return $oRandom;

	}
}