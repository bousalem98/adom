<?php require_once "../controllerUserData.php"; 
$email = $_SESSION['email'];
$password = $_SESSION['password'];
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
    header('Location: ../home1.php');
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
              <li role="presentation" class="active">
                <a class="persistant-disabled" href="#stepper-step-1" data-toggle="tab" aria-controls="stepper-step-1" role="tab" title="Passage de commande">
                  <span class="round-tab" id="span1">1</span>
                </a>
              </li>
             
              <li role="presentation" class="disabled">
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

 <form  method="post" action="paiement.php"> 
 
 
  <div style="height: 700px;"> 

    <!--                             1 1                              -->
    <div style="float: left;margin-left: 100px;height: auto;" id="wrapper_1">
      <h3 class "h2" >Livraison</h3>
    <style>
      
    </style>
<fieldset><legend>Adresse Livraison</legend> <table>
  <tr><td>
    <input type="text" class="champ" name="adresseL" required/>
  </td></tr></table></fieldset>
  <fieldset><legend>Ville</legend> <table>
  <tr><td>
  <select class="champ" id="ville" name="ville" required value="<?php echo $ville ?>">
      <option value="">-- Choisir Une Ville --</option>
      <option value="Ariana">Ariana</option>
      <option value="Beja">Beja</option>
      <option value="Ben Arous">Ben Arous</option>
      <option value="Bizerte">Bizerte</option>
      <option value="El Kef">El Kef</option>
      <option value="Gabes">Gabes</option>
      <option value="Gafsa">Gafsa</option>
      <option value="Jendouba">Jendouba</option>
      <option value="Kairouan">Kairouan</option>
      <option value="Kasserine">Kasserine</option>
      <option value="Kebili">Kebili</option>
      <option value="Mahdia">Mahdia</option>
      <option value="Manouba">Manouba</option>
      <option value="Medenine">Medenine</option>
      <option value="Monastir">Monastir</option>
      <option value="Nabeul">Nabeul</option>
      <option value="Sfax">Sfax</option>
      <option value="Sidi Bou Zid">Sidi Bou Zid</option>
      <option value="Siliana">Siliana</option>
      <option value="Sousse">Sousse</option>
      <option value="Tataouine">Tataouine</option>
      <option value="Tozeur">Tozeur</option>
      <option value="Tunis">Tunis</option>
      <option value="Zaghouan">Zaghouan</option>
    </select>
   
  </td></tr></table></fieldset>
 
    <div style="background:lightgray;width: 300px;">
      
     
      
    </div>
   


<h3 class "h2" style="margin-top: 60px;">Colis</h3>
<div style="background:lightgray;width: 300px;">

      
  </div>
<div>
  <div style="margin-top: 30px;">
    <fieldset class="fliedset2" ><legend>Longueur</legend> <table>
      <tr><td>
        <input type="number" class="champ2" name="longueur" required/>
      </td></tr></table></fieldset>
      <fieldset class="fliedset2" style="margin-left: 30px;"><legend>Largeur</legend> <table>
        <tr><td>
          <input type="number" class="champ2" name="largeur" required/>
        </td></tr></table></fieldset>
        <fieldset class="fliedset2" style="margin-left: 90px;"><legend>Hauteur</legend> <table>
          <tr><td>
            <input type="number" class="champ2" name="hauteur" required/>
          </td></tr></table></fieldset>
  </div>

<div style="width: auto;">
  <fieldset class="fliedset4" style="width: 160px;"><legend>Prix de la commande</legend> <table>
    <tr><td>
    <div class="text">
      <input type="number" class="champ4 total" style="width: 140px;" name="valeur" required value="<% total %> " />
    </div>
    </td></tr></table></fieldset>
    <fieldset class="fliedset3" style="margin-left: 20px;"><legend>Poids totale</legend> <table>
      <tr><td>
        <input type="number" class="champ3"  name="poids" required/>
      </td></tr></table></fieldset>
      <fieldset class="fliedset3" style="margin-left: 20px;"><legend>Nombre d'article</legend> <table>
        <tr><td>
          <input type="number" class="champ3" name="nbArticle" required/>
        </td></tr></table></fieldset>
       
</div>
</div>


<!--                             1 2                                -->

      
    </div>
    <div style="float: right;margin-right: 100px;height: auto;" id="wrapper_2">
      <h3 class "h2" >
        Informations
      </h3>
      
          <div style="width: 400px;height: 200px;">
          <fieldset><legend>Adresse Enlevement</legend> <table>
  <tr><td>
    <input type="text" class="champ" name="adresseE" required/>
  </td></tr></table></fieldset>
            <div style="float: left; width: 150px;">
              <fieldset  class="fliedset2"><legend>Nom</legend> <table>
                <tr><td>
                  <input type="text" class="champ2" name="nom" required/>
                </td></tr></table></fieldset>
                <fieldset  class="fliedset2" ><legend>Telephone</legend> <table>
                  <tr><td>
                    <input type="number" class="champ2" name="telephone" required/>
                  </td></tr></table></fieldset>
                  
            </div>
    
            <div style="float: right;width: 250px;">
              
              <fieldset  class="fliedset5"><legend>Prenom</legend> <table>
                <tr><td>
                  <input type="text" class="champ5" name="prenom" required/>
                </td></tr></table></fieldset>
                
                <fieldset  class="fliedset5"><legend>E-mail</legend> <table>
                  <tr><td>
                    <input type="email" class="champ5" name="email" required/>
                  </td></tr></table></fieldset>
            </div>
            </div>
            <div style="width: 400px;">
            <br><br><br>
              <label class="switch" style="margin-top: 8px;float:right;margin-left:50px">
                <input type="checkbox" checked name="express"/>
                <span class="slider round"></span>
              </label>
              <div style="float: left;">
                <h5>Livraison express (1 jours)</h5>
                <h6 style="
                color: lightslategray;">Livraison classique (2-3 jours)</h6>
              </div>
              
            <br><br><br><br>
            </div>
            <div style="width: 400px;margin-top: 5px;">
              <div style="height: 10px;width: 400px;"></div>
              <h5 class="label_ta" style="width: 400px;">Notes de livraison</a>  
                <textarea id="note" name="note" value=""
                style="margin-top: 5px; font-size: 10px;width: 400px;height: 200px;background: lightgray;"></textarea>
            </div>  
    </div>      
    </div>
              <ul class="list-inline pull-right" style="margin-right: 60px;">
                <li>
                <input class="btn btn-primary next-step " type="submit" name="suivant"id="suivant" style="font-size: 16px;" value="Suivant">
                </li>
              </ul>
              <ul class="list-inline pull-left" style="margin-left: 150px;">
                        <li>
                            <a href="home.php"><input disabled="disabled" type="submit" value="Annuler" class="btn btn-primary autre" id="autre" style="font-size: 16px;"/><a>
                        </li>
                     </ul>
                  </form>   
                </div>
     
<!--********************************22222222222222222*********************************-->
              
<!--**********************************3333333333333333*******************************-->
                <div class="tab-pane fade" role="tabpanel" id="stepper-step-3"></div>
                <!--*****************************4444444444444444************************************-->
                <div class="tab-pane fade" role="tabpanel" id="stepper-step-4"></div>
              </div>
            
          </div>
    
    
        </div>
      </div>
    </div>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
	  <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script>
	  
    </body>
</html>
