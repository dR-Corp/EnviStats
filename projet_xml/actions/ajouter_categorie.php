<?php

$xmlfile = './../data.xml';
$xml = simplexml_load_file($xmlfile);
$code = $_POST['code'];
$description = $_POST['description'];

$categories = $xml->xpath('/indicateurs/categorie[last()]');
$last_category = end($categories);
$id = (int)$last_category['id'] + 1;

$category = $xml->addChild('categorie');
$category->addAttribute('id', $id);
$category->addAttribute('code', $code); 
$category->addAttribute('description', $description);
$xml->asXML($xmlfile);

header("Location: ../categorie/add.php");

?>