<?php require_once "../controllerUserData.php"; 
$email = $_SESSION['email'];
$password = $_SESSION['password'];
$nom_sender='';$prenom_sender='';$ad_enlevement='';$ville='';$date_cmd='';$num_cmd='';$poids_total='';$nb_articles='';$ad_livraison='';$id_user='';$express='';$note_livraison='';$nom='';$prenom='';$telephone='';$email1='';$etat='';$prix_total='';
if($email != false && $password != false){
    $sql = "SELECT * FROM utilisateur WHERE email = '$email'";
    $run_Sql = mysqli_query($con, $sql);
    if($run_Sql){
        $fetch_info = mysqli_fetch_assoc($run_Sql);
        $status = $fetch_info['status'];
        $nom_sender = $fetch_info['nom'];
        $prenom_sender = $fetch_info['prenom'];
        $code = $fetch_info['code'];
        if($status == "verified"){
            if($code != 0){
                header('Location: login-signup/reset-code.php');
            }
        }else{
            header('Location: login-signup/verif-code.php');
        }
    }
}else{
    header('Location: home1.php');
}
$query="SELECT * FROM `utilisateur` WHERE email='$email'";
$result = mysqli_query($con,$query) ;
$rows = mysqli_num_rows($result);
if($rows==1){
  $id_user=mysqli_fetch_array($result)[0];  
}

  if(isset($_GET['adresseE']) && isset($_GET['longueur']) && isset($_GET['hauteur']) && isset($_GET['largeur']) && isset($_GET['nbArticle']) && isset($_GET['adresseL']) && isset($_GET['ville']) && isset($_GET['nom']) && isset($_GET['prenom']) && isset($_GET['poids']) && isset($_GET['valeur']) && isset($_GET['telephone']) && isset($_GET['email']) && isset($_GET['note']) ){
  
  $ad_enlevement = mysqli_real_escape_string($con, $_GET['adresseE']);
  $longueur = intval(mysqli_real_escape_string($con, $_GET['longueur']));
  $hauteur = intval(mysqli_real_escape_string($con, $_GET['hauteur']));
  $largeur = intval(mysqli_real_escape_string($con, $_GET['largeur']));
  $nb_articles = intval(mysqli_real_escape_string($con, $_GET['nbArticle']));
  $ad_livraison = mysqli_real_escape_string($con, $_GET['adresseL']);
  $ville = mysqli_real_escape_string($con, $_GET['ville']);
  $nom = mysqli_real_escape_string($con, $_GET['nom']);  
  $prenom = mysqli_real_escape_string($con, $_GET['prenom']);  
  $poids_total = intval(mysqli_real_escape_string($con, $_GET['poids']));
  $prix_total = intval(mysqli_real_escape_string($con, $_GET['valeur']));
  $telephone = intval(mysqli_real_escape_string($con, $_GET['telephone']));
  $email1 = mysqli_real_escape_string($con, $_GET['email']);
  $note_livraison = mysqli_real_escape_string($con, $_GET['note']);
  $date=mysqli_real_escape_string($con, $_GET['date_cmd']);
  $date_cmd=$date;
  $rated=0;
  $num_cmd=intval(mysqli_real_escape_string($con, $_GET['num_cmd']));
  $etat=0;
  $express=intval(mysqli_real_escape_string($con, $_GET['express']));
  if($express==1)
    $prix_total= $prix_total+2;
  $prix_total=$prix_total+($poids_total*3);
  $sql="insert into commande(ad_enlevement,ville,date_cmd,num_c,poids_total,nb_articles,ad_livraison,id_user,express,note_livraison,nom,prenom,telephone,email,etat,rated,prix_total)values('$ad_enlevement','$ville','$date_cmd',$num_cmd,$poids_total,$nb_articles,'$ad_livraison',$id_user,$express,'$note_livraison','$nom','$prenom',$telephone,'$email1',$etat,$rated,$prix_total)";
  $check_code = "SELECT * FROM commande WHERE num_c = $num_cmd";
  $code_res = mysqli_query($con, $check_code);
  if(mysqli_num_rows($code_res) == 0){
  $res=mysqli_query($con,$sql) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error($con), E_USER_ERROR);
  if($res){
    $subject = "Adom Delivery Notification";
    $message ="Dear $nom_sender $prenom_sender  \n \n Thank you for choosing Adom as your delivery partner. Please find below the details of your shipment(s): \n Le code de suivi de votre commande est $num_cmd \n \n For more information about your shipment(s), click on the shipment number above, or visit us at adom.com \n\n Thank you,\n Adom";      
    $message1 ="Dear $nom $prenom  \n \n Thank you for choosing Adom as your delivery partner. Please find below the details of your shipment(s): \n Le code de suivi de votre commande est $num_cmd \n \n For more information about your shipment(s), click on the shipment number above, or visit us at adom.com \n\n Thank you,\n Adom";
          $sender ="From: adomissat@gmail.com";
          if(mail($email1, $subject, $message1, $sender) && mail($email, $subject, $message, $sender)){
              $info = "Nous avons envoyee un code de suivi a votre email - $email";
          }else{
              $errors['otp-error'] = "Failed while sending code!";
          }
  }else{
    echo 'error';
  }
}
}else echo 'champs vides'

