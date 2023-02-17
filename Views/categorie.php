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
                        <table id="table-categorie" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Code</th>
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
            // // URL de l'API CRUD
            // $apiUrl = 'http://localhost/Controllers/categories.php';
            // // Requête de récupération de toutes les catégories
            // $getCategories = curl_init($apiUrl);
            // curl_setopt($getCategories, CURLOPT_RETURNTRANSFER, true);
            // $categories = json_decode(curl_exec($getCategories));
            // curl_close($getCategories);
        ?>

    </div>

    </div>
</section>

<!-- addModal -->
<div class="modal fade" id="addModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title">Nouvelle catégorie</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span style="color: white;" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="addForm">
                <div class="modal-body mt-3">
                    <div class="form-group">
                        <label for="code">Code</label>
                        <input type="text" class="form-control" name="values[code]" id="code" required>
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
                        <label for="code">Code</label>
                        <input type="text" class="form-control" name="values[code]" id="m_code" required>
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

var tableCategorie = $("#table-categorie");

var datatable_categorie = tableCategorie.DataTable({
    "deferRender": true,
    "drawCallback": function(setting, json) {
        $('a').css('cursor', 'pointer');
    },
    "ajax": {
        "url": "./Controllers/categorie.php",
        "method": "GET",
        "dataSrc": ""
    },
	"columns": [
		{ "data": "id" },
		{ "data": "code" },
		{ "data": "description" },
		{ "data": null, 
			"defaultContent": "<button class='btn btn-sm text-secondary update-btn'><i class='fas fa-edit fa-lg' aria-hidden='true'></i></button>" +
			"<button class='btn btn-sm text-dark delete-btn'><i class='fas fa-trash fa-lg' aria-hidden='true'></i></button>" 
		}
	],
    "columnDefs": [{
        "targets": [],
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
    var description = $('#description').val();

    $.ajax({
        url: "./Controllers/categorie.php",
        type: "POST",
        data: {
            code: code,
            description: description
        },
        cache: false,
        success: function(data) {

            var data = JSON.parse(data);

            console.log(data);

            if(data.success) {
				datatable_categorie.ajax.reload(null, true);
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
	var data = datatable_categorie.row(row).data();

	$.ajax({
		url: './Controllers/categorie.php',
		method: 'DELETE',
        data: {
            id: data.id,
        },
        cache: false,
		success: function(response) {
			var response = JSON.parse(response);
			console.log(response);
			if(response.success) {
				datatable_categorie.ajax.reload(null, true);
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
		}
	});
});

$(document).on('click', '.update-btn', function() {
	
    var row = $(this).closest('tr');
	var data = datatable_categorie.row(row).data();

    $('#editModal').modal('show');

	$('#m_id').val(data.id);
	$('#m_code').val(data.code);
	$('#m_description').val(data.description);

});

$('#upBtn').on('click', function() {

    var data = {
        id: $('#m_id').val(),
        code: $('#m_code').val(),
        description : $('#m_description').val()
    }

	$.ajax({
        url: "./Controllers/categorie.php",
		method: "PUT",
		data: data,
		success: function(data) {
            var data = JSON.parse(data);
            console.log(data);

            if(data.success) {
                datatable_categorie.ajax.reload(null, true);
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
	url: "./Controllers/categorie.php",
	type: "GET",
	cache: false,
	success: function(data) {

		var datas = JSON.parse(data);

		console.log(datas);

	}
})

</script>