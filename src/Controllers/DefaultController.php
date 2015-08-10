<?php

namespace MerciKI\App\Controllers;

use \MerciKI\Body\Controller;

class DefaultController extends Controller {

    public function index() {
        return [
            'result' => true, 
            'titre' => 'bienvenue'
        ];
    }
}

?>