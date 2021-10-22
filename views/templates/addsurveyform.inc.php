<?php 

function generateInputForResponse($n) {
	?>
<label for="responseSurvey<?php echo $n; ?>"> Réponse <?php echo $n; ?> :
</label>
<input
	name="responseSurvey<?php echo $n; ?>" class="field" type="text" />
<br>
<?php
}

if ($model->getMessage()!=="") {
	echo '<div class="message">'.$model->getMessage().'</div>';
}
?>

<form class="form" method="post" action="index.php?action=AddSurvey" >
		<label for="questionSurvey">Question : </label> <input
			name="questionSurvey" class="field"
			type="text" /><br>
		<?php 
		for ($i = 1; $i <= 5; $i++)
			generateInputForResponse($i);
		?>
		<input class="submit" type="submit"	value="Poster le sondage" /><br>
</form>



