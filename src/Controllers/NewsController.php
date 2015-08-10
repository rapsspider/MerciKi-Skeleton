<?php
/**
 * @author Jason BOURLARD<jason.bourlard@gmail.com>,
 *         Bastien VAUTIER
 */

namespace MerciKI\App\Controllers;

use MerciKI\Exception\PageNonExistante;
use MerciKI\Exception\NonAdminUtilisateur;

class NewsController extends AppController {
    
    public $layout = "default";
	
	public $models = [
	    'News' => 'PDO'
	];
	
	public function index() {
		$news = $this->News->getListe();
        $this->addVar('news', $news);
        
        return $this->view('News\index');
	}

	public function vue() {
		if(!isset($this->requete->params['id'])) {
			throw new PageNonExistante('La page demandée n\'existe pas');
		}

		try {
		    $new = $this->News->get($this->requete->params['id']);
		} catch(MerciKIException $e) {
			throw new PageNonExistante('La page demandée n\'existe pas');
		}

        $this->addVar('new', $new);
	}

	public function admin_index() {
		$news = $this->News->getListe();
        $this->addVar('news', $news);
	}

	public function admin_ajout() {
		$new = $this->News->nouvelEntite();

		if($this->requete->donnees && isset($this->requete->donnees['new'])) {
		    $new->set($this->requete->donnees['new']);
			$ajoute = $this->News->creer($new);

			if($ajoute) {
				return $this->redirect('/news/admin_index');
			} // TODO redirection
		}

		$this->addVar('new', $new);
	}

	public function admin_modifier() {
		if(!isset($this->requete->params['id'])) {
			throw new PageNonExistante('La page demandée n\'existe pas');
		}

		try {
		    $new = $this->News->get($this->requete->params['id']);
		} catch(MerciKIException $e) {
			throw new PageNonExistante('La page demandée n\'existe pas');
		}

		if($this->requete->donnees && isset($this->requete->donnees['new'])) {
			$new->set($this->requete->donnees['new']);
			$modifie = $this->News->modifier($new);

			if($modifie) {
				return $this->redirect('/news/admin_index');
			} // TODO redirection
		}

        $this->addVar('new', $new);
	}

    /**
     * Page permettant de supprimer une new
     */
	public function admin_supprimer() {
		try {
		    $new = $this->News->get($this->requete->params['id']);
		} catch(MerciKIException $e) {
			throw new PageNonExistante('La page demandée n\'existe pas');
		}

		if($this->News->supprimer($new)) {

		}
		return $this->redirect('/news/admin_index');
	}

}

?>