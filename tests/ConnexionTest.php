<?php
use micro\orm\DAO;
class ConnexionTest extends \PHPUnit_Framework_TestCase {

	/*
	 * @see_PHPUnit_Framework_TestCase::setUpBeforeClass()
	 */

	public function testConnexion(){
		if(Auth::isAdmin()) {
			echo 'ok';
		}
	}

} 