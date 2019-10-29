<?php
	session_start();
	include "header.php";
?>
		
<div id="myCarousel" class="carousel slide" data-ride="carousel">
	<!-- Indicators -->
	<ol class="carousel-indicators">
		<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
		<li data-target="#myCarousel" data-slide-to="1"></li>
		<li data-target="#myCarousel" data-slide-to="2"></li>
	</ol>

	<!-- Wrapper for slides -->
	<div class="carousel-inner">
		<div class="item active">
			<img src="img/slide1.jpg" alt="Los Angeles" style="width:100%;">
		</div>
					
		<div class="item">
			<img src="img/slide2.jpg" alt="Chicago" style="width:100%;">		
		</div>

		<div class="item">
			<img src="img/slide3.jpg" alt="Chicago" style="width:100%;">		
		</div>		  
	</div>

				<!-- Left and right controls -->
	<a class="left carousel-control" href="#myCarousel" data-slide="prev">
		<span class="glyphicon glyphicon-chevron-left"></span>
		<span class="sr-only">Prev</span>
	</a>
	<a class="right carousel-control" href="#myCarousel" data-slide="next">
		<span class="glyphicon glyphicon-chevron-right"></span>
		<span class="sr-only">Next</span>
	</a>
</div>

<div class="container">
	<div class="row">
	<?php
		// Used for creating banner boxes for navigation of categories
		$categorieImages = array(array("Gaming.jpg", "notebooks.php?type=gaming"), array("Mini_PC.jpg", "####"), array("Monitors.jpg", "peripherals.php?type=monitors"), 
		array("Motherboards_1.jpg", "components.php?type=motherboards"), array("VivoBook.jpg", "notebooks.php?type=vivobook"), array("ZenBook.jpg", "notebooks.php?type=zenbook"), 
		array("ZenFone.jpg", "phones.php?type=zenfone"), array("ZenPad.jpg", "tablets.php?type=zenpad"));							
		foreach ($categorieImages as $image):	
		?>
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 categories">
				<a href="<?php echo $image[1]; ?>"><img src="<?php echo'img/categories/' . $image[0]; ?>" class="img-responsive" /></a>
			</div>
		<?php
		endforeach;
	?>
	</div>
</div>

		

		
<?php
	include "footer.php";
?>
	
	
