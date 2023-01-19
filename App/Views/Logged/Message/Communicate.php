<div class="starter-template">
	<div class="main main-raised">
		<div class="container mainn-raised" style="width: 95%;">
	  
			<div id="myCarousel" class="carousel slide" data-ride="carousel">
			    <div class="carousel-inner">
			    	<?php
			    		for ($i=0; $i < count($Communicate) ; $i++) { 
			    			if ($i == 0) {
			    				?>
								    <div class="item active">
								    	<center>
								        	<img src="App/Views/img/icon-left-font-black.png" style="width:70%;">
								        </center>
								        <div class="section-title">
											<div class="text-justify">
												<p class="title h2" style="font-style: oblique; width: 60%; margin-left: 20%; margin-right: 20%;">
													<?php echo $Communicate[$i]->extrait; ?>
												</p>
											</div>
										</div>
								    </div>								
				    			<?php
			    			} else {
				    			?>
								    <div class="item">
								    	<center>
								        	<img src="App/Views/img/icon-left-font-black.png" style="width:70%;">
								        </center>
								        <div class="section-title">
											<div class="text-justify">
												<p class="title h2" style="font-style: oblique; width: 60%; margin-left: 20%; margin-right: 20%;">
													<?php echo $Communicate[$i]->extrait; ?>
												</p>
											</div>
										</div>
								    </div>								
				    			<?php
			    			}
			    		}
			    	?>

				    <a class="left carousel-control _26sdfg" href="#myCarousel" data-slide="prev">
				      <span class="glyphicon glyphicon-chevron-left"></span>
				      <span class="sr-only">Previous</span>
				    </a>

				    <a class="right carousel-control _26sdfg" href="#myCarousel" data-slide="next">
				      <span class="glyphicon glyphicon-chevron-right"></span>
				      <span class="sr-only">Next</span>
				    </a>
				</div>
			</div>
					
		</div>
	</div>
</div>