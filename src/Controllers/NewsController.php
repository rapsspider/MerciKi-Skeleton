<?php
/**
 * @author Jason BOURLARD<jason.bourlard@gmail.com>,
 */

namespace MerciKI\App\Controllers;

use MerciKI\Exception\PageNotExist;
use MerciKI\Exception\NonAdminUtilisateur;

class NewsController extends AppController {
    
    public $layout = "default";
    
    public $models = [
        'News' => 'PDO'
    ];
    
    /**
     * List all news
     *
     * @return The result of the view 'News\index'.
     */
    public function index() {
        $news = $this->News->getList();
        $this->addVar('news', $news);
        
        return $this->view('News\index');
    }

    /**
     * Display a new.
     *
     * @return The result of the view 'News\vue'.
     */
    public function vue($id = null) {
        if(!$id) {
            throw new PageNotExist('Impossible to get the new because no id has been passed.');
        }

        try {
            $new = $this->News->get($id);
        } catch(MerciKIException $e) {
            throw new EntityNotFound('Impossible to get the new with this id ... (ID : ' . $id . ')');
        }

        $this->addVar('new', $new);
        
        return $this->view('News\vue');
    }

    public function admin_index() {
        $news = $this->News->getList();
        $this->addVar('news', $news);
        
        return $this->view('News\admin_index');
    }

    public function admin_add() {
        $new = $this->News->newEntity();

        $this->addVar('new', $new);
        
        return $this->view('News\admin_add');
    }

    public function admin_save() {
        $new = $this->News->newEntity();

        if($_POST && isset($_POST['new'])) {
            $new->set($_POST['new']);
            $ajoute = $this->News->create($new);

            if($ajoute) {
                return $this->redirect('/admin/news/index');
            } // TODO redirection
        }

        $this->addVar('new', $new);
        return $this->view('News\admin_add');
    }

    public function admin_edit($id = null) {
        if(!$id) {
            throw new PageNotExist('La page demandée n\'existe pas');
        }

        try {
            $new = $this->News->get($id);
        } catch(MerciKIException $e) {
            throw new PageNotExist('La page demandée n\'existe pas');
        }

        $this->addVar('new', $new);
        return $this->view('News\admin_edit');
    }
    
    public function admin_update($id = null) {
        if(!$id) {
            throw new PageNotExist('La page demandée n\'existe pas');
        }

        try {
            $new = $this->News->get($id);
        } catch(MerciKIException $e) {
            throw new PageNotExist('La page demandée n\'existe pas');
        }

        if($_POST && isset($_POST['new'])) {
            $new->set($_POST['new']);
            $modifie = $this->News->edit($new);

            if($modifie) {
                return $this->redirect('/admin/news/index');
            } // else
        }

        $this->addVar('new', $new);
        return $this->view('News\admin_edit');
    }

    /**
     * Delete the new which have the id passed in request's parameter.
     * @throw PageNotExist     Not entity found with the id.
     * @throw MerciKiException Error during the delete.
     */
    public function admin_delete($id = null) {
        try {
            $new = $this->News->get($id);
        } catch(MerciKIException $e) {
            throw new EntityNotExist('Entity not exist.');
        }

        if($this->News->delete($new)) {
            return $this->redirect('/admin/news/index');
        }
        throw new MerciKiException('Impossible to delete this image. An error occured ...');
    }

}

?>