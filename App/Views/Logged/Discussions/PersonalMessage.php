<style type="text/css">
	body{
		/*background-color: rgba(179, 179, 179, 0.5);*/
		background-color: #aad8df;
	}
	#message{
		height: 100px;
		max-height: 100px;
		min-height: 100px;
		font-size: 20px;
		font-style: oblique;
	}
</style>
<div class="container">
	<div class="">
		<div class="">
			<div class="jumbotron" id="img">
				<img class="img-rounded" src="App/Views/img/icon-left-font-white.png">
			</div>
		</div>
		<div class="page-header">
			<p class="text-center">
				<a href="" class="btn btn-lg btn-default"  style="box-shadow: 0px 15px rgba(255, 255, 255, 1);">
					<span class="fa fa-envelope-o">&nbsp;</span>Messagerie
				</a>
				<a href="?page=Logged.Message.Communicate" class="btn btn-lg btn-primary">
					<span class="fa fa-newspaper-o">&nbsp;</span>Communiquer
				</a>
				<a href="?page=Logged.Message.Subjet" class="btn btn-lg btn-success">
					<span class="fa fa-users">&nbsp;</span>Sujet du jour
				</a>
				<a href="?page=Logged.Discussions.GroupMessage" class="btn btn-lg btn-info">
					<span class="fa fa-comments-o">&nbsp;</span>Chat
				</a>
			</p>
		</div>
	</div>
</div>
<div class="row">
    <div class="col-sm-4">
      <div class="list-group">
        <a href="#" class="list-group-item active">
          Vos chers collègues / Amies (<?php echo count($users); ?>)
        </a>
        <?php
        	if (!empty($users)) {
            	foreach ($users as $key => $value) {
            		?>
            			<a href="?page=Logged.Discussions.PersonalMessage&idUtilisateur=<?= $value->idUtilisateur ?>" class="list-group-item">
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
        	}
        ?>
      </div>
    </div>

    <div class="col-sm-8">
		<div class="list-group">
			<div class="list-group-item active">
			  	<h4 class="list-group-item-heading">Mes messages avec</h4>
				<p class="list-group-item-text h1 text-center">
				  	<?php 
				  		if (!empty($emetteur)) {
				  			echo strtoupper($emetteur->nom)." ".ucwords(strtolower($emetteur->prenom)) ."<img style='height: 80px;' class='img-rounded img-responsive' src='App/Views/upload/$emetteur->photo	'>";
				  		}
				  	?>
				</p>
			</div>
			<div class="jumbotron" style="color: black;">
				<?php
			    	if (!empty($message)) {
			    		foreach ($message as $value) {
			    			if ($value->emetteur === $_SESSION["info"]['idUtilisateur']) {
			        			?>
			        				<div class="container alert alert-success text-right" style="width: 80%; margin-right: 0%">
			        					<p class="text-right">
			        						Moi :
			        					</p>
			        					<p class="text-right" style="margin-left: 10%;">
			        						<?php
			        							if (empty($value->contenu)) {
			        								echo "Message vide !";
			        							}
			        							echo $value->contenu;
			        						?>
			        					</p>
			        					<p style="font-size: 15px; font-weight: bolder;">
			        						<span class="text-left" style="font-style: oblique;">Envoyer le </span>
			        						<?= date("d-m-Y à H:i:s", strtotime($value->dateCreation)) ?>
			        					</p>

			        					<form method="POST" action="?page=Logged.Discussions.delete" style="display: inline; margin-right: 100%;">
			        						<input type="hidden" name="message" value="<?php echo $value->idMessages?>">
			        						<button style="background-color: #dff0d8; color: red;" type="submit" class="btn "><span class="fa fa-trash">&nbsp;</span></button>
			        					</form>
			        				</div>
			        				<hr class="divider">
			        			<?php
			    			} else {
			    				?>
			        				<div class="container alert alert-info text-left" style="width: 80%; margin-left: 0%">
			        					<p class="text-left" style="font-style: oblique; color: black; font-weight: bolder;">
			        						<?= strtoupper($emetteur->nom)." ".ucwords(strtolower($emetteur->prenom)); ?>
			        					</p>
			        					<p class="text-justify" style="margin-right: 10%;">
			        						<?php
			        							if (empty($value->contenu)) {
			        								echo "Message vide !";
			        							}
			        							echo $value->contenu;
			        						?>
			        					</p>
			        					<p style="font-size: 15px; font-weight: bolder;">
			        						<span style="font-style: oblique;">Envoyer le </span>
			        						<?= date("d-m-Y à H:i:s", strtotime($value->dateCreation)); ?>
			        					</p>
			        				</div>
			        				<hr class="divider">
			        			<?php
			    			}
			    		}
			    	}
				?>
			</div>

			<?php
				if($errors){
					?>
						<div class="alert alert-danger text-center h2"><?= $errors_message ?></div>
					<?php
				}
			?>
			<?php 
				if (!empty($emetteur)) {
					?>
			          	<form method="POST" id="envoyer">
							<?= $form->textarea("message", "Message", null, "Redigez votre message"); ?>
							<?= $form->button("submit", "btn btn-primary", "Envoyer", null); ?>
							<div style="margin-top: -54px; margin-left: 90px;">
								<?= $form->button("reset", "btn btn-danger", "Effacer");?>
							</div>
						</form>	            
					<?php
				}
			?>
		</div>
    </div>
</div>