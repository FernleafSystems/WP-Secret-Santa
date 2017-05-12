<?php

/**
 * Created by PhpStorm.
 * User: Work
 * Date: 05/05/2017
 * Time: 14:20
 */
class SecretSantaAjax {


	/**
	 * SecretSantaAjax constructor.
	 */
	public function __construct() {
	}

	/**
	 *
	 */
	public function secretSantaAjaxcontroler(){
		$oSecretSantaShortCode = new SecretSantaShortcoeClass();
		add_shortcode( 'secret_santa_ajax_output', array( $oSecretSantaShortCode, 'secretSantaAjaxOutputShortcode' ) );

		add_shortcode( 'test_ajax', array( $this, 'TestAjaxForm' ) );

		add_shortcode('contact', array( $this, 'pippin_shortcode_contact' ) );

		wp_enqueue_script( 'my-ajax-handle', plugin_dir_url( __FILE__ ) . 'ajax.js', array( 'jquery' ) );
		wp_localize_script( 'my-ajax-handle', 'the_ajax_script', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );

		add_action( 'wp_ajax_the_ajax_hook', array( $this, 'theAjaxValidationFunction' ) );
		add_action( 'wp_ajax_nopriv_the_ajax_hook', array( $this, 'theAjaxValidationFunction' ) );

		$oSecretSantaShortcodeAjax = new SecretSantaShortcodeAjax();
		add_shortcode("secret_santa_ajax_frontend", array( $oSecretSantaShortcodeAjax, "secretSantaAjaxFrontend" ) );

		wp_enqueue_script('jquery');
	}

	/**
	 *
	 */
	public function theAjaxValidationFunction(){
		?>
		<h2>Secret Santa Ajax Configuration</h2>
		<?php
		$nNumberOfFeilds = get_option( 'number_of_people' );
		$oValidateFormInputs = new ValidateFormInputs();
		$aValidInputs = $oValidateFormInputs->validateFormInputs( $nNumberOfFeilds );

		$sPrevConfigurationString = $this->getConfigurationForPreviousPost();

		if( sizeof( $aValidInputs ) == 0 ){
			?>
			<p style="color: red" >
				Warning! you have entered and incorrect name or email, or you have entered a name without an email or vice versa';
			</p>
			<?php
			echo $sPrevConfigurationString;
		}
		else if( sizeof( $aValidInputs ) < 3 ){
			?>
			<p style="color: red" >
				Less than three valid entries, please ensure that you have entered at least 3 name email pairs;
			</p>
			<?php
			echo $sPrevConfigurationString;
		}
		else {
			$sConfigurationString = $this->getConfiguratioOutput();
			foreach( $aValidInputs as $sEmail => $sName ){
				echo 'valid Email = ' . $sEmail . ' Name = ' . $sName . '<br/>';
			}
			echo '<br/>' . $sConfigurationString;
		}

		?>
		<h2>Secret Santa ajax Output</h2>
		<?php

		if( sizeof( $aValidInputs ) > 2 ) {
			$oRunSecretSantaAjax = new PassToSecretSanta();
			$sSecretSantaOutput = $oRunSecretSantaAjax->passToSecretSanta( $aValidInputs );
			$_SESSION[ "AjaxOutputString" ] = $sSecretSantaOutput;
		}
		echo $_SESSION[ "AjaxOutputString" ];
		echo '<br/>';
		die();
	}

	/**
	 * @return string
	 */
	public function getConfiguratioOutput(){
		$sReturnString = '';
		$nNumberOfFeilds = get_option( 'number_of_people' );
		$oGetValuesForPost = new GetValuesForPost();
		$aPostValues = $oGetValuesForPost->getValues();

		$nIndex = 0;
		while( $nIndex < $nNumberOfFeilds ) {

			$aNameValues [ $nIndex ] = $aPostValues [ 'person_name' . $nIndex ];
			$aEmailValues [ $nIndex ] = $aPostValues [ 'person_email' . $nIndex ];

			$sSessionName = 'Name' . $nIndex;
			$sSessionEmail = 'Email' . $nIndex;

			if( $aNameValues [ $nIndex ] != null && $aEmailValues [ $nIndex ] != null ) {

				$aNameValues [ $nIndex ] = urldecode( $aNameValues [ $nIndex ] );
				$aEmailValues [ $nIndex ] = urldecode( $aEmailValues [ $nIndex ] );

				$sReturnString .= 'Name = ' . $aNameValues [ $nIndex ] . '<br/>';
				$sReturnString .= 'Email = ' . $aEmailValues [ $nIndex ] . '<br/>';
				$sReturnString .= '<br/>';

				$_SESSION[ $sSessionName ] = $aNameValues [ $nIndex ];
				$_SESSION[ $sSessionEmail ] = $aEmailValues [ $nIndex ];
			}
			else {
				$_SESSION[ $sSessionName ] = null;
				$_SESSION[ $sSessionEmail ] = null;
			}
			$nIndex++;
		}
		return $sReturnString;
	}

	/**
	 * @return string
	 */
	public function getConfigurationForPreviousPost(){
		$sReturnString = '';
		$nNumberOfFeilds = get_option( 'number_of_people' );
		$nIndex = 0;
		while( $nIndex < $nNumberOfFeilds ) {

			$oGetValuesForPost = new GetValuesForPost();
			$aPostValues = $oGetValuesForPost->getValues();

			$aNameValues [ $nIndex ] = $aPostValues [ 'person_name' . $nIndex ];
			$aEmailValues [ $nIndex ] = $aPostValues [ 'person_email' . $nIndex ];

			if( $aNameValues [ $nIndex ] != null && $aEmailValues [ $nIndex ] != null ) {

				$sSessionName = 'Name' . $nIndex;
				$sSessionEmail = 'Email' . $nIndex;

				$sReturnString .= 'Name = ' . $_SESSION[ $sSessionName ];
				$sReturnString .= '<br/>';
				$sReturnString .= 'Email = ' . $_SESSION[ $sSessionEmail ];
				$sReturnString .= '<br/>' . '<br/>';
			}
			$nIndex++;
		}
		return $sReturnString;
	}
}