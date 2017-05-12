<?php

/**
 * Created by PhpStorm.
 * User: Work
 * Date: 24/02/2017
 * Time: 10:53
 */
class GetEmailInputs {


	/**
	 * GetEmailInputs constructor.
	 */
	public function __construct() {
	}


	/**
	 * @return array
	 */
	public function getEmailInputs(){
		$aContents = new GetValuesForPost();
		$aTextBoxValues = $aContents->getValues();

		$aEmails = array();

		$nIndex = 0;

		foreach ( $aTextBoxValues as $sEmailInput ){
			$aEmails[ $nIndex ] = $sEmailInput;
			$nIndex++;

		}
		return $aEmails;
	}
}