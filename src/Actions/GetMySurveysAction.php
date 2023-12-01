<?php
namespace App\Actions;

use App\Models\SurveysModel;
use App\Views\SurveysView;

class GetMySurveysAction extends Action {

	/**
	 * Construit la liste des sondages de l'utilisateur dans un modèle
	 * de type "SurveysModel" et le dirige vers la vue "SurveysView" 
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

		$tabSurveys = $this->database->loadSurveysByOwner($this->getSessionLogin());
        if($tabSurveys!==false) {
            $this->setModel(new SurveysModel());
            $this->getModel()->setSurveys($tabSurveys);
            $this->getModel()->setLogin($this->getSessionLogin());
            $this->setView(new SurveysView());
        } else {
            $this->setMessageView('Une erreur s\'est produite sur le serveur. Veuillez contacter l\'administrateur.');
        }
	}

}

?>
