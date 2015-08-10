<?php
/**
 * @author Jason BOURLARD<jason.bourlard@gmail.com>,
 *         Bastien VAUTIER
 */

namespace MerciKI\Controleurs;

use MerciKI\Body\Controleur;
use MerciKI\Body\Uploader;

class ImagesController extends AppController {
    
    public $models = [
        'Images' => 'PDO'
    ];
    
    public function index() {

    }

    public function getListe() {
        $this->layout = 'ajax';
        $this->reponse->type('json');
        $this->ajoutVariable('images', [
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
    }

    public function getListexml() {
        $this->layout = 'ajax';
        $this->reponse->type('xml');
        $this->ajoutVariable('images', [
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
    }

    public function admin_index() {
        $images = $this->Images->getListe();
        $this->ajoutVariable('images', $images);
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

        $this->ajoutVariable('image', $image);
        $this->ajoutVariable('result', $ajoute);
    }

    public function admin_modifier() {
        if(!isset($this->requete->params['id'])) {
            throw new PageNotExist('La page demandée n\'existe pas');
        }

        try {
            $image = $this->Images->get($this->requete->params['id']);
        } catch(MerciKiException $e) {
            throw new PageNonExistante('La page demandée n\'existe pas');
        }

        if($this->requete->donnees && isset($this->requete->donnees['image'])) {
            $image->set($this->requete->donnees['image']);
            $modifie = $this->Images->modifier($image);

            if($modifie) {
                return $this->redirect('/images/admin_index');
            } // TODO redirection
        }

        $this->ajoutVariable('image', $image);
    }

    /**
     * Page permettant de supprimer une image
     */
    public function admin_supprimer() {
        try {
            $image = $this->Images->get($this->requete->params['id']);
        } catch(MerciKIException $e) {
            throw new PageNotExist('La page demandée n\'existe pas');
        }

        if($this->Images->supprimer($image)) {

        }
        return $this->redirect('/images/admin_index');
    }
}

?>