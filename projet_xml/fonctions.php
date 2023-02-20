<?php

//charger
function charger_xml() {
    $xmlfile = './data.xml';
    $xml = simplexml_load_file($xmlfile);
    return $xml;
}

//categoires
function get_all_categories() {
    $xml = charger_xml();
    $elements = $xml->xpath('/indicateurs/categorie');
    $categories = array_map(function($categorie) {
        return ((array) $categorie->attributes())['@attributes'];
    }, $elements);
    return $categories;
};

function get_categorie($id) {
    $xml = charger_xml();
    $element = $xml->xpath("/indicateurs/categorie[@id=$id]");
    $categorie = array_map(function($cat) {
        return ((array) $cat->attributes())['@attributes'];
    }, $element);
    return $categorie;
};

//sous categories
function get_all_sous_categories() {
    $xml = charger_xml();
    $sousCategories = [];
    foreach ($xml->xpath('//sous-categorie') as $sousCategorie) {
        $attributs = $sousCategorie->attributes();
        $categorie = $sousCategorie->xpath('parent::categorie')[0];
        $sousCategories[] = [
            'id' => (string) $attributs['id'],
            'code' => (string) $attributs['code'],
            'locale' => (string) $attributs['locale'],
            'description' => (string) $attributs['description'],
            'categorie_id' => (string) $categorie['id'],
            'categorie_code' => (string) $categorie['code'],
        ];
    }
    return $sousCategories; 
};

function get_sous_categorie($id) {
    $xml = charger_xml();
    $sousCategorie = $xml->xpath("//sous-categorie[@id='$id']");
    $attributs = $sousCategorie[0]->attributes();
    $categorie = $sousCategorie[0]->xpath('parent::categorie')[0];
    $sousCategorie = [
        'id' => (string) $attributs['id'],
        'code' => (string) $attributs['code'],
        'locale' => (string) $attributs['locale'],
        'description' => (string) $attributs['description'],
        'categorie_id' => (string) $categorie['id'],
        'categorie_code' => (string) $categorie['code'],
    ];
    return $sousCategorie;
};

//indicateurs
function get_all_indicateurs() {
    $xml = charger_xml();
    $indicateurs = [];
    foreach ($xml->xpath('//indicateur') as $indicateur) {
        $attributs = $indicateur->attributes();
        $sous_categorie = $indicateur->xpath('parent::sous-categorie')[0];
        $indicateurs[] = [
            'id' => (string) $attributs['id'],
            'code' => (string) $attributs['code'],
            'locale' => (string) $attributs['locale'],
            'description' => (string) $attributs['description'],
            'sous_categorie_id' => (string) $sous_categorie['id'],
            'sous_categorie_code' => (string) $sous_categorie['code'],
        ];
    }
    return $indicateurs;
};

function get_indicateur($id) {
    $xml = charger_xml();
    $indicateur = $xml->xpath("//indicateur[@id='$id']");
    
    $attributs = $indicateur[0]->attributes();
    $sousCategorie = $indicateur[0]->xpath('parent::sous-categorie')[0];
    
    $indicateur = [
        'id' => (string) $attributs['id'],
        'code' => (string) $attributs['code'],
        'locale' => (string) $attributs['locale'],
        'description' => (string) $attributs['description'],
        'sous_categorie_id' => (string) $sousCategorie['id'],
        'sous_categorie_code' => (string) $sousCategorie['code']
    ];
    return $indicateur;
};

//collectes
function get_all_collectes() {
    $xml = charger_xml();
    $collectes = array();
    foreach ($xml->xpath('//donnee') as $donnee) {
        $collectes[] = array(
            'id' => (string) $donnee['id'],
            'indicateur_id' => (string) $donnee->xpath('ancestor::indicateur')[0]['id'],
            'indicateur_code' => (string) $donnee->xpath('ancestor::indicateur')[0]['code'],
            'frequence' => (string) $donnee['frequence'],
            'zone_reference' => (string) $donnee['zone_reference'],
            'unite_mesure' => (string) $donnee['unite_mesure'],
            'valeur_annee_2019' => (string) $donnee->xpath('valeurs[@annee="2019"]')[0],
            'valeur_annee_2020' => (string) $donnee->xpath('valeurs[@annee="2020"]')[0],
            'valeur_annee_2021' => (string) $donnee->xpath('valeurs[@annee="2021"]')[0],
        );
    }
    return $collectes;
}

?>