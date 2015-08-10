<div class="images">
	<h1>Administration des images</h1>

	<table class="admin">
		<thead>
			<tr>
				<th>ID</th>
				<th>Titre</th>
				<th>Lien</th>
				<th>Actions</th>
			</tr>
		</thead>
	    <tbody>
	<?php
	if($images):
		foreach($images as $image): ?>
			<tr class="<?= $image->active ? 'active' : 'inactive' ?>">
				<td><?= htmlentities($image->id) ?></td>
				<td><?= htmlentities($image->titre) ?></td>
				<td><?= htmlentities($image->lien) ?></td>
				<td class="bouton">
					<a href="#" onClick="return ImagesManager.modifier(this);">Modifier</a>
					<a href="#" onClick="return ImagesManager.supprimer(this);">Supprimer</a>
				</td>
			</tr>
	<?php
		endforeach;
	endif;
	?>
	    </tbody>
	</table>
	<div class="bouton right">
	    <a href="#" onClick="return ImagesManager.nouvelle();">Ajouter une image</a>
	</div>
</div>

<script>
    /**
     * Ajout d'une fonction show à la classe Image
     * @param Object elem 
     */
    Image.prototype.showTable = function(elem) {
        // Si elem est null ou indéfini, on quite la fonction.
        if(elem == undefined || elem == null) return;

        // On remplace le contenu HTML par un titre
        elem.innerHTML = '<h2>' + this.title + '</h2>';
        // On ajoute ensuite l'image.
        elem.appendChild(this);
    }

    ImagesManager = {
    	images : {}, // Tableau d'images
    	url : null,
    	table : $('.images table.admin tbody'),

        nouvelle : function() {
            var t = ImagesManager.table;
            var tmpid = ImagesManager.getNewId();

            tr = document.createElement("tr");
            tr.innerHTML = '<td>?</td>'
                          +'<td><input type="text" value="" /></td>'
                          +'<td><input type="text" value="" /></td>'
                          +'<td class="bouton">'
					      +'    <a href="#" onClick="return ImagesManager.save(this)">Save</a>'
				          +'</td>';

            t.append(tr);

        	ImagesManager._ajout(
        		$(tr),
        		null, 
        		null, 
        		null
        	);

            return false;
        },

        modifier : function(elem) {
        	var tr = $(elem).parent().parent();
    		var elem_id = tr.attr('image_id');
    		if(elem_id == undefined) return;

    		var tab = ImagesManager.images[elem_id];
    		if(tab == undefined) return;
    		tr.find('td:eq(1)').html('<input type="text" value="' + tab.name + '" />');
    		tr.find('td.bouton').html('<a href="#" onClick="return ImagesManager.save(this)">Save</a>');
        },

    	supprimer : function(elem) {
    		var elem_id = $(elem).parent().parent().attr('image_id');
    		if(elem_id == undefined) return;

    		var elem = ImagesManager.images[elem_id];
    		if(elem == undefined) return;

    		if(elem.image_id == null) {
        		elem.elem.remove();
        		delete ImagesManager.images[elem_id];
                return;
    		}

            $.ajax({
                'type' : 'GET',
                'dataType' : 'json',
                'data' : {},
                'url' : ImagesManager.url + 'admin_supprimer/' + elem.image_id
            }).done(function(json) {
            	if(json.result) {
            		elem.elem.remove();
            		delete ImagesManager.images[elem_id];
            	}
            })
    	},

    	save : function(elem) {
        	var tr = $(elem).parent().parent();

    		tr.find('td:eq(1)').html('<input type="text" value="' + tab.name + '" />');

            alert('TODO');

    		tr.find('td.bouton').html(
    			'<a href="#" onClick="return ImagesManager.modifier(this)">Modifier</a> '
			+   '<a href="#" onClick="return ImagesManager.supprimer(this)">Supprimer</a>'
			);

    	},

    	upload : function() {

    	},

        getNewId : function() {
        	return parseInt(Math.random() * 100000) + "_id";
        },

        /**
         * On créer les images extraites à l'aide du tableau
         */
    	init : function() {
            var t = ImagesManager.table;

            t.find('tr').each(function() {
            	ImagesManager._ajout(
            		$(this),
            		$(this).find('td:eq(0)').html(), 
            		$(this).find('td:eq(1)').html(), 
            		$(this).find('td:eq(2)').html()
            	);
            });
    	},

    	_ajout : function(elem, id, titre, lien) {
        	var image = new Image();
            var tmpid = ImagesManager.getNewId();

            image.elem     = elem;
            image.image_id = id;
            image.src      = lien;
            image.name     = titre;
            image.title    = titre;

            ImagesManager.images[tmpid] = image;
            elem.attr('image_id', tmpid);
    	},

        _modifier : function(tmpid, id, titre, lien) {
            if(tmpid === undefined || ImagesManager.images[tmpid] === undefined) return;

            var img = ImagesManager.images[tmpid];

            if(id    !== undefined) img.image_id = id;
            if(titre !== undefined) img.image_id = titre;
            if(lien  !== undefined) img.image_id = lien;
        },
    };

    ImagesManager.init();
</script>