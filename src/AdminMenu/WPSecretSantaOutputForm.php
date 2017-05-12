<?php

/**
 * Created by PhpStorm.
 * User: Work
 * Date: 31/03/2017
 * Time: 11:05
 */
class WPSecretSantaOutputForm {


	/**
	 * WPSecretSantaOutputForm constructor.
	 */
	public function __construct() {
	}

	public function wpSecretSantaOutputForm(){

			$oSecretSantaOptions = new WordPressSecretSantaOutput();

			add_submenu_page( 'options-general.php' ,
				'SecretSanta',
				'Secret Santa Output',
				'manage_options',
				'Secret_Santa',
				array( $oSecretSantaOptions, 'secretSantaOuputPage' )
			);
		}
}