<?php

/**
 * Created by PhpStorm.
 * User: Work
 * Date: 23/02/2017
 * Time: 11:12
 */
class ValidateFormInputs {


	/**
	 * ValidateFormInputs constructor.
	 */
	public function __construct() {
	}

	/**
	 * @return array
	 */
	public function validateFormInputs( $nNumberOfFeilds ){
		$aContents = new GetValuesForPost();
		$aTextBoxValues = $aContents->getValues();
		$aEmails = array();
		$aNames = array();
		$nIndex = 0;

		do {
			$sPreDecoded = $aTextBoxValues[ 'person_email' . $nIndex ];
			$aEmails[ $nIndex ] = urldecode( $sPreDecoded );
			$aNames[ $nIndex ] = $aTextBoxValues[ 'person_name' . $nIndex ];
			$nIndex++;

		} while ( $nIndex < $nNumberOfFeilds );

		$aPeopleDets = array();

		$bValidInputsCount = 0;

		$nIndex = 0;

		$oValidateFormEmails = new ValidateEmails();
		$oValidateFormNames = new ValidateNames();

		$oDuplicates = new ArraySearchForDuplicates();
		$bDuplicates = $oDuplicates->arraySearchForDuplicates( $aEmails );

		if( $bDuplicates ){
			?>
			<p style="color: red">
				Error! You cannot enter the same email more than once.
			</p>
			<?php
		}

		foreach ( $aNames as $sName ) {
			if( $oValidateFormEmails->validateEmail( $aEmails[ $nIndex ] ) && $oValidateFormNames->validateName( $sName ) && !$bDuplicates ){
				$aPeopleDets[ $aEmails[ $nIndex ] ] = $sName;
				$bValidInputsCount++;
			}
			else if( $oValidateFormEmails->validateEmail( $aEmails[ $nIndex ] ) && !$oValidateFormNames->validateName( $sName ) ) {

					echo "
            <script type=\"text/javascript\">
            alert(\"Warning!, You have entered an email without a corrosponding name, To save your current settings please add a name for the given email\");
            </script>
        ";
				?>
				<p style="color: red;">
					Error! you have entered an incorrectly formed name or left a name without a corrosponding email.
				</p>
				<?php
				return null;
			}
			else if( $oValidateFormNames->validateName( $sName ) && !$oValidateFormEmails->validateEmail( $aEmails[ $nIndex ] ) ){
				echo "
            <script type=\"text/javascript\">
            alert(\"Warning!, You have entered a name without an email, Please enter an email for the given name to save you settings\");
            </script>
        ";
				?>
				<p style="color: red;">
					Error! you have entered an incorrectly formed email or left an email without a corrosponding name.
				</p>
				<?php
				return null;
			}
			$nIndex++;
		}
		return $aPeopleDets;
	}
}