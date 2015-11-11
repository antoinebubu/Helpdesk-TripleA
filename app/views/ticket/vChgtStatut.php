<form method="post" action="tickets/update">
<fieldset>
<legend>Modification du ticket</legend>
	<div class="form-group">
		<input type="submit" value="Valider" class="btn btn-default">
		<a class="btn btn-default" href="<?php echo $config["siteUrl"]?>tickets">Annuler</a>
	</div>
<div class="alert alert-info">Ticket : <?php echo $ticket->toString()?></div>
<div class="form-group">
	<input type="hidden" name="id" value="<?php echo $ticket->getId()?>">
	
	<label for="titre">Titre</label>
	<input type="text" name="titre" id="titre" value="<?php echo $ticket->getTitre()?>" placeholder="Entrez le titre" class="form-control">
	<label for="description">Description</label>
	<textarea name="description" id="description" placeholder="Entrez la description" class="form-control"><?php echo $ticket->getDescription()?></textarea>
</div>
<div class="form-group">
	<label for="statut">Statut</label></br>
	<?php foreach ($listStatut as $lStatut){
		$disabled="";
		$check="";
		if($lStatut->getOrdre()<=$ticket->getStatut()->getOrdre()){
			
			
		
			$disabled="disabled";
			if ($disabled="disabled"){
				
				$check="checked='checked'";
				
			}
		echo "<input type='radio' ".$check." ".$disabled." id='idStatut'".$lStatut->getId()."' name='idStatut' value=".$lStatut->getId().">
				<label class='control-label' ".$disabled." for='idStatut".$lStatut->getId()."'>&nbsp;".$lStatut."</label></br>";
		}
	
	else {
		echo "<input type='radio' ".$disabled." id='idStatut'".$lStatut->getId()."' name='idStatut' value=".$lStatut->getId().">
				<label class='control-label' ".$disabled." for='idStatut".$lStatut->getId()."'>&nbsp;".$lStatut."</label></br>";
		
	}
	}?>
	<label>Emetteur</label>
	<div class="form-control" disabled><?php echo $ticket->getUser()?></div>
	<label for="dateCreation">Date de création</label>
	<input type="text" name="dateCreation" id="dateCreation" value="<?php echo $ticket->getDateCreation()?>" disabled class="form-control">
	<input type="hidden" name="id" value="<?php echo $ticket->getId()?>">
	<input type="hidden" name="idUser" value="<?php echo $ticket->getUser()->getId()?>">
	<input type="hidden" name="idCategorie" value="<?php echo $ticket->getCategorie()->getId()?>">
</div>
<div class="form-group">
	<input type="submit" value="Valider" class="btn btn-default">
	<a class="btn btn-default" href="<?php echo $config["siteUrl"]?>tickets">Annuler</a>
</div>
</fieldset>
</form>