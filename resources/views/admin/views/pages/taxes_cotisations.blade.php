@extends('admin.views.layouts.app')
@section('title', 'Phenix ERP - Taxes et Cotisations')
@section('pageCss')
<link rel="stylesheet" type="text/css" href="/app-assets/css/core/menu/menu-types/vertical-menu.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/pages/app-chat.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/pages/app-chat-list.css">
@endsection
@section('content')
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Taxes et Cotisations</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Taxes et Cotisations</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="content-body">

            <div class="tab-pane" id="taxeCotisation" aria-labelledby="information-tab" role="tabpanel">
                <!-- users edit Info form start -->
                <div class="shadow card">
                    <div class="card-header d-flex justify-content-between">
                        <h4 class="m-">Créer une taxe</h4>

                        <button class="btn btn-primary" id="creTx">Créer une taxe</button>
                    </div>
                    <div class="p-2 d-none" id="createTaxFormHolder">
                        <form id="createTaxForm" method="POST">
                            @csrf
                            @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                            @endif

                            @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                            @endif
                            <div class="row g-3">
                                <!-- Titre -->
                                <div class="col-md-4">
                                    <label for="nom" class="form-label">Nom de la taxe | Cotisation</label>
                                    <input type="text" id="nom" name="name" class="form-control" placeholder="Entrer un nom" required>
                                </div>

                                <!-- Type de taxe -->
                                <div class="col-md-4">
                                    <label for="type_taxe" class="form-label">Type</label>
                                    <select id="type_taxe" name="base_calculation" class="form-select form-control" required>
                                        <option selected>Choisir un type de taxe</option>
                                        <option value="impot">Impot</option>
                                        <option value="cnss">CNSS</option>
                                        <option value="irpp">IRPP</option>
                                        <option value="wht">WHT</option>
                                        <option value="nhs">NHS</option>
                                        <option value="vat">VAT</option>
                                    </select>
                                </div>

                                <!-- Valeur en % -->
                                <div class="col-md-4">
                                    <label for="taxe" class="form-label">Valeur en %</label>
                                    <input type="number" name="rate" id="taxe" class="form-control" placeholder="Entrer un %" required>
                                </div>
                            </div>
                            <div>
                                <label for="is_active">Est active ?</label>
                                <input type="checkbox" id="edit_is_active" name="is_active" checked>
                            </div>

                            <!-- Submit Button -->
                            <div class="mt-4">
                                <button type="submit" class="btn btn-warning">Créer une taxe</button>
                            </div>



                            <!-- Dropdown for payroll periods -->

                        </form>
                    </div>

                    <div class="p-2">
                        <div class="mt-4">
                            <h4>
                                Liste des taxes
                            </h4>
                        </div>
                        <table class="table datatable-basic">
                            <thead>
                                <th>SN</th>
                                <th>Nom</th>
                                <th>Taux</th>
                                <th>Actions</th>
                            </thead>
                            <tbody>
                                @foreach($taxe->reverse() as $key => $tax)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{$tax->name}}</td>
                                    <td>{{$tax->rate}}</td>
                                    <td>
                                        <!-- Edit Button -->
                                        <button data-target="editTaxModal" class="btn btn-sm btn-primary edit-tax"
                                            data-id="{{ $tax->id }}"
                                            data-name="{{ $tax->name }}"
                                            data-rate="{{ $tax->rate }}">
                                            Éditer
                                        </button>

                                        <!-- Delete Button -->
                                        <form action="{{ route('taxe.destroy', $tax->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr?');">
                                                Supprimer
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>

                <!-- users edit Info form ends -->
            </div>
        </div>
    </div>
</div>


<!-- Bootstrap Modal -->
<div class="modal fade" id="editTaxModal" tabindex="-1" aria-labelledby="editTaxModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTaxModalLabel">Modifier la Taxe</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editTaxForm" method="PUT">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" name="id" id="tax_id">

                    <div class="form-group">
                        <label>Nom</label>
                        <input type="text" class="form-control" name="name" id="tax_name" required>
                    </div>

                    <div class="form-group">
                        <label>Taux</label>
                        <input type="number" step="0.01" class="form-control" name="rate" id="tax_rate" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-success">Mettre à jour</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection



@push('scripts')


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<!-- -->
<!-- BEGIN: Vendor JS-->
<script src="../../../app-assets/vendors/js/vendors.min.js"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="../../../app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js"></script>
<script src="../../../app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js"></script>
<script src="../../../app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js"></script>
<script src="../../../app-assets/vendors/js/tables/datatable/responsive.bootstrap4.js"></script>
<script src="../../../app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js"></script>
<script src="../../../app-assets/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
<script src="../../../app-assets/vendors/js/tables/datatable/jszip.min.js"></script>
<script src="../../../app-assets/vendors/js/tables/datatable/pdfmake.min.js"></script>
<script src="../../../app-assets/vendors/js/tables/datatable/vfs_fonts.js"></script>
<script src="../../../app-assets/vendors/js/tables/datatable/buttons.html5.min.js"></script>
<script src="../../../app-assets/vendors/js/tables/datatable/buttons.print.min.js"></script>
<script src="../../../app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js"></script>
<script src="../../../app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>
<!-- BEGIN: Page JS-->
<!-- <script src="/app-assets/js/scripts/tables/table-datatables-basic.js"></script> -->
<!-- END: Page JS-->

