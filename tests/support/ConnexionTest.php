<?php
use micro\orm\DAO;
class ConnexionTest extends \PHPUnit_Framework_TestCase {

	/*
	 * @see_PHPUnit_Framework_TestCase::setUpBeforeClass()
	 */
	public static function setUpBeforeClass(){
		global $config;
		DAO::connect($config["database"]["dbName"]);
	}

	public function testOne(){
		$this->assertEquals(3, 2+1);
	}

} 