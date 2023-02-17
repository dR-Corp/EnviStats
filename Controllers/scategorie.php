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
        // Vérifier si un ID de sous-catégorie a été spécifié
        if (isset($_GET['id'])) {
            $id = (int) $_GET['id'];
            // Récupérer la sous-catégorie correspondante à l'ID
            $subcategory = $xml->xpath("//sous-categorie[@id='$id']");
            if (empty($sousCategorie)) {
                // La sous-catégorie n'existe pas
                header('Content-Type: application/json');
                http_response_code(404);
                echo json_encode(['error' => "La sous-catégorie avec l'ID $id n'existe pas"]);
                exit;
            } else {
                // Retourner la sous-catégorie demandée
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
                header('Content-Type: application/json');
                echo json_encode($sousCategorie);
                exit;
            }
        } else {
            // Vérifier si une catégorie a été spécifiée
            if (isset($_GET['categorie_id'])) {
                $categorie_id = $_GET['categorie_id'];
                $categorie = $xml->xpath("//categorie[@id='$categorie_id']");
                if (empty($categorie)) {
                    // Aucune sous-catégorie n'a été trouvée pour la catégorie demandée
                    header('Content-Type: application/json');
                    http_response_code(404);
                    echo json_encode(['error' => "La catégorie avec l'ID $categorie_id n'existe pas"]);
                    exit;
                } else {
                    // Retourner toutes les sous-catégories de la catégorie demandée
                    $sousCategories = [];
                    foreach ($categorie[0]->xpath('sous-categorie') as $sousCategorie) {
                        $attributs = $sousCategorie->attributes();
                        $categorie = $sousCategorie->xpath('parent::categorie')[0];
                        $sousCategories[] = [
                            'id' => (string) $attributs['id'],
                            'code' => (string) $attributs['code'],
                            'locale' => (string) $attributs['locale'],
                            'description' => (string) $attributs['description'],
                            'categorie_id' => (string) $categorie_id,
                            'categorie_code' => (string) $categorie['code'],
                        ];
                    }
                    header('Content-Type: application/json');
                    echo json_encode($sousCategories);
                    exit;
                }
            } else {
                // Récupérer toutes les sous-catégories
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
                header('Content-Type: application/json');
                echo json_encode($sousCategories);
                exit;
            }
        }

        break;
        
    case 'POST':
        //Vérification que la catégorie parente existe
        $categorie_id = $_POST['categorie_id'];
        $categorie = $xml->xpath("//categorie[@id='$categorie_id']");
        $categorie_code = $categorie[0]['code'];
        if (empty($categorie)) {
            header('Content-Type: application/json');
            http_response_code(404);
            echo json_encode(['error' => "La catégorie avec l'ID $categorie_id n'existe pas"]);
            exit;
        }
        // Vérification que la sous-catégorie n'existe pas déjà
        $code = $_POST['code'];
        $sousCategorie = $categorie[0]->xpath("sous-categorie[@code='$code']");
        if (!empty($sousCategorie)) {
            header('Content-Type: application/json');
            http_response_code(409);
            echo json_encode(['error' => "La sous-catégorie $code existe déjà dans la catégorie $categorie_code."]);
            exit;
        }
        // Création de la nouvelle sous-catégorie
        $sousCategories = $xml->xpath('//sous-categorie[last()]');
        $lastSousCategorie = end($sousCategories);
        $lastSousCategorieId = (int) $lastSousCategorie['id'];
        $newSousCategorieId = $lastSousCategorieId + 1;
        // ajout
        $newSousCategorie = $categorie[0]->addChild('sous-categorie');
        $newSousCategorie->addAttribute('id', $newSousCategorieId);
        $newSousCategorie->addAttribute('code', $_POST['code']);
        $newSousCategorie->addAttribute('locale', $_POST['locale']);
        $newSousCategorie->addAttribute('description', $_POST['description']);
        $xml->asXML($xmlfile);
        header('Content-Type: application/json');
        http_response_code(201);
        echo json_encode(['success' => 'Enregistrement effectué']);
        break;
        
    case 'PUT':
        // Modifier une catégorie par ID
        parse_str(file_get_contents("php://input"), $putParams);
        $id = $putParams['id'];
        $sousCategorie = $xml->xpath("//sous-categorie[@id='$id']");
        if (empty($sousCategorie)) {
            header('Content-Type: application/json');
            http_response_code(404);
            echo json_encode(['error' => "La sous-catégorie avec l'ID $id n'existe pas"]);
            exit;
        }
        $categorie_id = $putParams['categorie_id'];
        $parent = $sousCategorie[0]->xpath('parent::categorie')[0];
        if ($categorie_id != $parent['id']) {
            //dans ce cas la categorie id a changé, on aura à déplacer la sous catégorie avant la modification
            $nouveauParent = $xml->xpath("//categorie[@id='$categorie_id']")[0];
            $newsSousCategorie = $nouveauParent->addChild('sous-categorie');
            $newsSousCategorie->addAttribute('id', $sousCategorie[0]['id']);
            $newsSousCategorie->addAttribute('code', $sousCategorie[0]['code']);
            $newsSousCategorie->addAttribute('locale', $sousCategorie[0]['locale']);
            $newsSousCategorie->addAttribute('description', $sousCategorie[0]['description']);
            unset($sousCategorie[0][0]);
            $xml->asXML($xmlfile);
            $sousCategorie = $xml->xpath("//sous-categorie[@id='$id']");
        }
        $sousCategorie[0]['code'] = $putParams['code'];
        $sousCategorie[0]['locale'] = $putParams['locale'];
        $sousCategorie[0]['description'] = $putParams['description'];
        $xml->asXML($xmlfile);
        header('Content-Type: application/json');
        echo json_encode(['success' => 'Modification effectuée']);
        break;

    case 'DELETE':
        // Supprimer une catégorie par ID        
        parse_str(file_get_contents('php://input'), $deleteData);
        $id = (int)$deleteData['id'];
        $sousCategorie = $xml->xpath("//sous-categorie[@id='$id']");
        if (empty($sousCategorie)) {
            header('Content-Type: application/json');
            http_response_code(404);
            echo json_encode(['error' => "La sous-catégorie avec l'ID $id n'existe pas"]);
            exit;
        }
        unset($sousCategorie[0][0]);
        $xml->asXML($xmlfile);
        header('Content-Type: application/json');
        echo json_encode(['success' => 'Suppression effectuée']);
        break;
        
    default:
        http_response_code(405); // Méthode non autorisée
        break;
}