<?php
require_once("views/View.inc.php");

class AddSurveyFormView extends View {

	/**
	 * Affiche le formulaire d'ajout de sondage.
	 *
	 * Le modèle passé en paramètre est une instance de la classe 'MessageModel'.
	 *
	 * @see View::displayBody()
	 */
	public function displayBody($model) {
		require("templates/addsurveyform.inc.php");
	}

}
?>


