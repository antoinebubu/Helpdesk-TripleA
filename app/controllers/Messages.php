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
		$user = $_POST['idUser'];
		$ticket = $_POST['idTicket'];
		
		DAO::$db->execute("INSERT INTO message(id,contenu,idUser,idTicket) VALUES('','".$contenu."',".$user.",".$ticket.")");
		
		$this->forward("Tickets","frm2",$ticket);
		
		if (Auth::isAdmin()){
			$obj=DAO::getOne("ticket", "id=".$ticket);
			$obj->setIdAdmin(Auth::getUser()->getId());
			DAO::update($obj);
				
		}
		
		
	}
}