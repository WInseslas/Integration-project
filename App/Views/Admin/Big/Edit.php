<div class="jumbotron">
	<div class="jumbotron" id="img">
		<img class="img-rounded" src="App/Views/img/icon-left-font-black.png">
	</div>
	<p class="text-center h2 fw">Mettre à jour le grade</p>
	
	<form method="POST">
		<?= $form->input("nomGrade", "Grade", "text", $big->nomGrade); ?>
		<?= $form->button("submit", "btn btn-primary", "Sauvegarder"); ?>
	</form>
</div>