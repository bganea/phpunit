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

	public function testSumFinder(){
		$input = array(0, 1, 2, 3, 6, 7, 8, 9, 11, 12, 14);
		$result = array('group'=>'6, 7, 8, 9', 'sum'=> 30);
		$this->assertEquals($result, $this->sumFinder($input));
	}

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

	private function sumFinder(array $inputArray){
		$arrayGroups = array();
		foreach ($inputArray as $element) {
			//initial settings
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
}