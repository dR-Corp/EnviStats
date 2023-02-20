<?php

$xmlfile = './../data.xml';
$xml = simplexml_load_file($xmlfile);
$code = $_POST['code'];
$description = $_POST['description'];
$sous_categorie_id = $_POST['sous_categorie_id'];
$locale = $_POST['locale'];

$sous_categorie = $xml->xpath("//sous-categorie[@id='$sous_categorie_id']");

$indicateurs = $xml->xpath('//indicateur[last()]');
$lastIndicateur = end($indicateurs);
$lastIndicateurId = (int) $lastIndicateur['id'];
$newIndicateurId = $lastIndicateurId + 1;

$newIndicateur = $sous_categorie[0]->addChild('indicateur');
$newIndicateur->addAttribute('id', $newIndicateurId);
$newIndicateur->addAttribute('code', $_POST['code']);
$newIndicateur->addAttribute('locale', $_POST['locale']);
$newIndicateur->addAttribute('description', $_POST['description']);
$xml->asXML($xmlfile);

header("Location: ../indicateur/add.php");

?>