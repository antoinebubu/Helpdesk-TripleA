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
			
<<<<<<< HEAD
// 		$faq=DAO::getOne("Faq", "5");
// 		$this->assertEquals($faq->getId(), 5);
// 	}
	
	public function testButtonAdd(){
=======
		$faq=DAO::getOne("Faq", "5");
		$this->assertEquals($faq->getId(), 5);
	}


	public function test_Bouton_Ajouter_Retour_Article_FAQ(){
>>>>>>> origin/master
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
		$bt2=$this->getElementBySelector("a#btUpdateTitre.btn.btn-warning");
		$this->assertNotNull($bt2);
		$bt2->click();
		
		$bt3=$this->getElementBySelector(".btn-ajouter");
		$this->assertNotNull($bt3);
	}


	public function test_Ajouter_Article_FAQ(){
		$this->get("DefaultC/asAdmin");
		$this->waitFor(2);
		$this->get("Faqs");
		$this->waitFor(2);
		$this->assertPageContainsText("Foire aux questions");
		$bt=$this->getElementBySelector(".btn-ajouter");
		$this->assertNotNull($bt);
		$bt->click();
		
		$titre=$this->getElementById("titre");
		$titre->sendKeys("Titre de l'article");
		
		
		$cat=$this->getElementById("element1");
		$cat->click();
		
		$valid=$this->getElementById("btUpdateTitre");
		$valid->click();
		
		$faqElt=DAO::getOne("Faq", "1=1 order by dateCreation DESC LIMIT 0,1");
		$this->assertEquals($faqElt->getTitre(), "Titre de l'article");
		$this->assertEquals($faqElt->getCategorie(), "Réseau");
	}


	public function test_Visualisation_EtRetour_Article_FAQ(){
		$this->get("Faqs");
		$this->waitFor(2);
		$this->assertPageContainsText("Foire aux questions");
		$bt=$this->getElementBySelector(".glyphicon.glyphicon-eye-open");
		$this->assertNotNull($bt);
		$bt->click();
		
		$this->assertPageContainsText("Titre de l'article");
		$this->assertPageContainsText("Réseau");
		
		$bt=$this->getElementById("btReadElent");
		$this->assertNotNull($bt);
		$bt->click();
		$this->assertPageContainsText("Foire aux questions");
	}

	
	public function test_Modif_FAQ(){
		$this->get("DefaultC/asAdmin");
		$this->waitFor(2);
		$this->get("Faqs");
		$this->waitFor(2);
		$this->assertPageContainsText("Foire aux questions");
		$bt=$this->getElementBySelector(".glyphicon.glyphicon-edit");
		$this->assertNotNull($bt);
		$bt->click();
		
		$faqElt=DAO::getOne("Faq", "1=1 order by dateCreation DESC LIMIT 0,1");
		$this->assertPageContainsText($faqElt->getTitre());
		$this->assertPageContainsText("Réseau");
		
		$titre=$this->getElementById("titre");
		$titre->sendKeys(" 2");
		$cat=$this->getElementById("element2");
		$cat->click();
		
		$valid=$this->getElementById("btUpdateTitre");
		$valid->click();
		
		$faqElt=DAO::getOne("Faq", "1=1 order by dateCreation DESC LIMIT 0,1");
		$this->assertEquals($faqElt->getTitre(), "Titre de l'article 2");
		$this->assertEquals($faqElt->getCategorie(), "Routage");
	}


	public function test_Disable(){
		$this->get("DefaultC/asAdmin");
		$this->waitFor(2);
		$this->get("Faqs");
		$this->waitFor(2);
		$this->assertPageContainsText("Foire aux questions");
		
		$bt=$this->getElementBySelector(".glyphicon.glyphicon-pause");
		$this->assertNotNull($bt);
		$bt->click();
		$faqElt=DAO::getOne("Faq", "1=1 order by dateCreation DESC LIMIT 0,1");
		$this->assertEquals($faqElt->getDisable(), "1");
		
		
		$bt=$this->getElementBySelector(".glyphicon.glyphicon-play");
		$this->assertNotNull($bt);
		$bt->click();
		$faqElt=DAO::getOne("Faq", "1=1 order by dateCreation DESC LIMIT 0,1");
		$this->assertEquals($faqElt->getDisable(), "0");
	}
	

	public function test_delete(){
		$this->get("DefaultC/asAdmin");
		$this->waitFor(2);
		$this->get("Faqs");
		$this->waitFor(2);
		$this->assertPageContainsText("Foire aux questions");
		
		$query=DAO::$db->query("SELECT Count(*) FROM faq")->fetchColumn();
		
		
		$titre=$this->getElementBySelector("input.btn");
		$titre->sendKeys($query);
		
		$bt=$this->getElementBySelector(".glyphicon.glyphicon-remove");
		$this->assertNotNull($bt);
		$bt->click();
		$queryy=DAO::$db->query("SELECT Count(*) FROM faq")->fetchColumn();
		
		$this->assertEquals($query, $queryy+1);
	}
	
	
	public function test_admin_mes_articles_FAQ(){
		$this->get("DefaultC/asAdmin");
		$this->waitFor(2);
		$this->get("Faqs");
		$this->waitFor(2);
		$this->assertPageContainsText("Foire aux questions");
		
		$bt=$this->getElementBySelector(".MesArticles");
		$this->assertNotNull($bt);
		$bt->click();
		
		$articles=DAO::getAll("Faq","iduser=1");
		foreach ($articles as $article){
			$this->assertPageContainsText($article->getTitre());
		}
		
		$this->assertEquals(count($this->getElementsBySelector("td.titre-faq")),count($articles));
	}

	
	public function test_Modif_Disable_Delete_SES_ARTICLES(){
		$this->get("DefaultC/asAdmin");
		$this->waitFor(2);
		$this->get("Faqs");
		$this->waitFor(2);
		$this->assertPageContainsText("Foire aux questions");
		$oklm=DAO::getAll("Faq","iduser=1");
		$this->assertEquals(count($this->getElementsBySelector("td.x")),3*count($oklm));
	}
}