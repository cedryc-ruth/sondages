<?php

require_once("models/SurveysModel.inc.php");
require_once("actions/Action.inc.php");

class SearchAction extends Action {

	/**
	 * Construit la liste des sondages dont la question contient le mot clé
	 * contenu dans la variable $_POST["keyword"]. Cette liste est stockée dans un modèle
	 * de type "SurveysModel". L'utilisateur est ensuite dirigé vers la vue "ServeysView"
	 * permettant d'afficher les sondages.
	 *
	 * Si la variable $_POST["keyword"] est "vide", le message "Vous devez entrer un mot clé
	 * avant de lancer la recherche." est affiché à l'utilisateur.
	 *
	 * @see Action::run()
	 */
	public function run() {
		$keyword = $_POST['keyword'];

		if(empty($keyword)) {
		    $this->setModel(new MessageModel());
		    $this->getModel()->setMessage("Vous devez remplir le champ!");
		    $this->setView(getViewByName("Message"));
		} else {
    		//Traitement de la recherche
    		//Mocking des données
		    $surveys = [
    		    new Survey('Bob', 'Quel est ton nom?'),
    		    new Survey('Fred', 'Quel est ton âge?'),
    		];
    		
		    $this->setModel(new SurveysModel());
		    $this->getModel()->setSurveys($surveys);
		    $this->setView(getViewByName("Surveys"));
		}
	}

}

?>
