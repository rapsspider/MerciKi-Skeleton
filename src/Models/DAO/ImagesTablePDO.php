<?php
/**
 * Framework
 * @author Jason BOURLARD<jason.bourlard@gmail.com>,
 *         Quentin DOUZIECH<quentin.douziech@gmail.com>,
 *         Bastien GIBRAT<bastien.gibrat@gmail.com>
 */

namespace MerciKI\App\Models\DAO;

use MerciKI\App\Models\Entities\Images;
use MerciKI\Database\DAO\PDO_DAO;

/**
 * Tableau des Images
 */
class ImagesTablePDO extends PDO_DAO {

	/**
	 * Nom de l'entité géré par le manager.
	 */
	protected $entity = "Images";

	/**
	 * Contient le nom de la table à utiliser.
	 */
	protected $table = 'images';

	/**
	 * Retourne une liste des utilisateurs
	 */
	public function getListe($order = 'id DESC') {
		$this->lastRequest = 'SELECT * FROM ' . $this->table . ' ORDER BY ' . $order . ';';
		$images = $this->_db->query($this->lastRequest, \PDO::FETCH_ASSOC);

		$images = $images->fetchAll();
		foreach($images as &$image) {
			$image = new Images($image);
		}

		return $images;
	}
}