	<link href="App/Views/bootstrap/docs/examples/blog/blog.css" rel="stylesheet">
  	<div class="container">
  		<div class="row">
			<div class="blog-header text-center" style="font-style: oblique;">
				<h1 class="blog-title">Sujets de discussions</h1>
				<p class="lead blog-description">Nos differents sujets de discussions.</p>
			</div>
	     	<div class="starter-template">
		        <div class="col-sm-12 blog-main">
			        <div class="blog-post text-justify">
			          	<?php foreach ($Subjet as $value) : ?>
			            	<h2 class="blog-post-title h"><?= $value->nomType ?></h2>
			            	<p class="blog-post-meta"><?= date("d-M-Y à H:i", strtotime($value->dateRedaction)) ?> Par 
			            		<a href="#"><?= strtoupper($value->nom)." ".ucwords(strtolower($value->prenom)); ?></a>
			            	</p>
			            	<blockquote>
				              <p>
				              	<?= $value->contenuTexte; ?>
				              </p>
				            </blockquote>

				            <p>
				            	<a href="?page=Logged.Message.Discussions&idSubjet=<?= $value->idTexte; ?>&pages=<?php echo ((isset($_GET['pages'])) ? $_GET['pages'] : 1); ?>" class="btn btn-default" style="color: blue; font-weight: bolder;">
				            		<em>Participer</em>
				            	</a>
				            </p>
				            <hr>
			          	<?php endforeach; ?>
	        		</div>
	        		<div class="text-center container">
						<ul class="pagination">
							<li class="page-item">
								<span>&laquo;</span>
							</li>
							<?php
								
								for ($i=1; $i <= $total; $i++) {
									if ($pageCourate == $i) {
										?>
											<li class="active"><a href="?page=Logged.Message.Subjet&pages=<?= $i; ?>"><?= $i; ?></a></li>
										<?php
									} else {
										?>
											<li><a href="?page=Logged.Message.Subjet&pages=<?= $i; ?>"><?= $i; ?></a></li>
										<?php
									}
								}
							?>
							<li class="page-item">
								<span>&raquo;</span>
							</li>
						</ul>
					</div>
	      		</div>
	    	</div>
  		</div>
    </div>
