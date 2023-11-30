<?php
namespace App\Models;

require 'libraries/rb-sqlite.php';

use R;

class Database {

	private $connection;

	/**
	 * Ouvre la base de données. Si la base n'existe pas elle
	 * est créée à l'aide de la méthode createDataBase().
	 */
	public function __construct() {
		R::setup("sqlite:database.sqlite");

		$this->connection = true;

		if (!$this->connection) die("impossible d'ouvrir la base de données");

		$rows = R::getAll('SELECT name FROM sqlite_master WHERE type="table"');

		if (count($rows)==0) {
			$this->createDataBase();
		}
	}


	/**
	 * Crée la base de données ouverte dans la variable $connection.
	 * Elle contient trois tables :
	 * - une table users(nickname char(20), password char(50));
	 * - une table surveys(id integer primary key autoincrement,
	 *						owner char(20), question char(255));
	 * - une table responses(id integer primary key autoincrement,
	 *		id_survey integer,
	 *		title char(255),
	 *		count integer);
	 */
	private function createDataBase() {
		R::exec( 'CREATE TABLE users(nickname char(20), password char(50));' );
		R::exec( 'CREATE TABLE surveys(id integer primary key autoincrement, 
			owner char(20), question char(255));' );
		R::exec( 'CREATE TABLE responses(id integer primary key autoincrement,
				id_survey integer,
				title char(255),
				count integer);');

		$rows = R::getAll('SELECT name FROM sqlite_master WHERE type="table"');

		if (count($rows)==0) {
			die("Impossible de créer les tables dans la base de données !");
		}
	}

	/**
	 * Vérifie si un pseudonyme est valide, c'est-à-dire,
	 * s'il contient entre 3 et 10 caractères et uniquement des lettres.
	 *
	 * @param string $nickname Pseudonyme à vérifier.
	 * @return boolean True si le pseudonyme est valide, false sinon.
	 */
	private function checkNicknameValidity($nickname) {
		return preg_match('/^[a-zA-Z]{3,10}$/',$nickname);
	}

	/**
	 * Vérifie si un mot de passe est valide, c'est-à-dire,
	 * s'il contient entre 3 et 10 caractères.
	 *
	 * @param string $password Mot de passe à vérifier.
	 * @return boolean True si le mot de passe est valide, false sinon.
	 */
	private function checkPasswordValidity($password) {
		return preg_match('/^\S{3,10}$/',$password);
	}

	/**
	 * Vérifie la disponibilité d'un pseudonyme.
	 *
	 * @param string $nickname Pseudonyme à vérifier.
	 * @return boolean True si le pseudonyme est disponible, false sinon.
	 */
	private function checkNicknameAvailability($nickname) {
		$user = R::findOne( 'users', ' nickname=?', [ $nickname ] );	//Requête préparée

		return empty($user);
	}

	/**
	 * Vérifie qu'un couple (pseudonyme, mot de passe) est correct.
	 *
	 * @param string $nickname Pseudonyme.
	 * @param string $password Mot de passe.
	 * @return boolean True si le couple est correct, false sinon.
	 */
	public function checkPassword($nickname, $password) {
		$user = R::findOne( 'users', ' nickname=?', [ $nickname ] );	//Requête préparée

		if(!empty($user) && password_verify($password, $user->password)) {
			return true;
		}

		return false;
	}

	/**
	 * Ajoute un nouveau compte utilisateur si le pseudonyme est valide et disponible et
	 * si le mot de passe est valide. La méthode peut retourner un des messages d'erreur qui suivent :
	 * - "Le pseudo doit contenir entre 3 et 10 lettres.";
	 * - "Le mot de passe doit contenir entre 3 et 10 caractères.";
	 * - "Le pseudo existe déjà.".
	 *
	 * @param string $nickname Pseudonyme.
	 * @param string $password Mot de passe.
	 * @return boolean|string True si le couple a été ajouté avec succès, un message d'erreur sinon.
	 */
	public function addUser($nickname, $password) {
		//Validation des données utilisateur
		if(!$this->checkNicknameValidity($nickname)) {
			return "Le pseudo doit contenir entre 3 et 10 lettres.";
		}

		if(!$this->checkNicknameAvailability($nickname)) {
			return "Le pseudo existe déjà.";
		}
				
		if(!$this->checkPasswordValidity($password)) {
			return "Le mot de passe doit contenir entre 3 et 10 caractères.";
		}

		//Ajout de l'utilisateur
		$user = R::dispense('users');
		$user->nickname = $nickname;
		$user->password = password_hash($password,PASSWORD_BCRYPT);

		$id = R::store($user);

		return $id ? true : false;
	}

	/**
	 * Change le mot de passe d'un utilisateur.
	 * La fonction vérifie si le mot de passe est valide. S'il ne l'est pas,
	 * la fonction retourne le texte 'Le mot de passe doit contenir entre 3 et 10 caractères.'.
	 * Sinon, le mot de passe est modifié en base de données et la fonction retourne true.
	 *
	 * @param string $nickname Pseudonyme de l'utilisateur.
	 * @param string $password Nouveau mot de passe.
	 * @return boolean|string True si le mot de passe a été modifié, un message d'erreur sinon.
	 */
	public function updateUser($nickname, $password) {
		//Validation des données utilisateur
		if(!$this->checkPasswordValidity($password)) {
			return "Le mot de passe doit contenir entre 3 et 10 caractères.";
		}

		$user = R::findOne( 'users', ' nickname=?', [ $nickname ] );

		if(empty($user)) {
			return "Cet utilisateur n'existe pas.";
		}

		//Mise à jour de l'utilisateur
		$user->password = $password;
		R::store($user);
		
		return true;
	}

