<?php

	session_start();
	include_once("config.php");
	MyAutoload::start();

	include_once(CONTROLLERS."functions.php");

	// if(isset($_GET['page'])) {
	// 	$page_element = $_GET['page'];
	// 	$element_parent = ($page_element == "scategorie") ? "categorie" : ($page_element == "indicateur" ? "scategorie" : "indicateur");
	// 	$api_url = "http://localhost/EnviStats/Controllers/".$element_parent.".php";
	// }

    $page = isset($_GET['page']) ? $_GET['page'].".php" : "dashboard.php";

    include(VIEWS.'layout.php');

?>