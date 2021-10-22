
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	Chercher un sondage sur...<br> <br>
	<input name="keyword" class="field" type="text" />
	<input class="submit" type="submit" value="Chercher" />
	<input type="hidden" name="action" value="Search">
</form>
<br />

<?php if ($model->getLogin()===null) { ?>
<div class="message">
Vous souhaitez poster des sondages :
<a href="<?php echo $_SERVER['PHP_SELF'].'?action=SignUpForm';?>">inscrivez-vous</a>
!</div>
<?php } ?>