	/**
	 * Sauvegarde un sondage dans la base de donnée et met à jour les indentifiants
	 * du sondage et des réponses.
	 *
	 * @param Survey $survey Sondage à sauvegarder.
	 * @return boolean True si la sauvegarde a été réalisée avec succès, false sinon.
	 */
	public function saveSurvey(&$survey) {
		R::begin();
		try{
			R::store( $survey );

			try {

			} catch( Exception $e ) {
				R::rollback();
			}

			R::commit();
		} catch( Exception $e ) {
			R::rollback();
		}
		$user = R::findOne( 'users', ' nickname=?', [ $nickname ] );
            $query = $this->connection->prepare("INSERT INTO surveys(owner,question) VALUES (?,?)");

            $r = $query->execute(array($survey->getOwner(), $survey->getQuestion()));
            if ($r === false) {
                $this->connection->rollback();
                return false;
            }
            
            $id = $this->connection->lastInsertId();
            $survey->setId($id);
            $responses = $survey->getResponses();
            
            foreach ($responses as &$response) {
                if ($this->saveResponse($response)===false) {
                    $this->connection->rollback();
                    return false;
                }
            }
            
            $this->connection->commit();
            return true;
	}

	/**
	 * Sauvegarde une réponse dans la base de donnée et met à jour son indentifiant.
	 *
	 * @param Survey $response Réponse à sauvegarder.
	 * @return boolean True si la sauvegarde a été réalisée avec succès, false sinon.
	 */
	private function saveResponse(&$response) {
		$query = $this->connection->prepare("INSERT INTO responses(id_survey, title, count) 
                                                    VALUES(:id_survey, :title, :count)");
            if ($query!==false) {
                $r = $query->execute( array(
                            'id_survey' => $response->getSurvey()->getId(),
                            'title' => $response->getTitle(),
                            'count'=> $response->getCount() ));
                
                if($r!==false) {
                    $id = $this->connection->lastInsertId();
                    $response->setId($id);

                    return true;
                }
            }
            return false;
	}

	/**
	 * Charge l'ensemble des sondages créés par un utilisateur.
	 *
	 * @param string $owner Pseudonyme de l'utilisateur.
	 * @return array(Survey)|boolean Sondages trouvés par la fonction ou false si une erreur s'est produite.
	 */
	public function loadSurveysByOwner($owner) {
		$surveys = R::find( 'surveys', 'owner = ? ', [ $owner ] );

		return $surveys;
		//Pas de gestion d'erreur
	}

	/**
	 * Charge l'ensemble des sondages dont la question contient un mot clé.
	 *
	 * @param string $keyword Mot clé à chercher.
	 * @return array(Survey)|boolean Sondages trouvés par la fonction ou false si une erreur s'est produite.
	 */
	public function loadSurveysByKeyword($keyword) {
		$surveys = R::find( 'surveys', 'title LIKE ? ', [ "%$keyword%" ] );

		return $surveys;
		//Pas de gestion d'erreur
	}


	/**
	 * Enregistre le vote d'un utilisateur pour la réponse d'indentifiant $id.
	 *
	 * @param int $id Identifiant de la réponse.
	 * @return boolean True si le vote a été enregistré, false sinon.
	 */
	public function vote($id) {
		$response = R::findOne( 'responses', 'id=?', [ $id ] );

		if(!empty($response)) {
			$response->count++;
			R::store($response);

			return true;
		}

		return false;
	}

	/**
	 * Construit un tableau de sondages à partir d'un tableau de ligne de la table 'surveys'.
	 * Ce tableau a été obtenu à l'aide de la méthode fetchAll() de PDO.
	 *
	 * @param array $arraySurveys Tableau de lignes.
	 * @return array(Survey)|boolean Le tableau de sondages ou false si une erreur s'est produite.
	 */
	private function loadSurveys($arraySurveys) {
		$surveys = array();
		
		foreach($arraySurveys as $row) {
			//Dénormaliser le sondage
			$s = new Survey($row['title'],$row['owner']);
			$s->setId($row['id']);

			//Récupérer les réponses
			$responses = R::find( 'responses', 'survey_id = ? ', [ $row['id'] ] );
			$this->loadResponses($s, $responses);

			$surveys[] = $s;
		}

		return $surveys;
	}

	/**
	 * Construit un tableau de réponses à partir d'un tableau de ligne de la table 'responses'.
	 * Ce tableau a été obtenu à l'aide de la méthode fetchAll() de PDO.
	 *
	 * @param array $arraySurveys Tableau de lignes.
	 * @return array(Response)|boolean Le tableau de réponses ou false si une erreur s'est produite.
	 */
	private function loadResponses(&$survey, $arrayResponses) {
		if(count($arrayResponses)==0) {
			return false;
		}

		foreach($arrayResponses as $row) {
			//Dénormaliser la réponse
			$r = new Response($row['survey_id'],$row['title'],$row['count']);
			$r->setId($row['id']);

			$survey->addResponse($r);
			$responses[] = $r;
		}

		return $responses;
	}

}
?>
