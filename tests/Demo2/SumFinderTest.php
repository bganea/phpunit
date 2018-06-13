<?php
/**
 * Created by PhpStorm.
 * User: Benny
 * Date: 11/06/2018
 * Time: 17:07
 */

namespace Test\Demo1;

use PHPUnit\Framework\TestCase as BaseTest;

class SumFinderTest extends BaseTest{

	/**
	 * The task is to write a function in PHP that returns the largest sum of contiguous
	 * integers in an ordered array.
	 */
	public function testSumFinder(){
		//region input array, cea mai mare suma de numere consecutive este 6+7+8+9=30
		$input = [0, 1, 2, 3, 6, 7, 8, 9, 11, 12, 14];
		//endregion

		/**
		 * Cum se rezolva problema?
		 *
		 * 1. folosind usort() vom sorta array-ul cu un user defined function
		 * 2. returnam ultimul element din array-ul sortat care va fi si cel mai mare grup
		 */

		//region rezolvare
		$result = [
			'group'=>'6, 7, 8, 9',
			'sum'=> 30
		];
		$this->assertEquals($result, $this->sumFinder($input));
		//endregion
	}

	//region Second test
	public function testCompareArrays(){
		$array1 = array(0,1,2,3);
		$array2 = array(6,7,8,9);
		// $array2 > $array1
		$this->assertEquals(-1,$this->compareArrays($array1,$array2));
		// $array1 < $array2
		$this->assertEquals(1,$this->compareArrays($array2,$array1));
		// $array2 = $array2
		$this->assertEquals(0,$this->compareArrays($array2,$array2));
	}
	//endregion

	//region Full code
	/** Returns largest sum of contiguous integers */
	private function sumFinder(array $inputArray){
		$arrayGroups = array();
		foreach ($inputArray as $element) {
			if (!isset($previousElement)) {
				$previousElement = $element;
				$arrayGroupNumber = 0;
			}
			if (($previousElement + 1) != $element){
				$arrayGroupNumber += 1;
			}
			$arrayGroups[$arrayGroupNumber][] = $element;
			$previousElement = $element;
		}
		usort($arrayGroups,[$this,'compareArrays']);
		$highestGroup = array_pop($arrayGroups);
		return(array('group'=> implode(', ',
			$highestGroup),'sum'=>array_sum($highestGroup)));
	}

	/** Custom array comparison method */
	private function compareArrays($a, $b){
		$sumA = array_sum($a);
		$sumB = array_sum($b);
		if ($sumA == $sumB ){
			return 0;
		}
		elseif ($sumA > $sumB){
			return 1;
		}
		else {
			return -1;
		}
	}
	//endregion
}