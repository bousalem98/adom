<?php 
session_start();
require "Connexion.php";
$email = "";
$nom = "";
$prenom = "";
$telephone = "";
$ville = "";
$address = "";
$errors = array();

//if user click signup button
if(isset($_POST['signup'])){
    $nom = mysqli_real_escape_string($con, $_POST['nom']);
    $prenom = mysqli_real_escape_string($con, $_POST['prenom']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['mdp']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cmdp']);
    $telephone = intval(mysqli_real_escape_string($con, $_POST['telephone']));
    $ville = mysqli_real_escape_string($con, $_POST['ville']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    if($password !== $cpassword){
        $errors['password'] = "les deux mots de passes ne sont pas identiques!";
    }
    $email_check = "SELECT * FROM utilisateur WHERE email = '$email'";
    $res = mysqli_query($con, $email_check);
    if(mysqli_num_rows($res) > 0){
        $errors['email'] = "Email que vous avez entrer existe deja!";
    }
    if(count($errors) === 0){
        $encpass = password_hash($password, PASSWORD_BCRYPT);
        $code = rand(999999, 111111);
        $status = "notverified";
        $typeU = "user";
        $insert_data = "INSERT INTO utilisateur (nom, prenom,code,email,mdp,status,telephone,adresse,typeU,ville)
                        values('$nom', '$prenom', '$code', '$email', '$encpass', '$status', '$telephone', '$address', '$typeU', '$ville')";
        $data_check = mysqli_query($con, $insert_data);
        if($data_check){
            $subject = "Email Verification Code";
            $message = "Your verification code is $code";
            $sender = "From: adomissat@gmail.com";
            if(mail($email, $subject, $message, $sender)){
                $info = "Nous avons envoyee un code de verification a votre email - $email";
                $_SESSION['info'] = $info;
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                header('location: verif-code.php');
                exit();
            }else{
                $errors['otp-error'] = "Failed while sending code!";
            }
        }else{
            $errors['db-error'] = "Failed while inserting data into database!";
        }
    }

}
//cas d'ajout d'un nouveau livreur
if(isset($_POST['ajouter'])){
    $nom = mysqli_real_escape_string($con, $_POST['nom']);
    $prenom = mysqli_real_escape_string($con, $_POST['prenom']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = generateRandomString();
    $telephone = intval(mysqli_real_escape_string($con, $_POST['telephone']));
    $ville = mysqli_real_escape_string($con, $_POST['ville']);
    $address = mysqli_real_escape_string($con, $_POST['address']);

    $email_check = "SELECT * FROM utilisateur WHERE email = '$email' and typeU='livreur'";
    $res = mysqli_query($con, $email_check);
    if(mysqli_num_rows($res) > 0){
        $errors['email'] = "Email que vous avez entrer existe deja!";
    }
    if(count($errors) === 0){
        $encpass = password_hash($password, PASSWORD_BCRYPT);
        $code = 0;
        $status = "verified";
        $typeU = "livreur";
        $insert_data = "INSERT INTO utilisateur (nom, prenom,code,email,mdp,status,telephone,adresse,typeU,ville,score)
                        values('$nom', '$prenom', '$code', '$email', '$encpass', '$status', '$telephone', '$address', '$typeU', '$ville',2.5)";
        $data_check = mysqli_query($con, $insert_data);
        if($data_check){
            $subject = "Mot de passe compte livreur";
            $message = "Votre mot de passe est : $password\n Vous pouvez le modifier apres la connexion avec ce mot de passe. ";
            $sender = "From: adomissat@gmail.com";
            if(mail($email, $subject, $message, $sender)){


                header('location: ../admin/admin-acceuil.php');
                exit();
            }else{
                $errors['otp-error'] = "Failed while sending code!";
            }
        }else{
            $errors['db-error'] = "Failed while inserting data into database!";
        }
    }

}

    //if user click verification code submit button
    if(isset($_POST['check'])){
        $_SESSION['info'] = "";
        $verif_code = mysqli_real_escape_string($con, $_POST['verifCode']);
        $check_code = "SELECT * FROM utilisateur WHERE code = $verif_code";
        $code_res = mysqli_query($con, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $fetch_code = $fetch_data['code'];
            $userType = $fetch_data['typeU'];
            $email = $fetch_data['email'];
            $code = 0;
            $status = 'verified';
            $update_otp = "UPDATE utilisateur SET code = $code, status = '$status' WHERE code = $fetch_code";
            $update_res = mysqli_query($con, $update_otp);
            if($update_res){
                $_SESSION['name'] = $nom;
                $_SESSION['email'] = $email;
                $_SESSION['userType'] = $userType;
                header('location: ../home.php');
                exit();
            }else{
                $errors['otp-error'] = "erreur lors de uploading le code!";
            }
        }else{
            $errors['otp-error'] = "vous avez entrer un code incorrect!";
        }
    }

    //if user click login button
    if(isset($_POST['login'])){
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['mdp']);
        $check_email = "SELECT * FROM utilisateur WHERE email = '$email'";
        $res = mysqli_query($con, $check_email);
        if(mysqli_num_rows($res) > 0){
            $fetch = mysqli_fetch_assoc($res);
            $fetch_pass = $fetch['mdp'];
            $userType = $fetch['typeU'];
            if(password_verify($password, $fetch_pass)){
                $_SESSION['email'] = $email;
                $status = $fetch['status'];
                if($status == 'verified'){
                  $_SESSION['email'] = $email;
                  $_SESSION['userType'] = $userType;
                  $_SESSION['password'] = $password;
                  if($userType=='user')
                    header('location: ../home.php');
                  else if($userType=='admin')
                    header('location: ../admin/admin-acceuil.php');
				else if($userType=='livreur')
                    header('location: ../livreur/livreur-home.php');
                }else{
                    $info = "Vous n'ayez pas encore vérifié votre adresse e-mail  - $email";
                    $_SESSION['info'] = $info;
                    header('location: verif-code.php');
                }
            }else{
                $errors['email'] = "Mot de passe incorrect!";
            }
        }else{
            $errors['email'] = "Vous n'êtes pas encore un membre ! Cliquez sur le lien du bas pour vous inscrire.";
        }
    }

    //if user click continue button in forgot password form
    if(isset($_POST['check-email'])){
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $check_email = "SELECT * FROM utilisateur WHERE email='$email'";
        $run_sql = mysqli_query($con, $check_email);
        if(mysqli_num_rows($run_sql) > 0){
            $code = rand(999999, 111111);
            $insert_code = "UPDATE utilisateur SET code = $code WHERE email = '$email'";
            $run_query =  mysqli_query($con, $insert_code);
            if($run_query){
                $subject = "Password Reset Code";
                $message = "Your password reset code is $code";
                $sender = "From: adomissat@gmail.com";
                if(mail($email, $subject, $message, $sender)){
                    $info = "Nous avons envoyé un code de réinitialisation à votre adresse e-mail  - $email";
                    $_SESSION['info'] = $info;
                    $_SESSION['email'] = $email;
                    header('location: reset-code.php');
                    exit();
                }else{
                    $errors['otp-error'] = "Failed while sending code!";
                }
            }else{
                $errors['db-error'] = "Something went wrong!";
            }
        }else{
            $errors['email'] = "This email address does not exist!";
        }
    }

    //if user click check reset otp button
    if(isset($_POST['check-reset-code'])){
        $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($con, $_POST['verifCode']);
        $check_code = "SELECT * FROM utilisateur WHERE code = $otp_code";
        $code_res = mysqli_query($con, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $email = $fetch_data['email'];
            $_SESSION['email'] = $email;
            $info = "Veuillez créer un nouveau mot de passe que vous n'utilisez sur aucun autre site .";
            $_SESSION['info'] = $info;
            header('location: new-password.php');
            exit();
        }else{
            $errors['otp-error'] = "You've entered incorrect code!";
        }
    }

    //if user click change password button
    if(isset($_POST['change-password'])){
        $_SESSION['info'] = "";
        $password = mysqli_real_escape_string($con, $_POST['mdp']);
        $cpassword = mysqli_real_escape_string($con, $_POST['cmdp']);
        if($password !== $cpassword){
            $errors['password'] = "Confirm password not matched!";
        }else{
            $code = 0;
            $email = $_SESSION['email']; //getting this email using session
            $encpass = password_hash($password, PASSWORD_BCRYPT);
            $update_pass = "UPDATE utilisateur SET code = $code, mdp = '$encpass' WHERE email = '$email'";
            $run_query = mysqli_query($con, $update_pass);
            if($run_query){
                $info = "Votre mot de passe a changé. Vous pouvez maintenant vous connecter avec votre nouveau mot de passe.";
                $_SESSION['info'] = $info;
                header('Location: password-changed.php');
            }else{
                $errors['db-error'] = "Failed to change your password!";
            }
        }
    }
    
   //if login now button click
    if(isset($_POST['login-now'])){
        header('Location: login-user.php');
    }
    function generateRandomString($length = 8) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
?>