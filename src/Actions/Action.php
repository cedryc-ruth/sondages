<?php
namespace App\Actions;

use App\Models\Database;
use App\Views\MessageView;

abstract class Action {
	private $view;
	private $model;
	protected $database;

	/**
	 * Construit une instance de la classe Action.
	 */
	public function __construct(){
		$this->view = null;
		$this->model = null;
		$this->database = new Database();
	}

	/**
	 * Fixe la vue qui doit être affichée par le contrôleur.
	 *
	 * @param View $view Vue qui doit être affichée par le contrôleur.
	 */
	protected function setView($view) {
		$this->view = $view;
	}

	/**
	 * Fixe le modèle à fournir à la vue lors de son affichage.
	 *
	 * @param Model $model Modèle à fournir à la vue.
	 */
	protected function setModel($model) {
		$this->model = $model;
	}

	/**
	 * Récupére la pseudonyme de l'utilisateur s'il est connecté, ou null sinon.
	 *
	 * @return string Pseudonyme de l'utilisateur ou null.
	 */
	protected function getSessionLogin() {
		if (isset($_SESSION['login'])) {
			$login = $_SESSION['login'];
		} else $login = null;
		return $login;
	}

	/**
	 * Sauvegarde le pseudonyme de l'utilisateur dans la session.
	 *
	 * @param string $login Pseudonyme de l'utilisateur.
	 */
	protected function setSessionLogin($login) {
		$_SESSION['login'] = $login;
	}

	/**
	 * Fixe de modèle et la vue de façon à afficher un message à l'utilisateur.
	 * 
	 * @param string $message Message à afficher à l'utilisateur.
	 */
	protected function setMessageView($message) {
		$this->setModel(new MessageModel());
		$this->getModel()->setMessage($message);
		$this->getModel()->setLogin($this->getSessionLogin());
		$this->setView(new MessageView());
	}

	/**
	 * Retourne la vue qui doit être affichée par le contrôleur.
	 * 
	 * @return View Vue qui doit être affichée par le contrôleur.
	 */
	public function getView() {
		return $this->view;
	}

	/**
	 * Retourne le modèle qui doit être donnée à la vue par le contrôleur.
	 *
	 * @return Model Modèle à fournir à la vue.
	 */
	public function getModel() {
		return $this->model;
	}

	/**
	 * Méthode qui doit être implémentée par chaque action afin de décrire
	 * son comportement.
	 */
	abstract public function run();
}
?>
