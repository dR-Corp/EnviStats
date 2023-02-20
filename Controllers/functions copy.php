<?php

// Fonction pour envoyer une requête HTTP en utilisant cURL
function sendRequest($method, $element, $data = null) {
    $element != "sous-categorie" ? $element : "scategorie";
    $url = 'http://localhost/Envistats/Controllers/'.$element.'.php';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    if ($data) {
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    }
    
    $response = curl_exec($ch);
    curl_close($ch);
    
    return $response;
}

// Récupérer toutes les catégories
function all($element) {
    $response = sendRequest('GET', $element);
    $categories = json_decode($response, true);
    return $categories;
}

// Récupérer une catégorie par ID
function get($element, $data) {
    // $data = http_build_query([
    //     'id' => 1,
    // ]);
    $data = http_build_query($data);
    $response = sendRequest('GET', $element, $data);
    $category = json_decode($response, true);
    return $category;
}

// Ajouter une catégorie
function save($element, $data) {
    // $data = http_build_query([
    //     'code' => 'NEW',
    //     'description' => 'Nouvelle catégorie'
    // ]);
    $data = http_build_query($data);
    $response = sendRequest('POST', $element, $data);
    $result = json_decode($response, true);
    return $result;
}

// Modifier une catégorie par ID
function edit($element, $data) {
    // $data = http_build_query([
    //     'id' => 1,
    //     'code' => 'NEW_CODE',
    //     'description' => 'Nouvelle description'
    // ]);
    $data = http_build_query($data);
    $response = sendRequest('PUT', $element, $data);
    $result = json_decode($response, true);
    return $result;
}

// Supprimer une catégorie par ID
function delete($element, $data) {
    // $data = http_build_query([
    //     'id' => 1,
    // ]);
    $data = http_build_query($data);
    $response = sendRequest('DELETE', $element, $data);
    $result = json_decode($response, true);
    return $result;
}