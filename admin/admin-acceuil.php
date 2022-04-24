<?php 
require_once "controllerAdminData.php"; 
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Adom </title>
    <link rel="stylesheet" href="../css/nav.css">
 
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
        <li><a class="active" href="admin-acceuil.php">Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Services</a></li>
        <li><a href="#">Contact</a></li>
        <li><a href="#">Feedback</a></li>
        
        <button type="button" class="btn btn-light" id="login"><a href="../logout-user.php">Logout</a></button>

      </ul>
    
    </nav>
    
<div style="height: 500px;">
 
 
  <div id="d79549" >
      <div style="background: #6665ee;">
           <span class="panel-bar" style="background:white"></span>
    <p style="color:white;background:#6665ee;text-transform: capitalize;font-size: 1.3em;line-height: 1.3;text-align: center;padding-bottom: 10px;padding-top: 10px;">Tableau de bord</p>
    
      </div>
   
     <ul class="amx-cp-list amx-mr-link-list">
       
      <li class="li-colis">
        <a href="commandes-admin.php">
        <div style="width: 100%;height: 30px;"></div>
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16" style="margin-left:15px">
          <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
        </svg>
        <span class="sp4646">Gerer les commandes</span>
        <a class="fleshes"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
        </svg></a>
</a>
      </li>
      <li class="li-colis">
        <a href="admin-livreurs.php">
        <div style="width: 100%;height: 30px;"></div>
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-square" viewBox="0 0 16 16" style="margin-left:15px">
        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
  <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1v-1c0-1-1-4-6-4s-6 3-6 4v1a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12z"/>
        </svg>
        
        <span class="sp4646">Gerer les livreurs </span>
        <a class="fleshes"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
        </svg></a>
      </a>
      </li>
      </ul>
   
    </div>
  </div>
  <!-- <div id="d79547">
    <span class="panel-bar"></span>
  
  </div>
  -->
</body>
</html>