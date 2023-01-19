<style type="text/css">
	body{
		background-color: #aad8df;
	}
</style>

<div class="container">
	<div class="jumbotron" id="img">
		<img class="img-rounded" src="App/Views/img/icon-left-font-white.png">
	</div>

	<div class="col-md-12 col-lg-12" align="center" >
		<div class="col-xs-12 col-sm-4 col-md-6 col-lg-7" style="padding-right: 5%;" >
			<div class="list-group">
				<a href="#" class="list-group-item active">
	              Rechercher par grade
	            </a>

				<?php
					foreach ($big as $value) {
						?>
							<a href="?page=Logged.Users.Chose&idGrade=<?= $value->idGrade ?>&pages=<?php echo (isset($_GET['pages'])) ? $_GET['pages'] : 1; ?>" class="list-group-item">
            					<?= ucfirst($value->nomGrade)  ?>
            				</a>
						<?php
					}
				?>

				<ul class="pagination">
					<li class="page-item">
						<span>&laquo;</span>
					</li>
					<?php

						for ($i=1; $i <= $total; $i++) {
							if ($pageCourate == $i) {
								?>
									<li class="active"><a href="?page=Logged.Users.Chose&pages=<?= $i; ?>"><?= $i; ?></a></li>
								<?php
							} else {
								?>
									<li><a href="?page=Logged.Users.Chose&pages=<?= $i; ?>"><?= $i; ?></a></li>
								<?php
							}
						}

					?>
					<li class="page-item">
						<span>&raquo;</span>
					</li>
				</ul>
			</div>
		</div>

		<div style="margin-bottom: 70px; background-color: white; border-radius: 50px;" id="carousel-example-generic" class="carousel slide col-xs-12 col-sm-8 col-md-6 col-lg-5" data-ride="carousel">
			<ol class="carousel-indicators">
				<?php
					for ($i=0; $i < $nombre; $i++) { 
						if ($i == 0) {
							?>
								<li data-target="#carousel-example-generic" data-slide-to="<?= $i; ?>" class="active"></li>
							<?php
						} else{
							?>
								<li data-target="#carousel-example-generic" data-slide-to="<?= $i; ?>"></li>
							<?php
						}
					}
				?>
			</ol>
			<div class="carousel-inner" role="listbox" style="height: 320px;">
				<?php
					if($errors){
						?>
							<div class="alert alert-info text-center h2" style="margin-top: 115px;"><?= $errors_message ?></div>
						<?php
					} else {
						for ($i=0; $i < $nombre; $i++) { 
							if ($i == 0) {
								?>
									<div class="item active" style="margin-top: 30px;">
										<p>
											<img style="height: 100px; width: 100px;" class="img-rounded" src="App/Views/upload/<?= $users[$i]->photo; ?>">
										</p>
										<p><?= strtoupper($users[$i]->nom)." ".ucwords(strtolower($users[$i]->prenom)); ?></p>
										<?php
											if ($users[$i]->statut == 1) {
												if ($users[$i]->suivie === $_SESSION["info"]['idUtilisateur']) {
													?>
														<p>
															<div class="h3">Vous avez une demande d’amitié </div>
															<a class="btn btn-success" href="?page=Logged.Users.Chose&idFollower=<?= $users[$i]->idUtilisateur; ?>&action=ok">Accepter l'invitation</a>
															<a class="btn btn-danger" href="?page=Logged.Users.Chose&idFollowed=<?= $users[$i]->idUtilisateur; ?>">Refuser l'invitation</a>
														</p>
													<?php
												} else {
													?>
														<p>
															<div class="h3">Demande en attente !</div>
															<a class="btn btn-warning" href="?page=Logged.Users.Chose&idFollowed=<?= $users[$i]->idUtilisateur; ?>">Annuler l'invitation </a>
														</p>
													<?php
												}
											} elseif ($users[$i]->statut == 2) {
												if (!is_null($users[$i]->bloqueur)) {
													if ($users[$i]->bloqueur === $_SESSION["info"]['idUtilisateur']) {
														?>
															<p>
																<div class="h3">Vous ete amies, vous l'avez bloquer !</div>
																<a class="btn btn-success" href="?page=Logged.Users.Chose&idFollower=<?= $users[$i]->idUtilisateur; ?>&action=dislock"><span class="fas fa-unlock-alt">&nbsp;&nbsp;</span>Débloquer</a>
															</p>
														<?php
													} elseif ($users[$i]->bloqueur != $_SESSION["info"]['idUtilisateur']) {
														?>
															<p>
																<div class="alert alert-info h3">Vous avez été bloqué par ce collègue !</div>
															</p>
														<?php
													}
												} else {
													?>
														<p>
															<div class="h3">Vous êtes amies !</div>
															<a class="btn btn-danger" href="?page=Logged.Users.Chose&idFollower=<?= $users[$i]->idUtilisateur; ?>&action=lock"><span class="fa fa-lock">&nbsp;&nbsp;</span>Bloquer</a>
														</p>
													<?php
												}
											} else {
												?>
													<p>
														<div class="h3">Faites votre demandes d’amitié !</div>
														<a class="btn btn-success" href="?page=Logged.Users.Chose&idFollowed=<?= $users[$i]->idUtilisateur; ?>">Ajouter</a>
													</p>							
												<?php
											}
										?>
									</div>
								<?php
							} else{
								?>
									<div class="item" style="margin-top: 30px;">
										<p>
											<img style="height: 100px; width: 100px;" class="img-rounded" src="App/Views/upload/<?= $users[$i]->photo; ?>">
										</p>
										<p><?= strtoupper($users[$i]->nom)." ".ucwords(strtolower($users[$i]->prenom)); ?></p>
										<?php
											if ($users[$i]->statut == 1) {
												if ($users[$i]->suivie === $_SESSION["info"]['idUtilisateur']) {
													?>
														<p>
															<div class="h3">Vous avez une demande d’amitié </div>
															<a class="btn btn-success" href="?page=Logged.Users.Chose&idFollower=<?= $users[$i]->idUtilisateur; ?>&action=ok">Accepter l'invitation</a>
															<a class="btn btn-danger" href="?page=Logged.Users.Chose&idFollowed=<?= $users[$i]->idUtilisateur; ?>">Refuser l'invitation</a>
														</p>
													<?php
												} else {
													?>
														<p>
															<div class="h3">Demande en attente !</div>
															<a class="btn btn-warning" href="?page=Logged.Users.Chose&idFollowed=<?= $users[$i]->idUtilisateur; ?>">Annuler l'invitation </a>
														</p>
													<?php
												}
											}  elseif ($users[$i]->statut == 2) {
												if (!is_null($users[$i]->bloqueur)) {
													if ($users[$i]->bloqueur === $_SESSION["info"]['idUtilisateur']) {
														?>
															<p>
																<div class="h3">Vous ete amies, vous l'avez bloquer !</div>
																<a class="btn btn-success" href="?page=Logged.Users.Chose&idFollower=<?= $users[$i]->idUtilisateur; ?>&action=dislock"><span class="fa fa-unlock-alt">&nbsp;&nbsp;</span>Débloquer</a>
															</p>
														<?php
													} elseif ($users[$i]->bloqueur != $_SESSION["info"]['idUtilisateur']) {
														?>
															<p>
																<div class="alert alert-info h3">Vous avez été bloqué par ce collègue !</div>
															</p>
														<?php
													}
												} else {
													?>
														<p>
															<div class="h3">Vous êtes amies !</div>
															<a class="btn btn-danger" href="?page=Logged.Users.Chose&idFollower=<?= $users[$i]->idUtilisateur; ?>&action=lock"><span class="fa fa-lock">&nbsp;&nbsp;</span>Bloquer</a>
														</p>
													<?php
												}
											} else {
												?>
													<p>
														<div class="h3">Faites votre demandes d’amitié !</div>
														<a class="btn btn-success" href="?page=Logged.Users.Chose&idFollowed=<?= $users[$i]->idUtilisateur; ?>">Ajouter</a>
													</p>								
												<?php
											}
										?>
									</div>
								<?php
							}
						}
					}	
				?>
			</div>
			<a style="border-radius: 50px 1px 1px 50px;" title="précèdent" class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
				<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a style="border-radius: 1px 50px 50px 1px;" title="suivant" class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
				<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
		</div>
	</div>
	
	<div>
		<div class="page-header">
			<p class="text-center h1" style="margin-top: 90px; margin-bottom: 30px;"><span class="fa fa-hand-o-down"></span>&nbsp;Faites votre choix</p>
			<p class="text-center">
				<a href="?page=Logged.Discussions.PersonalMessage" class="btn btn-lg btn-default">
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
		</div>
				
	</div>
</div>