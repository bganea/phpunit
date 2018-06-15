<?php
/**
 * Created by PhpStorm.
 * User: Benny
 * Date: 15/06/2018
 * Time: 13:53
 */

namespace Code\Demo5;

use InvalidArgumentException;

class HttpClient {
	private $url;
	private $request;

	public function __construct($url) {
		$this->url = $url;
	}

	public function setRequest($request) {
		$this->request = $request;
	}

	public function send(){
		if(!$this->request) {
			throw new InvalidArgumentException('Missing requestbody');
		}

		$curl = curl_init($this->url);
		curl_setopt($curl, CURLOPT_HEADER, 0);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, array('xml' => $this->request));
		$response = curl_exec($curl);
		curl_close($curl);

		if($response === false) {
			return false;
		}else{
			return true;
		}
	}
}