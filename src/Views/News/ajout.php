<form method="POST" action="/news/ajout">
    <div>
        <label>Titre</label>
        <input type="text" name="new[titre]" value="<?= $new->titre ?>" />
    </div>
    <div>
        <label>Date</label>
        <input type="date" name="new[date]" value="<?= $new->date ?>" />
    </div>
    <div>
        <label>Auteur</label>
        <input type="text" name="new[auteur]" value="<?= $new->auteur ?>" />
    </div>
    <div>
        <label>Contenu</label>
        <textarea name="new[contenu]"><?= $new->contenu ?></textarea>
    </div>
    <input type="submit" value="Ajout">
</form>