<?php

/**
 * Created by PhpStorm.
 * User: Work
 * Date: 29/03/2017
 * Time: 15:19
 */
class wordpressNoDuplicates {


	/**
	 * wordpressNoDuplicates constructor.
	 */
	public function __construct() {
	}

	/**
	 * @param $aValidNames
	 * @return bool
	 */
	public function duplicates( $aValidNames ) {
		$nOuterIndex = 0;
		$nMatchCount = 0;
		while( $nOuterIndex < sizeof( $aValidNames ) ){
			foreach( $aValidNames as $sElimentComp ){
				if( $aValidNames[$nOuterIndex] == $sElimentComp ){
					$nMatchCount++;
					if( $nMatchCount > 1 ) {
						add_settings_error(
							'incorrectNumberError',
							'validationError',
							'This field must be contain a value of at least 3',
							'error'
						);
						return true;
					}
				}
			}
			$nMatchCount = 0;
			$nOuterIndex++;
		}
		return false;
	}
}