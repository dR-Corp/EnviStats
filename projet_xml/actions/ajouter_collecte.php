<?php

$xmlfile = './../data.xml';
$xml = simplexml_load_file($xmlfile);
$code = $_POST['code'];
$description = $_POST['description'];
$indicateur_id = $_POST['indicateur_id'];

$frequence = $_POST['frequence'];
$zone_reference = $_POST['zone_reference'];
$unite_mesure = $_POST['unite_mesure'];
$valeurs = array(
    '2019' => $_POST['valeur_2019'],
    '2020' => $_POST['valeur_2020'],
    '2021' => $_POST['valeur_2021']
);

$listCollectes = $xml->xpath('//donnee[last()]');
$lastCollecte = end($listCollectes);
$lastCollecteId = (int) $lastCollecte['id'];
$id = $lastCollecteId + 1;

$indicateur = $xml->xpath("//indicateur[@id='$indicateur_id']")[0];
$donnee = $indicateur->addChild('donnee');
$donnee->addAttribute('id', $id);
$donnee->addAttribute('frequence', $frequence);
$donnee->addAttribute('zone_reference', $zone_reference);
$donnee->addAttribute('unite_mesure', $unite_mesure);
foreach ($valeurs as $annee => $valeur) {
    $donnee->addChild('valeurs', $valeur)->addAttribute('annee', $annee);
}
$xml->asXML($xmlfile);

header("Location: ../collecte/add.php");

?>