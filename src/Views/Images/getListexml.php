<?php
$xml = new DOMDocument('1.0', 'utf-8');
$tag = $xml->createElement('images');

foreach($images as $image) {
    $moi = $xml->createElement('image');

    $titre = $xml->createElement('titre', $image['titre']);
    $lien  = $xml->createElement('lien',  $image['lien']);

    $moi->appendChild($titre);
    $moi->appendChild($lien);

    $tag->appendChild($moi);
}

$xml->appendChild($tag);
echo $xml->saveXML();
?>