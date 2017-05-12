<?php

/**
 * Created by PhpStorm.
 * User: Work
 * Date: 09/03/2017
 * Time: 10:37
 */
class WordpressAddSubMenu {

	private $nNumberOfPeople;
	private $nNumberOfPresents;
	//assighning to array may need changed
	private $aNames;
	private $aEmails;
	private $nIndex;
	private $nEmailCount;
	private $nNameCount;
	private $aPairs;
	private $nNameFieldCount;
	private $nEmailFieldCount;
	private $nGlobalRegisterCount;
	//the two arrays below need to be passed to secret santa
	private $aValidNames;
	private $aValidEmails;

	private $bErrorsThrown;

	/**
	 * WordpressAddSubMenu constructor.
	 */
	public function __construct() {
	}


	/**
	 * @return String
	 */
	public function SolveSecret(){
		$sSecretSantaOutput = '';
		$oSolveSecretSanta = new SolveSecretSanta();
		$aNames = $this->aValidNames;
		$aEmails = $this->aValidEmails;
		if($this->bErrorsThrown == false) {
			$sSecretSantaOutput = $oSolveSecretSanta->solveSecretSanta( $aNames, $aEmails );
		}
		else {
			$this->bErrorsThrown = false;
		}
		return $sSecretSantaOutput;
	}

	/**
	 * @return mixed
	 */
	public function getNumberOfPeople() {
		$nFeildValueOne = esc_attr( get_option( 'number_of_people' ) );
		$this->nNumberOfPeople = $nFeildValueOne;
		return $this->nNumberOfPeople;
	}

	/**
	 * @return mixed
	 */
	public function getNumberOfPresents() {
		$nFeildValueOne = esc_attr( get_option( 'number_of_presents' ) );
		$this->nNumberOfPresents = $nFeildValueOne;
		return $this->nNumberOfPresents;
	}

	/**
	 * @return mixed
	 */
	public function getNames() {
		return $this->aNames;
	}

	/**
	 * @return mixed
	 */
	public function getEmails() {
		return $this->aEmails;
	}



	/**
	 * @param mixed $nNumberOfPeople
	 */
	public function setNumberOfPeople( $nNumberOfPeople ) {
		$this->nNumberOfPeople = $nNumberOfPeople;
	}

	/**
	 *
	 */
	public function addSubmenuPage() {

		$oSecretSantaAdmin = new WPSecretSantaAdmin();

		add_submenu_page( 'options-general.php' ,
			'SecretSanta',
			'Secret Santa Settings',
			'manage_options',
			'Secret_Santa',
			array( $oSecretSantaAdmin, 'secretSantaCallBack' )
		);
		add_action( 'admin_init', array( $this , 'secretSantaCustomeSettings') );
	}

	/**
	 *
	 */
	public function addSubMenuSecretSantaOutput(){

		$oSecretSantaAdmin = new WordPressSecretSantaOutput();

		add_submenu_page( 'options-general.php' ,
			'SecretSanta',
			'Secret Santa Output',
			'manage_options',
			'Secret_Santa',
			array( $oSecretSantaAdmin, 'secretSantaOuputPage' )
		);
		add_action( 'admin_init', array( $this , 'secretSantaOutput') );
	}

	/**
	 *
	 */
	public function secretSantaOutput(){
		register_setting( 'secret-santa-Output', 'output' );
		add_settings_section( 'secret-santa-output', 'Secret Santa', array( $this , 'secretSantaOutputSE'), 'options-general.php' );
		add_settings_field( 'secretSanta', 'Output', array( $this, 'secretSantaAdminOutput' ), 'options-general.php', 'secret-santa-output' );
	}

	/**
	 *
	 */
	public function secretSantaOutputSE(){
		echo 'Secret Santa output ';
	}

	/**
	 *
	 */
	public function secretSantaAdminOutput(){

		$this->aNames;
		$this->aEmails;

		$nIndex = 0;
		$sOutput = $this->SolveSecret();
		$aOutput = explode("<br/>", $sOutput);
		while( $nIndex < $this->nEmailCount ){
			echo '<input type="text" readonly style="width: 500px; margin: 10px;" name="' . $nIndex . '" value = "' . $aOutput[$nIndex] . '" placeholder="Name"/>';
			echo '<br/>';
			$nIndex++;
		}
	}

