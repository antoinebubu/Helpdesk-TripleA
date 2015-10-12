<?php 
use micro\orm\DAO;
class FaqTest extends \PHPUnit_Framework_TestCase {
	
	/*
	 * @see_PHPUnit_Framework_TestCase::setUpBeforeClass()
	 */
	public static function setUpBeforeClass(){
		global $config;
		DAO::connect($config["database"]["dbName"]);
	}
	
	public function testArticleFAQ(){
			
		$faq=DAO::getOne("Faq", "5");
		$this->assertEquals($faq->getId(), 5);
	}
}