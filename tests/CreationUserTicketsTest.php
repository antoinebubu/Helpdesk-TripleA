<?php
use micro\orm\DAO;
class CreationUserTickets extends AjaxUnitTest {
	
	/*
	 * @see_PHPUnit_Framework_TestCase::setUpBeforeClass()
	 */
public static function setUpBeforeClass(){
		parent::setUpBeforeClass();
		global $config;
		DAO::connect($config["database"]["dbName"]);
	}
	

public function testCreationTickets(){
	
		
	$this->get("DefaultC/asUser");
	$this->waitFor(5);
	$this->assertPageContainsText("Tickets");
	
	$this->get("Tickets");
	$this->assertPageContainsText("Ajouter...");
	$click=$this->getElementBySelector(".ajouter");
	$this->assertNotNull($click);
	$click->click();
	$this->waitFor(5);
	$add=$this->getElementById("elementdemande");
	$this->assertNotNull($add);
	$add->click();
	$this->waitFor(5);
	$add2=$this->getElementById("element1");
	$this->assertNotNull($add2);
	$add2->click();
	$titre=$this->getElementById("titre");
	$titre->sendKeys("test ticket nouveau");
	
	
	$submit=$this->getElementBySelector(".valider");
	$this->assertNotNull($submit);
	$submit->click();
	$this->waitFor(5);
	
	$this->assertPageContainsText("test ticket nouveau");
	
				
	}
	
}