?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Adom </title>
    <link rel="stylesheet" href="../css/nav.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css'>
    
    <link rel="stylesheet" href="../css/colis.css">
    
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
                <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
                <link rel="stylesheet" href="../css/tip.css">
                <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>
                <script src='https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.4.7/angular.min.js'></script>
                <script src='https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.4.7/angular-animate.min.js'></script>
                <script src='https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.4.7/angular-messages.min.js'></script>
                <script src="./js/tip.js"></script>
 
    
</head>
<body style="background-color: #cbcbec;">

    <nav class="navbar">
   
  
      <input type="checkbox" id="check">
      <label for="check" class="checkbtn">
        <i class="fas fa-bars"></i>
      </label>
      <label class="logo">Adom</label>
      <ul>
        <li><a class="active"href="../home.php">Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Services</a></li>
        <li><a href="#">Contact</a></li>
        <li><a href="#">Feedback</a></li>
        
    <button type="button" class="btn btn-light" id="login"><a href="../logout-user.php">Logout</a></button>
    

      </ul>
    
    </nav>


    <div style="margin-left: 350px;margin-top: 20px;">
      <div>
        <a  href="../home.php" id="compte">Acceuil</a>
        <a style="color: grey;font-size: medium; margin-left: 20px;">/</a>
        <a style="color: black;font-size: medium; margin-left: 20px;" id="adresses">    Lancement de commande</a>
      </div>
      <p style="font-size: 36px;">Passage de commande</p>
    </div>  
    <div class="container" style="margin-top: 30px;">
      <div class="panel panel-default">
        <div class="panel-body">
    
          <div class="stepper">
            <ul class="nav nav-tabs" role="tablist" style="margin-left: 240px;">
              <li role="presentation" class="completed">
                <a class="persistant-disabled" href="#stepper-step-1" data-toggle="tab" aria-controls="stepper-step-1" role="tab" title="Passage de commande">
                  <span class="round-tab" id="span1">1</span>
                </a>
              </li>
             
              <li role="presentation" class="completed">
                <a class="persistant-disabled" href="#stepper-step-3" data-toggle="tab" aria-controls="stepper-step-3" role="tab" title="Paiement">
                  <span class="round-tab" id="span3">2</span>
                </a>
              </li>
              <li role="presentation" class="active">
                <a class="persistant-disabled" href="#stepper-step-4" data-toggle="tab" aria-controls="stepper-step-4" role="tab" title="Comfirmation">
                  <span class="round-tab" id="span4">3</span>
                </a>
              </li>
            </ul>
            
              <div class="tab-content">
<!--********************************111111111111*********************************-->

<div class="tab-pane fade" role="tabpanel" id="stepper-step-1">  
</div>
     
              
<!--**********************************22222222222222222222*******************************-->
                <div class="tab-pane fade" role="tabpanel" id="stepper-step-3">
               
                </div>
                <!--*****************************33333333333333333333333333************************************-->
                <div class="tab-pane fade in active " role="tabpanel" id="stepper-step-4">
                  <div style="margin-left: 50px;margin-right: 50px;width: 1200px;">
                    <a style="font-size: 25px;color: rgb(0, 0, 82);">Nous vous confirmons que votre commande d'un montant de <?php  ?> DT a ete bien enregistree</a>
                  <br>
                    <a style="margin-top: 80px;">Vous pouvez suivre le progres de votre commande avec ce code si dessous:</a>
                    <div class="grid-container" style="width:1000px;margin-top: 20px;">
                        <?php 
                          echo $num_cmd;
                        ?>
                    </div>
                    <div style="height: 20px;width: 1200px;"></div>
                    <a style="margin-top: 50px;"></a>
                    <div style="height: 20px;width: 1200px;"></div>
                    <br><a style="margin-top: 50px;">Merci pour votre confiance</a>
                    
                    
                  <form style="margin-left: 850px;"method="post" action="../home.php">
                  <input name="payement" type="submit" value="Terminer"/>
                  </form>
                  
                  </div>
   
                     
                
                  
                </div>
              </div>
            
          </div>
    
    
        </div>
      </div>
    </div>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
	  <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script>
	  
    </body>
</html>
