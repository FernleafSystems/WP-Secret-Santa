<?php
/**
 * Plugin Name: Secret Santa
 * Author: Patrick Woods
 * Description: This plugin will do a Secret Santa draw for the user. The plugin includes short codes for ajax and a post bases draw. * Version: 1.0
 * Text Domain: secret-santa-wp
 */

require_once ( 'src/solve_secret_santa/Person.php' );
require_once ( 'src/solve_secret_santa/AGivesToB.php' );
require_once ( 'src/solve_secret_santa/Display.php' );
require_once ( 'src/solve_secret_santa/DisplayAll.php' );
require_once ( 'src/solve_secret_santa/GetNames.php' );
require_once ( 'src/solve_secret_santa/GetPeople.php' );
require_once ( 'src/solve_secret_santa/GetRandomPerson.php' );
require_once ( 'src/solve_secret_santa/GiveingToSelf.php' );
require_once ( 'src/solve_secret_santa/Swaps.php' );
require_once ( 'src/solve_secret_santa/DoubleGiveOrRecive.php' );
require_once ( 'src/solve_secret_santa/FindPairs.php' );
require_once ( 'src/solve_secret_santa/Whipe.php' );
require_once ( 'src/solve_secret_santa/SecretSantaClass.php' );
require_once ( 'src/solve_secret_santa/SolveSecret.php' );
require_once ( 'src/GetValuesForPost.php' );
require_once ( 'src/ValidateFormInputs.php' );
require_once ( 'src/ValidateEmails.php' );
require_once ( 'src/ValidateNames.php' );
require_once ( 'src/ArraySearchForDuplicates.php');
require_once ( 'src/DataValidator.php' );
require_once ( 'src/Run.php' );
require_once ( 'src/AdminMenu/WPSecretSantaAdmin.php' );
require_once ( 'src/AdminMenu/WordpressAddSubMenu.php' );
require_once ( 'src/AdminMenu/GetAdminMenuData.php' );
require_once ( 'src/wordpressNoDuplicates.php');
require_once ( 'src/AdminMenu/WordPressSecretSantaOutput.php' );
require_once ( 'src/AdminMenu/WPSecretSantaOutputForm.php');
require_once ( 'src/GetValuesFromShprtCodeForm.php' );
require_once ( 'src/MainShortCodeUIControler.php' );
require_once ( 'src/GetFormValues.php' );
require_once ( 'src/GetValuesFromForm.php' );
require_once ( 'src/Ajax/SecretSantaAjax.php' );
require_once ( 'src/ShortCodes/SecretSantaShortcoeClass.php');
require_once ( 'src/PassToSecretSanta.php');
require_once ( 'src/ShortCodes/SecretSantaShortcodeAjax.php' );
require_once ( 'src/ShortCodes/SecretSantaShortCodeController.php' );
require_once ( 'src/solve_secret_santa/AGivesToB.php' );
require_once ( 'src/solve_secret_santa/GetRandomPerson.php' );
require_once ( 'src/solve_secret_santa/AreTheSamePerson.php' );

session_start();

$oRun = new  Run();
$oRun->run();

$cs_base_dir = WP_PLUGIN_URL . '/' . str_replace(basename( __FILE__), "" ,plugin_basename(__FILE__));