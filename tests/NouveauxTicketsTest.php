<?php
use micro\orm\DAO;
class FirstTest extends \PHPUnit_Framework_TestCase {
	
	
	
public function testNouveauxTickets(){
	$ticket=DAO::getOne("ticket", 1);
	global $config;
	
	$this->assertEquals($notif, 1);
}
}