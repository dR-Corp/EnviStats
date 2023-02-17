<?php

// Définir le nom du fichier XML
$xmlfile = './../Data/data.xml';

// Vérifier que le fichier XML existe
if (!file_exists($xmlfile)) {
    exit('Le fichier XML n\'existe pas.');
}

// Charger le contenu du fichier XML dans un objet SimpleXMLElement
$xml = simplexml_load_file($xmlfile);

// Vérifier que le document a été chargé correctement
if (!$xml) {
    http_response_code(500);
    echo json_encode(['message' => 'Impossible de charger le document XML.']);
    exit();
}

// Définir les en-têtes de la réponse HTTP pour permettre les appels CORS
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Gestion des requêtes
switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        // Récupérer tous les éléments 'donnee'
        if (!isset($_GET['id']) && !isset($_GET['indicateur_id'])) {
            $donnees = array();
            foreach ($xml->xpath('//donnee') as $donnee) {
                $donnees[] = array(
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
            header('Content-Type: application/json');
            echo json_encode($donnees);
        }
        // Récupérer les éléments 'donnee' d'un indicateur spécifique
        else if (isset($_GET['indicateur_id']) && !isset($_GET['id'])) {
            $indicateur_id = $_GET['indicateur_id'];
            $donnees = array();
            foreach ($xml->xpath("//indicateur[@id='$indicateur_id']/donnee") as $donnee) {
                $donnees[] = array(
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
            header('Content-Type: application/json');
            echo json_encode($donnees);
        }
        // Récupérer un élément 'donnee' spécifique
        else if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $donnee = $xml->xpath("//donnee[@id='$id']")[0];
            $donnees = array(
                'id' => (string) $donnee['id'],
                'indicateur_id' => (string) $donnee->xpath('ancestor::indicateur')[0]['id'],
                'indicateur_code' => (string) $donnee->xpath('ancestor::indicateur')[0]['code'],
                'frequence' => (string) $donnee['frequence'],
                'zone_reference' => (string) $donnee['zone_reference'],
                'unite_mesure' => (string) $donnee['unite_mesure'],
                'valeur_annee_2019' => (string) $donnee->xpath("valeurs[@annee='2019']")[0],
                'valeur_annee_2020' => (string) $donnee->xpath("valeurs[@annee='2020']")[0],
                'valeur_annee_2021' => (string) $donnee->xpath("valeurs[@annee='2021']")[0]
            );
            // renvoyer les données sous forme de JSON
            header('Content-type: application/json');
            echo json_encode($donnees);
        }
        break;

    case 'POST':
        case 'POST':
            // Ajouter un élément 'donnee' 
            $indicateur_id = $_POST['indicateur_id'];
            $frequence = $_POST['frequence'];
            $zone_reference = $_POST['zone_reference'];
            $unite_mesure = $_POST['unite_mesure'];
            $valeurs = array(
                '2019' => $_POST['valeur_annee_2019'],
                '2020' => $_POST['valeur_annee_2020'],
                '2021' => $_POST['valeur_annee_2021']
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
            header('Content-Type: application/json');
            echo json_encode(array('success' => 'Enregistrement effectué.'));
            break;

    case 'PUT':
        // Modifier une catégorie par ID
        parse_str(file_get_contents('php://input'), $params);
        $id = $params['id'];
        $donnee = $xml->xpath("//donnee[@id='$id']")[0];
        $donnee[0]['frequence'] = $params['frequence'];
        $donnee[0]['zone_reference'] = $params['zone_reference'];
        $donnee[0]['unite_mesure'] = $params['unite_mesure'];
        $valeurs = $donnee->xpath('valeurs');
        $valeurs[0][0] = $params['valeur_annee_2019'];
        $valeurs[1][0] = $params['valeur_annee_2020'];
        $valeurs[2][0] = $params['valeur_annee_2021'];
        $xml->asXML($xmlfile);
        header('Content-Type: application/json');
        echo json_encode(array('message' => 'Modification effectuée.'));
        break;

    case 'DELETE':
        // Supprimer une catégorie par ID
        parse_str(file_get_contents('php://input'), $params);
        $id = $params['id'];
        $donnee = $xml->xpath("//donnee[@id='$id']")[0];
        unset($donnee[0]);
        
        $xml->asXML($xmlfile);
        header('Content-Type: application/json');
        echo json_encode(['success' => 'Suppression effectuée']);
        break;

    default:
        http_response_code(405); // Méthode non autorisée
        break;
}