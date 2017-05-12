<?php

/**
 * Created by PhpStorm.
 * User: Work
 * Date: 05/05/2017
 * Time: 14:26
 */
class SecretSantaShortCodeController {


	/**
	 * SecretSantaShortCodeController constructor.
	 */
	public function __construct() {
	}

	/**
	 *
	 */
	public function secretSantaShortCodeControler(){
		$oSecretSantaShortCode = new SecretSantaShortcoeClass();
		add_shortcode( 'secret_santa', array( $oSecretSantaShortCode, 'secretSantaShortcode' ) );
		add_shortcode( 'secret_santa_output', array( $oSecretSantaShortCode, 'secretSantaOutputShortcode' ) );
		add_shortcode( 'secret_santa_options_output', array( $oSecretSantaShortCode, 'secretSantaOutputOptionsShortcode' ) );
	}
}