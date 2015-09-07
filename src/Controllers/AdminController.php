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

        if($this->action != 'login' && $this->action != 'loginResult' ) {
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
        $this->addVar('texte', $texte->content('resources/Data/admin.ctp'));
        
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
        
        $isConnected = $this->auth->connexion(
            $_POST['username'],
            $_POST['password']
        );
        
        return ['result' => $isConnected];
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