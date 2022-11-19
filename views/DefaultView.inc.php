<?php
namespace App\Views;

class DefaultView extends View {
	
	/**
	 * Affiche une page sans contenu.
	 *
	 * Le modèle passé en paramètre est une instance de la classe 'Model'.
	 *
	 * @see View::displayBody()
	 */
	protected function displayBody($model) { echo "Coucou !"; }

}
?>

