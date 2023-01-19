<!DOCTYPE html>
<html lang="fr">
<?php 
	require_once 'head.php'; 
?>
<body id="page-top">
	<?php 
		require_once 'nav.php'; 
		require_once 'modal.php'; 
	?>
	
	<div class="container theme-showcase">
		<?= $content; ?>
	</div>

	<?php
		require_once 'footer.php';
	?>
</body>
</html>