	/**
	 *
	 */
	public function secretSantaCustomeSettings(){
		$this->nNameFieldCount = 0;
		$this->aNames = array();
		$this->aEmails = array();
		$this->aPairs = array();
		register_setting( 'secret-santa-settings-group', 'number_of_people', array( $this , 'validateNumberOfPeople') );
		register_setting( 'secret-santa-settings-group', 'number_of_presents', array( $this , 'validateNumberOfPresents') );
		$aNames = array();
		$aEmails = array();
		$nIndex = 0;
		while( $nIndex < get_option( 'number_of_people' ) ) {
			$sVar1 = $nIndex;
			$sVar2 = ( string ) $sVar1;
			$sVarName = 'Names' . $sVar2;
			$sVarEmails = 'Emails' . $sVar2;
			register_setting( 'secret-santa-settings-group', $sVarName, array( $this, 'validateName' ) );
			$aNames[ $nIndex ] = get_option( $sVarName );
			register_setting( 'secret-santa-settings-group', $sVarEmails, array( $this, 'validateEmail' ) );
			$aEmails[ $nIndex ] = get_option( $sVarEmails );
			$nIndex++;
		}
		add_settings_section( 'secret-santa-sidebar-options', 'Sidebar-options', array( $this , 'secret_santa_sidebar_options'), 'options-general.php' );

		add_settings_field( 'sidebar-name', 'Number Of Feilds', array( $this, 'SecretSanta_sidebar_name' ), 'options-general.php', 'secret-santa-sidebar-options' );
		add_settings_field( 'sidebar-people', 'Number Of Presents', array( $this, 'SecretSanta_sidebar_NumPeople' ), 'options-general.php', 'secret-santa-sidebar-options' );

		$nIndex = 0;
		$this->nIndex = 0;
		$this->nEmailCount = 0;
		$this->nNameCount = 0;

		while( $nIndex < get_option( 'number_of_people' ) ) {
			$sVar1 = $nIndex;
			$sVar2 = ( string ) $sVar1;
			$sVarName = 'Names' . $sVar2;
			$sVarEmails = 'Emails' . $sVar2;
			add_settings_field( $sVarName, 'Name', array( $this, 'secretSantaNames' ), 'options-general.php', 'secret-santa-sidebar-options' );
			add_settings_field( $sVarEmails, 'Email', array( $this, 'secretSantaEmails' ), 'options-general.php', 'secret-santa-sidebar-options' );
			$nIndex++;
		}
	}

	/**
	 *
	 */
	public function pairExists(){
		$this->aPairs;
		$nIndex = 0;
		foreach ( $this->aNames as $sName ) {
			if ( $this->aEmails[ $nIndex ] != null && $sName != null ) {
				$this->aPairs[ $this->aEmails[ $nIndex ] ] = $this->aNames[ $nIndex ];
			}
			else {
				$this->bErrorsThrown = true;
				add_settings_error(
					'incorrectNumberError',
					'validationError',
					'Invalid!, An Email was entered without a name or a name was entered without an email',
					'error'
				);
			}
		}
	}

	/**
	 * @return bool
	 */
	public function threeValidPairs(){
		$bThreeValid = true;
		if( sizeof( $this->aPairs ) < 3 ){
			$this->bErrorsThrown = true;
			add_settings_error(
				'incorrectNumberError',
				'validationError',
				'Error! You need to enter at least three valid names and emails',
				'error'
			);
			$bThreeValid = false;
		}
		return $bThreeValid;
	}

	/**
	 *
	 */
	public function secretSantaNames(){
		$sVarName = 'Names' . $this->nNameCount;
		$this->aNames[ $this->nNameCount ] = esc_attr( get_option( $sVarName ) );
		$this->validateName( $this->aNames[ $this->nNameCount ] );
		echo '<input type="text" name="' . $sVarName .'" value = "' . $this->aNames[ $this->nNameCount ] . '" placeholder="Name"/>';
		$this->nNameCount++;
	}

	/**
	 *
	 */
	public function secretSantaEmails(){
		$sVarEmail = 'Emails' . $this->nEmailCount;
		$this->aEmails[ $this->nEmailCount ] = esc_attr( get_option( $sVarEmail ) );
		$sValidEmail = $this->validateEmail( $this->aEmails[ $this->nEmailCount ] );
		echo '<input type="email" name="' . $sVarEmail . '" value = "' . $sValidEmail . '" placeholder="Email"/>';
		$this->nEmailCount++;
		if ( $this->nEmailCount == get_option( 'number_of_people' ) ) {
			$oOutputMenu = new WPSecretSantaOutputForm();
			add_action( 'admin_menu', array( $oOutputMenu, 'wpSecretSantaOutputForm' ) );
			//echo '<br/>';
		}
	}

	/**
	 *
	 */
	public function emailHasAName(){
		if ( $this->aEmails[ $this->nEmailCount ] != null && $this->aNames[ $this->nEmailCount ] != null ) {
			$this->aPairs[ $this->aEmails[ $this->nEmailCount ] ] = $this->aNames[ $this->nEmailCount ];
		}
		else {
			$this->bErrorsThrown = true;
			add_settings_error(
				'incorrectNumberError',
				'validationError',
				'Invalid!, An Email was entered without a name or a name was entered without an email',
				'error'
			);
		}
	}

	/**
	 * @return string
	 * @param string $data
	 */
	public function validateNumberOfPeople( $data ){
		$sCurrentValue = get_option( 'number_of_people' );
		if( $sCurrentValue < 3 ){
			$sCurrentValue = 3;
		}
		if ( $data < 3 ){
			$this->bErrorsThrown = true;
			$sReturnVal = $sCurrentValue;

			add_settings_error(
				'incorrectNumberError',
				'validationError',
				'This field must be contain a value of at least 3',
				'error'
			);
		}
		else {
			$sReturnVal = sanitize_text_field($data);
		}
		$this->nNumberOfPeople = $sReturnVal;
		return $sReturnVal;
	}

