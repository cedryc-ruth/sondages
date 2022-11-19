<form method="post" action="<?= $_SERVER['PHP_SELF']; ?>?action=Logout" >
	<div class="nickname"><?= $model->getLogin(); ?></div> 
	<input class="submit" type="submit" value="Déconnexion" />
</form>
