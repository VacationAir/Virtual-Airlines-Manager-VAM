<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo $title_for_layout; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<?php
		echo $this->Html->css('default');
		echo $this->Html->css('cake.generic');
		//echo $this->Html->css('ie');
		//echo $this->Html->css('layout');
		//echo $this->Html->css('reset');

	?>





<!--[if lt IE 7]>
	<div style=' clear: both; text-align:center; position: relative;'>
		<a href="http://www.microsoft.com/windows/internet-explorer/default.aspx?ocid=ie6_countdown_bannercode"><img src="http://www.theie6countdown.com/images/upgrade.jpg" border="0"  alt="" /></a>
	</div>
<![endif]-->
<!--[if lt IE 9]>
	<script type="text/javascript" src="js/html5.js"></script>
	<link rel="stylesheet" href="css/ie.css" type="text/css" media="screen">
<![endif]-->
</head>
<body id="page1">
<!-- header -->




	<div class="bg">
		<div class="main">

			<header>
				<section id="contenth">
				<div class="padding">
				<div class="indent">
						<h2>Administracion de la Aerolinea</h2>
						<div class="wrapper indent-bot">
							<div class="col-1">
								<div class="wrapper">

									<figure class="img-indent4">
									<?php echo $this->Html->image("Registry-Settings-icon.png", array(
										"alt" => "Brownies",
										'url' => array('controller' => 'FleetTypes', 'action' => 'index')
									));?>
									</figure>
									<div class="extra-wrap">
										<h6>Parametros de la VA</h6>
										Maneja los parámetros generales de la VA<br>
									</div>
								</div>
							</div>
							<div class="col-2">
								<div class="wrapper">
									<figure class="img-indent4"><?php echo $this->Html->image('Map-icon.png');?><a href="../point/administration.php"></a></figure>
									<div class="extra-wrap">
										<h6>Gestor de Rutas</h6>
										Gestiona las rutas regulares de la VA.
									</div>
								</div>
							</div>

							<div class="col-1">
								<div class="wrapper">

									<figure class="img-indent4"><?php echo $this->Html->image("Travel-Airplane-icon.png", array(
										"alt" => "Brownies",
										'url' => array('controller' => 'Fleets', 'action' => 'index')
									));?>
								</figure>
									<div class="extra-wrap">
										<h6>Parametros de la VA</h6>
										Maneja los parámetros generales de la VA<br>
									</div>
								</div>
							</div>
							<div class="col-2">
								<div class="wrapper">
									<figure class="img-indent4"><?php echo $this->Html->image('money-icon.png');?><a href="../point/administration.php"></a></figure>
									<div class="extra-wrap">
										<h6>Gestor de Rutas</h6>
										Gestiona las rutas regulares de la VA.
									</div>
								</div>
							</div>
							<div class="col-1">
								<div class="wrapper">

									<figure class="img-indent4"><?php echo $this->Html->image('Travel-Airplane-icon.png');?><a href="../point/administration.php"></a></figure>
									<div class="extra-wrap">
										<h6>Parametros de la VA</h6>
										Maneja los     generales de la VA<br>
									</div>
								</div>
							</div>
							<div class="col-1">
								<div class="wrapper">
									<figure class="img-indent4"><?php echo $this->Html->image('money-icon.png');?><a href="../point/administration.php"></a></figure>
									<div class="extra-wrap">
										<h6>Gestor de Rutas</h6>
										Gestiona las  regulares de la VA.
									</div>
								</div>
							</div>



						</div>




					</div>
			</header>

			<section id="content">
				<?php echo $content_for_layout; ?>
			</section>

<!-- footer -->
			<footer>
				<div class="row-top">
					<div class="row-padding">
						<div class="wrapper">
							<div class="col-1">
								<h4>Enlaces:</h4>
								<ul class="list-services">
									<li class="item-1"><?php echo $this->Html->image('facebook.png');?><a href="../point/administration.php"> Facebook</a></li>
									<li class="item-2"><?php echo $this->Html->image('twitter.png');?><a href="#"> Twitter</a></li>
								</ul>
							</div>

						</div>
					</div>
				</div>
				<div class="row-bot">
					<div class="aligncenter">
						<p class="p0"><a rel="nofollow" href="http://www.templatemonster.com/" target="_blank">Website Template</a> by TemplateMonster.com | <a rel="nofollow" href="http://www.html5xcss3.com/" target="_blank">html5xcss3.com<a/></p>
						<a href="http://www.templates.com/product/3d-models/" target="_blank">3D Models</a> provided by Templates.com<br>
						<!-- {%FOOTER_LINK} -->
					</div>
				</div>
			</footer>
		</div>
	</div>
	<script type="text/javascript"> Cufon.now(); </script>
	<script type="text/javascript">
		$(function(){
			$('.slider')._TMS({
				prevBu:'.prev',
				nextBu:'.next',
				playBu:'.play',
				duration:800,
				easing:'easeOutQuad',
				preset:'simpleFade',
				pagination:false,
				slideshow:3000,
				numStatus:false,
				pauseOnHover:true,
				banners:true,
				waitBannerAnimation:false,
				bannerShow:function(banner){
					banner
						.hide()
						.fadeIn(500)
				},
				bannerHide:function(banner){
					banner
						.show()
						.fadeOut(500)
				}
			});
		})
	</script>
</body>
</html>
