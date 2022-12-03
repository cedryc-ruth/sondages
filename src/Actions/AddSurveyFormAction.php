<?php
namespace App\Actions;

use App\Models\MessageModel;
use App\Views\AddSurveyFormView;

class AddSurveyFormAction extends Action {

	/**
	 * Dirige l'utilisateur vers le formulaire d'ajout de sondage.
	 *
	 * @see Action::run()
	 */	
	public function run() {
		
		if ($this->getSessionLogin()===null) {
			$this->setMessageView("Vous devez être authentifié.");
			return;
		}
		
		$this->setModel(new MessageModel());
		$this->getModel()->setLogin($this->getSessionLogin());
		$this->setView(new AddSurveyFormView());
	}

}

?>
