<?php
require_once("views/View.inc.php");

class SurveysView extends View {

	/**
	 * Affiche la liste des sondages présents dans le modèle passé en paramètre.
	 * 
	 * Le modèle passé en paramètre est une instance de la classe 'SurveysModel'.
	 *
	 * @see View::displayBody()
	 */
	public function displayBody($model) {

		if (count($model->getSurveys())===0) {
			echo "Aucun sondage ne correspond à votre recherche.";
			return;
		}

		foreach ($model->getSurveys() as $survey) {
			$survey->computePercentages();
			require("templates/survey.inc.php");
		}
	}

}
?>
