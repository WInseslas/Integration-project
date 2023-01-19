<div class="container">
	<div class="jumbotron">
		<p class="text-center" id="msgC">Sujet du jour</p>
		<form method="POST">
			<?= $form->textarea("message", "Sujet", null, "Titre de la session du jour"); ?>
			<?= $form->button("submit", "btn btn-primary", "Sauvegarder"); ?>
			<div style="margin-top: -54px; margin-left: 120px;">
				<?= $form->button("reset", "btn btn-danger", "Annuler");?>
			</div>
		</form>
	</div>
	
</div>

		
