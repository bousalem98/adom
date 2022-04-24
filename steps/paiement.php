<?php require_once "../controllerUserData.php"; 
$email = $_SESSION['email'];
$password = $_SESSION['password'];
$ad_enlevement='';$ville='';$date_cmd='';$num_cmd='';$poids='';$nb_articles='';$ad_livraison='';$id_user='';$express='';$note_livraison='';$nom='';$prenom='';$telephone='';$email1='';$etat='';$prix_total='';
if($email != false && $password != false){
    $sql = "SELECT * FROM utilisateur WHERE email = '$email'";
    $run_Sql = mysqli_query($con, $sql);
    if($run_Sql){
        $fetch_info = mysqli_fetch_assoc($run_Sql);
        $status = $fetch_info['status'];
        $code = $fetch_info['code'];
        if($status == "verified"){
            if($code != 0){
                header('Location: ../login-signup/reset-code.php');
            }
        }else{
            header('Location: ../login-signup/verif-code.php');
        }
    }
}else{
    header('Location: ../home.php');
}
$query="SELECT * FROM `utilisateur` WHERE email='$email'";
$result = mysqli_query($con,$query) ;
$rows = mysqli_num_rows($result);
if($rows==1){
  $id_user=mysqli_fetch_array($result)[0];  
}
if(isset($_POST['suivant'])){
  if(isset($_POST['adresseE']) && isset($_POST['longueur']) && isset($_POST['hauteur']) && isset($_POST['largeur']) && isset($_POST['nbArticle']) && isset($_POST['adresseL']) && isset($_POST['ville']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['poids']) && isset($_POST['valeur']) && isset($_POST['telephone']) && isset($_POST['email']) && isset($_POST['note']) ){
  $adresseE = mysqli_real_escape_string($con, $_POST['adresseE']);
  $longueur = intval(mysqli_real_escape_string($con, $_POST['longueur']));
  $hauteur = intval(mysqli_real_escape_string($con, $_POST['hauteur']));
  $largeur = intval(mysqli_real_escape_string($con, $_POST['largeur']));
  $nbArticle = intval(mysqli_real_escape_string($con, $_POST['nbArticle']));
  $adresseL = mysqli_real_escape_string($con, $_POST['adresseL']);
  $ville = mysqli_real_escape_string($con, $_POST['ville']);
  $nom = mysqli_real_escape_string($con, $_POST['nom']);  
  $prenom = mysqli_real_escape_string($con, $_POST['prenom']);  
  $poids = intval(mysqli_real_escape_string($con, $_POST['poids']));
  $valeur = intval(mysqli_real_escape_string($con, $_POST['valeur']));
  $telephone = intval(mysqli_real_escape_string($con, $_POST['telephone']));
  $email = mysqli_real_escape_string($con, $_POST['email']);
  $note = mysqli_real_escape_string($con, $_POST['note']);
  $date_cmd=date('Y-m-d');

  $num_cmd=rand(999999999, 111111111);
  $etat=0;
  $express=isset($_POST['express'])? 1 : 0;
  $href="confirmer.php?adresseE=$adresseE&longueur=$longueur&largeur=$largeur&hauteur=$hauteur&nbArticle=$nbArticle&adresseL=$adresseL&
  &ville=$ville&nom=$nom&prenom=$prenom&poids=$poids&valeur=$valeur&telephone=$telephone&email=$email&note=$note&
  num_cmd=$num_cmd&express=$express&date_cmd=$date_cmd";
  
}
}
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
             
              <li role="presentation" class="active">
                <a class="persistant-disabled" href="#stepper-step-3" data-toggle="tab" aria-controls="stepper-step-3" role="tab" title="Paiement">
                  <span class="round-tab" id="span3">2</span>
                </a>
              </li>
              <li role="presentation" class="disabled">
                <a class="persistant-disabled" href="#stepper-step-4" data-toggle="tab" aria-controls="stepper-step-4" role="tab" title="Comfirmation">
                  <span class="round-tab" id="span4">3</span>
                </a>
              </li>
            </ul>
            
              <div class="tab-content">
