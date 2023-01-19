<div class="jumbotron">
	<p class="text-center h2">Inscription(s)</p>
	<div>
		<?php
			if($errors){
				?>
					<div class="alert alert-danger text-center h2"><?= $errors_message ?></div>
				<?php
			}

			if($success){
				?>
					<div class="alert alert-success text-center h2"><?= $success_message ?></div>
					<p><a class="btn btn-link" href="?page=Users.index">Retour à l'accueil</a></p>
				<?php
			}
		?>
	</div>
	<form method="POST">
		<?= $form->input("nom", "Nom", "text"); ?>
		<?= $form->input("prenom", "Prenom", "text"); ?>
		<?= $form->input("dateNaissance", "Date de Naissance", "date"); ?>
		<?= $form->select("sexe", "Sexe", $sexe); ?>
		<?= $form->input("password", "Mot de passe", "password"); ?>
		<?= $form->input("passwordS", "Confirmer le mot de passe", "password"); ?>
		<?= $form->input("pseudo", "Pseudo", "text"); ?>
		<?= $form->message("<b>Connectez-vous</b>", "?page=Users.Login", null, "text-success");?>

		<?= $form->button("submit", "btn btn-primary", "Enregistrer"); ?>
		<div style="margin-top: -54px; margin-left: 120px;">
			<?= $form->button("reset", "btn btn-danger", "Annuler");?>
		</div>
	</form>
</div>