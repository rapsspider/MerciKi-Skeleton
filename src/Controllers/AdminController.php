<?php
/**
 * @author Jason BOURLARD<jason.bourlard@gmail.com>,
 *         Bastien VAUTIER
 */

namespace MerciKI\App\Controllers;

use MerciKI\Body\Controleur;

class AdminControleur extends AppController {
    
    public function beforeAction() {
    	parent::beforeAction();
        
        $this->layout = 'admin';

    	if($this->action != 'login') {
	        if($this->Auth != null && !$this->Auth->isConnecte()) {
	        	$this->redirect('/admin/login');
	        }
    	}
    }


    public function index() {
        $filename = __MerciKI__ . DS . 'src' . DS . 'Donnees' . DS . 'admin.ctp';
        $file     = fopen($filename, 'r');
        $texte    = fread($file, filesize($filename));
        fclose($file);

        $this->ajoutVariable('texte', $texte);
    }

    public function login() {
        if($this->requete->is('post')) {
            $this->layout = 'ajax';
            $this->vue = $this->vue . "_json";
            $this->reponse->type('json');

            $estConnecte = $this->Auth->connexion(
                $this->requete->donnees['username'],
                $this->requete->donnees['password']
            );

            $this->ajoutVariable('estConnecte', $estConnecte);
            return;
        }
        $this->layout = 'simple';
    }

    public function logout() {
        $this->Auth->deconnexion();
        $this->redirect('/');
    }
}

?>