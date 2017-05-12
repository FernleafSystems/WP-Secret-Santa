<?php

/**
 * Created by PhpStorm.
 * User: Work
 * Date: 05/04/2017
 * Time: 16:39
 */
class MainShortCodeUIControler {


	/**
	 * MainShortCodeUIControler constructor.
	 */
	public function __construct() {
	}

	/**
	 *
	 */
	public function ProcessInputs(){

		$oAdminSubMenu = new WordpressAddSubMenu();

		$nNumberOfFeilds = $oAdminSubMenu->getNumberOfPeople();

		$oContents = new GetValuesForPost();
		$sHiddenFeildValue = '';

		$aTextBoxValues = $oContents->getValues();
		if( isset( $aTextBoxValues[ 'is_form' ] ) ) {
			$sHiddenFeildValue = $aTextBoxValues[ 'is_form' ];
		}
		$aValidPairs = array();

		$aFormValues = array();

		if ( $sHiddenFeildValue == 'hasrun'  ) {
			$oGetValuesFromForm = new GetValuesFromForm();
			try{
				$aFormValues = $oGetValuesFromForm->getValuesFromForm( $nNumberOfFeilds );
			}
			catch ( Exception $oE ) {
				echo 'Caught exception: ',  $oE->getMessage(), "\n";
			}
			$oDataValidator = new DataValidator();
			$oDataValidator->setData( $aFormValues );

			try {
				$aValidPairs = $oDataValidator->validate();
			}
			catch ( Exception $oE ) {
				echo 'Caught exception: ',  $oE->getMessage(), "\n";
			}

			if( sizeof( $aValidPairs ) > 2 ) {
				$oGetEmailPassIn = new PassToSecretSanta();
				$oGetEmailPassIn->passToSecretSanta( $aValidPairs );
			}
			else {
				echo 'Invalid! less than three valid iputs were entered ' . '<br/>';
			}
		}
		else {
			echo 'main else reached ' . '<br/>';
			echo 'Invalid! less than three valid iputs were entered ' . '<br/>';
		}
	}
}