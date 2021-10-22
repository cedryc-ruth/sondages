<?php
if ($model->getMessage()!=="") {
	echo '<div class="message">'.$model->getMessage().'</div>';
}
?>
<br />

<form class="form" method="post" action="index.php?action=UpdateUser" >
				<label> Pseudo : </label><div class="field fixed"><?php echo $model->getLogin(); ?></div><br>
				<label for="updatePassword"> Mot de passe : </label>
				<input class="field" name="updatePassword" type="password" /><br>
				<label for="updatePassword2">Confirmation : </label>
				<input class="field" name="updatePassword2" type="password" /><br>
				<input class="submit" type="submit" value="Changer le mot de passe" />
</form>
