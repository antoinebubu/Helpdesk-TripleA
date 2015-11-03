<?php
use micro\orm\DAO;
use micro\views\Gui;
use micro\js\Jquery;
use micro\utils\RequestUtils;
/**
 * Gestion des articles de la Faq
 * @author jcheron
 * @version 1.1
 * @package helpdesk.controllers
 */
class Faqs extends \_DefaultController {
	private $where="1=1";
	private $orderBy="";
	public function Faqs(){
		parent::__construct();
		$this->title="Foire aux questions";
		$this->model="Faq";
	}

	/***********************************************************************************************************************************************************************/
	/* (non-PHPdoc)
	 * @see _DefaultController::setValuesToObject()
	 */
	protected function setValuesToObject(&$object) {
		parent::setValuesToObject($object);
		$object->setUser(Auth::getUser());
		$categorie=DAO::getOne("Categorie", $_POST["idCategorie"]);
		$object->setCategorie($categorie);
	}
	/***********************************************************************************************************************************************************************/

	/***********************************************************************************************************************************************************************/
	public function test(){
		$faqs=DAO::getAll("Faq","1=1 order by dateCreation limit 1,1");
		foreach ($faqs as $faq){
			echo $faq."<br>";
		}
		echo DAO::$db->query("SELECT max(id) FROM Faq")->fetchColumn();
		$ArticleMax=DAO::getOne("Faq","id=(SELECT max(id) FROM Faq)");
		echo $ArticleMax;
	}
	/***********************************************************************************************************************************************************************/

