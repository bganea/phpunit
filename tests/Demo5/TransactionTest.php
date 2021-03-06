<?php
/**
 * Created by PhpStorm.
 * User: Benny
 * Date: 15/06/2018
 * Time: 13:57
 */

namespace Test\Demo5;

use PHPUnit\Framework\TestCase as BaseTest;
use Code\Demo5\FakeLogger;
use Code\Demo5\Transaction;
use SimpleXMLElement;
use Code\Demo5\HttpClient;

class TransactionTest extends BaseTest{
	private $data;

	public function setUp() {
		$this->data = [
			'userId' => 1,
			'items' => [
				'item'=> [
					'id' => 1,
					'quantity' => 99
				]
			]
		];
	}

	public function testPrepareXMLRequest() {
		$logger = new FakeLogger();
		$client=$this->getMockBuilder(HttpClient::class)
			->setConstructorArgs(['http://localhost'])
			->getMock();
		//$client = $this->getMock('HttpClient', array(), array('http://localhost'));
		$transaction = new Transaction($logger, $client, $this->data);
		$request = new SimpleXMLElement(
			$transaction->prepareXMLRequest());
		$item = $request->items->item[0];
		$this->assertEquals("1", $request['userId']);
		$this->assertEquals("1", $item['id']);
		$this->assertEquals("99", $item['quantity']);
	}

	public function testPrepareXMLRequestFail(){
		$logger = new FakeLogger();
		$client=$this->getMockBuilder(HttpClient::class)
			->setConstructorArgs(['http://localhost'])
			->getMock();
		//$client = $this->getMock('HttpClient', array(), array('http://localhost'));
		//$dataMissingUserId = $this->data;
		//unset($dataMissingUserId['userId']);
		//$transaction = new Transaction($logger, $client, $dataMissingUserId);
		$transaction = new Transaction($logger, $client, $this->data);
		$xmlRequest = $transaction->prepareXMLRequest();

		$request = new SimpleXMLElement($xmlRequest);

		$item = $request->items->item[0];
		$this->assertEquals("1", $request['userId']);
		$this->assertEquals("1", $item['id']);
		$this->assertEquals("99", $item['quantity']);
		return $xmlRequest;
	}

	public function testSendRequest()
	{
		$logger = new FakeLogger();
		$client=$this->getMockBuilder(HttpClient::class)
			->setConstructorArgs(['http://localhost'])
			->setMethods(['send'])
			->getMock();
		//$client = $this->getMock('HttpClient', array('send'), array('http://localhost'));
		$client
			->expects($this->any())
			->method('send')
			->will($this->returnValue(true));
		$transaction = new Transaction($logger, $client, $this->data);
		$this->assertFalse($transaction->wasSent());
		$this->assertTrue($transaction->sendRequest());
		$this->assertTrue($transaction->wasSent());
	}
}