<?php
/**
 * Created by PhpStorm.
 * Will go through an array of people and find a random person for each member of the array of people
 * The give and recive feilds of each person will be set to represent the exchange of a gift
 * Called from SecretSantaClass
 */
class FindPairs {

	/**
	 * FindPairs constructor.
	 */
	public function __construct() {
	}

	/**
	 * @param Person[] $aPeople
	 * @param $nNumberOfPresentsGiven
	 * @return int|mixed
	 */
	public function FindPairs( $aPeople, $nNumberOfPresentsGiven ){

		$nPresentsGiven = 1;
		$nPresentCount = 0;
		$nNumberOfPeople = 0;

		$oAreTheSamePerson = new AreTheSamePerson();
		$oRandom = new getRandomPerson();
		$oAGivesToB = new AGivesToB();

		foreach ( $aPeople as $oPerson ) {
			$nNumGives = 0;

			while ( $nNumGives < $nNumberOfPresentsGiven ) {

				$nNumberOfPeople++;

				$oRandomPerson = $oRandom->getRandomPerson( $aPeople );

				$bHasRecived = $oRandomPerson->hasRecived();

				$bSame = $oAreTheSamePerson->sameAs( $oPerson, $oRandomPerson );

				if ( $bHasRecived && $bSame ) {
				}
				else {
					$nNumberOfPresents = $oAGivesToB->aGivesToB( $oPerson, $oRandomPerson, $nPresentsGiven );
					$nPresentCount += $nNumberOfPresents;
				}
				$nNumGives++;
			}
		}
		return $nPresentCount;
	}
}