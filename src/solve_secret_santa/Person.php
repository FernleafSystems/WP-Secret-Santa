<?php
/**
 * Created by PhpStorm.
 * User: Work
 * Date: 03/02/2017
 * Time: 12:02
 */

class Person {

	/**
	 * @var Person
	 */
	private $oGivingTo;
	/**
	 * @var Int
	 */
	private $nId;
	/**
	 * @var string
	 */
	private $sName;
	/**
	 * @var Person
	 */
	private $oReceivedFrom;

	/**
	 * Person constructor.
	 */
	public function __construct(  ){
	}

	/**
	 * @return Person
	 */
	public function getGivingTo() {
		return $this->oGivingTo;
	}

	/**
	 * @return Int
	 */
	public function getId() {
		return $this->nId;
	}

	/**
	 * @return string
	 */
	public function getName() {
		return $this->sName;
	}

	/**
	 * @return Person
	 */
	public function getReceivedFrom() {
		return $this->oReceivedFrom;
	}

	/**
	 * @param $oGivingTo
	 * @return $this
	 */
	public function setGivingTo( $oGivingTo ) {
		$this->oGivingTo = $oGivingTo;
		return $this;
	}

	/**
	 * @param $nId
	 * @return $this
	 */
	public function setId( $nId ) {
		$this->nId = $nId;
		return $this;
	}

	/**
	 * @param $sName
	 * @return $this
	 */
	public function setName( $sName ) {
		$this->sName = $sName;
		return $this;
	}

	/**
	 * @param $oReceivedFrom
	 * @return $this
	 */
	public function setReceivedFrom( $oReceivedFrom ) {
		$this->oReceivedFrom = $oReceivedFrom;
		return $this;
	}

	/**
	 * @return String
	 */
	public function __toString(){
			return $this->sName;
		}

	/**
	 *
	 */
	public function whipePersionDets(){
		$this->setReceivedFrom( null )->setGivingTo( null );
	}

	/**
	 * @return bool
	 */
	public function hasRecived(){
		$bHasRecived = false;
		if( $this->getReceivedFrom() != null ){
			$bHasRecived = true;
		}
		return $bHasRecived;
	}

	/**
	 * @return bool
	 */
	public function hasGiven(){
		$bHasGiven = false;
		if( $this->getGivingTo() != null ){
			$bHasGiven = true;
		}
		return $bHasGiven;
	}

}