	/***********************************************************************************************************************************************************************/
	public function index($param=null){

	global $config;
		$this->orderBy="order by dateCreation desc";
		if(!is_array($param) && $param!=null){
			$param=array($param);
		}
		$baseHref=get_class($this);
		if(isset($param) && $param[0] != "mess"){
			if(is_string($param[0])){
				$message=new DisplayedMessage($param[0]);
			}else
				$message=$param[0];
			if(isset($message)){
				$message->setTimerInterval($this->messageTimerInterval);
				$this->_showDisplayedMessage($message);
			}
		}
		

		$currentOrder="";
		$func="getRien";
		
		if(count($param)>1){
			$_SESSION["sortBy"]=$param[1];
		}
		
		if(isset($_SESSION["sortBy"])){
			switch ($_SESSION["sortBy"]){
				case "idCategorie":
					$func="getCategorie";
					$this->orderBy="order by idCategorie";
					break;
				case "dateCreation":
					$func="getDateCreation";
					$this->orderBy="order by dateCreation desc";
					break;
				case "popularity":
					$func="getPopularity";
					$this->orderBy="order by Popularity desc";
					break;
				case "removeFilter":
					$func="getRien";
					break;
			}
		}
		
		$objects=DAO::getAll($this->model,$this->where." ".$this->orderBy);
			
		
		
		echo "<ul style='list-style:none; padding:0 0 0 0;'>";
		
		
		
		if(Auth::isAdmin()){
			echo "<li style='float:left; margin-right:10px;'><a class='btn btn-primary MesArticles' href='".$config["siteUrl"].$baseHref."/mesArticles'>Mes articles</a></li>";
		}
		
		echo "<li style='float:left; margin-right:10px;'><a class='btn btn-info' href='".$config["siteUrl"].$baseHref."'>Tous les articles</a></li>";
		echo 	'<form method="post" action="faqs/search/mess/'.@$param[1].'">
					<li style="float:left;"><input id="inputRecherche" name="titre" class="btn" style="background-color:#ddd; color:#000; cursor:text; border-radius:4px 0px 0px 4px; border-top:solid 2px #999; border-bottom:solid 2px #999; border-left:solid 2px #999;" placeholder="Recherche"></input></li>
					<li style="float:left;"><button type="submit" class="btn glyphicon glyphicon-search" id="btRecherche" style="border-radius:0px 4px 4px 0px; top:0px; border-top:solid 2px #999; border-bottom:solid 2px #999; border-right:solid 2px #999; border-left:solid 1px #bbb"><?php echo $ajou_modif?></button></li>
				</form>
				</ul>';
		
		echo "<table class='table table-striped'>";
		echo "<thead>";
			echo "<tr>";
				echo "<th colspan='5' style='padding-left:90%'>";
				echo "<div class='btn-group'>";
					echo "<button type='button' class='btn btn-primary dropdown-toggle' data-toggle='dropdown' aria-expanded='false' id='btTrier'>";
						echo "Trier par... <span class='caret'></span>";
					echo "</button>";
					echo "<ul class='dropdown-menu' role='menu'>";
						echo "<li><a href='Faqs/index/mess/removeFilter' id='sansFiltre'> sans filtre </a></li>";
						echo "<li><a href='Faqs/index/mess/idCategorie' id='categorie'> categorie </a></li>";
						echo "<li><a href='Faqs/index/mess/dateCreation' id='dateCreation'> date de creation </a></li>";
						echo "<li><a href='Faqs/index/mess/popularity' id='popularite'> popularité </a></li>";
					echo "</ul>";
				echo "</div>";
				echo "</th>";
			echo "</tr>";
		echo "</thead>";
		echo "<tbody>";

		
		if (Auth::isAdmin()){
			foreach ($objects as $object){
				
				if($currentOrder!=$object->$func()."" && $func=="getCategorie"){
					echo "<tr><td colspan='2'><h2>".$object->$func()."</h2></td></tr>";
					$currentOrder=$object->$func()."";
				}
				else{
					$currentOrder=$object->$func()."";
				}
				
				echo "<tr>";
				echo "<td class='titre-faq' style='width:80%'><a id=".$object->getId()." href='".$baseHref."/frm2/".$object->getId()."' style='color:#253939'><b>".$object->getTitre()."</b> - ".$object->getUser()."</a></td>";
				echo "<td>".$object->getPopularity()."</td>";
				echo "<td class='td-center'><a class='btn btn-success btn-xs' href='".$baseHref."/frm2/".$object->getId()."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span></a></td>";
					
				if (Auth::getUser()==$object->getUser()){
					echo "<td class='td-center x '><a class='btn btn-primary btn-xs' href='".$baseHref."/frm/".$object->getId()."'><span class='glyphicon glyphicon-edit' aria-hidden='true'></span></a></td>";
					if ($object->getDisable()=="0"){
						echo "<td class='td-center x'><a class='btn btn-warning btn-xs' href='".$baseHref."/disable/".$object->getId()."'><span class='glyphicon glyphicon-pause' aria-hidden='true'></span></a></td>";
					}
					else {
						echo "<td class='td-center x'><a class='btn btn-info btn-xs' href='".$baseHref."/activate/".$object->getId()."'><span class='glyphicon glyphicon-play' aria-hidden='true'></span></a></td>";
					}
					echo "<td class='td-center x'><a class='btn btn-danger btn-xs' href='".$baseHref."/delete/".$object->getId()."'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span></a></td>";
				}
			}
			echo "</tr>";
		}
		else {
			foreach ($objects as $object){
				if ($object->getDisable()=="0"){
					
					echo "<tr>";
				if($currentOrder!=$object->$func()."" && $func=="getCategorie"){
					echo "<tr><td colspan='2'><h2>".$object->$func()."</h2></td></tr>";
					$currentOrder=$object->$func()."";
				}
				else{
					$currentOrder=$object->$func()."";
				}
					echo "<td class='titre-faq'><a id=".$object->getId()." href='".$baseHref."/frm2/".$object->getId()."' style='color:#253939'><b>".$object->getTitre()."</b> - ".$object->getUser()."</a></td>";
					echo "<td class='td-center'><a class='btn btn-success btn-xs' href='".$baseHref."/frm2/".$object->getId()."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span></a></td>";
				}
			}
			echo "</tr>";
		}
		
		echo "</tbody>";
		echo "</table>";
		
		if (Auth::isAdmin()){
			echo "<a class='btn btn-primary btn-ajouter' href='".$config["siteUrl"].$baseHref."/frm'>Ajouter...</a>";
		}
	}
	/***********************************************************************************************************************************************************************/
	
	/***********************************************************************************************************************************************************************/
	/* (non-PHPdoc)
	 * @see _DefaultController::frm()
	 */
	public function frm($id = NULL) {
		
		if (Auth::isAdmin()){
			$faq = $this->getInstance($id);
			
			$categories=DAO::getAll("Categorie");
			
			if($faq->getCategorie()==null){
				$cat=-1;
			}
		
			else {
				$cat=$faq->getCategorie()->getId();
			}
		
			$listCat=Gui::select($categories,$cat,"Sélectionner une catégorie ...");
		
			if (isset($id)){
				$ajou_modif = "Modifier";
				$this->loadView("faq/vUpdateTitre",array("faq"=>$faq, "ajou_modif"=>$ajou_modif, "idCategorie"=>$cat, "listCat"=>$listCat));
			}
			else {
				$ajou_modif = "Ajouter";
				$this->loadView("faq/vUpdateTitre",array("faq"=>$faq, "ajou_modif"=>$ajou_modif, "idCategorie"=>$cat, "listCat"=>$listCat));
			}
		}
		else {
			echo "Vous devez vous connecter en tant qu'administrateur pour accéder à ce module";
		}
		echo Jquery::execute("CKEDITOR.replace( 'contenu');");
	}
	/***********************************************************************************************************************************************************************/
	
