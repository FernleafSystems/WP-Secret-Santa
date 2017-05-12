<?php

/**
 * Created by PhpStorm.
 * User: Work
 * Date: 24/03/2017
 * Time: 12:06
 */
class GetAdminMenuData {

	private $oAdminSubMenu;

	/**
	 * @return mixed
	 */
	public function getOAdminSubMenu() {
		return $this->oAdminSubMenu;
	}

	/**
	 * GetAdminMenuData constructor.
	 */
	public function __construct() {
	}

	/**
	 *
	 */
	public function secretSantaAdmin() {
		$oAdminSubMenu = new WordpressAddSubMenu();
		add_action( 'admin_menu', array( $oAdminSubMenu, 'addSubmenuPage' ) );
		add_action( 'admin_menu', array( $oAdminSubMenu, 'addSubMenuSecretSantaOutput' ) );
	}
}
