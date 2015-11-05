<?php
use micro\orm\DAO;
include "AjaxUnitTest.php";
class TicketTest extends AjaxUnitTest {
	public function testAjoutMessage() {
		$this->get("Connexions");
		$this->waitFor(10);
		$this->assertPageContainsText("Connexion");
		$this->waitFor(10);
		$login=$this->getElementById("login");
		$login->sendKeys("user");
		$this->waitFor(10);
		$mdp=$this->getElementById("mdp");
		$mdp->sendKeys("user");
		$this->waitFor(10);
		$bt=$this->getElementById("btLogin");
		$this->assertNotNull($bt);
		$bt->click();
		
		// ****************** //
		
		$this->waitFor(5);
		$this->get("Tickets");
		$this->waitFor(10);
		$href = $this->getElementById("1");
		$this->assertNotNull($href);
		$href->click();
		$this->waitFor(10);
		/*$this->assertPageContainsText("Ecran bleu");
		$login=$this->getElementById("newMess");
		$login->sendKeys("Problème persistant !");
		$this->waitFor(10);
		$bt=$this->getElementById("btAjouter");
		$this->assertNotNull($bt);
		$bt->click();
		$this->waitFor(10);*/
	}
	
}