<?php
echo '<h1>Voici les news</h1>';

if(isset($user['admin']) && $user['admin']):
    echo '<div class="bouton">';
    echo '<a href="/news/admin_ajout">Ajouter une new</a>';
    echo '</div>';
endif; 

if($news):
    foreach($news as $new):
        echo '<div class="news">';
        echo '<h1>' . htmlentities($new->titre) . '</h1>';
        echo '<span class="date"><b>Date</b>' . htmlentities($new->date) . '</span><br />';
        echo '<span class="auteur"><b>Auteur</b>' . htmlentities($new->auteur) . '</span><br /><br />';
        echo '<div class="content">' . nl2br($new->apercu()) . '</div>';
        echo '<div class="right bouton"><a href="/news/' . $new->id . '">Voir plus en détails</a></div>';
        echo '</div>';
    endforeach;
endif;
?>