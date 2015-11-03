<?php
use micro\orm\DAO;
class NouveauxTicketsTest extends AjaxUnitTest {
	
	/*
	 * @see_PHPUnit_Framework_TestCase::setUpBeforeClass()
	 */
public static function setUpBeforeClass(){
		parent::setUpBeforeClass();
		global $config;
		DAO::connect($config["database"]["dbName"]);
	}
	

public function testNouveauxTickets(){
	
		$this->get("DefaultC/asAdmin");
		$this->waitFor(5);
		$this->assertPageContainsText("Nouveaux Tickets");
		$this->waitFor(5);

		$notif= sizeof(DAO::getAll("Ticket", "idStatut='1'"));
		$this->assertEquals($notif, 1);
		$this->get("TicketsNouveau");
		$this->waitFor(5);
		$bt=$this->getElementBySelector(".glyphicon.glyphicon-edit");
		$this->assertNotNull($bt);
		$bt->click();
		$add=$this->getElementById("elementdemande");
		$this->assertNotNull($add);
		$add->click();
		$this->waitFor(5);
		$add2=$this->getElementById("element1");
		$this->assertNotNull($add2);
		$add2->click();
		$titre=$this->getElementById("titre"); 		
		$titre->sendKeys("test ticket nouveau");
		
		$add2=$this->getElementBySelector(".statut #element3");
		$this->assertNotNull($add2);
		$add2->click();
		$this->waitFor(5);
		
		$submit=$this->getElementBySelector(".valider");
		$this->assertNotNull($submit);
		$submit->click();
		$this->waitFor(5);
		
		
		
		
	
	}
	
// 	$titre=$this->getElementById("titre"); 		$titre->sendKeys("Titre de l'article");
	
// 	$cat=$this->getElementById("element1"); 		$cat->click();
}