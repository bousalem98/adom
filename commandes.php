<?php
  require_once "controllerUserData.php"; 
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
                  header('Location: login-signup/reset-code.php');
              }
          }else{
              header('Location: login-signup/verif-code.php');
          }
      }
  }else{
      header('Location: home1.php');
  }
  ?>
<!DOCTYPE html>
<!-- Created By CodingNepal - www.codingnepalweb.com -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>ADOM</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
    
    <link rel="stylesheet" href="./css/navbar2.css">
      <link  rel="stylesheet" href="./css/custom-select.css">
      <style>
      h1{
        font-size: small;
        margin-left: 16px;
        margin-top: 10px;
      }
    
      button.button2 {
        background: transparent;
        border: none;
        
        
        font-size: 20px;
        outline: none;
        position: relative;
        transition: 0.3s;
        padding: 10px;
      }
      button.button2:before {
        content: '';
        border-bottom: 1px solid #000;
        padding: 0 10px;
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        margin: 0 auto;
        width: 0;
        transition: 0.3s;
      }
      button.button2:hover:before {
        width: 100%;
        padding: 0;
      }
      button.button2:active {
        background: #000;
        color: #fff;
        transition: none;
      }
      
      @import url(https://fonts.googleapis.com/css?family=Open+Sans);
      
      body{
        background: #f2f2f2;
        font-family: 'Open Sans', sans-serif;
      }
      
      .search {
        width: 50%;
        position: relative;
        display: flex;
      }
      
      .searchTerm {
        width: 400px;
        border: 3px solid #00B4CC;
        border-right: none;
        
        height: 36px;
        border-radius: 5px 0 0 5px;
        outline: none;
        color: #9DBFAF;
      }
      
      .searchTerm:focus{
        color: #00B4CC;
      }
      
      .searchButton {
        width: 40px;
        height: 36px;
        border: 1px solid #00B4CC;
        background: #00B4CC;
        text-align: center;
        color: #fff;
        border-radius: 0 5px 5px 0;
        cursor: pointer;
        font-size: 20px;
      }
      
      
      
      
      </style>
      <style>
          input {border:0;outline:0;background: rgb(255, 255, 255);}
          input:focus {outline:none!important;}
          td.txt{width:400px;height:50px;}
          legend{color:darkslategrey;font-weight:bold;}
          div.form{width:400px;height: 50px;margin-top: 30px;}
          fieldset{border-radius:5px;}
          .float-container {
      border: 3px solid #fff;
      
  }
  #formulaires{
      margin-left: 360px;margin-top: 90px;
  }
  .grid-container {
      display: grid;
      grid-template-columns: 1fr 2.3fr;
      grid-gap: 0px;
  }
  #check{margin-top: 30px;font-size: 50px;}
  #compte{
    color: gray;
  }
  #compte:hover{
     color: blue;
  }
      </style> 
      <style>
     #sauvegarder:hover {
  background-color: #2ed0e5;
  box-shadow: 0px 15px 20px rgba(46, 229, 157, 0.4);
  color: #000;
  transform: translateY(-7px);
}  
 #sauvegarder{
  width: 300px;
    height: 40px;
    font-family: 'Roboto', sans-serif;
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: 2.5px;
    font-weight: 500;
    color: #fff;
    margin-top: 15px;
    background-color: #140c42;
    border: none;
    border-radius: 5px;
    box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease 0s;
    cursor: pointer;
    outline: none;
}

 h1 span, small {
  display:block;
  font-size: 14px;
  color: #989598;
 }
small{ font-style: italic; 
  font-size: 11px;}
#form1 p { position: relative; }

.password {
  width: 90%;
  padding: 15px 12px;
  margin-bottom: 5px;
  border: 1px solid #e5e5e5;
  border-bottom: 2px solid #ddd;
  background: rgba(255,255,255,0.2) !important;
  color: #555;
}
.password + .unmask {
  position: absolute;
  right: 5%;
  top: 10px;
  width: 25px;
  height: 25px;
  background: transparent;
  border-radius: 50%;
  cursor:pointer;
  border: none;
  font-family:'fontawesome';
  font-size:14px;
  line-height:24px;
  -webkit-appearance:none;
  outline:none
}
.password + .unmask:before {
  content: "\f06e";
  position:absolute;
  top:0; left:0;
  width: 25px;
  height: 25px;
  background: rgba(205,205,205,0.2);
  z-index:1;
  color:#aaa;
  border:2px solid;
  border-radius: 50%;
}
.password[type="text"] + .unmask:before {
 content:"\f070";
  background: rgba(105,205,255,0.2);
  color:#06a
}
#valid{
  font-size:12px;
  color:#daa;
  height:15px
}
#strong{
  height:20px;
  font-size:12px;
  color:#daa;
  text-transform:capitalize;
  background:rgba(205,205,205,0.1);
  border-radius:5px;
  overflow:hidden
}

#strong span{  
  display:block;
  box-shadow:0 0 0 #fff inset;
  height:100%;
  transition:all 0.8s
}
#strong .weak{
   box-shadow:5em 0 0 #daa inset;
}
#strong .medium{
   color:#da6;
   box-shadow:10em 0 0 #da6 inset
}
#strong .strong{
   color:#595;
   box-shadow:50em 0 0 #ada inset
}
      </style>
      
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
       <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css'>
      
       <style>
     body{
  background: #f2f2f2;
  font-family: 'Open Sans', sans-serif;
}
   </style>
  </head>
  <body >
      
    
  <nav class="navbar">
   
  
      <input type="checkbox" id="check">
      <label for="check" class="checkbtn">
        <i class="fas fa-bars"></i>
      </label>
      <label class="logo">Adom</label>
      <ul>
        <li><a class="active" href="home.php">Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Services</a></li>
        <li><a href="#">Contact</a></li>
        <li><a href="#">Feedback</a></li>
        <button type="button" class="btn btn-light"><a href="logout-user.php">Logout</a></button> 
      </ul>
    
    </nav>
    

   <div style="margin-left: 200px;margin-top: 20px;">
    <div>
      <a  href="home.php"id="compte">Acceuil</a>
      <a style="color: grey;font-size: medium; margin-left: 20px;">/</a>
      <a style="color: black;font-size: medium; margin-left: 20px;" id="adresses">    Commandes</a>
    </div>
    <p style="font-size: 36px;">Commandes</p>
    <style>
