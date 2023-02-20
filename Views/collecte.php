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
                        <table id="table-collecte" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Indicateur ID</th>
                                    <th scope="col">Indicateur</th>
                                    <th scope="col">Fréquence</th>
                                    <th scope="col">Zone de référence</th>
                                    <th scope="col">Unité de mesure</th>
                                    <th scope="col">2019</th>
                                    <th scope="col">2020</th>
                                    <th scope="col">2021</th>
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
            $indicateurs = all("indicateur");
            // echo "<pre>"; print_r($indicateurs); exit;
        ?>

    </div>

    </div>
</section>

<!-- addModal -->
<div class="modal fade" id="addModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title">Nouvelle collecte</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span style="color: white;" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="addForm">
                <div class="modal-body mt-3">
                    <div class="form-group">
                        <label for="code">Indicateur</label>
                        <select name="indicateur_id" id="indicateur_id" class="custom-select">
                            <option value=""></option>
                            <?php foreach($indicateurs as $indicateur): ?>  
                                <option value="<?= $indicateur['id'] ?>"><?= $indicateur['code'].' - '.$indicateur['description'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="frequence">Fréquence</label>
                        <input type="text" class="form-control" name="values[frequence]" id="frequence" required>
                    </div>
                    <div class="form-group">
                        <label for="zone_reference">Zone de référence</label>
                        <input type="text" class="form-control" name="values[zone_reference]" id="zone_reference" required>
                    </div>
                    <div class="form-group">
                        <label for="unite_mesure">Unité de mesure</label>
                        <input type="text" class="form-control" name="values[unite_mesure]" id="unite_mesure" required>
                    </div>
                    <div class="form-group">
                        <label for="valeur_annee_2019">Valeur 2019</label>
                        <input type="text" class="form-control" name="values[valeur_annee_2019]" id="valeur_annee_2019" required>
                    </div>
                    <div class="form-group">
                        <label for="valeur_annee_2020">Valeur 2020</label>
                        <input type="text" class="form-control" name="values[valeur_annee_2020]" id="valeur_annee_2020" required>
                    </div>
                    <div class="form-group">
                        <label for="valeur_annee_2021">Valeur 2021</label>
                        <input type="text" class="form-control" name="values[valeur_annee_2021]" id="valeur_annee_2021" required>
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
                        <label for="code">Indicateur</label>
                        <select name="indicateur_id" id="m_indicateur_id" class="custom-select">
                            <option value=""></option>
                            <?php foreach($indicateurs as $indicateur): ?>
                                <option value="<?= $indicateur['id'] ?>"><?= $indicateur['code'].' - '.$indicateur['description'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="frequence">Fréquence</label>
                        <input type="text" class="form-control" name="values[frequence]" id="m_frequence" required>
                    </div>
                    <div class="form-group">
                        <label for="zone_reference">Zone de référence</label>
                        <input type="text" class="form-control" name="values[zone_reference]" id="m_zone_reference" required>
                    </div>
                    <div class="form-group">
                        <label for="unite_mesure">Unité de mesure</label>
                        <input type="text" class="form-control" name="values[unite_mesure]" id="m_unite_mesure" required>
                    </div>
                    <div class="form-group">
                        <label for="valeur_annee_2019">2019</label>
                        <input type="text" class="form-control" name="values[valeur_annee_2019]" id="m_valeur_annee_2019" required>
                    </div>
                    <div class="form-group">
                        <label for="valeur_annee_2020">2020</label>
                        <input type="text" class="form-control" name="values[valeur_annee_2020]" id="m_valeur_annee_2020" required>
                    </div>
                    <div class="form-group">
                        <label for="valeur_annee_2021">2021</label>
                        <input type="text" class="form-control" name="values[valeur_annee_2021]" id="m_valeur_annee_2021" required>
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

var controller = "./Controllers/collecte.php";

var tableCollecte = $("#table-collecte");

var datatable_collecte = tableCollecte.DataTable({
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
		{ "data": "indicateur_id" },
		{ "data": "indicateur_code" },
		{ "data": "frequence" },
		{ "data": "zone_reference" },
		{ "data": "unite_mesure" },
		{ "data": "valeur_annee_2019" },
		{ "data": "valeur_annee_2020" },
		{ "data": "valeur_annee_2021" },
		{ "data": null, 
			"defaultContent": "<button class='btn btn-sm text-secondary update-btn'><i class='fas fa-edit fa-lg' aria-hidden='true'></i></button>" +
			"<button class='btn btn-sm text-dark delete-btn'><i class='fas fa-trash fa-lg' aria-hidden='true'></i></button>" 
		}
	],
    "columnDefs": [{
        "targets": [1],
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
    var indicateur_id = $('#indicateur_id').val();
    var frequence = $('#frequence').val();
    var zone_reference = $('#zone_reference').val();
    var unite_mesure = $('#unite_mesure').val();
    var valeur_annee_2019 = $('#valeur_annee_2019').val();
    var valeur_annee_2020 = $('#valeur_annee_2020').val();
    var valeur_annee_2021 = $('#valeur_annee_2021').val();

    $.ajax({
        url: controller,
        type: "POST",
        data: {
            indicateur_id: indicateur_id,
            frequence: frequence,
            zone_reference: zone_reference,
            unite_mesure: unite_mesure,
            valeur_annee_2019: valeur_annee_2019,
            valeur_annee_2020: valeur_annee_2020,
            valeur_annee_2021: valeur_annee_2021
        },
        cache: false,
        success: function(data) {

            // var data = JSON.parse(data);

            console.log(data);

            if(data.success) {
				datatable_collecte.ajax.reload(null, true);
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
	var data = datatable_collecte.row(row).data();

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
				datatable_collecte.ajax.reload(null, true);
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
	var data = datatable_collecte.row(row).data();

    $('#editModal').modal('show');

	$('#m_id').val(data.id);
	$('#m_indicateur_id').val(data.indicateur_id);
	$('#m_frequence').val(data.frequence);
	$('#m_zone_reference').val(data.zone_reference);
	$('#m_unite_mesure').val(data.unite_mesure);
	$('#m_valeur_annee_2019').val(data.valeur_annee_2019);
	$('#m_valeur_annee_2020').val(data.valeur_annee_2020);
	$('#m_valeur_annee_2021').val(data.valeur_annee_2021);

});

$('#upBtn').on('click', function() {

    var data = {
        id: $('#m_id').val(),
        indicateur_id: $('#m_indicateur_id').val(),
        frequence: $('#m_frequence').val(),
        zone_reference : $('#m_zone_reference').val(),
        unite_mesure : $('#m_unite_mesure').val(),
        valeur_annee_2019 : $('#m_valeur_annee_2019').val(),
        valeur_annee_2020 : $('#m_valeur_annee_2020').val(),
        valeur_annee_2021 : $('#m_valeur_annee_2021').val(),
    }

	$.ajax({
        url: controller,
		method: "PUT",
		data: data,
		success: function(data) {
            // var data = JSON.parse(data);
            console.log(data);

            if(data.success) {
                datatable_collecte.ajax.reload(null, true);
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