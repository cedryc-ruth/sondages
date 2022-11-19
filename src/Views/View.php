<?php
namespace App\Views;

abstract class View {

	/**
	 * Génère la page à afficher au client en utilisant
	 * le modèle passé en paramètre.
	 *
	 * @param Model $model Modèle à utiliser lors de l'affichage.
	 */
	public function run($model) {
		$login = $model->getLogin();
		require("templates/page.inc.php");
	}

	/**
	 * Génère le formulaire de connexion.
	 *
	 * @param Model $model Modèle à utiliser lors de l'affichage.
	 */
	private function displayLoginForm($model) {
		require("templates/loginform.inc.php");
	}

	/**
	 * Génère le formulaire de déconnexion.
	 *
	 * @param Model $model Modèle à utiliser lors de l'affichage.
	 */
	private function displayLogoutForm($model) {
		require("templates/logoutform.inc.php");
	}

	/**
	 * Génère une liste de commandes proposées à un utilisateur authentifié.
	 *
	 * @param Model $model Modèle à utiliser lors de l'affichage.
	 */
	private function displayCommands($model) {
		require("templates/commands.inc.php");
	}

	/**
	 * Génère le formulaire de recherche.
	 *
	 * @param Model $model Modèle à utiliser lors de l'affichage.
	 */
	private function displaySearchForm($model) {
		require("templates/searchform.inc.php");
	}

	/**
	 * Affiche le corps de la page. Cette méthode doit être
	 * implémentée par les différentes vues.
	 *
	 * @param Model $model Modèle à utiliser lors de l'affichage.
	 */
	protected abstract function displayBody($model);

}
