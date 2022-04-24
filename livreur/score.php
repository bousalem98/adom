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
                
                    $sql1="SELECT * from utilisateur where id=$idLivreur; ";
                    $mysql1=mysqli_query($con,$sql1);
                    if($mysql1->num_rows>0) {
                        $row=mysqli_fetch_assoc($mysql1);
                        $score=floatval($row['score']);
                        switch (true){case $score<=2:$etatMessage='Vous etes dans le danger zone veuillez essayer d\'améliorer votre interaction avec les clients ou vous serez eleminer';$color='red';break;case $score<=4:$etatMessage='Vous etes dans le confort zone travailler plus dur pour monter dans le poduim';$color='darkblue';break;         ;break;default:$etatMessage='Vous etes dans le poduim continuez comme ca';$color='green';break;}
                        echo '<h2 class="text-center">Votre Score est  : </h2>'; 
                        echo '<h1 style="color:'.$color.';font-weight: bold;"class="text-center">'.$score.' </h1>'; 
                        echo '<p style="color:'.$color.';"class="text-center">'.$etatMessage.'</p>';
                    }
                ?>
             <a href="livreur-home.php"><button style="margin-left: 75px;margin-top: 15px;background:#6665ee;color:white;">Retourner Accuiel</button></a>
            </div>
        </div>
    </div>
    
</body>
</html>