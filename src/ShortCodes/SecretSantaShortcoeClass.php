<?php

/**
 * Created by PhpStorm.
 * User: Work
 * Date: 10/04/2017
 * Time: 09:13
 */
class SecretSantaShortcoeClass {

	private $aValidPairs;
	private $sOutputString;

	/**
	 * SecretSantaShortcoeClass constructor.
	 */
	public function __construct() {
	}

	/**
	 * @return mixed
	 */
	public function getAValidPairs() {
		return $this->aValidPairs;
	}

	/**
	 * @param mixed $aValidPairs
	 */
	public function setAValidPairs( $aValidPairs ) {
		$this->aValidPairs = $aValidPairs;
	}

	/**
	 * @param $atts
	 * @return null|string
	 */
	public function secretSantaShortcode( $atts ){

		$nNumberOfFeilds = get_option( 'number_of_people' );
		$oGetValuesForPost = new GetValuesForPost();
		$aPostValues = $oGetValuesForPost->getValues();

		$sFormCode = null;

		$aNameValues = array();
		$aEmailValues = array();

		$nIndex = 0;
		while( $nIndex < $nNumberOfFeilds ) {
			$aNameValues [ $nIndex ] = $aPostValues [ 'person_name' . $nIndex ];
			$aEmailValues [ $nIndex ] = $aPostValues [ 'person_email' . $nIndex ];
			$nIndex++;
		}

		$sUserInput = null;

		$atts = shortcode_atts(
			array(
				'fieldCount' => 5
			), $atts
		);
		$sFormCode .= "<form action='?' method='post'>";

		$sFormCode .= '<h1>' . $atts[ 'title' ] . '</h1>';

		$nIndex = 0;
		while ( $nIndex < $nNumberOfFeilds ) {

			$sSessionName = 'StName' . $nIndex;
			$sSessionEmail = 'StEmail' . $nIndex;

			$sNameString = 'person_name' . $nIndex;
			$sEmailString = 'person_email' . $nIndex;

			$sFormCode .= '<label for="names">Name</label>';
			$sFormCode .= '<input type="text" style="width: 500px;" name="'. $sNameString . '" value = "' . $_SESSION[ $sSessionName ] . '" placeholder="Name"/>' . '<br/>';

			$sFormCode .= '<label for="emails">Email</label>';
			$sFormCode .= '<input type="email" style="width: 500px;" name="' . $sEmailString . '" value = "' . $_SESSION[ $sSessionEmail ] . '" placeholder="Email"/>' . '<br/>';

			$nIndex++;
		}

		$sFormCode .= '<input type="reset" name="reset">';
		$sFormCode .= '<input type="submit" value="Submit">';
		$sFormCode .= '</form>';

		return $sFormCode;
	}

	/**
	 * @param $atts
	 * @return string
	 */
	public function secretSantaOutputOptionsShortcode( $atts ){

		$sReturnString = '';
		$atts = shortcode_atts(
			array(
				'title' => 'SecretSanta Configuration',
				'src' => 'www.google.com'
			), $atts
		);
		$sReturnString .= '<h1>' . $atts[ 'title' ] . '</h1>';
		$nNumberOfPeople = get_option( 'number_of_people' );

		echo '<br/>';

		$this->processForm( $nNumberOfPeople );

		$sReturnString .= $_SESSION[ 'configString' ];

		return $sReturnString;
	}

	/**
	 * @param $atts
	 * @return string
	 */
	public function secretSantaOutputShortcode( $atts ){

		$atts = shortcode_atts(
			array(
			'title' => 'Secret Santa Output',
		), $atts
		);
		$sReturnString = '';
		$sReturnString .= '<h1>' . $atts[ 'title' ] . '</h1>';
		//echo '<br/>';
		$sReturnString .= $_SESSION[ 'outputString' ];
		return $sReturnString;

		}

	/**
	 * @param $atts
	 * @return string
	 */
	public function secretSantaAjaxOutputShortcode( $atts ){

		$atts = shortcode_atts(
			array(
				'title' => 'Secret Santa Ajax Output',
			), $atts
		);
		$sReturnString = '';
		$sReturnString .= '<h1>' . $atts[ 'title' ] . '</h1>';
		echo '<br/>';
		$sReturnString .= $_SESSION[ 'AjaxOutputString' ];
		return $sReturnString;

	}

	/**
	 * @param $nNumberOfFeilds
	 */
	public function processForm( $nNumberOfFeilds ){

		$oValidateFormInputs = new ValidateFormInputs();
		$aValidInputs = $oValidateFormInputs->validateFormInputs( $nNumberOfFeilds );

		$this->aValidPairs = $aValidInputs;
		$sConfigString = '';

		$oPassToSecretSanta = new PassToSecretSanta();

		if( sizeof( $aValidInputs ) > 2 && $aValidInputs != null ){

			$nIndex = 0;

			while( $nIndex < get_option( 'number_of_people' ) ){

				$sSessionInputName = 'StName' . $nIndex;
				$sSessionInputEmail = 'StEmail' . $nIndex;

				$_SESSION[ $sSessionInputName ] = '';
				$_SESSION[ $sSessionInputEmail ] = '';

				$nIndex++;
			}

			$nIndex = 0;

			foreach( $aValidInputs as $sEmail => $sName ){

				$sSessionInputName = 'StName' . $nIndex;
				$sSessionInputEmail = 'StEmail' . $nIndex;

				$_SESSION[ $sSessionInputName ] = $sName;
				$_SESSION[ $sSessionInputEmail ] = $sEmail;

				$sConfigString .= 'Email = ' . $sEmail . '   ';
				$sConfigString .= 'Name = ' . $sName . '<br/>';

				$nIndex++;
			}
			$this->sOutputString = $oPassToSecretSanta->passToSecretSanta( $aValidInputs );
			$_SESSION[ 'outputString' ] = $this->sOutputString;

			$_SESSION[ 'configString' ] = $sConfigString;
		}
		else if( sizeof( $aValidInputs ) < 3 ){
			?>
				<p style="color: red">Please ensure that you enter at lest three valid inputs or your settings not saved!</p>
			<?php
		}
	}
}