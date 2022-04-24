 <?php 
require_once "controllerAdminData.php"; 
$num_c=$_GET['num_c'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Adom </title>
    <link rel="stylesheet" href="../css/nav.css">
 
  

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
   
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />
<link rel="stylesheet" href="./css/style.css">
</head>
<body>
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
        
    <button type="button" class="btn btn-light" id="login"><a href="../logout-user.php">Logout</a></button>
    

      </ul>
    
    </nav>
    
    <section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">Liste de livreurs</h2>
				</div>
			</div>
			<div class="row">
				

				<div class="col-md-12">
					<div class="table-wrap">
						<table class="table table-responsive-xl">
						  <thead>
						    <tr>
						    	<th>&nbsp;</th>
						    	<th>Nom</th>
						        <th>&nbsp;</th>
						        <th>Ville</th>
						        <th>Score</th>
						    </tr>
						  </thead>
						  <tbody>
                <?php
				$sql="SELECT * from utilisateur where typeU='livreur' ORDER BY score DESC ";
				$mysql=mysqli_query($con,$sql);
				
				while($row=mysqli_fetch_array($mysql)):
                    //verifier si le livreur est disponible
                    $idLivreur=$row['id'];
                    $sql1="SELECT * from commande where etat=1 and idLivreur=$idLivreur; ";
                    $mysql1=mysqli_query($con,$sql1);
                    if($mysql1->num_rows<1)

                
				echo '
						    <tr class="alert" role="alert">
                            <td></td>
						    	
						      <td class="d-flex align-items-center">
						      	<div class="img" style="background-image: url(../images/person_1.jpg);"></div>
						      	<div class="pl-3 email">
						      		<span> '.$row['prenom'].' '.$row['nom'].' </span>
						      		
						      	</div>
						      </td>
						      <td>'.'</td>
						      <td class="status">'.$row['ville'].'</td>
                              <td>
						    		<label class="checkbox-wrap checkbox-primary">
										  '.$row['score'].'
										</label>
						    	</td>
						      <td>
                  <a href="terminer-affectation.php?num_c='.$num_c.'&idLivreur='.$row['id'].'">
						      	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				            	<span aria-hidden="true">Affecter</span>
				          	</button>
                  </a>
				        	</td>
						    </tr>';
					
                endwhile;
							
				?>
						    
						  </tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>



</body>
</html>