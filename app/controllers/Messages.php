<?php
use micro\orm\DAO;
use micro\views\Gui;
use micro\js\Jquery;
use micro\utils\RequestUtils;


/**
 * Gestion des messages
 * @author jcheron
 * @version 1.1
 * @package helpdesk.controllers
 */
class Messages extends \_DefaultController {
	public function Messages(){
		parent::__construct();
		$this->title="Messages";
		$this->model="Message";
	}
	
	
	public function nouveauMess() {
		$contenu = $_POST['newMess'];
		$date = $_POST['dateMess'];
		echo $contenu;
		echo $date;
	}
}