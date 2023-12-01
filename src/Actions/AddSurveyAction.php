<?php
namespace App\Actions;

use App\Models\MessageModel;
use App\Models\Survey;
use App\Models\Response;
use App\Views\AddSurveyFormView;

class AddSurveyAction extends Action {

	/**
	 * Traite les données envoyées par le formulaire d'ajout de sondage.
	 *
	 * Si l'utilisateur n'est pas connecté, un message lui demandant de se connecter est affiché.
	 *
	 * Sinon, la fonction ajoute le sondage à la base de données. Elle transforme
	 * les réponses et la question à l'aide de la fonction PHP 'htmlentities' pour éviter
	 * que du code exécutable ne soit inséré dans la base de données et affiché par la suite.
	 *
	 * Un des messages suivants doivent être affichés à l'utilisateur :
	 * - "La question est obligatoire.";
	 * - "Il faut saisir au moins 2 réponses.";
	 * - "Merci, nous avons ajouté votre sondage.".
	 *
	 * Le visiteur est finalement envoyé vers le formulaire d'ajout de sondage pour lui
	 * permettre d'ajouter un nouveau sondage s'il le désire.
	 * 
	 * @see Action::run()
	 */
	public function run() {
		if ($this->getSessionLogin()===null) {
            $this->setMessageView("Vous devez être authentifié.");
            return;
        }
        
        if(!empty($_POST['questionSurvey'])) {
            $question = htmlentities($_POST['questionSurvey']);
            
            $tabReponses = array();
            for($i=1;$i<=5;$i++) {
                if(!empty($_POST['responseSurvey'.$i])) {
                    $tabReponses[] = htmlentities($_POST['responseSurvey'.$i]);
                }
            }
            
            if(sizeof($tabReponses)>=2) {
                $survey = new Survey($this->getSessionLogin(),$question);
                
                foreach($tabReponses as $title) {
                    $response = new Response($survey,$title);
                    $survey->addResponse($response);
                }
                
                if($this->database->saveSurvey($survey)) {
                    $this->createAddSurveyFormView('Merci, nous avons ajouté votre sondage.');
                } else {
                    $this->createAddSurveyFormView('Une erreur est survenue sur le serveur. Veuillez contacter l\'administrateur.');               
                }
            } else {
                $this->createAddSurveyFormView('Il faut saisir au moins 2 réponses.');
            }
        } else {
            $this->createAddSurveyFormView('La question est obligatoire.');
        }
	}

	private function createAddSurveyFormView($message) {
        $this->setModel(new MessageModel());
        $this->getModel()->setMessage($message);
        $this->getModel()->setLogin($this->getSessionLogin());
        $this->setView(new AddSurveyFormView());
    }

}

?>
