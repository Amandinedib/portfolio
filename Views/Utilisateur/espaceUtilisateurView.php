<!DOCTYPE html>
<html>
<head>
<!-- <link rel="stylesheet" type="text/css" href="./assets/css/boModificationFormStyle.css"> -->
<script type="text/javascript" src="./assets/javascript/espaceUtilisateur.js"></script>
<style type="text/css">
.container{ 
    position: relative;
    display: block;
    width: 100%;
    height: 500px;
    top:30px;
    margin-bottom: 5%;
    padding:3%;
}
.content{
  width: 50%;
  display: inline-block;
  margin-left: auto;
  margin-right: auto;
  border: 1px solid green;
}
.content h1{
    text-align: center;
}
.nav{
    float:left;
    margin: 20px;
    width: 15%;
    height: 300px;
    border: 1px solid yellow;
}
.nav li{
    padding: 14%;
    text-align: center;
}
.nav ul{
    padding: 0;
    margin: 0;
}
.pop{
    display: block;
     margin-left: auto;
     margin-right: auto;
    text-align: center;
    border: 1px solid red;
    padding: 10%;
}
.pop label{
    color:red;
}
</style>
</head>
<body>
    <?php 
    var_dump($_SESSION);
    ?>
    <div class="container">
        <div class="nav">
            <ul id="menu">
                <li id="link1"><a href="#">Topic One</a></li>
                <li id="link2"><a href="#">Topic Two</a></li>
                <li id="link3"><a href="#">Topic Three</a></li>               
            </ul>
        </div>
        <div class="main">
            <div id="page1" class="content">
                <h1>Information utilisateur</h1>
                    <?php
                    foreach ($utilisateurs as $key => $value) {
                    ?>
                <div class="pop">
                    <form action="index.php?controller=utilisateur&action=afficherInfoUtilisateur" method="POST">
                    <label>Prenom</label>
                    <input type="text" name="prenom" value=""<?php echo $value->getNom();?>"">
                    <label>Nom</label>
                    <input type="text" name="nom" value="ProutProut">
                    <label>Pseudo</label>
                    <input type="text" name="pseudo" value="Pseudo">
                    <br />
                    <label>E-mail</label>
                    <input type="mail" name="mail" value="bla.dib@live.fr">
                    <br />
                    <label>Ancien mot de passe</label>
                    <input type="password" name="ancienMdp">
                                    <br/>
                    <label>Nouveau mot de passe</label>
                    <input type="password" name="nouveauMdp">
                    <br />
                    <input type="submit" name="validerChange" value="Modifier">
                </form>
                </div>
            </div>
            <div id="page2" class="content">
                <div class="pop">
                <h1>Page 2</h1>        
                <p>Second section of content</p>
            </div>
            </div>
            <div id="page3" class="content">        
                <h1>Page 3</h1>
                <p>Third section of content.</p>
            </div>  
            <?php
            }
            ?>               
        </div>
    </div>
</body>
</html>
