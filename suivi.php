<?php require_once "controllerUserData.php"; 
if(isset($_POST['btn_suivi'])){
    $num=$_POST['num_suivi'];
    $_SESSION['num']=$num;
    $cmd="select * from commande where num_c='$num'";
    $results = mysqli_query($con,$cmd);
    $row = mysqli_num_rows($results);
    if($row == 0){
      if($_SESSION['email']==null)
        header('Location: home1.php?livraison=notfound');
      else
        header('Location: home.php?livraison=notfound');
        
    }
    else{
        $fetch_data = mysqli_fetch_assoc($results);
        $nom = $fetch_data['nom'];
        $prenom = $fetch_data['prenom'];
        $addres_liv = $fetch_data['ad_livraison'];
        $prix = $fetch_data['prix_total'];
        $etat = $fetch_data['etat'];
        $rated = $fetch_data['rated'];
        $livreur = $fetch_data['idLivreur'];
        $date_cmd = $fetch_data['date_cmd'];
        $date_liv = $fetch_data['date_liv'];
        $date_arrive = $fetch_data['date_arrive'];
        $_SESSION['livreur']=$livreur;
    }
}else header('Location: home.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Formulaire de suivi commande</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/css/bootstrap.min.css" integrity="sha384-SI27wrMjH3ZZ89r4o+fGIJtnzkAnFs3E4qz9DIYioCQ5l9Rd/7UAa8DHcaL8jkWt" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
    <link rel="stylesheet" href="css/timeline.css">
    <link rel="stylesheet" href="css/nav.css">
    
</head>
<body>
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
        </ul>
    </nav>

    
    <div class="wrapper">

    <div class="center-line">
    <div class="center-line">
      <a href="#" class="scroll-icon"><i class="fas fa-caret-up"></i></a>
    </div>
    </div>
    <div class="row row-1">
      <section>
        <i class="icon fas fa-pen"></i>
        <div class="details">
          <span class="title">Traitement de livraison</span>
          <span><?php if($date_cmd!=null) echo $date_cmd;?></span>
         
        </div>
         <div class="form-group">
                <b>Nom et prenom : </b> 
                    <?php
                    echo " $nom $prenom";
                    ?>
                </div>  
                <div class="form-group">
                <b> Adreese de livraison : </b>
                    <?php
                    echo " $addres_liv";
                    ?>
                </div>  
                <div class="form-group">
                   <b> Montant de Commande : </b> 
                    <?php
                    echo " $prix DT";
                    ?>
                </div> 
      </section>
    </div>
    <div class="row row-2">
      <section>
        <i class="icon fas fa-truck <?php if($date_liv==null) echo 'inactive';?>"></i>
        <div class="details">
          <span class="title">Demarrage de livraison</span>
          <span><?php if($date_liv!=null) echo $date_liv;?></span>
        </div>
        
      </section>
    </div>
    <div class="row row-1">
      <section>
        <i class="icon fas fa-home <?php if($date_arrive==null) echo 'inactive';?>"></i>
        <div class="details">
          <span class="title">Arrivee de produit</span>
          <span><?php if($date_arrive!=null) echo $date_arrive;?></span>
        </div>
        <div class="form-group">
      <?php 
      if($date_arrive!=null){
            switch ($etat){
              case 1:$etatMessage='en cours de livraison';break;
              case 2:$etatMessage='<p style="color:green;background:lightgreen;border-radius:10px;text-align:center;border-color:green;border-style: solid;">livree</p>';break;
              case 3:$etatMessage='<div style="color:red;background:peach;border-radius:10px;text-align:center;border-color:red;border-style: solid;">annulée</div>';break;      
              case 0:$etatMessage='en cours de traitment';      break;default:break;}
            echo 
            "<b> Etat de commande : </b> $etatMessage ";
      }
      
      ?>
      </div> 
      </section>
    </div>
    
                <?php
                if ($etat==2 && $rated==0){

                echo '<div class="row row-2">
      <section>
        <i class="icon fas fa-star <?php if($date_arrive==null) echo inactive;?>"></i>
        <div class="details">
          <span class="title">feedback sur le livraison</span>
          <span><?php if($date_liv!=null) echo $date_liv;?></span>
        </div>
        <form action="suivi2.php" method="post"><div class="form-group">
                    <b> rating de livreur : </b>
                    <div class="rateyo" id= "rating"
                    data-rateyo-rating="4"
                    data-rateyo-num-stars="5"
                    data-rateyo-score="3">
                    </div>
                    <span class="result">0</span>
                    <input type="hidden" name="rating">
                    <button class="btn-star"style="color: #6665ee; border: 1.7px solid black;"  name="add" >Envoyer</button>
                </div></form>
      </section>
    </div> ';
                }   
                ?>
            
    
  </div>
    
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
 
        <script>
        $(function () {
            $(".rateyo").rateYo().on("rateyo.change", function (e, data) {
                var rating = data.rating;
                $(this).parent().find('.score').text('score :'+ $(this).attr('data-rateyo-score'));
                $(this).parent().find('.result').text('rating :'+ rating);
                $(this).parent().find('input[name=rating]').val(rating); //add rating value to input field
            });
        });  
    </script>
</body>
</html>