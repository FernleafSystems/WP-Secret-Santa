<?php

/**
 * Created by PhpStorm.
 * Determins weather any people in an array of people have given or recoved more than one present
 * Class is currently unused
 */
class DoubleGiveOrRecive {

	/**
	 * NoMoreThanOnce constructor.
	 */
	public function __construct() {
	}

	/**
	 * @param Person [] $aPeople
	 * @return bool
	 */
	public function noMoreThanOnce( $aPeople ) {

				$bDefaultReturn = true;

				$aRecivers = array();
				$aGivers = array();

				$nIndex = 0;

				foreach ( $aPeople as $oPerson ) {
					$aRecivers[ $nIndex ] = $oPerson->getReceivedFrom()->getId();
					$aGivers[ $nIndex ] = $oPerson->getGivingTo()->getId();
					$nIndex++;
				}



		foreach ( $aGivers as $nGiver ){

			$nCount1 = 0;

			foreach ( $aGivers as $nGiverComp ){

				if( $nGiver === $nGiverComp ){
					$nCount1++;
					if( $nCount1 >= 2 ){
						return false;
					}
				}
			}

		}

		foreach ( $aRecivers as $nReciver ){
			$nCount2 = 0;
			echo 'Reciver = ' . $nReciver . '<br/>';
			foreach ( $aRecivers as $nReciverComp ){
				echo 'ReciverComp = ' . $nReciverComp . '<br/>';
				if( $nReciver === $nReciverComp ){
					$nCount2++;
					echo $nCount2 . '<br/>';
					if( $nCount2 >= 2 ){
						return false;
					}
				}
			}
		}

				return $bDefaultReturn;
	}

	}
