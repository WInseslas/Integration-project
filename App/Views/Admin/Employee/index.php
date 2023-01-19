<!-- <div class="starter-template">
	<img class="img-rounded" src="../App/Views/img/home.png">
</div> -->
<div class="container">
	<div class="jumbotron" id="img">
		<img class="img-rounded" src="App/Views/img/icon-left-font-black.png">
	</div>
	<div class="cnt">
		<p class="text-center h1"><em>Administrer les different Employés</em></p>
		
		<div class="table-responsive">
			<table class="table table-striped text text-center">
				<thead>
					<tr style="font-weight: bolder;">
						<td>#</td>
						<td>Nom et prénom</td>
						<td>Sexe</td>
						<td>Date de naissance</td>
						<td class="text-capitalize">état</td>
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
						foreach ($users as $value) {
							?>
								<tr>
									<td><?= $value->idUtilisateur  ?></td>
									<td><?= strtoupper($value->nom)." ".ucwords(strtolower($value->prenom))  ?></td>
									<td>
										<?php 
											if ($value->sexe) {
												echo "Femme";
											} else {
												echo "Homme";
											}
										?>
											
									</td>
									<td><?= $value->dateNaissance  ?></td>
									<td class="btn-default"> 
										<a class="btn btn-warning" href="?page=Admin.Employee.EditState&id=<?= $value->idUtilisateur; ?>&etat=<?= $value->actif  ?>&pages=<?= (isset($_GET['pages'])) ?	 $_GET['pages'] : 1; ?>">
											<?php 
												if ($value->actif) {
													echo "Actif";
												} else {
													echo "Désactiver";
												}
											?>
										</a>
									</td>
									
									<td>
										<a class="btn btn-primary" href="?page=Admin.Employee.Edit&id=<?= $value->idUtilisateur; ?>"><span class="fa fa-edit">&nbsp;</span>Editer</a>
										<form method="POST" action="?page=Admin.Employee.Delete" style="display: inline;">
											<input type="hidden" name="id" value="<?= $value->idUtilisateur; ?>">
											<button class="btn btn-danger" type="submit">
												<span class="fa fa-trash">&nbsp;</span>Supprimer
											</button>
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
								<li class="active"><a href="?page=Admin.Employee.index&pages=<?= $i; ?>"><?= $i; ?></a></li>
							<?php
						} else {
							?>
								<li><a href="?page=Admin.Employee.index&pages=<?= $i; ?>"><?= $i; ?></a></li>
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

		
