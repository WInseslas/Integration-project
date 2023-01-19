<!-- <div class="starter-template">
	<img class="img-rounded" src="../App/Views/img/home.png">
</div> -->
<div class="container">
	<div class="jumbotron" id="img">
		<img class="img-rounded" src="App/Views/img/icon-left-font-black.png">
	</div>
	<div class="cnt">
		<p class="text-center h1"><em>Administrer les differents grades</em></p>
		<p>
			<a href="?page=Admin.Big.Add" class="btn btn-success"><span class="fa fa-plus">&nbsp;</span>Ajouter</a>
		</p>
		<div class="table-responsive">
			<table class="table table-striped text text-center">
				<thead>
					<tr style="font-weight: bolder;">
						<td>#</td>
						<td>Nom </td>
						<td>Actions</td>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<td></td>
						<td></td>
						<td></td>
					</tr>
				</tfoot>
				<tbody>
					<?php
						foreach ($big as $value) {
							?>
								<tr>
									<td><?= $value->idGrade - 2;  ?></td>
									<td><?= ucfirst($value->nomGrade)  ?></td>
									<td>
										<a class="btn btn-primary" href="?page=Admin.Big.Edit&id=<?= $value->idGrade; ?>"><span class="fa fa-pencil-square">&nbsp;</span>Editer</a>
										<form method="POST" action="?page=Admin.Big.Delete" style="display: inline;">
											<input type="hidden" name="id" value="<?= $value->idGrade; ?>">
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
								<li class="active"><a href="?page=Admin.Big.index&pages=<?= $i; ?>"><?= $i; ?></a></li>
							<?php
						} else {
							?>
								<li><a href="?page=Admin.Big.index&pages=<?= $i; ?>"><?= $i; ?></a></li>
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

		
