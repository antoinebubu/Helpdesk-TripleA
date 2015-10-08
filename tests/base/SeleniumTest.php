<?php
class SeleniumTest extends AjaxUnitTest{
	
	
	public function testIndex(){
		
		$this->get("DefaultC/index");
		
		$bt=$this->getElementBySelector(".btn-link");
		
		
		
		$this->getElementsBySelector(".btn-default");
	
		$doIt=false;
		foreach ($btsDefault as $bt){
			
			
			if($bt->getText()=="Utilisateurs"){
				$bt->click();
				$this->waitFor();
				$doIt=true;
				
				$this->assertPageContainsText("Utilisateurs");
				break;
				
			}
		}
		$this->assertTrue($doIt);
	}
	
	
}