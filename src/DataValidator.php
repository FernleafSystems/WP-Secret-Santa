<?php

/**
 * Created by PhpStorm.
 * User: Work
 * Date: 24/02/2017
 * Time: 16:02
 */
class DataValidator {


	private $aData;

	/**
	 * DataValidator constructor.
	 */
	public function __construct() {
	}

	/**
	 * @return
	 */
	public function getData() {
		return $this->aData;
	}

	/**
	 * @param $aAllValues
	 * @return $this
	 */
	public function setData( $aAllValues ) {
		$this->aData = $aAllValues;
		return $this;
	}

	/**
	 * @return array
	 * @throws Exception
	 */
	public function validate() {

		$aData = $this->getData();

		$aPeopleDets = array();
		$aEmails = array();
		$bValidInputsCount = 0;

		$oValidateFormEmails = new ValidateEmails();
		$oValidateFormNames = new ValidateNames();

		foreach ( $aData as $sEmail => $sName ) {
			$aEmails[ $bValidInputsCount ] = $sEmail;
			if ( $oValidateFormEmails->validateEmail( $sEmail ) && $oValidateFormNames->validateName( $sName ) ) {

				$aPeopleDets[ $sEmail ] = $sName;
				echo $aPeopleDets[ $sEmail ];
				$bValidInputsCount++;
			}
			else if(  $sEmail == null && $sName == null ){
				unset( $aData[ $sEmail ] );
			}
			else if(  $sEmail == null && $sName != null ){
				unset( $aData[ $sEmail ] );
				throw new Exception( 'Invalid data entry, email feild cannot be left black ' . '<br/>' );
			}
			else {
				unset( $aData[ $sEmail ] );
				throw new Exception( 'Invalid data entry, please enter valid name and email pairs ' . '<br/>' );
			}
		}

		$oDuplicates =  new ArraySearchForDuplicates();
		$oDuplicates->arraySearchForDuplicates( $aEmails );

		return $aData;
	}
}