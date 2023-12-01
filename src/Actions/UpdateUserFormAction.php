<?php
namespace App\Actions;

use App\Models\MessageModel;
use App\Views\MessageView;
use App\Views\UpdateUserFormView;

class UpdateUserFormAction extends Action {

	/**
	 * Dirige l'utilisateur vers le formulaire de modification de mot de passe.
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
		$this->setView(new UpdateUserFormView());
	}

}
?>
