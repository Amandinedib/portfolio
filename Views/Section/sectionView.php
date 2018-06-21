<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="./assets/css/sectionStyle.css">
</head>
<body>
	<div class="bloc_section">
		<?php 
		foreach ($sections as $section) {
			echo'<span class="titreSection">'. $section->getTitle() .'</span>';
			echo '<p>'.$section->getMain().'</p>';
		}
		?>
	</div>
</body>
</html>
