<?php

/**
 * Created by PhpStorm.
 * User: Work
 * Date: 24/02/2017
 * Time: 14:45
 */
class ArraySearchForDuplicates {


	/**
	 * ArraySearchForDuplicates constructor.
	 */
	public function __construct() {
	}

	/**
	 * @param $aEmails
	 * @return bool
	 */
	public function arraySearchForDuplicates( $aEmails ) {
		$nMatchCount = 0;
		foreach ( $aEmails as $sMail ) {

			foreach ( $aEmails as $sEmail ) {

				if($sEmail != null && $sMail != null) {
					if ( $sEmail == $sMail ) {
						$nMatchCount++;
						if ( $nMatchCount > 1 ) {
							return true;
						}
					}
				}
			}
			$nMatchCount = 0;
		}
		return false;
	}
}