	/***********************************************************************************************************************************************************************/
	public function frm2($id = NULL) {
		$faq = $this->getInstance($id);
		if (Auth::isAdmin()){}
		else {
			$object=DAO::getOne($this->model, $id[0]);
			$object->setPopularity($faq->getPopularity() + 1);
			DAO::update($object);
		}
		
		
		$this->loadView("faq/vReadElent", array("faq"=>$faq));
	}
	/***********************************************************************************************************************************************************************/
	
	/***********************************************************************************************************************************************************************/
	public function disable($id = NULL){
		try{
			$object=DAO::getOne($this->model, $id[0]);
			if($object!==NULL){
				$object->setDisable("1");
				DAO::update($object);
				$msg=new DisplayedMessage("<b>Article</b> ".$object->getTitre()." <b>désactivé</b>");
			}else{
				$msg=new DisplayedMessage($this->model." introuvable","warning");
			}
		}catch(\Exception $e){
			$msg=new DisplayedMessage("Impossible de désactiver l'instance de ".$this->model,"danger");
		}
		$this->forward(get_class($this),"index",$msg);
	}
	/***********************************************************************************************************************************************************************/
	
	/***********************************************************************************************************************************************************************/
	public function activate($id = NULL){
		try{
			$object=DAO::getOne($this->model, $id[0]);
			if($object!==NULL){
				$object->setDisable("0");
				DAO::update($object);
				$msg=new DisplayedMessage("<b>Article</b> ".$object->getTitre()." <b>activé</b>");
			}else{
				$msg=new DisplayedMessage($this->model." introuvable","warning");
			}
		}catch(\Exception $e){
			$msg=new DisplayedMessage("Impossible d'activer l'instance de ".$this->model,"danger");
		}
		$this->forward(get_class($this),"index",$msg);
	}
	/***********************************************************************************************************************************************************************/
	
	/***********************************************************************************************************************************************************************/
	public function search($param=null){
		$this->where="faq.titre LIKE '%".$_POST['titre']."%'";
		$this->index($param);
	}
	/***********************************************************************************************************************************************************************/
	
	/***********************************************************************************************************************************************************************/
	public function mesArticles($param = NULL) {
		
	global $config;
		$this->orderBy="order by dateCreation desc";
		$baseHref=get_class($this);		
		
		$objects=DAO::getAll($this->model,$this->where." ".$this->orderBy);
		
		echo "<a class='btn btn-primary'  style='margin-right:10px;' href='".$config["siteUrl"].$baseHref."/mesArticles'>Mes articles</a>";
		echo "<a class='btn btn-info' href='".$config["siteUrl"].$baseHref."'>Tous les articles</a>";
				echo "<br><br><table class='table table-striped'><tbody>";
			foreach ($objects as $object){
				if (Auth::getUser()==$object->getUser()){
					
					echo "<tr>";
					echo "<td class='titre-faq' style='width:80%'><a href='".$baseHref."/frm2/".$object->getId()."' style='color:#253939'><b>".$object->getTitre()."</b></a></td>";
					echo "<td class='td-center'><a class='btn btn-success btn-xs' href='".$baseHref."/frm2/".$object->getId()."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span></a></td>";
						
					echo "<td class='td-center'><a class='btn btn-primary btn-xs' href='".$baseHref."/frm/".$object->getId()."'><span class='glyphicon glyphicon-edit' aria-hidden='true'></span></a></td>";
					if ($object->getDisable()=="0"){
						echo "<td class='td-center'><a class='btn btn-warning btn-xs' href='".$baseHref."/disable/".$object->getId()."'><span class='glyphicon glyphicon-pause' aria-hidden='true'></span></a></td>";
					}
					else {
						echo "<td class='td-center'><a class='btn btn-info btn-xs' href='".$baseHref."/activate/".$object->getId()."'><span class='glyphicon glyphicon-play' aria-hidden='true'></span></a></td>";
					}
					echo "<td class='td-center'><a class='btn btn-danger btn-xs' href='".$baseHref."/delete/".$object->getId()."'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span></a></td>";
				}
			}
			echo "</tr>";
		
		echo "</tbody>";
		echo "</table>";
		
		if (Auth::isAdmin()){
			echo "<a class='btn btn-primary' href='".$config["siteUrl"].$baseHref."/frm'>Ajouter...</a>";
		}
	}
	/***********************************************************************************************************************************************************************/

}