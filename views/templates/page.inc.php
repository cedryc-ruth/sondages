<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Site de gestion de sondages</title>
<meta name="Description" content="Site de gestion de sondages" />
<link rel="stylesheet" type="text/css" href="style.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<?php $login = $model->getLogin(); ?>

<body>

	<div class="header">
		<div class="title">Site de sondages</div>
		<div class="loginForm">
			<?php 
			if ($login===null) $this->displayLoginForm($model);
			else $this->displayLogoutForm($model);
			?>
		</div>
	</div>

	<div class="commands">
		<?php if ($login!=null)  $this->displayCommands($model); ?>
	</div>

	<div class="searchForm">
		<?php $this->displaySearchForm($model); ?>
	</div>

	<div class="content">
		<?php $this->displayBody($model); ?>
	</div>

	<div class="footbar">
		Sujet de TP de l'UE "Web Côté Serveur"
	</div>

</body>
</html>
