<?php
namespace App\Actions;

use App\Models\MessageModel;
use App\Views\MessageView;
use App\Views\SignUpFormView;

class SignUpAction extends Action {

	/**
	 * Traite les données envoyées par le formulaire d'inscription
	 * ($_POST['signUpLogin'], $_POST['signUpPassword'], $_POST['signUpPassword2']).
	 *
	 * Le compte est crée à l'aide de la méthode 'addUser' de la classe Database.
	 *
	 * Si la fonction 'addUser' retourne une erreur ou si le mot de passe et sa confirmation
	 * sont différents, on envoie l'utilisateur vers la vue 'SignUpForm' avec une instance
	 * de la classe 'MessageModel' contenant le message retourné par 'addUser' ou la chaîne
	 * "Le mot de passe et sa confirmation sont différents.";
	 *
	 * Si l'inscription est validée, le visiteur est envoyé vers la vue 'MessageView' avec
	 * un message confirmant son inscription.
	 *
	 * @see Action::run()
	 */
	public function run() {
		$login = $_POST['signUpLogin'];
		$password = $_POST['signUpPassword'];
		$confPass = $_POST['signUpPassword2'];

		if($password!=$confPass) {
			$this->createSignUpFormView("Le mot de passe et sa confirmation sont différents.");
			return;
		}
		
		$result = $this->database->addUSer($login, $password);
	
		if(is_string($result)) {
			$this->createSignUpFormView($result);
			return;
		}

		if($result===false) {
			$this->createSignUpFormView("Une erreur d'insertion est survenue dans la base de données.");
			return;
		}

		$this->setModel(new MessageModel());
		$this->getModel()->setMessage("Inscription réussie.");
		$this->getModel()->setLogin($this->getSessionLogin());
		$this->setView(new MessageView());
	}

	private function createSignUpFormView($message) {
		$this->setModel(new MessageModel());
		$this->getModel()->setMessage($message);
		$this->getModel()->setLogin($this->getSessionLogin());
		$this->setView(new SignUpFormView());
	}

}


?>
