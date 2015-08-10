<?php
/**
 * Framework
 * @author Jason BOURLARD<jason.bourlard@gmail.com>,
 *         Quentin DOUZIECH<quentin.douziech@gmail.com>,
 *         Bastien GIBRAT<bastien.gibrat@gmail.com>
 */

namespace MerciKI\App\Models\DAO;

use MerciKI\App\Models\Entites\Utilisateurs;
use MerciKI\Database\DAO\PDO_DAO;
use MerciKI\Interfaces\IUtilisateurTableau;

/**
 * Tableau des utilisateurs
 */
class UtilisateursTablePDO extends PDO_DAO implements IUtilisateurTableau {

	/**
	 * Nom de l'entité géré par le manager.
	 */
	protected $entite = "Utilisateurs";

	/**
	 * Contient le nom de la table à utiliser.
	 */
	protected $table = 'utilisateurs';

	/**
	 * Tente de connecté un utilisateur
	 *
	 * @param String login Le login de l'utilisateur
	 * @param String password Le password de l'utilisateur
	 * @return Model L'utilisateur
	 * @see IUtilisateurTableau::getUtilisateur
	 */
	public function getUtilisateur($login, $password) {
		$this->lastRequest = 'SELECT * FROM ' . $this->table . ' WHERE username=\'' . addslashes($login) . '\';';
		$usernames = $this->_db->query($this->lastRequest, \PDO::FETCH_ASSOC);

        if(!$usernames) return false;

		$usernames = $usernames->fetchAll();
		$user = false;
		$i = 0;
		while($i < count($usernames)) {
			$user = $usernames[$i]['passe'] == $password ? $usernames[$i] : false;
		    $i++;
		}

		if ($user && isset($user['passe'])) {
			unset($user['passe']);
		}

		return $user ? new Utilisateurs($user) : false;
	}
}