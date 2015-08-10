<div class="news">
	<?php
	echo '<h1>Administration des news</h1>';
	?>

	<table class="admin">
		<thead>
			<tr>
				<th>ID</th>
				<th>Titre</th>
				<th>Auteur</th>
				<th>Date</th>
				<th>Actions</th>
			</tr>
		</thead>
	    <tbody>
	<?php
	if($news):
		foreach($news as $new): ?>
			<tr>
				<td><?= htmlentities($new->id) ?></td>
				<td><?= htmlentities($new->titre) ?></td>
				<td><?= htmlentities($new->auteur) ?></td>
				<td><?= htmlentities($new->date) ?></td>
				<td class="bouton">
					<a href="/news/admin_modifier/<?= $new->id ?>">Modifier</a>
					<a href="/news/admin_supprimer/<?= $new->id ?>">Supprimer</a>
				</td>
			</tr>
	<?php
		endforeach;
	endif;
	?>
	    </tbody>
	</table>
	<div class="bouton right">
    	<a href="/news/admin_ajout">Ajouter une new</a>
	</div>
</div>