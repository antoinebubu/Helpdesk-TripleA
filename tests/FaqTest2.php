<?php
use micro\orm\DAO;
include "AjaxUnitTest.php";
class ConnexionTest extends AjaxUnitTest {
	
	/*public function testLire() {
 		$this->get("Faqs"); 		
 		$this->assertPageContainsText("Foire aux questions");
 		$this->waitFor(1000);
		$bt = $this->getElementBySelector(".Faqs-1");
		$bt = $this->getElementBySelector(".glyphicon-eye-open");
		$this->assertNotNull($bt);
		$bt->click();
 		$this->waitFor(1000);
 	}*/
	
	/*public function testLireLien() {
		$this->get("Faqs");
		$this->assertPageContainsText("Foire aux questions");
		$this->waitFor(1000);
		$href = $this->getElementById("2");
		$this->assertNotNull($href);
		$href->click();
		$this->waitFor(1000);
	}*/
	
	/*public function testTrier() {
		$this->get("Faqs");
		$this->assertPageContainsText("Foire aux questions");
		$this->waitFor(1000);
		$btTrier = $this->getElementById("btTrier");
		$this->assertNotNull($btTrier);
		$btTrier->click();
		$this->waitFor(1000);
		$btChoix = $this->getElementById("categorie");
		$this->assertNotNull($btChoix);
		$btChoix->click();
		$this->waitFor(1000);		
	}*/
	
	public function testRecherche() {
		$this->get("Faqs");
		$this->assertPageContainsText("Foire aux questions");
		$this->waitFor(1000);
		$login = $this->getElementById("inputRecherche");
		$login->sendKeys("helpdesk");
		$this->waitFor(1000);
		//$this->sendEnter("inputRecherche");
		$btRecherche = $this->getElementById("btRecherche");
		$this->assertNotNull($btRecherche);
		$btRecherche->click();
		$this->waitFor(1000);
	}
	
	
	
	
	
	
	
}