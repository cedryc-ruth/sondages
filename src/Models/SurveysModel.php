<?php
require_once("models/Model.inc.php");

class SurveysModel extends Model {

	/**
	 * @var Array(Survey) Tableau de sondages à afficher.
	 */
	private $surveys;

	/**
	 * Construit une instance de la classe 'SurveysModel'.
	 * Initialise la variable $surveys à 'null'.
	 */
	public function __construct() {
		$this->surveys = null;
	}

	/**
	 * Retourne le tableau de sondages stocké dans le modèle.
	 *
	 * @return Array(Survey) Tableau de sondages stocké dans le modèle.
	 */
	public function getSurveys() {
		return $this->surveys;
	}	
	
	/** 
	 * Affecte un tableau de sondages à la variable $$surveys.
	 * 
	 * @param Array(Survey) $surveys Tableau de sondages à affecter.
	 */
	public function setSurveys($surveys) {
		$this->surveys = $surveys;
	}

}
?>