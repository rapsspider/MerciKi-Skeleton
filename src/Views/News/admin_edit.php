<div class="news">
    <h1>Modification d'une new</h1>

    <form method="POST" action="/admin/news/<?= $new->id ?>/edit">
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
            <div class="textarea">
                <textarea id="editor" name="new[contenu]" rows="10" cols="80"><?= $new->contenu ?></textarea>
            </div>
        </div>
        <div class="bouton right">
            <button class="submit" onClick="submit()"><i class="icon-edit"></i>Modifier</button>
        </div>
    </form>

    <script>
        $( document ).ready( function() {
            //$( 'textarea#editor' ).ckeditor();
            CKEDITOR.replace('editor');
        } );
    </script>
</div>