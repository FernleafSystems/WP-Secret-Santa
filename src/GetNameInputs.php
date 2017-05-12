<?php

/**
 * Created by PhpStorm.
 * User: Work
 * Date: 24/02/2017
 * Time: 10:53
 */
class GetNameInputs {


	/**
	 * GetNameInputs constructor.
	 */
	public function __construct() {
	}

	/**
	 * @return array
	 */
	public function getNameInputs() {

		$aContents = new GetValuesForPost();
		$aTextBoxValues = $aContents->getValues();

		$aNames = array();

		$nIndex = 0;
		foreach ( $aTextBoxValues as $sNames ) {

			$aNames[ $nIndex ] = $sNames;
			$nIndex++;

		}
		return $aNames;
	}
}