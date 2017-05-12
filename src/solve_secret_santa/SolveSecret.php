<?php
/**
 * Created by PhpStorm.
 * User: Work
 * Date: 17/02/2017
 * Time: 10:05
 */

Class SolveSecretSanta{

	/**
	 * SolveSecretSanta constructor.
	 */
	public function __construct() {
	}

	/**
	 * @param $aNames
	 * @param $aEmails
	 * @return String
	 */
	public function solveSecretSanta ( $aNames, $aEmails ) {
		$oGetNamesOfPeople = new GetNames();

		$aNamesOfPeople = $oGetNamesOfPeople->getNames( $aNames );

		$oPeople = new GetPeople();

		$aPeopleObjects = $oPeople->getPeople( $aNamesOfPeople, $aEmails );

		$oRunSecretSanta = new SecretSantaClass();

		$sSecretSantaWordpressOutput = $oRunSecretSanta->runSecretSantaClass( $aPeopleObjects );

		return $sSecretSantaWordpressOutput;
	}
}
