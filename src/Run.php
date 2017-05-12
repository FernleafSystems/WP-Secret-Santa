<?php

/**
 * Created by PhpStorm.
 * User: Work
 * Date: 07/03/2017
 * Time: 10:41
 */
class Run {

	/**
	 * Run constructor.
	 */
	public function __construct() {
	}

	/**
	 *
	 */
	public function run() {

		$oAdminSubMenu = new WordpressAddSubMenu();

		$oGetAdminMenu = new GetAdminMenuData();
		$oGetAdminMenu->secretSantaAdmin();

		$oSecretSantaShortCodeController = new SecretSantaShortCodeController();

		$oSecretSantaShortCodeController->secretSantaShortCodeControler();

		$oSecretSantaAjax = new SecretSantaAjax();

		$oSecretSantaAjax->secretSantaAjaxcontroler();

		$nNumberOfFeilds = $oAdminSubMenu->getNumberOfPeople();

		$oContents = new GetValuesForPost();

		$sHiddenFeildValue = '';

		$aTextBoxValues = $oContents->getValues();
		if( isset( $aTextBoxValues[ 'is_form' ] ) ) {
			$sHiddenFeildValue = $aTextBoxValues[ 'is_form' ];
		}

		if ( $sHiddenFeildValue == 'hasrun'  ) {
			$oGetValuesFromForm = new GetValuesFromForm();

				$aFormValues = $oGetValuesFromForm->getValuesFromForm( $nNumberOfFeilds );

			$oDataValidator = new DataValidator();
			$oDataValidator->setData( $aFormValues );

				$aValidPairs = $oDataValidator->validate();

			if( sizeof( $aValidPairs ) > 2 ) {
				$oGetEmailPassIn = new PassToSecretSanta();
				$oGetEmailPassIn->passToSecretSanta( $aValidPairs );
			}
		}
	}
}