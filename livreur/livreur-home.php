<?php require_once "../controllerUserData.php";
$email=$_SESSION['email'];
$sql="SELECT * from utilisateur where email='$email'";
$mysql=mysqli_query($con,$sql);
if($mysql->num_rows==1)
$row=mysqli_fetch_assoc($mysql);
$idLivreur=$row['id'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Formulaire de connexion</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    
</head>
<body>
<nav class="navbar">
   <input type="checkbox" id="check">
   <label for="check" class="checkbtn">
     <i class="fas fa-bars"></i>
   </label>
   <label class="logo">Adom</label>
   <ul>
     <li><a class="active" href="livreur-home.php">Home</a></li>
     <li><a href="#">About</a></li>
     <li><a href="#">Services</a></li>
     <li><a href="#">Contact</a></li>
     <li><a href="#">Feedback</a></li>
     <button type="button" class="btn btn-light"><a href="../logout-user.php">Logout</a></button>
    </ul>
</nav>
<div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form login-form">
                <?php 
                
                    $sql1="SELECT * from commande where etat=1 and idLivreur=$idLivreur; ";
                    $mysql1=mysqli_query($con,$sql1);
                    if($mysql1->num_rows<1) {
                        echo '<h2 class="text-center">Vous n\'avez aucune commande à livrer</h2><br>';
                        if(isset($_GET['livraison'])){
                            $livraison=$_GET['livraison'];
                            if($livraison=='terminee')
                            echo "<h2 class=\"text-center\" style=\"color:green; \"> Vous avez confirme la livraison";
                            else if($livraison=='annule')
                            echo "<h2 class=\"text-center\" style=\"color:red; \"> La livraison n'est pas bien arrive";
                            
                        }
                        
                    echo '</h2>';
                    }
                    else {
                        $row=mysqli_fetch_assoc($mysql1);
                        echo '<h2 class="text-center">numero commande : '.$row['num_c'].'</h2>';
                        echo '<p class="text-center">Nom destinataire : '.$row['nom'].' '.$row['prenom'].'</p>';
                        echo '<p class="text-center">adresse destinataire : '.$row['ad_livraison'].'</p>';
                        echo '<p class="text-center">telephone destinataire : '.$row['telephone'].'</p>';
                        echo '<p class="text-center" style="color:blue">note livraison : '.$row['note_livraison'].'</p>';
                        if($row['express']==1)
                        echo '<b style="
                        color: black;
                        padding: 5px;
                        margin-left: 110px;">Express</b>';
                        echo '<div style="margin-top:20px">
                        <a href="confirmer.php?num_c='.$row['num_c'].'"><button style="background:green;color:white;float:left;font-size:">Confirmer</button></a>
                        <a href="annuler.php?num_c='.$row['num_c'].'"><button style="background:red;color:white;float:right">Annuler</button></a>
                        </div>';
                    }
                ?>
              <a href="score.php"><button style="margin-left: 75px;margin-top: 15px;background:#6665ee;color:white;">Suivre mon score</button></a>
            </div>
        </div>
    </div>
    
</body>
</html>