<!-- Gabarit commun à toutes les Views, chacune des Views a un titre propre (variable $titre) et un contenu propre (variable $contenu). Les variables $header et $footer sont automatiquement générées -->
<!DOCTYPE html>
<html>
<head>
	<title><?= $titre ?></title>
	<meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="./assets/css/commonLayoutStyle.css">
    <script src="./assets/javascript/jquery-3.3.1.js"></script>
    <script src="./assets/javascript/jquery.validate.min.js"></script>


    <link href="./assets/bootstrap/css/bootstrap.css" rel="stylesheet">
    <script src="./assets/bootstrap/js/jquery-3.3.1.js"></script>
    <script src="./assets/bootstrap/js/bootstrap.min.js"></script>

    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>


</head>
<body>
    <div id="content">
        <!-- correspond au header commun à toutes les pages-->
        <div class="header">
            <?= $header ?>
        </div>
        <hr />
    	<div class="corps">
    		<?= $contenu ?>
    	</div>
        <!-- correspond au footer commun à toutes les pages -->
        <div class="footer">
            <?= $footer ?>
        </div>
    </div>
</body>
</html>