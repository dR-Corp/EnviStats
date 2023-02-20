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
        // Vérifier si un ID d'indicateur a été spécifié
        if (isset($_GET['id'])) {
            $id = (int) $_GET['id'];
            // Récupérer l'indicateur correspondant à l'ID
            $indicateur = $xml->xpath("//indicateur[@id='$id']");
            if (empty($indicateur)) {
                // L'indicateur n'existe pas
                header('Content-Type: application/json');
                http_response_code(404);
                echo json_encode(['error' => "L'indicateur avec l'ID $id n'existe pas"]);
                exit;
            } else {
                // Retourner l'indicateur demandé
                $attributs = $indicateur[0]->attributes();
                $sousCategorie = $indicateur[0]->xpath('parent::sous-categorie')[0];
                // $categorie = $sousCategorie->xpath('parent::categorie')[0];
                $indicateur = [
                    'id' => (string) $attributs['id'],
                    'code' => (string) $attributs['code'],
                    'locale' => (string) $attributs['locale'],
                    'description' => (string) $attributs['description'],
                    'sous_categorie_id' => (string) $sousCategorie['id'],
                    'sous_categorie_code' => (string) $sousCategorie['code'],
                    // 'categorie_id' => (string) $categorie['id'],
                    // 'categorie_code' => (string) $categorie['code'],
                    // 'frequence' => (string) $indicateur[0]->donnees['frequence'],
                    // 'zone_reference' => (string) $indicateur[0]->donnees['zone_reference'],
                    // 'unite_mesure' => (string) $indicateur[0]->donnees['unite_mesure'],
                ];
                header('Content-Type: application/json');
                echo json_encode($indicateur);
                exit;
            }
        } else {
            // Vérifier si une sous-catégorie a été spécifiée
            if (isset($_GET['sous_categorie_id'])) {
                $sous_categorie_id = $_GET['sous_categorie_id'];
                $sousCategorie = $xml->xpath("//sous-categorie[@id='$sous_categorie_id']");
                if (empty($sousCategorie)) {
                    // Aucun indicateur n'a été trouvé pour la sous-catégorie demandée
                    header('Content-Type: application/json');
                    http_response_code(404);
                    echo json_encode(['error' => "La sous-catégorie avec l'ID $sous_categorie_id n'existe pas"]);
                    exit;
                } else {
                    // Retourner tous les indicateurs de la sous-catégorie demandée
                    $indicateurs = [];
                    foreach ($sousCategorie[0]->indicateur as $indicateur) {
                        $attributs = $indicateur->attributes();
                        $indicateurs[] = [
                            'id' => (string) $attributs['id'],
                            'code' => (string) $attributs['code'],
                            'locale' => (string) $attributs['locale'],
                            'description' => (string) $attributs['description'],
                            'sous_categorie_id' => (string) $sous_categorie_id,
                            'sous_categorie_code' => (string) $sousCategorie[0]['code']
                        ];
                    }
                    header('Content-Type: application/json');
                    echo json_encode($indicateurs);
                    exit;
                }
            }
            else {
                // Récupérer toutes les indicateurs
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
                header('Content-Type: application/json');
                echo json_encode($indicateurs);
                exit;
            }
        }
        break;

        case 'POST':
            //Vérification que la sous catégorie parente existe
            $sous_categorie_id = $_POST['sous_categorie_id'];
            $sous_categorie = $xml->xpath("//sous-categorie[@id='$sous_categorie_id']");
            $sous_categorie_code = $sous_categorie[0]['code'];
            if (empty($sous_categorie)) {
                header('Content-Type: application/json');
                http_response_code(404);
                echo json_encode(['error' => "La sous catégorie avec l'ID $sous_categorie_id n'existe pas"]);
                exit;
            }
            // Vérification que l'indicateur' n'existe pas déjà
            $code = $_POST['code'];
            $indicateur = $sous_categorie[0]->xpath("indicateur[@code='$code']");
            if (!empty($indicateur)) {
                header('Content-Type: application/json');
                http_response_code(409);
                echo json_encode(['error' => "L'indicateur $code existe déjà dans la catégorie $categorie_code."]);
                exit;
            }
            // Création du nouvel indicateur
            $indicateurs = $xml->xpath('//indicateur[last()]');
            $lastIndicateur = end($indicateurs);
            $lastIndicateurId = (int) $lastIndicateur['id'];
            $newIndicateurId = $lastIndicateurId + 1;
            // ajout
            $newIndicateur = $sous_categorie[0]->addChild('indicateur');
            $newIndicateur->addAttribute('id', $newIndicateurId);
            $newIndicateur->addAttribute('code', $_POST['code']);
            $newIndicateur->addAttribute('locale', $_POST['locale']);
            $newIndicateur->addAttribute('description', $_POST['description']);
            $xml->asXML($xmlfile);
            header('Content-Type: application/json');
            http_response_code(201);
            echo json_encode(['success' => 'Enregistrement effectué']);
            break;

            case 'PUT':
                // Modifier une catégorie par ID
                parse_str(file_get_contents("php://input"), $putParams);
                $id = $putParams['id'];
                $indicateur = $xml->xpath("//indicateur[@id='$id']");
                if (empty($indicateur)) {
                    header('Content-Type: application/json');
                    http_response_code(404);
                    echo json_encode(['error' => "L'indicateur avec l'ID $id n'existe pas"]);
                    exit;
                }
                $sous_categorie_id = $putParams['sous_categorie_id'];
                $parent = $indicateur[0]->xpath('parent::sous-categorie')[0];
                if ($sous_categorie_id != $parent['id']) {
                    //dans ce cas la categorie id a changé, on aura à déplacer la sous catégorie avant la modification
                    $nouveauParent = $xml->xpath("//sous-categorie[@id='$sous_categorie_id']")[0];
                    $newIndicateur = $nouveauParent->addChild('indicateur');
                    $newIndicateur->addAttribute('id', $indicateur[0]['id']);
                    $newIndicateur->addAttribute('code', $indicateur[0]['code']);
                    $newIndicateur->addAttribute('locale', $indicateur[0]['locale']);
                    $newIndicateur->addAttribute('description', $indicateur[0]['description']);
                    unset($indicateur[0][0]);
                    $xml->asXML($xmlfile);
                    $indicateur = $xml->xpath("//indicateur[@id='$id']");
                }
                $indicateur[0]['code'] = $putParams['code'];
                $indicateur[0]['locale'] = $putParams['locale'];
                $indicateur[0]['description'] = $putParams['description'];
                $xml->asXML($xmlfile);
                header('Content-Type: application/json');
                echo json_encode(['success' => 'Modification effectuée']);
                break;

        case 'DELETE':
            // Supprimer une catégorie par ID        
            parse_str(file_get_contents('php://input'), $deleteData);
            $id = (int)$deleteData['id'];
            $indicateur = $xml->xpath("//indicateur[@id='$id']");
            if (empty($indicateur)) {
                header('Content-Type: application/json');
                http_response_code(404);
                echo json_encode(['error' => "L'indicateur avec l'ID $id n'existe pas"]);
                exit;
            }
            unset($indicateur[0][0]);
            $xml->asXML($xmlfile);
            header('Content-Type: application/json');
            echo json_encode(['success' => 'Suppression effectuée']);
            break;

    default:
        http_response_code(405); // Méthode non autorisée
        break;
}