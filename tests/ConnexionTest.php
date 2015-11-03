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
	
	/*public function testConnexionError() {
		$this->get("Connexions");
		$this->waitFor(10);
		$this->assertPageContainsText("Connexion");
		$this->waitFor(10);
		$login = $this->getElementById("login");
		$login->sendKeys("123");
		$this->waitFor(10);
		$mdp = $this->getElementById("mdp");
		$mdp->sendKeys("123");
		$this->waitFor(10);
		$bt = $this->getElementById("btLogin");
		$this->assertNotNull($bt);
		$bt->click();
		$this->waitFor(10);
		$this->assertPageContainsText("Votre mot de passe ou login est incorrecte.");
		$this->waitFor(1000);
	}*/
	
	public function testDeconnexion() {
		$this->get("Connexions");
		$this->assertPageContainsText("Connexion");
		$login = $this->getElementById("login");
		$login->sendKeys("user");
		$mdp = $this->getElementById("mdp");
		$mdp->sendKeys("user");
		$btLog = $this->getElementById("btLogin");
		$this->assertNotNull($btLog);
		$btLog->click();
		$this->assertPageContainsText("user");
		
		$btDeco = $this->getElementById("btDeco");
		$this->assertNotNull($btDeco);
		$btDeco->click();
		$this->assertPageContainsText("Connexion");
	}
	
	/*public function testModif() {
		$this->get("Connexions");
		$this->assertPageContainsText("Connexion");
		$login = $this->getElementById("login");
		$login->sendKeys("user");
		$mdp = $this->getElementById("mdp");
		$mdp->sendKeys("user");
		$btLog = $this->getElementById("btLogin");
		$this->assertNotNull($btLog);
		$btLog->click();
		$this->assertPageContainsText("user");
		
		$this->get("Connexions/compte");
		$logModif = $this->getElementById("login");
		$logModif->sendKeys("1");
		$btUpdate = $this->getElementById("btUpdateTitre");
		$this->assertNotNull($btUpdate);
		$btUpdate->click();
		$this->assertPageContainsText("user1");
		
		$this->get("Connexions/compte");
		$passModif = $this->getElementById("mdp");
		$passModif->sendKeys("2");
		$btUpdate = $this->getElementById("btUpdateTitre");
		$this->assertNotNull($btUpdate);
		$btUpdate->click();
		$this->get("Connexions/compte");
		$this->assertPageContainsText("user2");
		
		$this->get("Connexions/compte");
		$mailModif = $this->getElementById("mail");
		$mailModif->sendKeys("3");
		$btUpdate = $this->getElementById("btUpdateTitre");
		$this->assertNotNull($btUpdate);
		$btUpdate->click();
		$this->get("Connexions/compte");
		$this->assertPageContainsText("user@local.fr3");
	}*/








} 