	/**
	 * @param $sEMails
	 * @return string
	 */
	public function validateEmail( $sEMails ) {
		$sVar1 = $this->nNameFieldCount - 1;
		$sVar2 = ( string )$sVar1;
		$sVarName = 'Names' . $sVar2;
		$sCurrentName = get_option( $sVarName );

		if ( $sEMails != null && $sCurrentName != null ) {
			$this->nGlobalRegisterCount++;
			$this->aValidNames[ $this->nGlobalRegisterCount - 1 ] = $sCurrentName;
			$this->aValidEmails[ $this->nGlobalRegisterCount - 1 ] = $sEMails;
		}
		else {
			if ( $sEMails == null && $sCurrentName == null ) {
			}
			else {
				$this->bErrorsThrown = true;
				add_settings_error(
					'incorrectNumberError',
					'validationError',
					'Error! name and email pairs must be entered, you cannot only enter a name without an email or vise versa',
					'error'
				);
			}
		}
		$sReturnVal = '';
		$sEMails = urldecode( $sEMails );
		if ( filter_var( $sEMails, FILTER_VALIDATE_EMAIL ) !== false && $sEMails != null ) {
			$sReturnVal = $sEMails;
		}
		else {
			if ( $sEMails != null ) {
				$this->bErrorsThrown = true;
				add_settings_error(
					'incorrectNumberError',
					'validationError',
					'You must enter a valid email that includes an "@" and a "." into each email feild ',
					'error'
				);
			}
		}

		if ( $this->nEmailFieldCount == get_option( 'number_of_people' ) - 1 ) {
			$oArraySearchForDuplicates = new wordpressNoDuplicates();
			$bNameRepeat = $oArraySearchForDuplicates->duplicates( $this->aValidNames );
			$bEmailRepeat = $oArraySearchForDuplicates->duplicates( $this->aValidEmails );
			if( $bEmailRepeat == true || $bNameRepeat == true ){
				$this->bErrorsThrown = true;
				add_settings_error(
					'incorrectNumberError',
					'validationError',
					'Error! You cannot enter a name or email more than once',
					'error'
				);
			}

			if ( $this->nGlobalRegisterCount < 3 ) {
				$this->bErrorsThrown = true;
				add_settings_error(
					'incorrectNumberError',
					'validationError',
					'Error! You must enter at least three people details correctly',
					'error'
				);
			}
		}
		$this->nEmailFieldCount++;
		return $sReturnVal;
	}

	/**
	 * @param $sNames
	 * @return string
	 */
	public function validateName( $sNames){
		$sNames = urldecode ( $sNames );
		if ( strpos( $sNames , ' ' ) == false && $sNames != null ) {
			$sReturnVal = $sNames;
		}
		else {
			$sReturnVal = '';
		}
		$this->nNameFieldCount++;
		return $sReturnVal;
	}

	/**
	 *
	 */
	public function SecretSanta_sidebar_name(){
		$nFeildValueOne = esc_attr( get_option( 'number_of_people' ) );
		if( $nFeildValueOne > 2 ){
			$this->nNumberOfPeople = $this->sanitize_text_field( $this->nNumberOfPeople );
			$this->nNumberOfPeople = $nFeildValueOne;
		}
		echo '<input type="number" min="0" max="100" name="number_of_people" value = "'. $this->nNumberOfPeople .'" placeholder="Number Of People"/>';
	}

	/**
	 * @param $str
	 * @return string
	 */
	public function sanitize_text_field( $str ) {
		$str = strip_shortcodes( strip_tags( stripcslashes( $str ) ) );
		return $str;
	}

	/**
	 *
	 */
	public function SecretSanta_sidebar_NumPeople(){
		$nFeildValueTwo = esc_attr( get_option( 'number_of_presents' ) );
		if( $nFeildValueTwo > 0 && $nFeildValueTwo < 5 ){
			$this->nNumberOfPresents = $this->sanitize_text_field( $this->nNumberOfPresents );
			$this->nNumberOfPresents = $nFeildValueTwo;
		}
		echo '<input type="number" min="1" max="100" name="number_of_presents" value = "'. $this->nNumberOfPresents .'" placeholder="Number Of Presents"/>';
	}

	/**
	 *
	 */
	public function secret_numfeilds_admin_notices() {
		echo '<div class="error"><p><strong>Error</strong>: you entered an invalid number of feilds this feild can only contain numbers greater than 2 </p></div>';
	}

	/**
	 *
	 */
	public function secret_numpresents_admin_notices() {
		echo '<div class="error"><p><strong>Error</strong>: You entered an invalid number of presents this feild can only handle values greater then 0</p></div>';
	}

	/**
	 *
	 */
	public function secret_santa_sidebar_options(){
		echo 'Customise your secret santa configuration ';
	}

	/**
	 *
	 */
	public function secret_santa_inputs(){
		echo 'Input names and emails for each person participating';
	}
}
