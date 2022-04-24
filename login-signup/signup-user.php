<?php require_once "../controllerUserData.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>S'inscrire</title>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/login.css">
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
     <li><a class="active" href="../home1.php">Home</a></li>
     <li><a href="#">About</a></li>
     <li><a href="#">Services</a></li>
     <li><a href="#">Contact</a></li>
     <li><a href="#">Feedback</a></li>
    </ul>
</nav>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <form action="signup-user.php" method="POST" autocomplete="">
                    <h2 class="text-center">Créer un nouveau compte</h2>
                    <?php
                    if(count($errors) == 1){
                        ?>
                        <div class="alert alert-danger text-center">
                            <?php
                            foreach($errors as $showerror){
                                echo $showerror;
                            }
                            ?>
                        </div>
                        <?php
                    }elseif(count($errors) > 1){
                        ?>
                        <div class="alert alert-danger">
                            <?php
                            foreach($errors as $showerror){
                                ?>
                                <li><?php echo $showerror; ?></li>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="form-group">
                        <input class="form-control" type="text" name="nom" placeholder="Nom" required value="<?php echo $nom ?>">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" name="prenom" placeholder="Prenom" required value="<?php echo $prenom ?>">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="mdp" placeholder="Mot de passe" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="cmdp" placeholder="Confirmer votre mot de passe" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="email" name="email" placeholder="Addresse Email" required value="<?php echo $email ?>">
                    </div>  
                    <div class="form-group">  
                        <input class="form-control" type="number" name="telephone" placeholder="Telephone" required value="<?php echo $telephone ?>">
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="ville" required value="<?php echo $ville ?>">
                            <option value="">-- Choisir Votre Ville --</option>
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
                        
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" name="address" placeholder="Addresse" required value="<?php echo $address ?>">
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="signup" value="S'inscrire">
                    </div>
                    <div class="link login-link text-center">Déjà membre? <a href="login-user.php">Se connecter</a></div>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>