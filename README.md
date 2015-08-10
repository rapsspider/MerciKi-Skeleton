# MERCIKI Framework

## Architecture

- Libs : Contient le core du framework. Il est normalement commun à tous.
  - Body : Contient les classes représentant le core de l'application.
  - Database : Contient les classes représentant l'ORM de l'application.
- Src : Contient les sources personnelles pour chaque application.
  - Controllers : Contient vos différents controller.
  - Views : Contient vos différentes views.
  - Model : Contient vos différents modèles.
  - Public : Racine du site. Contiendra les css, javascript et autres files devant êtres accessible directement.
  - resources : Contiendra par exemple les assets pour compiler le style du style.

## Creation de son application

### Modèles
Il faut créer deux classes. La première va représenté une table dans la base de données, par exemple une table _project_. La seconde classe représentera une entité, c'est à dire une ligne dans cette table.

Exemple :
    ProjectTablePDO extends DAO_PDO
    Project extends Model
    
### Controller

Un controller contient différentes page du site. Il devra communiquer avec différents modèles.

Exemple:

    namespace MerciKI\App\Controllers;

    use MerciKI\App\Body\Controller;

    class DefaultController extends Controller {
	
	    public $models = [
	        'Project' => 'PDO'
	    ];
	
	    /**
	     * Page principale du controller.
	     * Liste les différentes news présentes dans
	     * la base de données.
	     */
	    public function index() {
		    $projects = $this->Projects->getList();
            $this->addVar('projects', $projects);
            
            return view
	    }
    }

	    
## Les vues

Les vues sont décomposées en 