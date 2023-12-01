<?php
namespace App\Actions;

use App\Models\MessageModel;
use App\Views\MessageView;
use App\Views\UpdateUserFormView;

class UpdateUserAction extends Action {

	/**
	 * Met à jour le mot de passe de l'utilisateur en procédant de la façon suivante :
	 *
	 * Si toutes les données du formulaire de modification de profil ont été postées
	 * ($_POST['updatePassword'] et $_POST['updatePassword2']), on vérifie que
	 * le mot de passe et la confirmation sont identiques.
	 * S'ils le sont, on modifie le compte avec les méthodes de la classe 'Database'.
	 *
	 * Si une erreur se produit, le formulaire de modification de mot de passe
	 * est affiché à nouveau avec un message d'erreur.
	 *
	 * Si aucune erreur n'est détectée, le message 'Modification enregistrée.'
	 * est affiché à l'utilisateur.
	 *
	 * @see Action::run()
	 */
	public function run() {
		if(!empty($_POST['updatePassword']) && !empty($_POST['updatePassword2'])) {
            if($_POST['updatePassword']==$_POST['updatePassword2']) {
                $nickname = $this->getSessionLogin();
                $password = $_POST['updatePassword'];
                $dbResult = $this->database->updateUser($nickname,$password);
                
                if($dbResult===true) {
                    $this->setMessageView('Modification enregistrée.');
                } else {
                    $this->createUpdateUserFormView($dbResult);
                }
            } else {
                $this->createUpdateUserFormView('Les mots de passe doivent être identiques!');
            }
        } else {
            $this->createUpdateUserFormView('Veuillez remplir tous les champs, svp.');
        }
	}

	private function createUpdateUserFormView($message) {
		$this->setModel(new MessageModel());
		$this->getModel()->setMessage($message);
		$this->getModel()->setLogin($this->getSessionLogin());
		$this->setView(new UpdateUserFormView());
	}

}

?>
