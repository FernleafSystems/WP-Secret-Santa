<?php

/**
 * Created by PhpStorm.
 * Displays all feilds of a given person object in terms of names
 * Called from DisplayAll
 */
class Display {

	/**
	 * Display constructor.
	 */
	public function __construct() {
	}

	/**
	 * @param $oPerson
	 * @return string
	 */
	public function display( $oPerson ){

		$sName = $oPerson->getName();
		$sReciverName = $oPerson->getReceivedFrom()->getName();
		$sGiverName = $oPerson->getGivingTo()->getName();

		return 'Recived from ' . $sReciverName . ', Name = ' . $sName . ', Gives to ' . $sGiverName . '<br/>';
	}
}