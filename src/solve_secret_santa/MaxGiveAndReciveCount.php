<?php

/**
 * Created by PhpStorm.
 * User: Work
 * Date: 16/02/2017
 * Time: 15:55
 * class is currently unused
 */
class MaxGiveAndReciveCount {


	/**
	 * MaxGiveAndReciveCount constructor.
	 */
	public function __construct() {
	}

	/**
	 * @param Person[] $aPeople
	 * @param $nMaxRecive
	 * @return bool
	 */
	public function TestMaxGiveAndReciveCount( $aPeople, $nMaxRecive ){

		$bDefaultReturn = true;


		foreach( $aPeople as $oPerson ){

			$nCountRec = 0;
			$nCountGiv = 0;

			$nReciver = $oPerson->getReceivedFrom()->getId();
			$nGiver = $oPerson->getGivingTo()->getId();

			foreach( $aPeople as $oPersonComp ){

				$nRecived = $oPersonComp->getReceivedFrom()->getId();

				if( $nRecived === $nReciver ){
					$nCountRec++;
					if( $nCountRec >= $nMaxRecive ){
						return false;
					}
				}
				else {
					$bDefaultReturn = true;
				}

				$nGiving = $oPersonComp->getGivingTo()->getId();

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