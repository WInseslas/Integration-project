<div class="jumbotron">
	<p class="text-center h2 fw">Mise à jour du grade</p>
	<div class="row">
		<img style="height: 150px;" class="img-rounded" src="App/Views/upload/<?= $user->photo; ?>">
	</div>
	<form method="POST">
		<?= $form->select("_idGrade", "Grade", $big, $user->nomGrade); ?>
		<?= $form->button("submit", "btn btn-primary", "Sauvegarder"); ?>
	</form>
</div>