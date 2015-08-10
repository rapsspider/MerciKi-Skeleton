<?php
/**
 * @author Jason BOURLARD<jason.bourlard@gmail.com>,
 *         Bastien VAUTIER
 */

namespace MerciKI\App\Controllers;

use MerciKI\Body\Controller;
use MerciKI\Exception\NotAdminUser;

class AppController extends Controller {
	
	public function beforeAction() {
		parent::beforeAction();
	}
}

?>