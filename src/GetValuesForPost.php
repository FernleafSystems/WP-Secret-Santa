<?php

/**
 * Created by PhpStorm.
 * User: Work
 * Date: 17/02/2017
 * Time: 17:16
 * the function gets a string of all values recived from a post within one string
 * the function breakes this string up into an assosiative array of values entered into text feilds and the names attahced
 * to each textbox used as a key
 */
class GetValuesForPost {


	/**
	 * GetValues constructor.
	 */
	public function __construct() {
	}

	/**
	 * @return array
	 */
	public function getValues() {

		$aArrayPost = array();

		$aReliventStrings = file_get_contents('php://input');
		if( $aReliventStrings != null) {
			$aReliventStrings = explode( '&', $aReliventStrings );

			foreach ( $aReliventStrings as $sPairs ) {
				$aPairs = explode( '=', $sPairs, 2 );
				$aArrayPost[ $aPairs[ 0 ] ] = $aPairs[ 1 ];
			}
		}
		return $aArrayPost;
	}
}