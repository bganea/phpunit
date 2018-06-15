<?php
/**
 * Created by PhpStorm.
 * User: Benny
 * Date: 13/06/2018
 * Time: 17:35
 */

namespace Test\Demo4;

use PHPUnit\Framework\TestCase as BaseTest;
use Code\Demo4\MockTester;

class DoublesTest extends BaseTest{
	/**
	 * Următoarele sunt cele mai comune tipuri de dubluri de test
	 * - Dummy - acesta este un container care nu este apelat sau utilizat,
	 * este folosit numai atunci când trebuie să passezi required arguments
	 * - Fake - acesta imita obiectul si functionalitatea lui, dar este scris
	 * si folosit numai pentru teste
	 * - Stub - Aceasta returnează valori predefinite pentru metoda numită sau null pentru
	 * alte metode. Uneori, ele sunt, de asemenea, numite indirect input la teste
	 * - Spy - Acesta este similar cu stub. Pur și simplu retine valorile returnate care pot
	 * fi verificat mai târziu.
	 * - Mock - Cea mai simplă definiție a acestei dubluri de test este, un stub cu așteptări.
	 * O așteptare este specificarea metodei când și cum
	 * ar trebui să fie apelata în timpul unui test.
	 *
	 * $double = $this->getMockClass('MyClass');
	 * $double = $this->getMockBuilder('MyClass')->getMock();
	 */

	public function testOne() {
		$mockTester = $this->getMockBuilder(MockTester::class)
			->disableOriginalConstructor()
			->disableOriginalClone()
			->disableArgumentCloning()
			->disallowMockingUnknownTypes()
			->getMock();
		$mockTester
			->expects($this->any())
			->method('getOne')
			->will($this->returnValue(3));
		$this->assertEquals(3, $mockTester->getOne());
		//$this->assertEquals(2, $mockTester->getTwo());
	}
}