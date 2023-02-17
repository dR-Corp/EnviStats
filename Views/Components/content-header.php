<?php

if($page== 'dashboard.php'):
	$title = "Dashboard";
elseif($page== 'categorie.php'):
	$title = "Categories";
elseif($page== 'scategorie.php'):
	$title = "Sous-categories";
elseif($page== 'indicateur.php'):
	$title = "Indicateurs";
elseif($page== 'collecte.php'):
	$title = "Collectes";
endif;

?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><?= $title ?></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a class="text-success" href="./">EnviStats</a></li>
                    <li class="breadcrumb-item active"><?= $title ?></li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>