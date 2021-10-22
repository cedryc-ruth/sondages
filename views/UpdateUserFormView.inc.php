<?	
require_once("views/View.inc.php");

class UpdateUserFormView extends View {

	/**
	 * Affiche le formulaire de modification de mot de passe.
	 * 
	 * Le modèle passé en paramètre est une instance de la classe 'MessageModel'.
	 * 
	 * @see View::displayBody()
	 */
	public function displayBody($model) {
		require("templates/updateuserform.inc.php");
	}

}
?>

