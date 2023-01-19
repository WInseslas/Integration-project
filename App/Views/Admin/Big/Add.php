<div class="container">
	<div class="jumbotron" id="img">
		<img class="img-rounded" src="App/Views/img/icon-left-font-black.png">
	</div>
	<div class="cnt">
		<div class="jumbotron">
			<p class="text-center h2">Enregistrement d’un nouveau grade</p>
			<form method="POST">
				<?= $form->input("nomGrade", "Nom du grade", "text"); ?>
				<?= $form->button("submit", "btn btn-primary", "Sauvegarder"); ?>
				<div style="margin-top: -54px; margin-left: 120px;">
					<?= $form->button("reset", "btn btn-danger", "Annuler");?>
				</div>
			</form>
		</div>
	</div>
</div>