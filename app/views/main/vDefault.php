
<div class="container">
	<div class="well well-lg">
		<div id="main">
			<?php if(Auth::isAdmin()){?>
		<fieldset>
		<legend>Récents</legend>
		<a class="btn btn-info" href="TicketsNouveau">Nouveaux Tickets <?php echo "("; echo $notif; echo ")"; ?></a>
		
		</fieldset>
		<?php }?>
			<fieldset>
				<legend>Données</legend>
				<?php if(Auth::isAdmin()){?>
				<a class="btn btn-default" href="users">Utilisateurs</a>
				<a class="btn btn-primary" href="categories">Catégories</a>
				<?php }?>
				<a class="btn btn-info" href="tickets">Tickets</a>	
				<?php if(Auth::isAdmin()){?>
				<a class="btn btn-success" href="statuts">Statuts</a>
				<?php }?>
				<a class="btn btn-warning" href="faqs">Faq</a>
				<?php if(Auth::isAdmin()){?>
				<a class="btn btn-danger" href="messages">Messages</a>
				<a class="btn btn-danger" href="tickets/messages/1">Messages d'un ticket</a>
				<?php }?>
				
			</fieldset>
			
					<!-- <a class="btn btn-default" href="defaultc/asAdmin">Connexion en tant qu'admin</a> -->
					<?php if(Auth::isAuth()){ ?>


					<fieldset>
					<legend>Connexion</legend>
					
					<?php } 
					?>
					</fieldset>
					 
					
				
				
	

					<a class="btn btn-default" href="connexions/compte" id="btCompte">Mon compte</a>
					<a class="btn btn-warning" href="defaultc/disconnect" id="btDeco">Déconnexion</a>
					

					<fieldset>
					<legend>Connexion</legend>
					<a class="btn btn-default" href="connexions/compte">Mon compte</a>
					<a class="btn btn-warning" href="defaultc/disconnect" id="btDeco">Déconnexion</a>
					
					</fieldset>
						

			</fieldset>
	<!--		<fieldset>
	 			<legend>Exemples</legend>
					<a class="btn btn-link" href="defaultc/ckEditorSample">Exemple ckEditor</a>
					<a class="btn btn-link btAjax">Exemple ajax (liste des utilisateurs)</a>
			</fieldset>    -->

			<fieldset>
				<legend>Exemples</legend>
					<a class="btn btn-link" href="defaultc/ckEditorSample">Exemple ckEditor</a>
					<a class="btn btn-link btAjax">Exemple ajax (liste des utilisateurs)</a>
			</fieldset>

		</div>
		<div id="response"></div>
	</div>

</div>
