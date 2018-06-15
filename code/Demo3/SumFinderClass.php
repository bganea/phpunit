<?php
/**
 * Created by PhpStorm.
 * User: Benny
 * Date: 11/06/2018
 * Time: 17:21
 */

namespace Code\Demo3;


class SumFinderClass {
	private $inputArray;

	public function __construct($inputArray = null){
		$this->inputArray = $inputArray;
	}

	public function findSum(){
		$arrayGroups = array();
		foreach ($this->inputArray as $element) {
			//initial settings
			if (!isset($previousElement)) {
				$previousElement = $element;
				$arrayGroupNumber = 0;
			}
			if(($previousElement + 1) != $element)
				$arrayGroupNumber += 1;
			$arrayGroups[$arrayGroupNumber][] = $element;
			$previousElement = $element;
		}
		usort($arrayGroups,array($this,'compareArrays'));
		$highestGroup = array_pop($arrayGroups);

		return $this->extractResult($highestGroup);
	}

	public function compareArrays(array $a, array $b){
		$sumA = array_sum($a);
		$sumB = array_sum($b);
		if($sumA == $sumB ) return 0;
		elseif($sumA > $sumB) return 1;
		else return -1;
	}

	private function extractResult(array $highestGroup) {
		if(!$highestGroup || !is_array($highestGroup))
			return false;
		$group = implode(', ', $highestGroup);
		$groupSum = array_sum($highestGroup);

		return(array('group'=> $group,'sum'=>$groupSum));
	}
}