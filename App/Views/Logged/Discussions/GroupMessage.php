<style type="text/css">
	body{
		background-color: #aad8df;
	}
</style>
<div class="container">
	<div>
		<div class="page-header">
			<p class="text-center">
				<a href="?page=Logged.Discussions.PersonalMessage" class="btn btn-lg btn-default"><span class="fa fa-envelope-o">&nbsp;</span>Messagerie</a>
				<a href="?page=Logged.Message.Communicate" class="btn btn-lg btn-primary"><span class="fa fa-newspaper-o">&nbsp;</span>Communiquer</a>
				<a href="?page=Logged.Message.Subjet" class="btn btn-lg btn-success"><span class="fa fa-users">&nbsp;</span>Sujet du jour</a>
				<a href="" class="btn btn-lg btn-info"  style="box-shadow: 0px 15px rgba(91, 192, 222, 1);"><span class="fa fa-comments-o">&nbsp;</span>Chat</a>
			</p>
		</div>
	</div>

	<div class="col-xs-12 col-sm-6 col-md-4 col-lg-5" style="background-color: none;">
		<div class="list-group">
	        <?php
	        	if (!empty($users)) {
	        		?>
	        			<a href="#" class="list-group-item active">
				          Membres Connectée 
				        </a>
	        		<?php
	            	foreach ($users as $key => $value) {
	            		?>
	            			<a href="#" class="list-group-item">
	            				<?php
	            					if ($value->enLigne) {
	            						?>
	            							<span style="color: green; margin-right: 12.5%; font-weight: bolder;" >En ligne</span>	
	            							<span>
	            								<?= strtoupper($value->nom)." ".ucwords(strtolower($value->prenom)); ?>
	            							</span>
	            						<?php
	            					} else{
	            				  		?>	
	            				  		 	<span style="color: black; padding-right: 5%; font-weight: bolder;" >Déconnecter</span>
	            							<span>
	            								<?= strtoupper($value->nom)." ".ucwords(strtolower($value->prenom)); ?>
	            							</span>
	            						<?php
	            					}
	            				?>
	            			</a>
	            		<?php
	            	}
	        	} else {
	        		?>
	        			<a href="#" class="list-group-item active h2">
				        	<marquee>Aucun utilisateur connecter !</marquee>
				     	</a>
            		<?php
	        	}
	        ?>
	    </div>
	</div>
	<div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
		<div>
	      	<div class="list-group">
		        <div class="list-group-item active">
		          	<h4 class="list-group-item-heading">Les conversations</h4>
		    	</div>
		 		<div class="jumbotron" style="color: black;">
		 			<?php
				    	if (!empty($texte)) {
				    		foreach ($texte as $value) {
				    			if ($value->_idUtilisateur === $_SESSION["info"]['idUtilisateur']) {
				        			?>
				        				<div class="container alert text-right" style="width: 80%; margin-right: 0%; border: 1px solid rgba(0, 0, 0, 0.5);">
				        					<p class="text-right" style="font-weight: bolder;">
				        						Vous :
				        					</p>
				        					<p class="text-right" style="margin-left: 10%;">
				        						<?php
				        							if (empty($value->contenuTexte)) {
				        								echo "Message vide !";
				        							}
				        							echo ucfirst($value->contenuTexte);
				        						?>
				        					</p>
				        					<p style="font-size: 15px; font-weight: bolder;">
				        						<span class="text-left" style="font-style: oblique;">Envoyer le </span>
				        						<?= date("d-m-Y à H:i:s", strtotime($value->dateRedaction)) ?>
				        					</p>
				        					<form method="POST" action="?page=Logged.Discussions.deleteTexte" style="display: inline; margin-right: 100%;">
				        						<input type="hidden" name="commentaires" value="<?php echo $value->idTexte?>">
				        						<button style="color: red;" type="submit" class="btn "><span class="fa fa-trash">&nbsp;</span></button>
				        					</form>
				        				</div>
				        				<hr class="divider">
				        			<?php
				    			} else {
				    				?>
				        				<div class="container alert alert-info text-left" style="width: 90%; margin-left: 0%">
				        					<p class="text-left">
				        						<div class="col-xs-9 col-sm-9 col-md-8 col-lg-10 h4" style="font-style: oblique; color: black; font-weight: bolder;">
				        							<?php echo strtoupper($value->nom)." ".ucwords(strtolower($value->prenom)); ?>
				        						</div>
												<div class="col-xs-3 col-sm-3 col-md-4 col-lg-2">
													<img style="height: 50px;" class="img-rounded" src="App/Views/upload/<?= $value->photo; ?>">
												</div>
				        					</p>
				        					<p class="col-md-12 text-justify" style="margin-right: 10%;">
			        							<?php
				        							if (empty($value->contenuTexte)) {
				        								echo "Message vide !";
				        							}
				        							echo ucfirst($value->contenuTexte);
				        						?>
				        					</p>
				        					<p class="col-md-12" style="font-size: 15px; font-weight: bolder;">
				        						<span style="font-style: oblique;">Envoyer le </span>
				        						<?= date("d-m-Y à H:i:s", strtotime($value->dateRedaction)); ?>
				        					</p>
				        				</div>
				        				<hr class="divider">
				        			<?php
				    			}
				    		}
				    	} else {
				    		?>
				    			<p class="h1"><marquee>Aucune(s) réaction(s) !</marquee></p>
				    		<?php
				    	}
					?>
				</div>
	 		</div>

	 		<form method="POST">
				<?= $form->textarea("commentaire", "Message", null); ?>
				<?= $form->button("submit", "btn btn-primary", "Envoyer", null); ?>
				<div style="margin-top: -54px; margin-left: 90px;">
					<?= $form->button("reset", "btn btn-danger", "Effacer");?>
				</div>
			</form>	    

	    </div>
	</div>
</div>