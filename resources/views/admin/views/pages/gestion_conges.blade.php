@extends('admin.views.layouts.app')
@section('title', 'Phenix ERP - Gestion des congés')
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
                        <h2 class="content-header-title float-left mb-0">Congés</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Congés</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Gestion des congés</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="content-body">
            <!-- Basic table -->
            <div class="container">
                <h2>Gestion des Congés</h2>

                <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#ajouterCongeModal">Ajouter un Congé</button>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Employé</th>
                            <th>Début</th>
                            <th>Fin</th>
                            <th>Statut</th>
                            <th>État</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($conges as $conge)
                        <tr>
                            <td>{{ $conge->employee->nom }} {{ $conge->employee->prenoms }}</td>
                            <td>{{ $conge->date_debut }}</td>
                            <td>{{ $conge->date_fin }}</td>
                            <td>{{ ucfirst($conge->statut) }}</td>
                            <td>
                                <span class="badge bg-{{ $conge->etat == 'en cours' ? 'warning' : 'success' }}">
                                    {{ ucfirst($conge->etat) }}
                                </span>
                            </td>
                            <td>
                                <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#editCongeModal-{{ $conge->id }}">Modifier</button>
                                <form action="{{ route('conges.terminer', $conge->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm">Terminer</button>
                                </form>
                                <form hidden action="{{ route('conges.destroy', $conge->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button hidden type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                                </form>
                            </td>
                        </tr>


                        <!-- Modal d'édition -->
                        <div class="modal fade" id="editCongeModal-{{ $conge->id }}" tabindex="-1" aria-labelledby="editCongeLabel-{{ $conge->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editCongeLabel-{{ $conge->id }}">Modifier le congé</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('conges.update', $conge->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')

                                            <div class="form-group">
                                                <label>Employé</label>
                                                <select name="employee_id" class="form-control">
                                                    <option value="{{ $conge->employee_id }}" {{ $conge->employee_id == $conge->employee_id ? 'selected' : '' }}>
                                                        {{ $conge->employee->nom }}  {{ $conge->employee->prenoms }}
                                                    </option>

                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label>Date début</label>
                                                <input type="date" name="date_debut" class="form-control" value="{{ $conge->date_debut }}">
                                            </div>

                                            <div class="form-group">
                                                <label>Date fin</label>
                                                <input type="date" name="date_fin" class="form-control" value="{{ $conge->date_fin }}">
                                            </div>

                                            <div class="form-group">
                                                <label>Statut</label>
                                                <select name="statut" class="form-control">
                                                    <option value="payé" {{ $conge->statut == 'payé' ? 'selected' : '' }}>Payé</option>
                                                    <option value="non payé" {{ $conge->statut == 'non payé' ? 'selected' : '' }}>Non payé</option>
                                                </select>
                                            </div>

                                            <button type="submit" class="btn btn-success">Enregistrer</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Modal Ajouter Congé -->
            <div class="modal fade" id="ajouterCongeModal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Ajouter un Congé</h5>
                            <button type="button" class="close" data-dismiss="modal">x</button>
                        </div>
                        <form action="{{ route('conges.store') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <label>Employé</label>
                                <select name="id_employee" class="form-control">
                                    @foreach(\App\Models\Employee::all() as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->nom }} {{ $employee->prenoms }}</option>
                                    @endforeach
                                </select>
                                <label>Date début</label>
                                <input type="date" name="date_debut" class="form-control">
                                <label>Date fin</label>
                                <input type="date" name="date_fin" class="form-control">
                                <label>Statut</label>
                                <select name="statut" class="form-control">
                                    <option value="payé">Payé</option>
                                    <option value="non payé">Non payé</option>
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Enregistrer</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--/ Basic table -->
        </div>
    </div>
</div>

@endsection



@push('script')


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
