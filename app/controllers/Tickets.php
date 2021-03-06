<?php
use micro\orm\DAO;
use micro\js\Jquery;
use micro\views\Gui;
/**
 * Gestion des tickets
 * @author jcheron
 * @version 1.1
 * @package helpdesk.controllers
 */
class Tickets extends \_DefaultController {
	public function Tickets(){
		parent::__construct();
		$this->title="Tickets";
		$this->model="Ticket";
	}
	
public function index($message=null){
		global $config;
		$baseHref=get_class($this);
		if(isset($message)){
			if(is_string($message)){
				$message=new DisplayedMessage($message);
			}
			$message->setTimerInterval($this->messageTimerInterval);
			$this->_showDisplayedMessage($message);
		}
		
		if (Auth::isAdmin()){
			
			$objects=DAO::getAll("ticket", "idAdmin=".Auth::getUser()->getId());
			echo "<table class='table table-striped'>";
			echo "<thead><tr><th>Mes Tickets</th></tr></thead>";
			echo "<tbody>";
			foreach ($objects as $object){
				echo "<tr>";
				echo "<td class='titre-faq' style='width:80%'><a class=".$baseHref."-".$object->getId()." href='".$baseHref."/frm2/".$object->getId()."' style='color:#253939'>".$object->toString()."</a></td>";
				echo "<td class='td-center'><a class='btn btn-success btn-xs' href='".$baseHref."/frm2/".$object->getId()."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span></a></td>";
				if (Auth::isAdmin()){
				echo "<td class='td-center'><a class='btn btn-primary btn-xs' href='tickets/updateStatut/".$object->getId()."'><span class='glyphicon glyphicon-edit' aria-hidden='true'></span></a></td>".
						"<td class='td-center'><a class='btn btn-warning btn-xs' href='".$baseHref."/delete/".$object->getId()."'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span></a></td>";
				}
				echo "</tr>";
			}
			echo "</tbody>";
			echo "</table>";
			
				
				echo "<br><br><br>";
				$objects=DAO::getAll("Ticket", "idAdmin=0");
				
				echo "<table class='table table-striped'>";
				echo "<thead><tr><th>Nouveaux Tickets</th></tr></thead>";
				echo "<tbody>";
				foreach ($objects as $object){
					echo "<tr>";
					echo "<td class='titre-faq' style='width:80%'><a class=".$baseHref."-".$object->getId()." href='".$baseHref."/frm2/".$object->getId()."' style='color:#253939'>".$object->toString()."</a></td>";
					echo "<td class='td-center'><a class='btn btn-success btn-xs' href='".$baseHref."/frm2/".$object->getId()."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span></a></td>";
					if (Auth::isAdmin()){
						echo "<td class='td-center'><a class='btn btn-primary btn-xs' href='tickets/updateStatut/".$object->getId()."'><span class='glyphicon glyphicon-edit' aria-hidden='true'></span></a></td>".
								"<td class='td-center'><a class='btn btn-warning btn-xs' href='".$baseHref."/delete/".$object->getId()."'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span></a></td>";
					}
					echo "</tr>";
				}	
				
				if (count($objects)==0){
					echo "<tr><td>Aucun nouveau ticket</td></tr>";
				}
				echo "</tbody>";
				echo "</table>";
			
			
		}else{
			$objects=DAO::getAll("ticket", "idUser=".Auth::getUser()->getId());
			echo "<table class='table table-striped'>";
			echo "<thead><tr><th>Mes Tickets</th></tr></thead>";
			echo "<tbody>";
			foreach ($objects as $object){
				echo "<tr>";
				echo "<td class='titre-faq' style='width:80%'><a class=".$baseHref."-".$object->getId()." href='".$baseHref."/frm2/".$object->getId()."' style='color:#253939'>".$object->toString()."</a></td>";
				echo "<td class='td-center'><a class='btn btn-success btn-xs' href='".$baseHref."/frm2/".$object->getId()."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span></a></td>";
				if (Auth::isAdmin()){
					echo "<td class='td-center'><a class='btn btn-primary btn-xs' href='tickets/updateStatut/".$object->getId()."'><span class='glyphicon glyphicon-edit' aria-hidden='true'></span></a></td>".
							"<td class='td-center'><a class='btn btn-warning btn-xs' href='".$baseHref."/delete/".$object->getId()."'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span></a></td>";
				}
				echo "</tr>";
			
			}
			if (count($objects)==0){
				echo "<tr><td>Aucun ticket</td></tr>";
			}
			echo "</tbody>";
			echo "</table>";
		}
		
		
		echo "<a class='ajouter btn btn-primary' href='".$config["siteUrl"].$baseHref."/frm'>Ajouter...</a>";
	}
	
	
	public function trier(){
		$faqs=DAO::getAll("Faq","1=1 order by dateCreation limit 1,1");
		foreach ($faqs as $faq){
			echo $faq."<br>";
		}
		echo DAO::$db->query("SELECT max(id) FROM Faq")->fetchColumn();
		$ArticleMax=DAO::getOne("Faq","id=(SELECT max(id) FROM Faq)");
		echo $ArticleMax;
	}
	
	
	public function messages($id){
		$ticket=DAO::getOne("Ticket", $id[0]);
		if($ticket!=NULL){
			echo "<h2>".$ticket."</h2>";
			$messages=DAO::getOneToMany($ticket, "messages");
			echo "<table class='table table-striped'>";
			echo "<thead><tr><th>Messages</th></tr></thead>";
			echo "<tbody>";
			foreach ($messages as $msg){
				echo "<tr>";
				echo "<td title='message' data-content='".htmlentities($msg->getContenu())."' data-container='body' data-toggle='popover' data-placement='bottom'>".$msg->toString()."</td>";
				echo "</tr>";
			}
			echo "</tbody>";
			echo "</table>";
			echo Jquery::execute("$(function () {
					  $('[data-toggle=\"popover\"]').popover({'trigger':'click','html':true})
				})");
		}
	}
	
	public function frm2($id = NULL) {
		$ticket = $this->getInstance($id);
		$this->loadView("ticket/vReadElent", array("ticket"=>$ticket));
	}
	
	public function frm($id=NULL){
	$ticket=$this->getInstance($id);
		$categories=DAO::getAll("Categorie");
		if($ticket->getCategorie()==null){
			$cat=-1;
		}else{
			$cat=$ticket->getCategorie()->getId();
		}
		
		$statut=DAO::getAll("Statut");
		if($ticket->getStatut()==null){
			$stat=$ticket->getStatut()->getId();
		}else{
			$stat=$ticket->getStatut()->getId();
		}
		
		$listCat=Gui::select($categories,$cat,"Sélectionner une catégorie ...");
		$listType=Gui::select(array("demande","intervention"),$ticket->getType(),"Sélectionner un type ...");
		$listStatut=Gui::select($statut,$stat,"Sélectionner un statut ...");
		$statuts=DAO::getAll("Statut", "1=1");
		
		$this->loadView("ticket/vAdd",array("ticket"=>$ticket,"listCat"=>$listCat,"listType"=>$listType, "listStatut"=>$statuts));
		echo Jquery::execute("CKEDITOR.replace( 'description');");
	
		
			
	}
	
	public function updateStatut($id=NULL){
		$ticket=$this->getInstance($id);
		$statut=DAO::getAll("Statut");
		if($ticket->getStatut()==null){
			$stat=-1;
		}
		else{
			$stat=$ticket->getStatut()->getId();
		}
		
		
	
		
		$statuts=DAO::getAll("Statut", "1=1");
		$this->loadView("ticket/vChgtStatut",array("ticket"=>$ticket, "listStatut"=>$statuts));
	}
	
	/* (non-PHPdoc)
	 * @see _DefaultController::setValuesToObject()
	 */
	protected function setValuesToObject(&$object) {
		parent::setValuesToObject($object);
		$categorie=DAO::getOne("Categorie", $_POST["idCategorie"]);
		$object->setCategorie($categorie);
		$statut=DAO::getOne("Statut", $_POST["idStatut"]);
		$object->setStatut($statut);
		$user=DAO::getOne("User", $_POST["idUser"]);
		$object->setUser($user);
		
	}
	/* (non-PHPdoc)
	 * @see _DefaultController::getInstance()
	 */
	public function getInstance($id = NULL) {
		$obj=parent::getInstance($id);
		if(null==$obj->getType())
			$obj->setType("intervention");
		 if($obj->getStatut()===NULL){
			$statut=DAO::getOne("Statut", 1);
			$obj->setStatut($statut);
		
			}
			
			
		
		if($obj->getUser()===NULL){
			$obj->setUser(Auth::getUser());
		}
		if($obj->getDateCreation()===NULL){
			$obj->setdateCreation(date('Y-m-d H:i:s'));
		}
		return $obj;
	}
	/* (non-PHPdoc)
	 * @see BaseController::isValid()
	 */
	public function isValid() {
		return Auth::isAuth();
	}
	
	
}