<!--********************************111111111111*********************************-->

<div class="tab-pane fade in active" role="tabpanel" id="stepper-step-1">

 
</div>
     

              
<!--**********************************3333333333333333*******************************-->
                <div class="tab-pane fade in active" role="tabpanel" id="stepper-step-3">
                  <div style="border-bottom: solid lightgrey 1px;height: 50px;width: 100%;">
                    <a style="color: rgb(0, 0, 82);text-shadow: 1px 1px 1px rgb(0, 0, 82);float: left;margin-left: 20px;font-size: 20px;">
                      Information de facturation
  
                    </a>
                    <a style="color: rgb(0, 0, 82);text-shadow: 1px 1px 1px rgb(0, 0, 82);float: right;margin-right: 400px;font-size: 20px;">
                      Information de commande
  
                    </a>

                  </div>
                <div style="margin-left:  20px;height: 200px;"> 

                
                    
              
              
                <div style="float: left;height: auto;">
                
                  <a id="step2_nom_prenom"style="color: rgb(0, 0, 82);text-shadow: 1px 1px 1px rgb(0, 0, 82);font-size: 20px;width: 100%;">
                    <?php 
                    global $nom,$prenom;
                    echo $prenom.' '.$nom;
                    
                    ?>
                 
  
                    </a>
                    <div>
                      <a id="step2_ville" style="color: rgb(0, 0, 82);font-size: 18px;width: 100%;">
                      <?php 
                        global $ville;
                        echo $ville;
                      ?>
                     
                    </a>
                    <br>
                    <a id="step2_addresse" style="color: rgb(0, 0, 82);font-size: 15px;width: 100%;">
                    <?php 
                        global $adresseL;
                        echo $adresseL;
                      ?>
                   
                    </a>
                    <br>
                    
                    </div>
                    
                
                </div>


              <div style="float: right;margin-right: 35px;height: auto;width: 600px;">
                
                <div style="width: 600px;margin-top: 30px;height: 40px;border-bottom: solid lightgrey 1px;">
                  <a style="color: rgb(0, 0, 82);font-size: 15px;float: left;">
                 
                  Le prix de commande
                </a>
                <a id="step2_prix_cmd" style="color: rgb(0, 0, 82);font-size: 15px;float: right;">
                <?php
                echo $valeur.' DT';
                ?>
                </a>

                </div>
                <div style="width: 600px;margin-top: 30px;height: 40px;border-bottom: solid lightgrey 1px;">
                  <a style="color: rgb(0, 0, 82);font-size: 15px;float: left;">
                  Total commande TVA incluse (%8) 
                </a>
                <a id="step2_prix_cmd_livraison" style="color: rgb(0, 0, 82);font-size: 15px;float: right;">
                  <?php
                  global $valeur,$poids;
                  if($express==1)
                  $valeur= $valeur+2;
                  $prix_total= $valeur+(intval($poids)*3);
                  echo $prix_total.' DT';
                  ?>
                </a>

                </div>
              
              </div>
              <a style="color: rgb(0, 0, 82);text-shadow: 1px 1px 1px rgb(0, 0, 82);float: left;margin-left: 20px;font-size: 16px;margin-top: 20px;">
                En cliquant sur le bouton Payer maintenant, vous affirmez avoir lu , compris et accepte les conditions generales de ventes d'ADOM

              </a>
              
              
              </div>

                  






                  <ul class="list-inline pull-right">
                    
                    <li>
                      <a class="btn btn-primary next-step" href="<?php global $href;echo $href?>">Payer maintenant</a>
                      
                    </li>
                  </ul>
                </div>
                <!--*****************************4444444444444444************************************-->
                <div class="tab-pane fade" role="tabpanel" id="stepper-step-4">
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
