<!DOCTYPE html>
<html>
<head>
  <title></title>
  <!-- <script type="text/javascript" src="./assets/javascript/header.js"></script> -->
  <link rel="stylesheet" type="text/css" href="./assets/css/headerLayout.css">
</head>
<body>
<!-- Layout commun à tous les headers -->
<header>
  <div class="utilisateurBloc">
    <?php 
    //Possibilité de se connecter pour l'admin s'il n'y a pas de session active
    if(empty($_SESSION['portfolio'])){ 
        echo '<p>';
            echo '<a href="index.php?controller=utilisateur&action=AfficherConnexion">Se connecter</a>';
        echo '</p>';
     }
     //Si utilisateur de connecté, on affiche son pseudo, un bouton pour acceder au back office et le bouton "se déconnecter"
     else{
        echo '<p class="msgBienvenue">Bienvenue '.$_SESSION['portfolio']['utilisateur']['u_pseudo'].' !</p>';
        echo '<a href="index.php?controller=backoffice&action=afficherBackOffice" id="backOfficeButton" class="backOfficeLink">Back Office</a>';
        echo "<br>";
        echo '<a href="index.php?controller=accueil&action=deconnexion" class="buttonDeco">Se deconnecter</a>';
     }
     ?>
   </div>
     <!-- Logo du site -->
    <div class="bloc_logo">
        <img class="logoSite" src="./assets/images/4044.jpg">
    </div>
    <div class="bloc_portfolio">
        <h1>Portfolio de photographe</h1>
    </div>

    <!--Menu qui permet de naviquer sur le site-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light" id="menu">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="index.php?controller=accueil&action=afficherAccueil" id="buttonHome">Home<span class="sr-only">Home</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php?controller=photo&action=afficherPhotoPage" id="buttonPhotos">Photos</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php?controller=section&action=afficherSectionPublic" id="buttonAPropos">A propos</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php?controller=contact&action=afficherContact" id="buttonContact">Contact</a>
      </li>
    </ul>
  </div>
</nav>
</header>
</body>
</html>
