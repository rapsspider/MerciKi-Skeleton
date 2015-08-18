<?php
/**
 * @author Jason BOURLARD<jason.bourlard@gmail.com>,
 */

namespace MerciKI\App\Controllers;

use MerciKI\Body\Controller;
use MerciKI\Exception\NotConnectedUser;

class AppController extends Controller {
	
    /**
     * Look to the action. If it's an admin's action, it's test
     * that the user is connected. If not, an exception will be throw.
     * @throw NotConnectedUser The user is not connected.
     */
	public function beforeAction() {
	    parent::beforeAction();

        // If it's an admin page
		if(substr($this->action, 0, 6) == "admin_") {
            // If the user is not connected
		    if($this->auth != null && !$this->auth->isConnected()) {
			    throw new NotConnectedUser('You need to be connected !');
			} // else
            $this->layout = 'admin';
        }
	}
}

?>