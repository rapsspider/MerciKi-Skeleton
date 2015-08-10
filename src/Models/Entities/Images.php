<?php
/**
 * Framework
 * @author Jason BOURLARD<jason.bourlard@gmail.com>,
 *         Quentin DOUZIECH<quentin.douziech@gmail.com>,
 *         Bastien GIBRAT<bastien.gibrat@gmail.com>
 */

namespace MerciKI\App\Models\Entites;

use MerciKI\Body\Model;

class Images extends Model {

    /**
     * Liste des attributs que peut contenir l'objet.
     *
     * Permet de faire la correspondance entre un attribut et son type :
     * Type : 'i' Entier
     *        's' Chaînes de caractères.
     *        'b' BLOB
     *        'd' Nombre décimal.
     *
     * Permet de faire la correspondance entre un attribut et son nom de colonne
     * dans la base de données.
     */
    public $attributs = [
        'id' => [
            'type' => 's',
            'column' => 'id'
        ],
        'titre' => [
            'type' => 's',
            'column' => 'titre'
        ],
        'lien' => [
            'type' => 's',
            'column' => 'lien'
        ],
        'active' => [
            'type' => 'i',
            'column' => 'active'
        ]
    ];    
}

?>