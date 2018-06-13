<?php
/**
 * Created by PhpStorm.
 * User: Benny
 * Date: 07/06/2018
 * Time: 14:01
 */
namespace Test\Demo1;

use PHPUnit\Framework\TestCase as BaseTest;

class DemoTest extends BaseTest{
	//region First test
	public function testDemo(){
		$this->assertTrue(true);
	}
	//endregion

	//region Second test asort(), sorts value by manintainig indexes
	public function estAsort() {
		$vegetablesArray = [
			'carrot' => 1,
			'broccoli' => 2.99,
			'garlic' => 3.98,
			'swede' => 1.75
		];
		$sortedArray = [
			'carrot' => 1,
			'swede' => 1.75,
			'broccoli' => 2.99,
			'garlic' => 3.98
		];
		//sorts value by manintainig indexes
		asort($vegetablesArray, SORT_NUMERIC);

		$this->assertSame($sortedArray, $vegetablesArray);
	}
	//endregion

	//region Third test ksort(), sorts by key
	public function estKsort() {
		$fruitsArray = [
			'oranges' => 1.75,
			'apples' => 2.05,
			'bananas' => 0.68,
			'pear' => 2.75
		];
		$sortedArray = [
			'apples' => 2.05,
			'bananas' => 0.68,
			'oranges' => 1.75,
			'pear' => 2.75
		];
		//sorts by key
		ksort($fruitsArray, SORT_STRING);

		$this->assertSame($sortedArray, $fruitsArray);
	}
	//endregion
}