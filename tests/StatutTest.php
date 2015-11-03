<?php
use micro\orm\DAO;
class StatutTest extends AjaxUnitTest {
	
	/*
	 * @see_PHPUnit_Framework_TestCase::setUpBeforeClass()
	 */
public static function setUpBeforeClass(){
		parent::setUpBeforeClass();
		global $config;
		DAO::connect($config["database"]["dbName"]);
	}
	

public function testStatut(){
	
		$this->get("DefaultC/asAdmin");
		$this->waitFor(5);
		$this->assertPageContainsText("Tickets");
		$this->waitFor(5);
		$this->get("tickets");
		$this->waitFor(5);
		
		
		$bt=$this->getElementBySelector(".Tickets-1");
		$bt=$this->getElementBySelector(".glyphicon-edit");	
		$this->assertNotNull($bt);
		$bt->click();
		$this->waitFor(5);
		//ouverture de la modification du premier ticket de la liste
		
		$add2=$this->getElementBySelector(".statut #element1");
		$this->assertNotNull($add2);
		$add2->click();
		$this->waitFor(5);
		
		$submit=$this->getElementBySelector(".valider");
		$this->assertNotNull($submit);
		$submit->click();
		$this->waitFor(5);
		
	
		$this->assertPageContainsText("Nouveau");
		
		
	
				
				
	}
	
}