<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>?action=Login" >
	<label class="label" for="nickname">Pseudo : </label>
	<input class="field"  name="nickname" type="text" /><br>
	<label class="label" for="password">Mot de passe : </label>
	<input class="field"  name="password"	type="password" /><br>
	<div class="error"><?= $model->getLoginError() ?? "" ?></div>
	<input class="submit" name="connexionConnexion" class="sondageLoginTextField"
		type="submit" value="Connexion" />
</form>
