<?php
namespace App\Actions;

use App\Models\Model;
use App\Views\DefaultView;

class DefaultAction extends Action {

	/**
	 * Traite l'action par défaut. 
	 * Elle dirige l'utilisateur vers une page avec un contenu vide.
	 *
	 * @see Action::run()
	 */
	public function run() {
	    $model = new Model();
	    $view = new DefaultView();
	    
		$this->setModel($model);
		$model->setLogin($this->getSessionLogin());
		$this->setView($view);
	}

}
?>
