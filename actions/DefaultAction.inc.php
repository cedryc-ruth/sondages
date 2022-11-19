<?php
namespace App\Actions;

use App\Models\Model;

class DefaultAction extends Action {

	/**
	 * Traite l'action par défaut. 
	 * Elle dirige l'utilisateur vers une page avec un contenu vide.
	 *
	 * @see Action::run()
	 */
	public function run() {
	    $model = new Model();
	    $view = getViewByName("Default");
	    
		$this->setModel($model);
		$model->setLogin($this->getSessionLogin());
		$this->setView($view);
	}

}
?>
