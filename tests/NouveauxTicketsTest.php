<?php
use micro\orm\DAO;
class NouveauxTicketsTest extends \PHPUnit_Framework_TestCase {
	
	public static function setUpBeforeClass(){
		global $config;
		DAO::connect($config["database"]["dbName"]);
	}
	
	public function testNouveauxTickets(){

	global $config;
	$config->
	$notif= sizeof(DAO::getAll("Ticket", "idStatut='1'"));
	$this->assertEquals($notif, 1);
	
}

 	public function testOne(){
	
 		$this->assertEquals(3, 2+1);
 	}
}