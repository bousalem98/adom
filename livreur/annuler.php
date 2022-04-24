<?php
require_once "../controllerUserData.php";
$num_c=$_GET['num_c'];
$date_arrive=date('Y-m-d');
$sql="UPDATE commande set etat=3,date_arrive='$date_arrive' where num_c=$num_c";
if(mysqli_query($con,$sql))
header("Location: livreur-home.php?livraison=annule");
?>