<?php

/**
 * Created by PhpStorm.
 * User: Work
 * Date: 16/02/2017
 * Time: 09:25
 * Is used to determin wether any indeviduals within an array of people have given to more than one person or recived from more than one person
 *it can be used to determin weather the max number of people who recived goes above a given threshold
 * Called from SecretSantaClass
 */
class NumberOfPresetsExchanged {


	/**
	 * NumberOfPresetsExchanged constructor.
	 */
	public function __construct() {
	}

	/**
	 * @param Person[] $aPeople
	 * @param $nMaxRecive
	 * @return bool
	 */
	public function NumberOfPresentsExchanged( $aPeople, $nMaxRecive ){

		$bDefaultReturn = true;

		foreach( $aPeople as $oPerson ){

			$nCountRec = 0;
			$nCountGiv = 0;

			$nReciver = $oPerson->getReceivedFrom()->getId();
			$nGiver = $oPerson->getGivingTo()->getId();

			foreach( $aPeople as $oPersonComp ){

				$nRecived = $oPersonComp->getReceivedFrom()->getId();
				$nGiving = $oPersonComp->getGivingTo()->getId();

				if( $nRecived === $nReciver ){
					$nCountRec++;
					if( $nCountRec >= $nMaxRecive ){
						return false;
					}
				}
				else {
					$bDefaultReturn = true;
				}

				if( $nGiver === $nGiving ){
					$nCountGiv++;
					if( $nCountGiv >= $nMaxRecive ){
						return false;
					}
				}
				else {
					$bDefaultReturn = true;
				}
			}
		}
		return $bDefaultReturn;
	}
}