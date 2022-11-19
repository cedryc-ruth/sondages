<?php
 if ($model->getMessage()!=="") {
	echo '<div class="message">'.$model->getMessage().'</div>';
}
?>
<form method="post" action="index.php?action=SignUp" class="form">
				<label for="inscriptionLogin">Pseudo : </label>
				<input class="field" name="signUpLogin" type="text"/><br>
				<label for="signUpPassword"> Mot de passe : </label>
				<input class="field" name="signUpPassword" type="password" /><br>
				<label for="signUpPassword2"> Confirmation : </label>
				<input class="field" name="signUpPassword2" type="password" /><br>
				<input class="submit" type="submit" value="Créer mon compte" />
</form>
