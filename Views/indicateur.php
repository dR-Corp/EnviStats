<section class="content">
    <div class="container-fluid">

        <?php include(COMPONENTS.'header_buttons.php') ?>

        <div class="row">
            <div class="col-sm-12">
                <div class="card elevation-3">
                    <div class="card-body table-responsive">
                        <style>
                        td {
                            white-space: nowrap;
                        }
                        </style>
                        <table id="table-indicateur" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Code</th>
                                    <th scope="col">Sous categorie ID</th>
                                    <th scope="col">Sous categorie</th>
                                    <th scope="col">Locale</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>

        <?php
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $api_url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);            
            $sous_categories = curl_exec($ch);
            $sous_categories = json_decode($sous_categories, true);
            curl_close($ch);
            // echo "<pre>"; print_r($sous_categories); exit;
        ?>

    </div>

    </div>
</section>

<!-- addModal -->
<div class="modal fade" id="addModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title">Nouvel indicateur</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span style="color: white;" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="addForm">
                <div class="modal-body mt-3">
                    <div class="form-group">
                        <label for="code">Sous catégorie</label>
                        <select name="sous_categorie_id" id="sous_categorie_id" class="custom-select">
                            <option value=""></option>
                            <?php foreach($sous_categories as $sous_categorie): ?>
                                <option value="<?= $sous_categorie['id'] ?>"><?= $sous_categorie['code'].' - '.$sous_categorie['description'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="code">Code</label>
                        <input type="text" class="form-control" name="values[code]" id="code" required>
                    </div>
                    <div class="form-group">
                        <label for="locale">Locale</label>
                        <input type="text" class="form-control" name="values[locale]" id="locale" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="values[description]" id="description" cols="30" rows="3"
                            class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button id="saveBtn" class="btn btn-block font-weight-bold btn-info">Valider</button>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- editModal -->
<div class="modal fade" id="editModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-secondary">
                <h4 class="modal-title">Modification</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span style="color: white;" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="editForm">
                <input type="hidden" class="form-control" name="values[id]" id="m_id" required>
                <div class="modal-body mt-3">
                    <div class="form-group">
                        <label for="code">Sous catégorie</label>
                        <select name="sous_categorie_id" id="m_sous_categorie_id" class="custom-select">
                            <option value=""></option>
                            <?php foreach($sous_categories as $sous_categorie): ?>
                                <option value="<?= $sous_categorie['id'] ?>"><?= $sous_categorie['code'].' - '.$sous_categorie['description'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="code">Code</label>
                        <input type="text" class="form-control" name="values[code]" id="m_code" required>
                    </div>
                    <div class="form-group">
                        <label for="locale">Locale</label>
                        <input type="text" class="form-control" name="values[locale]" id="m_locale" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="values[description]" id="m_description" cols="30" rows="3"
                            class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button id="upBtn" class="btn btn-block font-weight-bold btn-secondary">Valider</button>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script>

var controller = "./Controllers/indicateur.php";

var tableIndicateur = $("#table-indicateur");

var datatable_indicateur = tableIndicateur.DataTable({
    "deferRender": true,
    "drawCallback": function(setting, json) {
        $('a').css('cursor', 'pointer');
    },
    "ajax": {
        "url": controller,
        "method": "GET",
        "dataSrc": ""
    },
	"columns": [
		{ "data": "id" },
		{ "data": "code" },
		{ "data": "sous_categorie_id" },
		{ "data": "sous_categorie_code" },
		{ "data": "locale" },
		{ "data": "description" },
		{ "data": null, 
			"defaultContent": "<button class='btn btn-sm text-secondary update-btn'><i class='fas fa-edit fa-lg' aria-hidden='true'></i></button>" +
			"<button class='btn btn-sm text-dark delete-btn'><i class='fas fa-trash fa-lg' aria-hidden='true'></i></button>" 
		}
	],
    "columnDefs": [{
        "targets": [2],
        "visible": false,
        "searchable": true
    }],
    "responsive": false,
    "autoWidth": false,
    "order": [],
    "language": {
        "sEmptyTable": "Aucune donnée disponible dans le tableau",
        "sInfo": "Affichage de l'élément _START_ à _END_ sur _TOTAL_ éléments",
        "sInfoEmpty": "Affichage de l'élément 0 à 0 sur 0 élément",
        "sInfoFiltered": "(filtré à partir de _MAX_ éléments au total)",
        "sInfoPostFix": "",
        "sInfoThousands": ",",
        "sLengthMenu": "Afficher _MENU_ éléments",
        "sLoadingRecords": '<div><i class="fa fa-3x fa-spinner fa-spin"></i><div class="text-bold pt-2">Chargement...</div></div>',
        "sProcessing": '<div><i class="fas fa-3x fa-sync-alt fa-spin"></i><div class="text-bold pt-2">Traitement...</div></div>',
        "sSearch": "Rechercher :",
        "sZeroRecords": "Aucun élément correspondant trouvé",
        "oPaginate": {
            "sFirst": "Premier",
            "sLast": "Dernier",
            "sNext": "Suivant",
            "sPrevious": "Précédent"
        },
        "oAria": {
            "sSortAscending": ": activer pour trier la colonne par ordre croissant",
            "sSortDescending": ": activer pour trier la colonne par ordre décroissant"
        },
        "select": {
            "rows": {
                "_": "%d lignes sélectionnées",
                "0": "Aucune ligne sélectionnée",
                "1": "1 ligne sélectionnée"
            }
        }
    }
});

$('#addBtn').on('click', function() {
    $('#addModal').modal('show');
})

$('#saveBtn').on('click', function() {
    var code = $('#code').val();
    var sous_categorie_id = $('#sous_categorie_id').val();
    var locale = $('#locale').val();
    var description = $('#description').val();

    $.ajax({
        url: controller,
        type: "POST",
        data: {
            code: code,
            sous_categorie_id: sous_categorie_id,
            locale: locale,
            description: description
        },
        cache: false,
        success: function(data) {

            // var data = JSON.parse(data);

            console.log(data);

            if(data.success) {
				datatable_indicateur.ajax.reload(null, true);
				//En cas de succès envoyer une alert
				const Toast = Swal.mixin({
					toast: true,
					position: 'bottom',
					showConfirmButton: false,
					timer: 5000
				});
				Toast.fire({
					icon: 'success',
					title: data.success
				});

                $('#code').val('');
                $('#description').val('');

				$('#addModal').modal('hide');
			}

        },
        error: function(jqXHR, textStatus, errorThrown) {
            const Toast = Swal.mixin({
                toast: true,
                position: 'bottom',
                showConfirmButton: false,
                timer: 3000
            });
            Toast.fire({
                icon: textStatus,
                title: errorThrown + ' : ' + JSON.parse(jqXHR.responseText).error
            });
        }
    })
})

// Supprimer une catégorie
$(document).on('click', '.delete-btn', function() {
    
	var row = $(this).closest('tr');
	var data = datatable_indicateur.row(row).data();

	$.ajax({
		url: controller,
		method: 'DELETE',
        data: {
            id: data.id,
        },
        cache: false,
		success: function(response) {
			// var response = JSON.parse(response);
			console.log(response);
			if(response.success) {
				datatable_indicateur.ajax.reload(null, true);
				const Toast = Swal.mixin({
					toast: true,
					position: 'bottom',
					showConfirmButton: false,
					timer: 5000
				});
				Toast.fire({
					icon: 'success',
					title: response.success
				});
			}
		},
        error: function(jqXHR, textStatus, errorThrown) {
            const Toast = Swal.mixin({
                toast: true,
                position: 'bottom',
                showConfirmButton: false,
                timer: 3000
            });
            Toast.fire({
                icon: textStatus,
                title: errorThrown + ' : ' + JSON.parse(jqXHR.responseText).error
            });
        }
	});
});

$(document).on('click', '.update-btn', function() {
	
    var row = $(this).closest('tr');
	var data = datatable_indicateur.row(row).data();

    $('#editModal').modal('show');

	$('#m_id').val(data.id);
	$('#m_code').val(data.code);
	$('#m_sous_categorie_id').val(data.sous_categorie_id);
	$('#m_locale').val(data.locale);
	$('#m_description').val(data.description);

});

$('#upBtn').on('click', function() {

    var data = {
        id: $('#m_id').val(),
        code: $('#m_code').val(),
        sous_categorie_id: $('#m_sous_categorie_id').val(),
        locale: $('#m_locale').val(),
        description : $('#m_description').val()
    }

	$.ajax({
        url: controller,
		method: "PUT",
		data: data,
		success: function(data) {
            // var data = JSON.parse(data);
            console.log(data);

            if(data.success) {
                datatable_indicateur.ajax.reload(null, true);
                //En cas de succès envoyer une alert
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'bottom',
                    showConfirmButton: false,
                    timer: 5000
                });
                Toast.fire({
                    icon: 'success',
                    title: data.success
                });

                $('#m_id').val('');
                $('#m_code').val('');
                $('#m_locale').val('');
                $('#m_description').val('');

                $('#editModal').modal('hide');
            }

        },
        error: function(jqXHR, textStatus, errorThrown) {
            const Toast = Swal.mixin({
                toast: true,
                position: 'bottom',
                showConfirmButton: false,
                timer: 3000
            });
            Toast.fire({
                icon: textStatus,
                title: errorThrown + ' : ' + JSON.parse(jqXHR.responseText).error
            });
        }
	});

});

$.ajax({
	url: controller,
	type: "GET",
	cache: false,
	success: function(data) {
		console.log(data);
	}
})

</script>