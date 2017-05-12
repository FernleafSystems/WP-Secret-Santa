<?php

/**
 * Created by PhpStorm.
 * User: Work
 * Date: 07/04/2017
 * Time: 09:16
 */
class GetFormValues {


	/**
	 * GetFormValues constructor.
	 */
	public function __construct() {
	}

	/**
	 * @param $nNumberOfFeilds
	 * @return array
	 * @throws Exception
	 */
	public function getFormValues( $nNumberOfFeilds ){

		$aData = array();

		$aContents = new GetValuesForPost();
		$aTextBoxValues = $aContents->getValues();

		$aEmails = array();
		$aNames = array();

		$nIndex = 0;

		while ( $nIndex < $nNumberOfFeilds ){
			$aEmails[ $nIndex ] = $aTextBoxValues[ 'person_email' . $nIndex ];
			$aNames[ $nIndex ] = $aTextBoxValues[ 'person_name' . $nIndex ];

			$oDuplicates = new ArraySearchForDuplicates();
			$oDuplicates->arraySearchForDuplicates( $aEmails );

			if( $aEmails[ $nIndex ] == null && $aNames[ $nIndex ] != null ){
				throw new Exception('email cannot be left null.');
			}
			else{
				$aData[ $aEmails[ $nIndex ] ] = $aNames[ $nIndex ];
			}
			$nIndex++;
		}
		return $aData;
	}
}