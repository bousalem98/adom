<?php
require_once "controllerUserData.php"; 
    if(isset($_POST['add'])){
        $rating = $_POST["rating"];
        $livreur=$_SESSION['livreur'];
        $req="select * from utilisateur where id=$livreur";
        $resultat = mysqli_query($con,$req);
        if(mysqli_num_rows($resultat) > 0){
            $fetch_data = mysqli_fetch_assoc($resultat);
            $score = $fetch_data['score'];
            $score = ($score+$rating)/2;
            $score = round($score, 2);
            $update_otp = "UPDATE utilisateur SET score = $score WHERE id = $livreur";
            $update_res = mysqli_query($con, $update_otp);
            $numero_cmd=$_SESSION['num'];
            $update_otp2 = "UPDATE commande SET rated = 1 WHERE num_c = $numero_cmd";
            $update_res2 = mysqli_query($con, $update_otp2);
            if($update_res2 && $update_res){
                echo "merci pour votre vote redirecting vers home page ...";
                header('Location: home.php');

            }
           
        }
    }
?>