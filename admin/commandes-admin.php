<?php 
require_once "controllerAdminData.php"; 
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
    <link rel="stylesheet" href="./css/commandes.css">
    <link rel="stylesheet" href="../css/navbar2.css">
      <link  rel="stylesheet" href="../css/custom-select.css">
      <style>
      .express{
  background-color: orangered;
  color: white;
  padding: 5px;
  margin-left: 10px;
}
      
      
      </style>
    
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css'>
  </head>
  <body >
      
    
  <nav class="navbar">
   
  
      <input type="checkbox" id="check">
      <label for="check" class="checkbtn">
        <i class="fas fa-bars"></i>
      </label>
      <label class="logo">Adom</label>
      <ul>
        <li><a class="active" href="admin-acceuil.php">Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Services</a></li>
        <li><a href="#">Contact</a></li>
        <li><a href="#">Feedback</a></li>
        <button type="button" class="btn btn-light"><a href="../logout-user.php">Logout</a></button> 
      </ul>
    
    </nav>
    

   <div style="margin-left: 200px;margin-top: 20px;">
    <div>
      <a  href="admin-acceuil.php"id="compte">Acceuil</a>
      <a style="color: grey;font-size: medium; margin-left: 20px;">/</a>
      <a style="color: black;font-size: medium; margin-left: 20px;" id="adresses">    Commandes</a>
    </div>
    <p style="font-size: 36px;">Commandes</p>
  

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
    <th>Livreur</th>
  </tr>
  <?php
  $sql="SELECT id from utilisateur where email='$email' ;";
  $id=mysqli_fetch_array(mysqli_query($con,$sql))[0];
  $etatN="";
    if(isset($_POST['filtre1']))
    $etatN="where etat=2";
    if(isset($_POST['filtre2']))
    $etatN="where etat=1";
    if(isset($_POST['filtre3']))
    $etatN="where etat=0";
    if(isset($_POST['filtre4']))
    $etatN="where etat=3";
    
  $sql="SELECT * from commande  $etatN ORDER BY date_cmd DESC,express DESC";
  
  $result=mysqli_query($con,$sql);
  if($result){
  while($row=mysqli_fetch_array($result)):
    $num_c=$row['num_c'];
    $prix=$row['prix_total'];
    $etat="";$etatMessage="";
    $affecter="";
    $idLiv=$row['idLivreur'];
    $sql_livreur="SELECT * from utilisateur where id=$idLiv";
    $exec=mysqli_query($con,$sql_livreur);
    $nom="";
    $prenom="";
    if(mysqli_num_rows($exec)>0)
    {
      $fetch=mysqli_fetch_assoc($exec);
      $nom=$fetch['nom'];
    
      $prenom=$fetch['prenom'];
    }
    
    $express= $row['express']==1 ? "<span class=express>Livraison Express</span>":"";
    switch ($row["etat"]){
      case 1:$etat="en_cours";$etatMessage='en cours de livraison';$affecter=$nom." ".$prenom;break;
      case 2:$etat="livree";$etatMessage='livree';$affecter=$nom." ".$prenom;break;
      case 3:$etat="annule";$etatMessage='annulée';$affecter=$nom." ".$prenom;break;      
      case 0:$etat="trait";$etatMessage='en cours de traitment';   $affecter="<a href='affecter-commande.php?num_c=$num_c' style='font-weight:bold'>Affecter livreur</a>"   ;break;default:break;}
    
    echo ' <tr>
    <td style="color: darkblue;">'.$row["nom"].' '.$row["prenom"].'</td>
    <td style="color: grey;">'.$row["num_c"].'</td>
    <td style="color: grey;"><a>'.$row["date_cmd"].'</a>'.$express.'</td>
    <td style="color: darkblue;">'.$prix.' DT</td>
    <td><h6 class="status '.$etat.'">'.$etatMessage.'</h6> </td>
    <td class="livreur">'.$affecter.'</td>
    '.'
    
  </tr>';

  endwhile;  
}

  ?>
 
 
 
</table>
      </div>


       
        

    </div>





  </div>  

    <script src="./js/custom-select.js"></script>
  </body>
</html>