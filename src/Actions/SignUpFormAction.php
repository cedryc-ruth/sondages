<?php
namespace App\Actions;

use App\Models\MessageModel;
use App\Views\MessageView;
use App\Views\SignUpFormView;

class SignUpFormAction extends Action {

	/**
	 * Dirige l'utilisateur vers le formulaire d'inscription.
	 *
	 * @see Action::run()
	 */	
	public function run() {
		$this->setModel(new MessageModel());
		$this->getModel()->setLogin($this->getSessionLogin());
		$this->setView(new SignUpFormView());
	}

}

?>
