<?php
/**
 * @author Jason BOURLARD<jason.bourlard@gmail.com>,
 */

namespace MerciKI\App\Controllers;

use MerciKI\Body\Controleur;
use MerciKI\Body\Uploader;

class ImagesController extends AppController {
    
    public $models = [
        'Images' => 'PDO'
    ];
    
    public function index() {
        return $this->view('Images\index');
    }

    public function getListe() {
        return [
            [
                'titre' => 'DRACO ? FEU ! piou piou',
                'lien'  => 'http://127.0.0.1/img/drakofeu.jpg'
            ],
            [
                'titre' => 'RONDOUDOUDOUDOUDOU',
                'lien'  => 'http://127.0.0.1/img/rondoudou.jpg'
            ],
            [
                'titre' => 'POUSSE, SI FEU !!!!',
                'lien'  => 'http://127.0.0.1/img/poussifeu.png'
            ],
            [
                'titre' => 'Salle à mêches !!!!',
                'lien'  => 'http://127.0.0.1/img/salameche.png'
            ]
        ];
    }

    public function getListexml() {
        $this->layout = 'ajax';
        $this->response->type('xml');
        
        $this->addVar('images', [
            [
                'titre' => 'DRACO ? FEU ! piou piou',
                'lien'  => 'http://127.0.0.1/img/drakofeu.jpg'
            ],
            [
                'titre' => 'RONDOUDOUDOUDOUDOU',
                'lien'  => 'http://127.0.0.1/img/rondoudou.jpg'
            ],
            [
                'titre' => 'POUSSE, SI FEU !!!!',
                'lien'  => 'http://127.0.0.1/img/poussifeu.png'
            ],
            [
                'titre' => 'Salle à mêches !!!!',
                'lien'  => 'http://127.0.0.1/img/salameche.png'
            ]
        ]);
        return $this->view('Images\getListexml');
    }

    public function admin_index() {
        $images = $this->Images->getListe();
        $this->addVar('images', $images);
        return $this->view('Images\admin_index');
    }

    public function admin_ajout() {
        $this->layout = 'ajax';
        $uploader = new Uploader('img/', 'img/thumbnail');
        $uploads = $uploader->upload();
        $fileName = substr($uploads, 2, -2);

        $image['image']['photo_chemin'] = $uploader->getOutputFolder().$fileName;
        $image = $this->Images->nouvelEntite();
        $photos->set($image['image']);
        $ajoute = $this->Images->creer($image);

        $this->addVar('image', $image);
        $this->addVar('result', $ajoute);
        return $this->view('Images\admin_ajout');
    }

    public function admin_edit() {
        if(!isset($this->request->params['id'])) {
            throw new PageNotExist('La page demandée n\'existe pas');
        }

        try {
            $image = $this->Images->get($this->request->params['id']);
        } catch(MerciKiException $e) {
            throw new PageNonExistante('La page demandée n\'existe pas');
        }

        if($this->request->data && isset($this->request->data['image'])) {
            $image->set($this->request->data['image']);
            $modifie = $this->Images->edit($image);

            if($modifie) {
                return $this->redirect('/images/admin_index');
            } // TODO redirection
        }

        $this->addVar('image', $image);
        return $this->view('Images\admin_ajout');
    }

    /**
     * Page permettant de delete une image
     */
    public function admin_delete() {
        try {
            $image = $this->Images->get($this->request->params['id']);
        } catch(MerciKIException $e) {
            throw new PageNotExist('La page demandée n\'existe pas');
        }

        if($this->Images->delete($image)) {

        }
        return $this->redirect('/images/admin_index');
    }
}

?>