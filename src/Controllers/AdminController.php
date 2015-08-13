<?php
/**
 * @author Jason BOURLARD<jason.bourlard@gmail.com>,
 */

namespace MerciKI\App\Controllers;

use MerciKI\Body\Controller;
use MerciKI\Body\View;

class AdminController extends AppController {
    
    /**
     * Change the layout of this page.
     * If the user is not connected and not on the login page, then he's redirected
     * to the login page.
     */
    public function beforeAction() {
    	parent::beforeAction();
        
        $this->layout = 'admin';

    	if($this->action != 'login') {
	        if($this->auth == null || !$this->auth->isConnected()) {
	        	$this->redirect('/login');
	        }
    	}
    }

    /**
     * Show the main admin page.
     */
    public function index() {
        $texte = new View();
        $texte->file = 'resources/Data/admin.ctp';

        $this->addVar('texte', $texte->content());
        
        return $this->view('Admin/index');
    }

    /**
     * Show the login page.
     */
    public function login() {
        $this->layout = 'simple';
        
        return $this->view('Admin/login');
    }
    
    /**
     * Try to connect the user. Return the json result.
     */
    public function loginResult() {
        $this->layout = 'ajax';
        $this->response->type('json');

        $isConnected = $this->auth->connexion(
            $this->request->data['username'],
            $this->request->data['password']
        );

        $this->addVar('estConnecte', $isConnected);
        return $this->view('Admin/login_json');
    }

    /**
     * Logout page and redirect to the root page of the website.
     */
    public function logout() {
        $this->auth->logout();
        $this->redirect('/');
    }
}

?>