<?php 
use micro\orm\DAO;
class FaqTest extends AjaxUnitTest {
	
	/*
	 * @see_PHPUnit_Framework_TestCase::setUpBeforeClass()
	 */
	public static function setUpBeforeClass(){
		parent::setUpBeforeClass();
		global $config;
		DAO::connect($config["database"]["dbName"]);
	}
	
// 	public function testArticleFAQ(){
			
// 		$faq=DAO::getOne("Faq", "5");
// 		$this->assertEquals($faq->getId(), 5);
// 	}
	
	public function testButtonAdd(){
		$this->get("DefaultC/asAdmin");
		$this->waitFor(5);
		$this->get("Faqs");
		$this->waitFor(5);
		$this->assertPageContainsText("Foire aux questions");
		$bt=$this->getElementBySelector(".btn-ajouter");
		$this->assertNotNull($bt);
		$bt->click();
		$this->assertNotNull($this->getElementById("contenu"));
		$this->assertNotNull($this->getElementById("titre"));
	}
}