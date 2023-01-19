  	<div class="container">
  		<div class="row">
			<div class="blog-header text-center" style="font-style: oblique;">
				<h1 class="blog-title">Administrer les  communiquer</h1>
			</div>
	     	<div class="starter-template">
	     		<p class="text-left">
					<a href="?page=Admin.Message.Communicate" class="btn btn-success"><span class="fa fa-plus">&nbsp;</span>Nouveau communiquer</a>
				</p>

	        	<div class="table-responsive">
					<table class="table table-striped text text-center">
						<thead>
							<tr style="font-weight: bolder;">
								<td>Date</td>
								<td>Auteur</td>
								<td><span class="fa fa-thumbs-up"></span>&nbsp;&nbsp;</td>
								<td><span class="fa fa-thumbs-down"></span>&nbsp;&nbsp;</td>
								<td>Extrait</td>
								<td>Actions</td>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
						</tfoot>
						<tbody>
							<?php
								foreach ($Subjet as $value) {
									?>
										<tr>
											<td>
												<?php echo date("d-M-Y", strtotime($value->dateRedaction)); ?>
		            						</td>
		            						<td>
		            							<?php echo strtoupper($value->nom)." ".ucwords(strtolower($value->prenom)); ?>
		            						</td>
											<td><?php echo $value->likes  ?></td>
											<td><?php echo $value->dislikes;  ?></td>
											<td><?php echo $value->ext;  ?></td>
											<td>
												<a class="btn btn-primary" href="?page=Admin.Message.Edi&id=<?= $value->idTexte; ?>"><span class="fa fa-edit">&nbsp;</span>Editer</a>
												<form method="POST" action="?page=Admin.Message.Delete" style="display: inline;">
													<input type="hidden" name="id" value="<?= $value->idTexte; ?>">
													<button class="btn btn-danger" type="submit"><span class="fa fa-trash">&nbsp;</span>Supprimer</button>
												</form>
											</td>
										</tr>
									<?php
								}
							?>
						</tbody>
					</table>
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
										<li class="active"><a href="?page=Admin.Message.Communicates&pages=<?= $i; ?>"><?= $i; ?></a></li>
									<?php
								} else {
									?>
										<li><a href="?page=Admin.Message.Communicates&pages=<?= $i; ?>"><?= $i; ?></a></li>
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
