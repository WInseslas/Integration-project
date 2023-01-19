	<nav class="navbar navbar-default navbar-fixed-top shadow">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<img class="navbar-brand" src="App/Views/img/icon-font-white.png"><a class="navbar-brand" href="">P.I.R.S.E.</a>
			</div>

			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav navbar-right">
					<?php
						if (isset($link)) {
							$i = 0;
							foreach ($link as $key => $value) {
								if ($i == 0) {
									?>
										<li class="active">
											<a href="?page=<?= $key ?>">
												<?= $value ?>
											</a>
										</li>
									<?php
								} else {
									?>
										<li><a href="?page=<?= $key ?>"><?= $value ?></a></li>
									<?php
								}
								$i++;
							}
						}

						if (isset($profile)) {
							?>
								<li class="dropdown">
									<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
										<?= $_SESSION["info"]['pseudo'] ?>
										<img class="img-rounded" src="App/Views/upload/<?php echo $_SESSION['info']['photo']; ?>">
									</a>
								</li>
								<li class="dropdown">
									<a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
										<span class="caret"></span>
									</a>
				                    <ul class="dropdown-menu">
				                        <li>
											<a href="#" onclick="profil()">
												<span class="fa fa-user">&nbsp;</span>Compte
											</a>
										</li>
										<li>
											<a href="#" onclick="updatePassword()">
												<span class="fa fa-unlock-alt">&nbsp;</span>Mot de passe
											</a>
										</li>
										<li>
											<a href="#" onclick="photo()">
												<span class="fa fa-image">&nbsp;</span>Photo de profile
											</a>
										</li>
										<li class="divider"></li>
				                        <li>
				                        	<a href="#" onclick="logout()">
				                        		<span class="fa fa-sign-out">&nbsp;</span>Deconnectez-vous
				                        	</a>
				                        </li>

				                    </ul>
								</li>
							<?php
						}
					?>
				</ul>
			</div>
		</div>
	</nav>