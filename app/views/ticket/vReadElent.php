<?php use micro\orm\DAO; ?>
<head>
<script>

function submitForm()
{ 
    var xhr; 
    try {  xhr = new ActiveXObject('Msxml2.XMLHTTP');   }
    catch (e) 
    {
        try {   xhr = new ActiveXObject('Microsoft.XMLHTTP'); }
        catch (e2) 
        {
           try {  xhr = new XMLHttpRequest();  }
           catch (e3) {  xhr = false;   }
         }
    }
  
    xhr.onreadystatechange  = function() 
    { 
       if(xhr.readyState  == 4)
       {
        if(xhr.status  == 200) 
            document.ajax.dyn="Received:"  + xhr.responseText; 
        else
            document.ajax.dyn="Error code " + xhr.status;
        }
    }; 
 
   xhr.open( GET", "data.xml",  true); 
   xhr.send(null); 
} 

</script>
</head>
<form name="frm2Titre" id="frm2Titre" onSubmit="return false;">
	<div class="alert alert-info">Ticket : <?php echo $ticket->toString()?></div>
	<div class="form-group">
		<label for="type"><h4>Type : </h4></label>
		<p id="type" name="type"><?=$ticket->getType()?></p>
		<label for="categorie"><h4>Categorie : </h4></label>
		<p id="categorie" name="categorie"><?=$ticket->getCategorie()?></p>
		<label for="titre"><h4>Titre : </h4></label>
		<p id="titre" name="titre"><?=$ticket->getTitre()?></p>
		<label for="categorie"><h4>Description : </h4></label>
		<p id="categorie" name="categorie"><?=$ticket->getDescription()?></p>
		<label for="categorie"><h4>Statut : </h4></label>
		<p id="categorie" name="categorie"><?=$ticket->getStatut()?></p>
		<label for="categorie"><h4>Emetteur : </h4></label>
		<p id="categorie" name="categorie"><?=$ticket->getUser()?></p>
		<label for="categorie"><h4>Date de creation : </h4></label>
		<p id="categorie" name="categorie"><?=$ticket->getDateCreation()?></p>
	</div>
</form>
<?php 

$idTicket = $ticket->getId();
$msg = DAO::getAll("message", "idTicket='".$idTicket."'");
$user = $_SESSION["user"]->getId();

foreach ($msg as $oklm){ ?>

	<div class="form-group" style="background-color:<?php if ($oklm->getUser()->getAdmin()==True){echo '#FFC3C3;';}else{echo '#D4F8F9;';}?>padding:20px; margin-top:10px; margin-<?php if ($oklm->getUser()->getAdmin()==True){echo 'right:200px;';}else{echo 'left:200px;';}?> display:block; overflow:hidden; border:solid #aaa 2px; border-radius:5px;">
		<p id="contMess" name="contMess"><?= $oklm->getContenu();?></p>
		<br>
		<p id="userMess" name="userMess" style="float:right; display:block; padding:10px;"><?= $oklm->getUser();?></p>
	</div>	
	
<?php } ?>

<form class="form-group" action='Messages/nouveauMess' method='post' name='ajax'>
	<input type='hidden' name="idUser" id="idUser" value="<?php echo $user ?>">
	<input type='hidden' name="idTicket" id="idTicket" value="<?php echo $idTicket ?>">
	<label for="newMess">Contenu de votre message : </label> <br>
	<textarea name="newMess" style="width:100%; height:100px; display:block; margin-bottom:10px; border:2px #aaa solid; border-radius:5px;" id="newMess"></textarea>
	<button class="btn btn-primary" name="btAjouter" value="submit" ONCLICK="submitForm()">Ajouter</button>
	<a href="tickets" class="btn btn-primary" id="btReadElent">Retour</a>
</form>
