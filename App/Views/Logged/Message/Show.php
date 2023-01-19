 <style type="text/css">
	ul{
		text-align: center;
	}
	li{
		display: inline;
		list-style-type: none;
	}
</style>

<div class="jumbotron">
	<div class="text-justify">
		<p class="title h2" style="font-style: oblique;">
		    <?php echo $texte->contenuTexte; ?>
		</p>
	</div>
	<div class="section-nav">
		<ul>
			<li>
				<a class="btn btn-success text-uppercase" href="?page=Logged.Message.Show&idTexte=<?php echo $texte->idTexte ?>&action=1">
					<span class="fa fa-thumbs-up"></span>&nbsp;&nbsp;J'aime (<?= $texte->likes ?>)
				</a>														
			</li>
			<li>
				<a class="btn btn-danger text-uppercase" href="?page=Logged.Message.Show&idTexte=<?php echo $texte->idTexte ?>&action=2">
					<span class="fa fa-thumbs-down"></span>&nbsp;&nbsp;Je n'aime pas (<?= $texte->dislikes ?>)
				</a>														
			</li>
		</ul>
	</div>
</div>