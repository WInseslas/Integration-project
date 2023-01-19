<div class="container">
	<div class="jumbotron">
		<div>
			<?php
				if($errors){
					?>
						<div class="alert alert-danger text-center h2"><?= $errors_message ?></div>
					<?php
				}
			?>
		</div>
		<p class="text-center" id="msgC">Communiquer</p>
		<form method="POST">
			<?= $form->textarea("message", "Communiquer", null, "Nouveau comminiquer", "required"); ?>
			<?= $form->button("submit", "btn btn-primary", "Sauvegarder", "send"); ?>
			<div style="margin-top: -54px; margin-left: 120px;">
				<?= $form->button("reset", "btn btn-danger", "Annuler");?>
			</div>
		</form>
	</div>
	
</div>

		
