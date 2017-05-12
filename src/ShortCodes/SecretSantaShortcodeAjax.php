<?php

/**
 * Created by PhpStorm.
 * User: Work
 * Date: 19/04/2017
 * Time: 16:19
 */
class SecretSantaShortcodeAjax {

	/**
	 * SecretSantaShortcodeAjax constructor.
	 */
	public function __construct() {
	}

	/**
	 * @param $atts
	 * @return null|string
	 */
	public function secretSantaAjaxFrontend( $atts ){

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
		$sFormCode .= "<form action='?' method='post' id='theForm'> ";

		$sFormCode .= '<h1>' . $atts[ 'title' ] . '</h1>';

		$nIndex = 0;
		while ( $nIndex < $nNumberOfFeilds ) {

			$sSessionName = 'Name' . $nIndex;
			$sSessionEmail = 'Email' . $nIndex;

			$sNameString = 'person_name' . $nIndex;
			$sEmailString = 'person_email' . $nIndex;

			$sFormCode .= '<label for="names">Name</label>';
			$sFormCode .= '<input id="'. $sNameString . '" onblur="validate( ' . $sNameString . ', this.value)" type="text" style="width: 500px;" name="'. $sNameString . '" value = "' . $_SESSION[ $sSessionName ] . '" placeholder="Name"/>' . '<br/>';

			$sFormCode .= '<label for="emails">Email</label>';
			$sFormCode .= '<input id="' . $sEmailString . '" onblur="validate(' . $sEmailString . ', this.value)" type="email" style="width: 500px;" name="' . $sEmailString . '" value = "' . $_SESSION[ $sSessionEmail ] . '" placeholder="Email"/>' . '<br/>';

			$nIndex++;
		}

		$sFormCode .= '<input name="action" type="hidden" value="the_ajax_hook" />&nbsp;';
		$sFormCode .= '<input id="submit_button" value = "Submit" type="button" onClick="submit_me();" />';
		$sFormCode .= '</form>';

		$sFormCode .= '<div id="response_area">';
		$sFormCode .= 'This is where we\'ll get the response';
		$sFormCode .= '</div>';

		return $sFormCode;
	}
}