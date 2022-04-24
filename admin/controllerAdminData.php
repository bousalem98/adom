<?php 
require_once "../controllerUserData.php"; 
$email = $_SESSION['email'];
$password = $_SESSION['password'];
if($email != false && $password != false){
    $sql = "SELECT * FROM utilisateur WHERE email = '$email'";
    $run_Sql = mysqli_query($con, $sql);
    if($run_Sql){
        $fetch_info = mysqli_fetch_assoc($run_Sql);
        $type = $fetch_info['typeU'];
        
        if($type != "admin"){
            
                header('Location: ../login-signup/login-user.php');
            
        }
    }
}else{
    header('Location: ../home1.php');
}
?>