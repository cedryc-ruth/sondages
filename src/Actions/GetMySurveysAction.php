<?php

require_once("models/SurveysModel.inc.php");
require_once("actions/Action.inc.php");

class GetMySurveysAction extends Action {

	/**
	 * Construit la liste des sondages de l'utilisateur dans un modèle
	 * de type "SurveysModel" et le dirige vers la vue "ServeysView" 
	 * permettant d'afficher les sondages.
	 *
	 * Si l'utilisateur n'est pas connecté, un message lui demandant de se connecter est affiché.
	 *
	 * @see Action::run()
	 */
	public function run() {

		if ($this->getSessionLogin()===null) {
			$this->setMessageView("Vous devez être authentifié.");
			return;
		}

		/* TODO  */
	}

}

?>
