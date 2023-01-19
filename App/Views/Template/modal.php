	<div class="modal fade" id="logout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	    <div class="modal-dialog" role="document">
	        <div class="modal-content">
	            <div class="modal-header">
	                <h5 class="modal-title" id="exampleModalLabel">Prêt à partir ?</h5>
	                <button onclick="modal('logout')" class="close" type="button" data-dismiss="modal" aria-label="Close">
	                    <span aria-hidden="true">×</span>
	                </button>
	            </div>
	            <div  class="modal-body">Selectionnez "Déconnexion" ci-dessous si vous êtes prêt à mettre fin à votre session en cours.</div>
	            <div class="modal-footer">
	                <button onclick="modal('logout')" class="btn btn-secondary" type="button" data-dismiss="modal">
	                	<span class="fa fa-remove"></span>Annuler</button>
	                <a class="btn btn-danger" href="?page=Logged.Users.logout">
	                	<span class="fa fa-sign-out">&nbsp;</span>Déconnexion</a>
	            </div>
	        </div>
	    </div>
	</div>


	<div class="modal fade" id="profil" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button onclick="modal('profil')" type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <center><h4 class="modal-title" id="myModalLabel">Mon compte</h4></center>
                </div>
                <div class="modal-body">
				<div class="container-fluid">
				<form method="POST" action="?page=Logged.Users.updateProfil">
					<div style="height: 10px;"></div>
					<div class="form-group input-group">
						<label class="input-group-addon" for="nom" style="width:150px;">Nom :</label>
						<input type="text" style="width:350px;" class="form-control" name="nom" id="nom" value="<?php echo $_SESSION["info"]["nom"]; ?>">
					</div>
					<div class="form-group input-group">
						<label for="prenom" class="input-group-addon" style="width:150px;">Prénom :</label>
						<input type="text" style="width:350px;" class="form-control" name="prenom" id="prenom" value="<?php echo (empty($_SESSION["info"]["prenom"])) ? " " :  $_SESSION["info"]["prenom"]; ?>">
					</div>
					<div class="form-group input-group">
						<label for="pseudo" class="input-group-addon" style="width:150px;">Pseudo :</label>
						<input type="text" style="width:350px;" class="form-control" name="pseudo" id="pseudo" value="<?php echo $_SESSION["info"]["pseudo"]; ?>">
					</div>
					<div class="form-group input-group">
						<label for="dateNaissance" class="input-group-addon" style="width:150px;">Date de naissance :</label>
						<input type="date" style="width:350px;" class="form-control" name="dateNaissance" id="dateNaissance" value="<?php echo $_SESSION["info"]["dateNaissance"]; ?>">
					</div>
					
					<hr>
					<span>Entrez le mot de passe actuel pour enregistrer les modifications :</span>
					<div style="height: 10px;"></div>
					<div class="form-group input-group">
						<label for="password" class="input-group-addon" style="width:150px;">Mot de passe:</label>
						<input type="password" style="width:350px;" class="form-control" id="password" name="password" required="password">
					</div>
					
                </div> 
				</div>
                <div class="modal-footer">
                    <button onclick="modal('profil')" type="button" class="btn btn-danger" data-dismiss="modal">
                    	<span class="fa fa-remove"></span> Annuler
                    </button>
                    <button type="submit" class="btn btn-success">
                    	<span class="fa fa-check"></span> Mettre à jour
                    </button>
				</form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>


	<div class="modal fade" id="updatePassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button onclick="modal('updatePassword')" type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <center><h4 class="modal-title" id="myModalLabel">Modifier votre mot de passe</h4></center>
                </div>
                <div class="modal-body">
				<div class="container-fluid">
				<form method="POST" action="?page=Logged.Users.updatePassword">
					<div style="height: 10px;"></div>

					<span>Si vous souhaitez modifier votre mot de passe suivez les instructions</span>
					<div style="height: 10px;"></div>
					<div class="form-group input-group">
						<label for="cpassword" class="input-group-addon" style="width:150px;">Ancien Mot de passe :</label>
						<input type="password" style="width:350px;" class="form-control" id="cpassword" name="cpassword" required>
					</div>
					<div class="form-group input-group">
						<label for="apassword" class="input-group-addon" style="width:150px;">Nouveau Mot de passe :</label>
						<input type="password" style="width:350px;" class="form-control" id="apassword" name="apassword" required>
					</div>
                </div> 
				</div>
                <div class="modal-footer">
                    <button onclick="modal('updatePassword')" type="button" class="btn btn-danger" data-dismiss="modal">
                    	<span class="fa fa-remove"></span> Annuler
                    </button>
                    <button type="submit" class="btn btn-success">
                    	<span class="fa fa-check"></span> Changer le mot de passe
                    </button>
				</form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="photo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button onclick="modal('photo')" type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <center><h4 class="modal-title" id="myModalLabel">Télécharment de photo...</h4></center>
                </div>
                <div class="modal-body">
				<div class="container-fluid">
					<form method="POST" enctype="multipart/form-data" action="?page=Logged.Users.updatePhoto">
					<div class="form-group input-group">
						<span class="input-group-addon" style="width:150px;">Photo:</span>
						<input type="file" style="width:350px;" class="form-control" name="image" required>
					</div>
                </div> 
				</div>
                <div class="modal-footer">
                    <button onclick="modal('photo')" type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-remove"></span> Annuler</button>
                    <button type="submit" class="btn btn-success">
                    	<span class="fa fa-upload"></span> Télécharger
                    </button>
					</form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

