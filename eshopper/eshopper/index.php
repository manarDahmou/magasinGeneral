<?php
session_start();
require_once("config.php");


//code for Cart
if (!empty($_GET["action"])) {
	switch ($_GET["action"]) {
			//code for adding product in cart
		case "add":
			if (!empty($_POST["quantity"])) {
				$pid = $_GET["pid"];
				$result = mysqli_query($con, "SELECT * FROM produit WHERE id_pro='$pid'");
				while ($productByCode = mysqli_fetch_array($result)) {
					$itemArray = array($productByCode["code"] => array('nom' => $productByCode["nom"], 'code' => $productByCode["code"], 'quantity' => $_POST["quantity"], 'prix' => $productByCode["prix"], 'image' => $productByCode["image"]));
					if (!empty($_SESSION["cart_item"])) {
						if (in_array($productByCode["code"], array_keys($_SESSION["cart_item"]))) {
							foreach ($_SESSION["cart_item"] as $k => $v) {
								if ($productByCode["code"] == $k) {
									if (empty($_SESSION["cart_item"][$k]["quantity"])) {
										$_SESSION["cart_item"][$k]["quantity"] = 0;
									}
									$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
								}
							}
						} else {
							$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"], $itemArray);
						}
					} else {
						$_SESSION["cart_item"] = $itemArray;
					}
				}
			}
			break;

			// code for removing product from cart
		case "remove":
			if (!empty($_SESSION["cart_item"])) {
				foreach ($_SESSION["cart_item"] as $k => $v) {
					if ($_GET["code"] == $k)
						unset($_SESSION["cart_item"][$k]);
					if (empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
				}
			}
			break;
			// code for if cart is empty
		case "empty":
			unset($_SESSION["cart_item"]);
			break;
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>Home | E-Shopper</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/prettyPhoto.css" rel="stylesheet">
	<link href="css/price-range.css" rel="stylesheet">
	<link href="css/animate.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
	<!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
	<link rel="shortcut icon" href="images/ico/favicon.ico">
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
	<link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
	<style>
		.categorie {
			background-color: transparent;
			border: none;
		}
	</style>
</head>
<!--/head-->

<body>
	<header id="header">
		<!--header-->
		<div class="header_top">
			<!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i> info@domain.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--/header_top-->

		<div class="header-middle">
			<!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="index.html"><img src="images/home/logo.png" alt="" /></a>
						</div>
						<div class="btn-group pull-right">
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									USA
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="#">Canada</a></li>
									<li><a href="#">UK</a></li>
								</ul>
							</div>

							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									DOLLAR
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="#">Canadian Dollar</a></li>
									<li><a href="#">Pound</a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-star"></i> Wishlist</a></li>
								<li><a href="checkout.html"><i class="fa fa-crosshairs"></i> Checkout</a></li>
								<li><a href="cart.php"><i class="fa fa-shopping-cart"></i> Cart</a></li>
								<?php
								if (isset($_SESSION['email']) && isset($_SESSION['password'])) {
									echo '<li><a href="Account.php"><i class="fa fa-user"></i> Account</a></li>';
								} else {
									echo '<li><a href="login.php"><i class="fa fa-lock"></i> Login</a></li>';
								}
								?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--/header-middle-->

		<div class="header-bottom">
			<!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="index.php" class="active">Home</a></li>
								<li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
									<ul role="menu" class="sub-menu">
										<li><a href="shop.php">Products</a></li>
										<li><a href="product-details.php">Product Details</a></li>
										<li><a href="checkout.html">Checkout</a></li>
										<li><a href="cart.php">Cart</a></li>
										<li><a href="login.php">Login</a></li>
									</ul>
								</li>
								<li class="dropdown"><a href="#">Blog<i class="fa fa-angle-down"></i></a>
									<ul role="menu" class="sub-menu">
										<li><a href="blog.html">Blog List</a></li>
										<li><a href="blog-single.html">Blog Single</a></li>
									</ul>
								</li>
								<li><a href="404.html">404</a></li>
								<li><a href="contact-us.html">Contact</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="search_box pull-right">
							<input type="text" placeholder="Search" />
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--/header-bottom-->
	</header>
	<!--/header-->

	<section id="slider">
		<!--slider-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
							<li data-target="#slider-carousel" data-slide-to="1"></li>
							<li data-target="#slider-carousel" data-slide-to="2"></li>
						</ol>

						<div class="carousel-inner">
							<div class="item active">
								<div class="col-sm-6">
									<h1><span>E</span>-SHOPPER</h1>
									<h2>Free E-Commerce Template</h2>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
										incididunt ut labore et dolore magna aliqua. </p>
									<button type="button" class="btn btn-default get">Get it now</button>
								</div>
								<div class="col-sm-6">
									<img src="images/home/girl1.jpg" class="girl img-responsive" alt="" />
									<img src="images/home/pricing.png" class="pricing" alt="" />
								</div>
							</div>
							<div class="item">
								<div class="col-sm-6">
									<h1><span>E</span>-SHOPPER</h1>
									<h2>100% Responsive Design</h2>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
										incididunt ut labore et dolore magna aliqua. </p>
									<button type="button" class="btn btn-default get">Get it now</button>
								</div>
								<div class="col-sm-6">
									<img src="images/home/girl2.jpg" class="girl img-responsive" alt="" />
									<img src="images/home/pricing.png" class="pricing" alt="" />
								</div>
							</div>

							<div class="item">
								<div class="col-sm-6">
									<h1><span>E</span>-SHOPPER</h1>
									<h2>Free Ecommerce Template</h2>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
										incididunt ut labore et dolore magna aliqua. </p>
									<button type="button" class="btn btn-default get">Get it now</button>
								</div>
								<div class="col-sm-6">
									<img src="images/home/girl3.jpg" class="girl img-responsive" alt="" />
									<img src="images/home/pricing.png" class="pricing" alt="" />
								</div>
							</div>

						</div>

						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>

				</div>
			</div>
		</div>
	</section>
	<!--/slider-->

	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Category</h2>
						<div class="panel-group category-products" id="accordian">
							<!--category-productsr-->
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordian" href="#sportswear">
											<span class="badge pull-right"><i class="fa fa-plus"></i></span>
											Superette
										</a>
									</h4>
								</div>
								<div id="sportswear" class="panel-collapse collapse">
									<div class="panel-body">
										<form method="get" action="shop.php">
											<ul>
												<li><input class="categorie" type="submit" value="ÉPICERIE SUCRÉE & SALÉE" name="c"></li>
												<li><input class="categorie" type="submit" value="BOISSONS" name="c"></li>
												<li><input class="categorie" type="submit" value="LES ESSENTIELS" name="c"></li>
												<li><input class="categorie" type="submit" value="LESSIVE" name="c"></li>
												<li><input class="categorie" type="submit" value="NETTOYAGE DOMESTIQUE" name="c"></li>
											</ul>
										</form>
									</div>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordian" href="#mens">
											<span class="badge pull-right"><i class="fa fa-plus"></i></span>
											Maison & Bureau
										</a>
									</h4>
								</div>
								<div id="mens" class="panel-collapse collapse">
									<div class="panel-body">
										<form method="get" action="shop.php">
											<ul>
												<li><input class="categorie" type="submit" value="PETIT ÉLECTROMÉNAGER" name="c"></li>
												<li><input class="categorie" type="submit" value="CUISINE" name="c"></li>
												<li><input class="categorie" type="submit" value="GROS ÉLECTROMENAGER" name="c"></li>
												<li><input class="categorie" type="submit" value="TOP MARQUE" name="c"></li>
											</ul>
										</form>
									</div>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordian" href="#mode">
											<span class="badge pull-right"><i class="fa fa-plus"></i></span>
											Mode
										</a>
									</h4>
								</div>
								<div id="mode" class="panel-collapse collapse">
									<div class="panel-body">
										<form method="get" action="shop.php">
											<ul>
												<li><input class="categorie" type="submit" value="MODE HOMME" name="c"></li>
												<li><input class="categorie" type="submit" value="MODE FEMME" name="c"></li>
												<li><input class="categorie" type="submit" value="CHAUSSURES HOMME" name="c"></li>
												<li><input class="categorie" type="submit" value="CHAUSSURES FEMME" name="c"></li>
											</ul>
										</form>
									</div>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordian" href="#womens">
											<span class="badge pull-right"><i class="fa fa-plus"></i></span>
											Telephone & Tablette
										</a>
									</h4>
								</div>
								<div id="womens" class="panel-collapse collapse">
									<div class="panel-body">
										<form method="get" action="shop.php">
											<ul>
												<li><input class="categorie" type="submit" value="SMARTPHONES" name="c"></li>
												<li><input class="categorie" type="submit" value="TELEPHONE BASICS" name="c"></li>
												<li><input class="categorie" type="submit" value="TABLETTES" name="c"></li>
												<li><input class="categorie" type="submit" value="ACCESSOIRES TÉLÉPHONIE" name="c"></li>
											</ul>
										</form>
									</div>
								</div>
							</div>

							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordian" href="#Informatiques">
											<span class="badge pull-right"><i class="fa fa-plus"></i></span>
											Informatique
										</a>
									</h4>
								</div>
								<div id="Informatiques" class="panel-collapse collapse">
									<div class="panel-body">
										<form method="get" action="shop.php">
											<ul>
												<li><input class="categorie" type="submit" value="ORDINATEURS" name="c"></li>
												<li><input class="categorie" type="submit" value="PÉRIPHÉRIQUES & ACCESSOIRES" name="c"></li>
												<li><input class="categorie" type="submit" value="IMPRIMANTES & SCANNERS" name="c"></li>
												<li><input class="categorie" type="submit" value="STOCKAGE DE DONNÉES" name="c"></li>
											</ul>
										</form>
									</div>
								</div>
							</div>

							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordian" href="#Electroniques">
											<span class="badge pull-right"><i class="fa fa-plus"></i></span>
											Electroniques
										</a>
									</h4>
								</div>
								<div id="Electroniques" class="panel-collapse collapse">
									<div class="panel-body">
										<form method="get" action="shop.php">
											<ul>
												<li><input class="categorie" type="submit" value="TÉLÉVISIONS" name="c"></li>
												<li><input class="categorie" type="submit" value="APPAREIL PHOTO ET CAMÉRAS" name="c"></li>
												<li><input class="categorie" type="submit" value="ACCESSOIRES TV" name="c"></li>
												<li><input class="categorie" type="submit" value="AUDIO" name="c"></li>
											</ul>
										</form>
									</div>
								</div>
							</div>

						</div>
						<!--/category-products-->

						<div class="brands_products">
							<!--brands_products-->
							<h2>Brands</h2>
							<div class="brands-name">
								<ul class="nav nav-pills nav-stacked">
									<li><a href="#"> <span class="pull-right">(50)</span>Acne</a></li>
									<li><a href="#"> <span class="pull-right">(56)</span>Grüne Erde</a></li>
									<li><a href="#"> <span class="pull-right">(27)</span>Albiro</a></li>
									<li><a href="#"> <span class="pull-right">(32)</span>Ronhill</a></li>
									<li><a href="#"> <span class="pull-right">(5)</span>Oddmolly</a></li>
									<li><a href="#"> <span class="pull-right">(9)</span>Boudestijn</a></li>
									<li><a href="#"> <span class="pull-right">(4)</span>Rösch creative culture</a></li>
								</ul>
							</div>
						</div>
						<!--/brands_products-->

						<div class="shipping text-center">
							<!--shipping-->
							<img src="images/home/shipping.jpg" alt="" />
						</div>
						<!--/shipping-->

					</div>
				</div>

				<div class="col-sm-9 padding-right">
					<div class="features_items">
						<!--features_items-->
						<h2 class="title text-center">Features Items</h2>
						<!-- code php for produit -->
						<?php
						// On se connecte à MySQL 
						try {
							$bdd = new PDO('mysql:host=localhost;dbname=mg;charset=utf8', 'root', '');
							$req = "SELECT * FROM `produit` ORDER BY RAND()";
							$reponse = $bdd->query($req);
						} catch (Exception $e) {
							die('Erreur : ' . $e->getMessage());
						}
						$i = 0;
						foreach ($reponse->fetchAll() as $donnee) {

							if ($i == 6) {
								break;
							}

						?>
							<!-- End code php for produit -->
							<div class="col-sm-4">
								<div class="product-image-wrapper">
									<div class="single-products">
										<div class="productinfo text-center">
											<img src="images/home/product1.jpg" alt="" />
											<h2><?php echo $donnee['prix']; ?></h2>
											<p><?php echo $donnee['nom']; ?></p>
											<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
										</div>
										<div class="product-overlay">
											<div class="overlay-content">
												<h2><?php echo $donnee['prix']; ?></h2>
												<form method="get" action="product-details.php">
													<button style="background-color: transparent;color: black;border: 2px solid transparent;" type="submit" value="<?php echo $donnee['id_pro']; ?>" name="choix"><i></i><?php echo $donnee['nom']; ?></button>
												</form>
												<!--<p><?php echo $donnee['Nom_pro']; ?></p>
											<a href="#" class="btn btn-default add-to-cart">
											<i class="fa fa-shopping-cart"></i>Add to cart</a>-->
												<?php
												if ($donnee['quantite'] > 0) {
												?>
													<form method="post" action="index.php?action=add&pid=<?php echo $donnee["id_pro"]; ?>">
														<input type="hidden" name="quantity" value="1" />
														<button class="btn btn-default add-to-cart" type="submit" value="Add to Cart" name="Add to Cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
													</form>
												<?php
												} else {
												?>

													<h5>Non disponible</h5>

												<?php
												}
												?>
											</div>
										</div>
									</div>

								</div>
							</div>
						<?php
							$i++;
						}
						?>
					</div>
					<!--features_items-->

					<div class="category-tab">
						<!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#tshirt" data-toggle="tab"><?php $c1 = "SmartPhone" ?>T-Shirt</a></li>
								<li><a href="#blazers" data-toggle="tab"><?php $c2 = "SmartPhone" ?>Blazers</a></li>
								<li><a href="#sunglass" data-toggle="tab"><?php $c3 = "SmartPhone" ?>Sunglass</a></li>
								<li><a href="#kids" data-toggle="tab"><?php $c4 = "SmartPhone" ?>Kids</a></li>
								<li><a href="#poloshirt" data-toggle="tab"><?php $c5 = "SmartPhone" ?>Polo shirt</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade active in" id="tshirt">
								<!-- code php for produit -->
								<?php
								// On se connecte à MySQL 
								try {
									$bdd = new PDO('mysql:host=localhost;dbname=mg;charset=utf8', 'root', '');
									$req = "SELECT * FROM `produit` ORDER BY RAND()";
									$reponse = $bdd->query($req);
								} catch (Exception $e) {
									die('Erreur : ' . $e->getMessage());
								}
								$i = 0;
								foreach ($reponse->fetchAll() as $donnee) {

									if ($i == 4) {
										break;
									}

								?>
									<!-- End code php for produit -->
									<div class="col-sm-3">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="images/home/gallery1.jpg" alt="" />
													<h2><?php echo $donnee['prix']; ?></h2>
													<p><?php echo $donnee['nom']; ?></p>
													<form method="post" action="index.php?action=add&pid=<?php echo $donnee["id_pro"]; ?>">
														<input type="hidden" name="quantity" value="1" />
														<button class="btn btn-default add-to-cart" type="submit" value="Add to Cart" name="Add to Cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
													</form>

												</div>

											</div>
										</div>
									</div>
								<?php
									$i++;
								}
								?>

							</div>

							<div class="tab-pane fade" id="blazers">
								<!-- code php for produit -->
								<?php
								// On se connecte à MySQL 
								try {
									$bdd = new PDO('mysql:host=localhost;dbname=mg;charset=utf8', 'root', '');
									$req = "SELECT * FROM `produit` ORDER BY RAND()";
									$reponse = $bdd->query($req);
								} catch (Exception $e) {
									die('Erreur : ' . $e->getMessage());
								}
								$i = 0;
								foreach ($reponse->fetchAll() as $donnee) {

									if ($i == 4) {
										break;
									}

								?>
									<div class="col-sm-3">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="images/home/gallery4.jpg" alt="" />
													<h2><?php echo $donnee['prix']; ?></h2>
													<p><?php echo $donnee['nom']; ?></p>
													<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>

											</div>
										</div>
									</div>
								<?php
									$i++;
								}
								?>

							</div>

							<div class="tab-pane fade" id="sunglass">
								<!-- code php for produit -->
								<?php
								// On se connecte à MySQL 
								try {
									$bdd = new PDO('mysql:host=localhost;dbname=mg;charset=utf8', 'root', '');
									$req = "SELECT * FROM `produit` ORDER BY RAND()";
									$reponse = $bdd->query($req);
								} catch (Exception $e) {
									die('Erreur : ' . $e->getMessage());
								}
								$i = 0;
								foreach ($reponse->fetchAll() as $donnee) {

									if ($i == 4) {
										break;
									}

								?>
									<div class="col-sm-3">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="images/home/gallery3.jpg" alt="" />
													<h2><?php echo $donnee['prix']; ?></h2>
													<p><?php echo $donnee['nom']; ?></p>
													<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>

											</div>
										</div>
									</div>
								<?php
									$i++;
								}
								?>
							</div>

							<div class="tab-pane fade" id="kids">
								<!-- code php for produit -->
								<?php
								// On se connecte à MySQL 
								try {
									$bdd = new PDO('mysql:host=localhost;dbname=mg;charset=utf8', 'root', '');
									$req = "SELECT * FROM `produit` ORDER BY RAND()";
									$reponse = $bdd->query($req);
								} catch (Exception $e) {
									die('Erreur : ' . $e->getMessage());
								}
								$i = 0;
								foreach ($reponse->fetchAll() as $donnee) {

									if ($i == 4) {
										break;
									}

								?>
									<div class="col-sm-3">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="images/home/gallery1.jpg" alt="" />
													<h2><?php echo $donnee['prix']; ?></h2>
													<p><?php echo $donnee['nom']; ?></p>
													<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>

											</div>
										</div>
									</div>
								<?php
									$i++;
								}
								?>
							</div>

							<div class="tab-pane fade" id="poloshirt">
								<!-- code php for produit -->
								<?php
								// On se connecte à MySQL 
								try {
									$bdd = new PDO('mysql:host=localhost;dbname=mg;charset=utf8', 'root', '');
									$req = "SELECT * FROM `produit` ORDER BY RAND()";
									$reponse = $bdd->query($req);
								} catch (Exception $e) {
									die('Erreur : ' . $e->getMessage());
								}
								$i = 0;
								foreach ($reponse->fetchAll() as $donnee) {

									if ($i == 4) {
										break;
									}

								?>
									<div class="col-sm-3">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="images/home/gallery2.jpg" alt="" />
													<h2><?php echo $donnee['prix']; ?></h2>
													<p><?php echo $donnee['nom']; ?></p>
													<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>

											</div>
										</div>
									</div>
								<?php
									$i++;
								}
								?>

							</div>
						</div>
					</div>
					<!--/category-tab-->

					<div class="recommended_items">
						<!--recommended_items-->
						<h2 class="title text-center">recommended items</h2>

						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="item active">
									<!-- code php for produit -->
									<?php
									// On se connecte à MySQL 
									try {
										$bdd = new PDO('mysql:host=localhost;dbname=mg;charset=utf8', 'root', '');
										$req = "SELECT * FROM `produit` ORDER BY RAND()";
										$reponse = $bdd->query($req);
									} catch (Exception $e) {
										die('Erreur : ' . $e->getMessage());
									}
									$i = 0;
									foreach ($reponse->fetchAll() as $donnee) {

										if ($i == 3) {
											break;
										}

									?>
										<div class="col-sm-4">
											<div class="product-image-wrapper">
												<div class="single-products">
													<div class="productinfo text-center">
														<img src="images/home/recommend1.jpg" alt="" />
														<h2><?php echo $donnee['prix']; ?></h2>
														<p><?php echo $donnee['nom']; ?></p>
														<form method="post" action="index.php?action=add&pid=<?php echo $donnee["id_pro"]; ?>" >
														<input type="hidden"  name="quantity" value="1"  />
														<button class="btn btn-default add-to-cart" type="submit" value="Add to Cart" name="Add to Cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
														</form>
													</div>

												</div>
											</div>
										</div>
									<?php
										$i++;
									}
									?>

								</div>
								<div class="item">
									<!-- code php for produit -->
									<?php
									// On se connecte à MySQL 
									try {
										$bdd = new PDO('mysql:host=localhost;dbname=mg;charset=utf8', 'root', '');
										$req = "SELECT * FROM `produit` ORDER BY RAND()";
										$reponse = $bdd->query($req);
									} catch (Exception $e) {
										die('Erreur : ' . $e->getMessage());
									}
									$i = 0;
									foreach ($reponse->fetchAll() as $donnee) {

										if ($i == 3) {
											break;
										}

									?>
										<div class="col-sm-4">
											<div class="product-image-wrapper">
												<div class="single-products">
													<div class="productinfo text-center">
														<img src="images/home/recommend1.jpg" alt="" />
														<h2><?php echo $donnee['prix']; ?></h2>
														<p><?php echo $donnee['nom']; ?></p>
														<form method="post" action="index.php?action=add&pid=<?php echo $donnee["id_pro"]; ?>" >
														<input type="hidden"  name="quantity" value="1"  />
															<button class="btn btn-default add-to-cart" type="submit" value="Add to Cart" name="Add to Cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
														</form>
													</div>

												</div>
											</div>
										</div>
									<?php
										$i++;
									}
									?>
								</div>
							</div>
							<a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							</a>
							<a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							</a>
						</div>
					</div>
					<!--/recommended_items-->

				</div>
			</div>
		</div>
	</section>

	<footer id="footer">
		<!--Footer-->
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="companyinfo">
							<h2><span>e</span>-shopper</h2>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,sed do eiusmod tempor</p>
						</div>
					</div>
					<div class="col-sm-7">
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="images/home/iframe1.png" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>

						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="images/home/iframe2.png" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>

						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="images/home/iframe3.png" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>

						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="images/home/iframe4.png" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="address">
							<img src="images/home/map.png" alt="" />
							<p>505 S Atlantic Ave Virginia Beach, VA(Virginia)</p>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="footer-widget">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Service</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Online Help</a></li>
								<li><a href="#">Contact Us</a></li>
								<li><a href="#">Order Status</a></li>
								<li><a href="#">Change Location</a></li>
								<li><a href="#">FAQ’s</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Quock Shop</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">T-Shirt</a></li>
								<li><a href="#">Mens</a></li>
								<li><a href="#">Womens</a></li>
								<li><a href="#">Gift Cards</a></li>
								<li><a href="#">Shoes</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Policies</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Terms of Use</a></li>
								<li><a href="#">Privecy Policy</a></li>
								<li><a href="#">Refund Policy</a></li>
								<li><a href="#">Billing System</a></li>
								<li><a href="#">Ticket System</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>About Shopper</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Company Information</a></li>
								<li><a href="#">Careers</a></li>
								<li><a href="#">Store Location</a></li>
								<li><a href="#">Affillate Program</a></li>
								<li><a href="#">Copyright</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3 col-sm-offset-1">
						<div class="single-widget">
							<h2>About Shopper</h2>
							<form action="#" class="searchform">
								<input type="text" placeholder="Your email address" />
								<button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
								<p>Get the most recent updates from <br />our site and be updated your self...</p>
							</form>
						</div>
					</div>

				</div>
			</div>
		</div>

		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">Copyright © 2013 E-SHOPPER Inc. All rights reserved.</p>
					<p class="pull-right">Designed by <span><a target="_blank" href="http://www.themeum.com">Themeum</a></span></p>
				</div>
			</div>
		</div>

	</footer>
	<!--/Footer-->



	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.scrollUp.min.js"></script>
	<script src="js/price-range.js"></script>
	<script src="js/jquery.prettyPhoto.js"></script>
	<script src="js/main.js"></script>
</body>

</html>