<?php

$xmlfile = './../data.xml';
$xml = simplexml_load_file($xmlfile);
$code = $_POST['code'];
$description = $_POST['description'];
$categorie_id = $_POST['categorie_id'];
$locale = $_POST['locale'];


$categorie = $xml->xpath("//categorie[@id='$categorie_id']");

$sousCategories = $xml->xpath('//sous-categorie[last()]');
$lastSousCategorie = end($sousCategories);
$lastSousCategorieId = (int) $lastSousCategorie['id'];
$newSousCategorieId = $lastSousCategorieId + 1;

$newSousCategorie = $categorie[0]->addChild('sous-categorie');
$newSousCategorie->addAttribute('id', $newSousCategorieId);
$newSousCategorie->addAttribute('code', $_POST['code']);
$newSousCategorie->addAttribute('locale', $_POST['locale']);
$newSousCategorie->addAttribute('description', $_POST['description']);
$xml->asXML($xmlfile);

header("Location: ../sous_categorie/add.php");

?>