<script>
    $(document).ready(function() {
        $('.edit-tax').on('click', function() {
            let id = $(this).data('id');
            let name = $(this).data('name');
            let rate = $(this).data('rate');

            $('#tax_id').val(id);
            $('#tax_name').val(name);
            $('#tax_rate').val(rate);

            // Set the action URL for the form dynamically
            $('#editTaxForm').attr('data-id',  id);

            $('#editTaxModal').modal('show');
        });
    });

    $(document).ready(function() {

        $('#creTx').on('click', function() {
            var taxH = $('#createTaxFormHolder');
            if (taxH.hasClass('d-none')) {
                taxH.removeClass('d-none');
            } else {
                taxH.addClass('d-none');
            }
        });


        $('#createTaxForm').on('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission

            // Get form data
            var formData = $(this).serialize();

            $.ajax({
                url: "{{ route('taxes.store') }}", // Ensure this is the correct route
                type: "POST",
                data: formData,
                success: function(response) {
                    // Handle success
                    if (response.status === 'success') {
                        toastr.success(response.message); // Display Toastr success message
                        // Optionally, you can clear the form

                        $('#createTaxForm')[0].reset();
                        location.reload();
                    }
                },
                error: function(xhr) {
                    // Handle error
                    var errorMessage = 'An error occurred while processing your request.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }
                    toastr.error(errorMessage); // Display Toastr error message
                }
            });
        });

        $('#editTaxForm').on('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission

            // Get form data
            var formData = $(this).serialize();
            var id = $(this).data('id'); // Get the ID of the tax to be updated

            $.ajax({
                url: `/taxes/update/${id}`, // Ensure this is the correct route
                type: "PUT",
                data: formData,
                success: function(response) {
                    // Handle success
                    if (response.status === 'success') {
                        toastr.success(response.message); // Display Toastr success message
                        // Optionally, you can clear the form

                        $('#createTaxForm')[0].reset();
                        location.reload();
                    }
                },
                error: function(xhr) {
                    // Handle error
                    var errorMessage = 'An error occurred while processing your request.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }
                    toastr.error(errorMessage); // Display Toastr error message
                }
            });
        });
    });

    $(function() {
        'use strict';

        var dt_debats_table = $('#debatsTable');

        window.table = dt_debats_table;

        if (dt_debats_table.length) {
            var dt_debats = dt_debats_table.DataTable({
                processing: true, // Show loading indicator while processing
                serverSide: false, // Set this to true if using server-side processing
                paging: true, // Enable pagination
                searching: true, // Enable searching
                ordering: true, // Enable sorting
                lengthChange: true, // Allow changing page length
                info: true, // Display table info
                dom: '<"card-header border-bottom p-1"<"head-label"><"dt-action-buttons text-right"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                displayLength: 10,
                lengthMenu: [7, 10, 25, 50, 75, 100],
                buttons: [{
                        extend: 'collection',
                        className: 'btn btn-outline-secondary dropdown-toggle mr-2',
                        text: feather.icons['share'].toSvg({
                            class: 'font-small-4 mr-50'
                        }) + 'Exporter',
                        buttons: [{
                                extend: 'print',
                                text: feather.icons['printer'].toSvg({
                                    class: 'font-small-4 mr-50'
                                }) + 'Print',
                                className: 'dropdown-item',
                                exportOptions: {
                                    columns: [3, 4, 5, 6, 7]
                                }
                            },
                            {
                                extend: 'csv',
                                text: feather.icons['file-text'].toSvg({
                                    class: 'font-small-4 mr-50'
                                }) + 'Csv',
                                className: 'dropdown-item',
                                exportOptions: {
                                    columns: [3, 4, 5, 6, 7]
                                }
                            },
                            {
                                extend: 'excel',
                                text: feather.icons['file'].toSvg({
                                    class: 'font-small-4 mr-50'
                                }) + 'Excel',
                                className: 'dropdown-item',
                                exportOptions: {
                                    columns: [3, 4, 5, 6, 7]
                                }
                            },
                            {
                                extend: 'pdf',
                                text: feather.icons['clipboard'].toSvg({
                                    class: 'font-small-4 mr-50'
                                }) + 'Pdf',
                                className: 'dropdown-item',
                                exportOptions: {
                                    columns: [3, 4, 5, 6, 7]
                                }
                            },
                            {
                                extend: 'copy',
                                text: feather.icons['copy'].toSvg({
                                    class: 'font-small-4 mr-50'
                                }) + 'Copy',
                                className: 'dropdown-item',
                                exportOptions: {
                                    columns: [3, 4, 5, 6, 7]
                                }
                            }
                        ]
                    },
                    {
                        text: feather.icons['plus'].toSvg({
                            class: 'mr-50 font-small-4'
                        }) + 'Ajouter un sujet',
                        className: 'create-new btn btn-primary',
                        attr: {
                            'data-toggle': 'modal',
                            'data-target': '#modals-slide-in'
                        }
                    }
                ],
                responsive: true,
                language: {
                    search: "Rechercher:",
                    lengthMenu: "Afficher _MENU_ sujets KYC par page",
                    info: "Affichage de _START_ à _END_ sur _TOTAL_ sujets",
                    infoEmpty: "Aucun enregistrement disponible",
                    infoFiltered: "(filtré à partir de _MAX_ sujets au total)",
                    paginate: {
                        first: "Premier",
                        last: "Dernier",
                        next: "Suivant",
                        previous: "Précédent"
                    },
                    emptyTable: "Aucune donnée disponible dans le tableau",
                }
            });
            $('div.head-label').html('<h6 class="mb-0">Liste des sujets de débats</h6>');
            $('#debatsTable_filter input').attr('placeholder', 'Rechercher un sujet...');

        }

    });
</script>

<script>
    window.filterStatus = (tables, status) => {
        table.column(6).search(status).draw();
    };
</script>
@endpush
