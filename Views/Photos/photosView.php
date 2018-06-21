<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="./assets/css/photoStyle.css">
</head>
<body>
	<div class="bloc_photo">
		<?php
		foreach ($mesphotos as $photo) {
			echo'<div class="card" style="width: 18rem;display:inline-block;margin:15px;">';
		 	echo' <img class="card-img-top" src="'.$photo->getUrl().'" alt="Card image cap">';
		 	 echo'<div class="card-body">';
		    echo'<span class="card-text">'. $photo->getTitle() . '</span>';
		    echo'<p class="card-text">'. $photo->getDescription() . '</p>';
		  	echo'</div>';
			echo'</div>';
		}
		?>
	</div>
</body>
</html>
