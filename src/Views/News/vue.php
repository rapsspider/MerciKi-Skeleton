<?php
    if($new == null):
    echo "La new n'existe pas";
    else:
?>
    <div class="news">
        <h1><?= htmlentities($new->titre) ?></h1>
        <span class="date"><b>Date</b><?= htmlentities($new->date) ?></span><br />
        <span class="auteur"><b>Auteur</b><?= htmlentities($new->auteur) ?></span><br /><br />
        <div class="content"><?= nl2br($new->contenu) ?></div>
        <?php if(isset($user['admin']) && $user['admin']): ?>
        <div class="right bouton">
            <a href="/news/admin_modifier/<?= $new->id ?>">Modifier la new</a>
            <a href="/news/admin_supprimer/<?= $new->id ?>">Supprimer la new</a>
        </div>
        <?php endif; ?>
    </div>
<?php
endif;
?>