<?php

/**
 * Created by PhpStorm.
 * User: Work
 * Date: 09/03/2017
 * Time: 09:43
 */
class WPSecretSantaAdmin {


	/**
	 * WPSecretSantaAdmin constructor.
	 */
	public function __construct() {
	}

	/**
	 *
	 */
	public function secretSantaCallBack() {
		?>
		<h1>Secret Santa Options</h1>
		<form method = 'post' action = 'options.php'>
			<?php
			settings_fields( 'secret-santa-settings-group' );
			?>
			<?php
			do_settings_sections( 'options-general.php' );
			?>
            <?php
            submit_button();
            ?>
		</form>
		<?php
	}
}