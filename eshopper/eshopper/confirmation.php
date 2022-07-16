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

try {
	$conn = new PDO('mysql:host=localhost;dbname=mg;charset=utf8', 'root', '');
	// set the PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch(PDOException $e) {
}
$id=$_SESSION['id'];
$pid = $_POST['id'];
$date=date("Y-m-d");
if(isset($_SESSION["cart_item"])){
	foreach ($_SESSION["cart_item"] as $item){
		$item_price = $item["quantity"]*$item["prix"];
		
		$qte=$item["quantity"];
		$prix=$item["prix"];
		

		$req = $conn->prepare('UPDATE produit SET quantite = quantite-:nquantite  WHERE code = :nid_pro');
		$req->execute(array(
		'nquantite' => $item["quantity"],
		'nid_pro' => $item["code"]
		));

		$sql1 = "INSERT INTO commande VALUES (NULL, '$id', '$item_price','$date')";
		// use exec() because no results are returned
		$sql2 = "SELECT MAX(Id_com) FROM commande";
		$result = $conn->query($sql2);
		$sql3 = "INSERT INTO detail_com VALUES ('$pid', '$result', '$qte','$prix')";
		// use exec() because no results are returned
		$conn->exec($sql3);
	}
}

 		
header('Location: cart.php');
?>
