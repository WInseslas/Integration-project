<style type="text/css">
	#messages{
		max-width: 100%;
		min-width: 100%;
		max-height: 250px;
		min-height: 250px;
	}
</style>
<div>
	<div class="jumbotron" id="img">
		<img class="img-rounded" src="App/Views/img/icon-left-font-black.png">
	</div>
	<p class="text-center h2 fw">Mettre à jour</p>
	
	<form method="POST">
		<?= $form->textarea("messages", "Sujet", strip_tags($subjet->contenuTexte)); ?>
		<?= $form->button("submit", "btn btn-primary", "Sauvegarder"); ?>
	</form>
</div>