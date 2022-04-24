<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Adom </title>
    <link rel="stylesheet" href="./css/nav.css">
    <link rel="stylesheet" href="./css/stylepass.css">
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
        <li><a class="active" href="#">Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Services</a></li>
        <li><a href="#">Contact</a></li>
        <li><a href="#">Feedback</a></li>
        <button type="button" class="btn btn-light" id="login"><a href="login-signup/login-user.php">Login</a></button>
        <button type="button" class="btn btn-light" id="signup"><a href="login-signup/signup-user.php">Sign-up</a></button>
      </ul>
    </nav>
    <div id="d12546">
      <form method="POST" action="suivi.php">
      <div id="input-container">
            <input placeholder="Saisissez votre numero de suivi" name="num_suivi" type="text" id="num-suivi"/>   
      <input type="submit" id="submit" value="Suivi" name="btn_suivi"href="suivi.php"/>
      <?php
        if (isset($_GET['livraison'])){
          echo '<p style="color:red;margin-left:50px;background:white;width:274px;"class="text-center">Veuillez entrer un numero de suivi valide !</p>';
        }
      ?>
      </div>
      </form>
    </div>
<div style="height: 500px;">
  <div id="d79549">
    <span class="panel-bar"></span>
    <p style="text-transform: capitalize;color: #000;font-size: 1.3em;line-height: 1.3;text-align: center;padding-bottom: 10px;padding-top: 10px;">Calcul Rapide Des Tarifs D'expédition</p>
    <p style="line-height: 1.4;color: #353636;text-transform: none;font-size: .9em;text-align: center;padding-bottom: 20px;"> Des tarifs d'expédition concurrentiels pour répondre à vos besoins</p>
    <label style="margin: 50px;">Expéditeur</label>
    <span class="label-expid">*</span>
    <select id="villeE" name="ville" required value="<?php echo $ville ?>">
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
    <label style="margin: 50px">Destinataire</label>
    <span class="label-expid">*</span>
    <select id="villeD" name="ville" required value="<?php echo $ville ?>">
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
    <label style="margin: 50px;">Poids</label>
    <span class="label-expid">*</span>
    <label style="margin: 173px;">Unité</label>
    <span class="label-unite">*</span><br>
    <input value="1" type="number" id="poids">
    <select style="margin-left: 50px;" name="unite" id="unite" required>
      <option value="kg">kg</option>
      <option value="Lb">Lb</option>
    </select>
    <div style="height: 10px;width:200px;margin-left:50px;"> <a id="affiche" ></a></div>
    <button id="calc" onclick="fn()">Calculer le tarif</button>

  </div>
 
  <div id="d79547">
    <span class="panel-bar"></span>
    <p style="text-transform: capitalize;color: #000;font-size: 1.3em;line-height: 1.3;text-align: center;padding-bottom: 10px;padding-top: 10px;">Gérer Les Colis</p>
    <p style="line-height: 1.4;color: #353636;text-transform: none;font-size: .9em;text-align: center;padding-bottom: 20px;"> Inscrivez-vous pour gérer facilement tous vos colis</p>
    <ul class="amx-cp-list amx-mr-link-list">
     
      <li class="li-colis">
        <a href="login-signup/login-user.php">
        <div style="width: 100%;height: 30px;"></div>
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16" style="margin-left:15px">
          <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
        </svg>
        <span class="sp4646" >Preparer un colis</span>
        <a  class="fleshes"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
        </svg></a>
      </a>
      </li>
      <li class="li-colis">
        <a href="login-signup/login-user.php">
        <div style="width: 100%;height: 30px;" ></div>
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16" style="margin-left:15px">
          <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
          <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/>
        </svg>
        <span class="sp4646">Mes colis </span>
        <a class="fleshes"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
        </svg></a>
      </a>
      </li>
      </ul>
      <a href="login-signup/signup-user.php"><button id="calc" style="margin-top: 70px;" >S'inscrire</button></a>
    </div>
  </div>
  <!-- <div id="d79547">
    <span class="panel-bar"></span>
  
  </div>
  -->
  <div class="wrapper">
    <div class="static-txt">Vous pouvez</div>
    <ul class="dynamic-txts">
      <li><span>passer une commande</span></li>
      <li><span>suiver votre commande</span></li>
      <li><span>annuler une commande</span></li>
      <li><span>gagner plus de temps</span></li>
    </ul>
  </div>
  <script>
    function fn(){
        var villeE=document.getElementById("villeE").value;
        var villeD=document.getElementById("villeD").value;
        var poids=document.getElementById("poids").value;
        var unite = document.getElementById("unite").value;
        if(villeE!=""&villeD!=""){
            var constant = villeD!=villeE ? 10 : 1;
            var coef=0;
            if(unite=="kg")coef=3;
            else if(unite=="Lb")coef=1.5;
            var prix_total=coef*poids+constant;
            document.getElementById("affiche").innerHTML="le prix estime est "+prix_total;
  
        }else document.getElementById("affiche").innerHTML="champs vide";
    }
  
  
  </script>
</body>
</html>