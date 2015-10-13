<?php
use micro\orm\DAO;
include "AjaxUnitTest.php";
class ConnexionTest extends AjaxUnitTest {

	/* public function testBtConnexion() {
		$this->get("Connexions");
		$this->waitFor(10);
		$this->assertPageContainsText("Connexion");
		$bt=$this->getElementBySelector(".btn-primary");
		$this->assertNotNull($bt);
		$this->waitFor(10);
		$bt->click();
		$this->waitFor(10);
		$this->assertPageContainsText("Accueil");
	} */
	
	/* public function testConnexionUser() {
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
		$this->waitFor(10);
		$this->assertPageContainsText("user");		
		$this->waitFor(1000);
	} */
	
	/* public function testConnexionAdmin() {
		$this->get("Connexions");
		$this->waitFor(10);
		$this->assertPageContainsText("Connexion");
		$this->waitFor(10);
		$login=$this->getElementById("login");
		$login->sendKeys("admin");
		$this->waitFor(10);
		$mdp=$this->getElementById("mdp");
		$mdp->sendKeys("admin");
		$this->waitFor(10);
		$bt=$this->getElementById("btLogin");
		$this->assertNotNull($bt);
		$bt->click();
		$this->waitFor(10);
		$this->assertPageContainsText("admin");
		$this->waitFor(1000);
	} */
	
	public function testConnexionError() {
		$this->get("Connexions");
		$this->waitFor(10);
		$this->assertPageContainsText("Connexion");
		$this->waitFor(10);
		$login=$this->getElementById("login");
		$login->sendKeys("123");
		$this->waitFor(10);
		$mdp=$this->getElementById("mdp");
		$mdp->sendKeys("123");
		$this->waitFor(10);
		$bt=$this->getElementById("btLogin");
		$this->assertNotNull($bt);
		$bt->click();
		$this->waitFor(10);
		$this->assertPageContainsText("Votre mot de passe ou login est incorrecte.");
		$this->waitFor(1000);
	}

} 