.filtre{
  height: 40px;
  background: transparent;
  border: 0px;
  border-bottom:2px solid lightgrey ;
  outline: none;
  margin: 0px;
  padding: 0px;
  font-size: 16px;
  color: grey;

}
.filtre.active{
  border-bottom:2px solid orange ;
  color: darkblue;
}
.filtre:hover{
  border-bottom:2px solid rgb(7, 7, 82) ;
}
.filtre.active:hover{
  border-bottom:2px solid orangered ;
}
    </style>

    <div style="width: 90%;height: 100%; background-color: white;padding: 20px;margin-right: 50px;box-shadow:  1px 1px 1px lightgrey;">
    <div style="width: 100%;height: 50px;">
    
    <form method="post">
     
     <input type="submit" value="Tout" name="tout" class="filtre <?php
     if(!isset($_POST['filtre1'])&!isset($_POST['filtre2'])&!isset($_POST['filtre3'])&!isset($_POST['filtre4']))echo 'active'
     ?>"  style="width: 60px;" />
<input type="submit" value="livree" name="filtre1" class="filtre <?php
     if(isset($_POST['filtre1']))echo 'active'
     ?>"  style="width: 60px;" />
<input type="submit" value="annulée" name="filtre4" class="filtre <?php
     if(isset($_POST['filtre4']))echo 'active'
     ?>"  style="width: 60px;" />
<input type="submit" value="en-cours de livraison" name="filtre2" class="filtre <?php
     if(isset($_POST['filtre2']))echo 'active'
     ?>"  style="width: 180px;" />
<input type="submit" value="en-cours de traitement" name="filtre3" class="filtre <?php
     if(isset($_POST['filtre3']))echo 'active'
     ?>"  style="width: 65.5%;" />

    </form>
    </div>


<table id="customers" >
  <tr>
    <th>Nom destinataire</th>
    <th>Numero de commande</th>
    <th>Date</th>
    <th>Montant</th>
    <th>Status</th>
    <th>Facture</th>
  </tr>
  <?php
  $sql="SELECT id from utilisateur where email='$email' ;";
  $id=mysqli_fetch_array(mysqli_query($con,$sql))[0];
  $etatN="";
    if(isset($_POST['filtre1']))
    $etatN="and etat=2";
    if(isset($_POST['filtre2']))
    $etatN="and etat=1";
    if(isset($_POST['filtre3']))
    $etatN="and etat=0";
    if(isset($_POST['filtre4']))
    $etatN="and etat=3";
    
  $sql="SELECT * from commande where id_user=$id $etatN ORDER BY date_cmd desc";
  
  $result=mysqli_query($con,$sql);
  if($result){
  while($row=mysqli_fetch_array($result)):
    $prix=$row["prix_total"];
    $etat="";$etatMessage="";
    switch ($row["etat"]){case 1:$etat="en_cours";$etatMessage='en cours de livraison';break;case 2:$etat="livree";$etatMessage='livree';break;case 3:$etat="annule";$etatMessage='annulée';break;      case 0:$etat="trait";$etatMessage='en cours de traitment';      break;default:break;}
    
    echo ' <tr>
    <td style="color: darkblue;">'.$row["nom"].' '.$row["prenom"].'</td>
    <td style="color: grey;">'.$row["num_c"].'</td>
    <td style="color: grey;">'.$row["date_cmd"].'</td>
    <td style="color: darkblue;">'.$prix.' DT</td>
    <td><h6 class="status '.$etat.'">'.$etatMessage.'</h6> </td>
    <td class="facture">TELECHARGER</td>
    
  </tr>';

  endwhile;  
}

  ?>
 
 
 
</table>
      </div>

      <style>
        .facture{
          font-size: 20px;
          color: darkblue;
          text-shadow: 0px 0px 2px black;
        }
        #customers {
          font-family: Arial, Helvetica, sans-serif;
          border-collapse: collapse;
          width: 100%;
          margin-top: 20px;
        }
        
        #customers td, #customers th {
          border-bottom: 1px solid #ddd;
          padding: 8px;
        }
        
        #customers tr:nth-child(even){background-color: transparent;}
        
        #customers tr:hover {background-color: #ddd;}
        
        #customers th {
          padding-top: 12px;
          padding-bottom: 12px;
          text-align: left;
          background-color: transparent;
          color: rgb(23, 8, 53);
        
        }
        .status{
          color: white;
          
          
          border-radius: 20px;
          text-align: center;
          
          font-size: 16px;
        }
        .status.en_cours{
          background-color: darkblue;
          width: 160px;

          
        }
        .status.livree{
          background-color: green;
          width: 60px;

          
        }
        .status.trait{
          background-color: #3d3dff;
          width: 170px;
        }
        .status.annule{
          background-color: red;
          width: 80px;
        }
        </style>
       
        

    </div>





  </div>  

    <script src="./js/custom-select.js"></script>
  </body>
</html>