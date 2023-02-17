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

// Gestion des requêtes
switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        // Récupérer toutes les catégories
        if (!isset($_GET['id'])) {
            $elements = $xml->xpath('/indicateurs/categorie');
            $categories = array_map(function($categorie) {
                return ((array) $categorie->attributes())['@attributes'];
            }, $elements);
            echo json_encode($categories);
        } else {
            // Récupérer une catégorie par ID
            $id = (int)$_GET['id'];
            $element = $xml->xpath("/indicateurs/categorie[@id=$id]");
            if (empty($element)) {
                http_response_code(404); // Ressource non trouvée
                echo json_encode(['error' => 'La catégorie avec cet ID n\'existe pas.']);
            } else {
                $categorie = array_map(function($cat) {
                    return ((array) $cat->attributes())['@attributes'];
                }, $element);
                echo json_encode($categorie);
            }
        }
        break;
        
    case 'POST':
        // Ajouter une catégorie
        $code = $_POST['code'];
        $category = $xml->xpath("/indicateurs/categorie[@code='$code']");
        if (!empty($category)) {
            http_response_code(409); // Conflit de ressources
            echo json_encode(['error' => 'La catégorie avec cet code existe déjà.']);
        } else {

            $categories = $xml->xpath('/indicateurs/categorie[last()]');
            $last_category = end($categories);
            $id = (int)$last_category['id'] + 1;

            $category = $xml->addChild('categorie');
            $category->addAttribute('id', $id);
            $category->addAttribute('code', $code); 
            $category->addAttribute('description', $_POST['description']);
            $xml->asXML($xmlfile);
            echo json_encode(['success' => 'Enregistrement effectué']);
        }
        break;
        
    case 'PUT':
        // Modifier une catégorie par ID
        parse_str(file_get_contents('php://input'), $putData);
        $id = (int)$putData['id'];
        $category = $xml->xpath("/indicateurs/categorie[@id=$id]");
        if (empty($category)) {
            http_response_code(404); // Ressource non trouvée
            echo json_encode(['error' => 'La catégorie avec cet ID n\'existe pas.']);
        } else {
            $category = $category[0];
            $category['code'] = $putData['code'];
            $category['description'] = $putData['description'];
            $xml->asXML($xmlfile);
            echo json_encode(['success' => "Modification effectuée"]);
        }
        break;
        
    case 'DELETE':
        // Supprimer une catégorie par ID        
        parse_str(file_get_contents('php://input'), $deleteData);
        $id = (int)$deleteData['id'];
        $category = $xml->xpath("/indicateurs/categorie[@id='$id']");
        if (empty($category)) {
            http_response_code(404); // Ressource non trouvée
            echo json_encode(['error' => 'La catégorie avec cet ID n\'existe pas.']);
        } else {
            unset($category[0][0]);
            $xml->asXML($xmlfile);
            // file_put_contents($xmlfile, $xml->asXML());
            echo json_encode(['success' => 'Suppression effectuée']);
        }
        break;
        
    default:
        http_response_code(405); // Méthode non autorisée
        break;
}