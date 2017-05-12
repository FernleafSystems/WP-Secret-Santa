<?php

/**
 * Created by PhpStorm.
 * User: Work
 * Date: 31/03/2017
 * Time: 11:02
 */
class WordPressSecretSantaOutput {


	/**
	 * WordPressSecretSantaOutput constructor.
	 */
	public function __construct() {
	}

	public function secretSantaOuputPage(){
		?>
		<h1></h1>
		<form method = 'post' action = 'options.php'>
			<?php
			settings_fields( 'secret-santa-Output' );
			?>
			<?php
			do_settings_sections( 'options.php' );
			?>
		</form>
		<?php
	}
}