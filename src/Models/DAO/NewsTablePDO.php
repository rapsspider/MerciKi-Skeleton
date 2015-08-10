<?php
/**
 * Framework
 * @author Jason BOURLARD<jason.bourlard@gmail.com>,
 *         Quentin DOUZIECH<quentin.douziech@gmail.com>,
 *         Bastien GIBRAT<bastien.gibrat@gmail.com>
 */

namespace MerciKI\App\Models\DAO;

use MerciKI\App\Models\Entites\News;
use MerciKI\Database\DAO\PDO_DAO;

/**
 * Tableau des news
 */
class NewsTablePDO extends PDO_DAO {

	/**
	 * Nom de l'entité géré par le manager.
	 */
	protected $entite = "News";

	/**
	 * Contient le nom de la table à utiliser.
	 */
	protected $table = 'news';

	/**
	 * Retourne une liste de news
	 */
	public function getListe($order = 'id DESC') {
		$this->lastRequest = 'SELECT * FROM ' . $this->table . ' ORDER BY ' . $order . ';';
		$news = $this->_db->query($this->lastRequest, \PDO::FETCH_ASSOC);

        if($news) {
            $news = $news->fetchAll();
            foreach($news as &$new) {
                $new = new News($new);
            }
            return $news;
        } // else
        
        return [];
	}
}