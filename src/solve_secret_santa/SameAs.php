<?php

/**
 * Created by PhpStorm.
 * This class will compare two people objects and determin if thay are the same
 * Class is currently unused
 */
class SameAs {


	/**
	 * SameAs constructor.
	 */
	public function __construct() {
	}

	/**
	 * @param Person $oPersonA
	 * @param Person $oPersonB
	 * @return bool
	 */
	public function sameAs( $oPersonA, $oPersonB ){
		return $oPersonA->getId() === $oPersonB->getId();
	}
}