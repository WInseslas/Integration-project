<style type="text/css">
	body{
		background-color: rgba(179, 179, 179, 0.5);
	}
</style><div class="container">
	<div>
		<?php
			if($errors){
				?>
					<div class="alert alert-danger text-center h2"><?= $errors_message ?></div>
				<?php
			}
		?>
	</div>

	<form method="POST" action="#" class="form-signin">
		<p class="form-signin-heading text-center h1">Bienvenu chèr(e) employé(s) connectez-vous.</p>
		<?= $form->input("pseudo", "Entrez votre pseudo"); ?>
		<?= $form->input("password", "Votre mot de passe", "password");?>
		<?= $form->checkbox("checkbox", "sesssion", "checkbox", "1", "Se souvenir de moi");?>
		<?= $form->message("<b>S'inscrire</b>", "?page=Users.Register", "Creer un compte", "text-success");?>
		<?= $form->button("submit", "btn btn-primary", "Se connecter", null, "login()");?>
		<div style="margin-top: -54px; margin-left: 120px;">
			<?= $form->button("reset", "btn btn-danger", "Annuler");?>
		</div>
	</form>
</div>
