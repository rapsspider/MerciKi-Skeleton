# MERCIKI Framework

@TOTRANSLATE

## Architecture

- Libs : Contient le core du framework. Il est normalement commun à tous.
  - Body : Contient les classes représentant le core de l'application.
  - Database : Contient les classes représentant l'ORM de l'application.
- Src : Contient les sources personnelles pour chaque application.
  - Controllers : Contient vos différents contrôleurs.
  - Views : Contient vos différentes vues.
  - Model : Contient vos différents modèles.
  - Public : Racine du site. Contiendra les css, javascript et autres fichiers devant êtres accessible directement.
  - resources : Contiendra par exemple les assets pour compiler le style du site (LESS / SASS).

## Creation de son application

### Modèles
Il faut créer deux classes. La première va représenter une table dans la base de données, par exemple une table _project_. 
Elle contiendra les méthodes permettant de communiquer avec cette table (Requêtes SQL).
La seconde classe représentera une entité, c'est l'entité représentée dans MERISE (MCD).

Exemple :
    ProjectTablePDO extends DAO_PDO
    Project extends Model
    
### Les contrôleurs

Un contrôleur peut contenir différentes pages du site. Il peut utiliser zéro, un ou plusieurs modèles.

Exemple:

    namespace MerciKI\App\Controllers;

    use MerciKI\App\Body\Controller;

    class DefaultController extends Controller {
	
	    public $models = [
	        'Project' => 'PDO'
	    ];
	
	    /**
	     * Page principale du contrôleur.
	     * Liste les différentes news présentes dans
	     * la base de données.
	     */
	    public function index() {
		    $projects = $this->Projects->getList();
            $this->addVar('projects', $projects);
            
            return view('Default/index');
	    }
    }

	    
## Les vues

@TODO