<?php
if($groups):
	foreach($groups as &$group):
		echo '<div>';
        echo '<form action="/groupe/' . $group->id . '/compute" method="POST">';
        echo '<div class="row">';
        echo '    <div class="col-xs-1">';
		echo '       <h1>' . $group->name . '</h1>';
        echo '    </div>';
        echo '    <div class="form-group col-xs-2">';
        echo '       <label for="'. $group->id .'start">Date debut</label>';
        echo '       <input type="text" class="form-control date" value="' . date("Y-m-d") . '" name="startdate" id="'. $group->id .'start" placeholder="">';
        echo '    </div>';
        echo '    <div class="form-group col-xs-2">';
        echo '        <label for="'. $group->id .'end">Date fin</label>';
        echo '        <input type="text" class="form-control date" value="' . date("Y-m-d") . '" name="enddate" id="'. $group->id .'end" placeholder="">';
        echo '    </div>';
        echo '    <div class="form-group col-xs-1">';
        echo '        <label for="'. $group->id .'cbo">Consomme BO (jours)</label>';
        echo '        <input type="text" class="form-control" value="" name="cbo" id="'. $group->id .'cbo" placeholder="">';
        echo '    </div>';
        echo '    <div class="form-group col-xs-1">';
        echo '        <label for="'. $group->id .'cfo">Consomme FO (jours)</label>';
        echo '        <input type="text" class="form-control" value="" name="cfo" id="'. $group->id .'cfo" placeholder="">';
        echo '    </div>';
        echo '    <div class="form-group col-xs-1">';
        echo '        <label for="'. $group->id .'raebo">RAE BO (jours)</label>';
        echo '        <input type="text" class="form-control" value="" name="raebo" id="'. $group->id .'raebo" placeholder="">';
        echo '    </div>';
        echo '    <div class="form-group col-xs-1">';
        echo '        <label for="'. $group->id .'raefo">RAE FO (jours)</label>';
        echo '        <input type="text" class="form-control" value="" name="raefo" id="'. $group->id .'raefo" placeholder="">';
        echo '    </div>';
        echo '    <div class="col-xs-1">';
        echo '        <button type="submit" class="btn btn-primary">Go</button>';
        echo '    </div>';
        echo '</div>';
        echo '</form>';
		echo '</div>';
	endforeach;
endif;
?>
<a href="/groupe/create">Créer un groupe</a>