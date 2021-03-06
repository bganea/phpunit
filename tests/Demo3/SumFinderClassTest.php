<?php
/**
 * Created by PhpStorm.
 * User: Benny
 * Date: 11/06/2018
 * Time: 17:27
 */

namespace Test\Demo3;

use PHPUnit\Framework\TestCase as BaseTest;
use Code\Demo3\SumFinderClass;

class SumFinderClassTest extends BaseTest{
	public function testFindSum()
	{
		$input = array(0, 1, 2, 3, 6, 7, 8, 9, 11, 12, 14);
		$result = array('group'=>'6, 7, 8, 9', 'sum'=> 30);
		$sumFinder = new SumFinderClass($input);
		$this->assertEquals($result, $sumFinder->findSum());
	}

	public function testCompareArrays()
	{
		$array1 = array(0,1,2,3);
		$array2 = array(6,7,8,9);

		$sumFinder = new SumFinderClass();
		// $array2 > $array1
		$this->assertEquals(-1,
			$sumFinder->compareArrays($array1,$array2));
		// $array1 < $array2
		$this->assertEquals(1,
			$sumFinder->compareArrays($array2,$array1));
		// $array2 = $array2
		$this->assertEquals(0, $sumFinder->compareArrays($array2,
			$array2));
	}
}