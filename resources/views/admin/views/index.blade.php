@extends('admin.views.layouts.app')
@section('title', 'Phenix - Admin | Dashboard')
@section('pageCss')


    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="/app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/pages/app-chat.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/pages/app-chat-list.css">

    <!--
                                            <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/vendors.min.css">
                                            <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css">
                                            <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css">
                                            <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css">
                                            <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/tables/datatable/rowGroup.bootstrap4.min.css">
                                            <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css">
                                            END: Vendor CSS -->

    <!-- BEGIN: Theme CSS-->
    <!-- <link rel="stylesheet" type="text/css" href="/app-assets/css/bootstrap.css">
                                            <link rel="stylesheet" type="text/css" href="/app-assets/css/bootstrap-extended.css">
                                            <link rel="stylesheet" type="text/css" href="/app-assets/css/colors.css">
                                            <link rel="stylesheet" type="text/css" href="/app-assets/css/components.css">
                                            <link rel="stylesheet" type="text/css" href="/app-assets/css/themes/dark-layout.css">
                                            <link rel="stylesheet" type="text/css" href="/app-assets/css/themes/bordered-layout.css"> -->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="/app-assets/css/core/menu/menu-types/vertical-menu.css">
    <!-- END: Page CSS-->


    <!-- END: Page CSS-->
@endsection

@section('content')
    <div class="app-content content ">
        <div class="content-wrapper">
            <div class="content-header row">
            </div>

            <div class="content-body">
                <section id="dashboard-ecommerce">
                    <div class="row match-height">

                        <!-- Statistics Card -->

                        <div class="col-xl-12 col-md-6 col-12">
                            <div class="card card-statistics p-0">
                                <div class="card-header">
                                    <h4 class="card-title">Statistiques</h4>
                                    <div class="d-flex align-items-center">
                                        <p class="card-text font-small-2 mr-25 mb-0" id="last-updated">Updated
                                            {{ $updated_at->diffForHumans() }}
                                        </p>
                                    </div>
                                </div>
                                <div class="card-body p-0 statistics-body">
                                    <div class="row d-flex flex-wrap " style="">
                                        <div class="col-xl-4 col-sm-6  p-1 col-12 ">
                                            <div class="media border-primary p-1 rounded ">
                                                <div class="avatar bg-light-primary mr-2">
                                                    <div class="avatar-content">
                                                        <i data-feather="users" class="avatar-icon"></i>
                                                    </div>
                                                </div>
                                                <div class="media-body my-auto">
                                                    <h4 class="font-weight-bolder mb-0">{{ $employees->count() }}</h4>
                                                    <p class="card-text font-small-3 mb-0">Total des employés</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-sm-6  p-2 col-12 ">
                                            <div class="media border-info  p-1 rounded ">
                                                <div class="avatar bg-light-info mr-2">
                                                    <div class="avatar-content">
                                                        <i data-feather="dollar-sign" class="avatar-icon"></i>
                                                    </div>
                                                </div>
                                                <div class="media-body my-auto">
                                                    <h4 class="font-weight-bolder mb-0">
                                                        {{ number_format($payslips->sum('net_salary'), 2, ',', ' ') }}
                                                    </h4>
                                                    <p class="card-text font-small-3 mb-0">Paiements global</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 p-1 col-sm-6 col-12 ">
                                            <div class="media border-danger  p-1 rounded ">
                                                <div class="avatar bg-light-danger mr-2">
                                                    <div class="avatar-content">
                                                        <i data-feather="message-square" class="avatar-icon"></i>
                                                    </div>
                                                </div>
                                                <div class="media-body my-auto">
                                                    <h4 class="font-weight-bolder mb-0">{{ $employees->count() }}</h4>
                                                    <p class="card-text font-small-3 mb-0">Employés & prestataires
                                                        enregistrés</p>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>


                        {{-- <div class="col-xl-12 col-md-6 col-12">
                            <div class="card card-statistics">
                                <div class="card-header">
                                    <h4 class="card-title">Statistiques</h4>
                                    <div class="d-flex align-items-center">
                                        <p class="card-text font-small-2 mr-25 mb-0" id="last-updated">Updated
                                            {{ $updated_at->diffForHumans() }}
                                        </p>
                                    </div>
                                </div>
                                <div class="card-body statistics-body">
                                    <div class="row">
                                        <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                                            <div class="media">
                                                <div class="avatar bg-light-primary mr-2">
                                                    <div class="avatar-content">
                                                        <i data-feather="user" class="avatar-icon"></i>
                                                    </div>
                                                </div>
                                                <div class="media-body my-auto">
                                                    <h4 class="font-weight-bolder mb-0">{{ $employees->count() }}</h4>
                                                    <p class="card-text font-small-3 mb-0">Total des employés</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                                            <div class="media">
                                                <div class="avatar bg-light-info mr-2">
                                                    <div class="avatar-content">
                                                        <i data-feather="dollar-sign" class="avatar-icon"></i>
                                                    </div>
                                                </div>
                                                <div class="media-body my-auto">
                                                    <h4 class="font-weight-bolder mb-0">
                                                        {{ number_format($paymentRequests->sum('amount'), 2, ',', ' ') }}
                                                    </h4>
                                                    <p class="card-text font-small-3 mb-0">Paiements global</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
                                            <div class="media">
                                                <div class="avatar bg-light-danger mr-2">
                                                    <div class="avatar-content">
                                                        <i data-feather="users" class="avatar-icon"></i>
                                                    </div>
                                                </div>
                                                <div class="media-body my-auto">
                                                    <h4 class="font-weight-bolder mb-0">{{ $employees->count() }}</h4>
                                                    <p class="card-text font-small-3 mb-0">Employés & prestataires
                                                        enregistrés</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-sm-6 col-12">
                                            <div class="media">
                                                <div class="avatar bg-light-success mr-2">
                                                    <div class="avatar-content">
                                                        <i data-feather="tool" class="avatar-icon"></i>
                                                    </div>
                                                </div>
                                                <div class="media-body my-auto">
                                                    <h4 class="font-weight-bolder mb-0">
                                                        {{ $staffApplications->services_functionnels ?? 0 }}
                                                    </h4>
                                                    <p class="card-text font-small-3 mb-0">Services fonctionnels</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <!--/ Statistics Card -->


                        <div class="col-md-6">
                            <!-- Staff List -->
                            <div class="staff-list  mb-4 p-2  card shadow">
                                <h2>Staff List</h2>
                                <div class="table-wrapper">
                                    <table id="staff-table" class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Staff Name</th>
                                                <th>Staff Role</th>
                                                <th>Compte</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($employees->sortByDesc('created_at')->take(5) as $index => $employee)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $employee->nom }} {{ $employee->prenoms }}</td>
                                                    <td>{{ $employee->poste }}</td>
                                                    <td></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>



                        <div class="col-md-6">


                            <!-- Payment Requests Table -->
                            <div class="requests mb-4 p-2 card shadow">
                                <h2>Paiements récents</h2>

                                <div class="table-wrapper">
                                    <table id="paymentRequeststable" class="table table-wrapper table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Employé</th>
                                                <th>Déductions</th>
                                                <th>Montant payé</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($payslips->sortByDesc('created_at')->take(5) as $index => $payslip)
                                                <tr>
                                                    <td>{{ $index + 1}}</td>
                                                    <td>{{$payslip->employee->nom . ' ' . $payslip->employee->prenoms }}</td>
                                                    <td>{{$payslip->total_deductions}}</td>
                                                    <td>{{$payslip->net_salary}}</td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button class="btn btn-primary text-white btn-sm " type="button"
                                                                id="actionsMenu" data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                Actions
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-right"
                                                                aria-labelledby="dropdown-user">
                                                                <li>
                                                                    <a class="dropdown-item reject-action"
                                                                        href="/admin/payslips/{{$payslip->id}}"
                                                                        data-kyc-id="{{$payslip->id}}">Voir fiche de
                                                                        paiement
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>


                        <div class="row">


                            <div class="col-md-6">
                                <!-- Staff Applications Card -->
                                <div class="charts card p-2 shadow">
                                    <h2>Staff Applications Card</h2>
                                    <canvas id="staffChart" height="200px"></canvas>
                                </div>
                            </div>
                        </div>
                        <!-- memos dash end -->
                    </div>
                </section>
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
    <!-- <script src="../../../app-assets/vendors/js/vendors.min.js"></script> -->
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
        $(function () {
            'use strict';
            var memoTables = $('#staff-table');
            var paymentRequestsTable = $('#paymentRequeststable');

            var dt_memosTable = memoTables.DataTable({
                processing: true, // Show loading indicator while processing
                serverSide: false, // Set this to true if using server-side processing
                paging: true, // Enable pagination
                searching: true, // Enable searching
                ordering: true, // Enable sorting
                // lengthChange: true, // Allow changing page length
                info: true, // Display table info
                displayLength: 5,
                responsive: true, //
                dom: '<"top"f>rt<"bottom"ip><"clear">',
                language: {
                    paginate: {
                        first: "Premier",
                        last: "Dernier",
                        next: "Suivant",
                        previous: "Précédent"
                    },
                    emptyTable: "Aucune donnée disponible dans le tableau",
                    zeroRecords: "Aucune donnée trouvée",
                    info: "Affichage de _START_ à _END_ sur _TOTAL_ enregistrements",
                    infoEmpty: "Aucun enregistrement disponible",
                    infoFiltered: "(filtré de _MAX_ enregistrements au total)"
                }
            });

            $('#memoTables_filter input').attr('placeholder', 'Rechercher un employés...');


            var dt_paymentRequestsTable = paymentRequestsTable.DataTable({
                processing: true, // Show loading indicator while processing
                serverSide: false, // Set this to true if using server-side processing
                paging: true, // Enable pagination
                searching: true, // Enable searching
                ordering: true, // Enable sorting
                // lengthChange: true, // Allow changing page length
                info: true, // Display table info
                displayLength: 5,
                responsive: true, //
                dom: '<"top"f>rt<"bottom"ip><"clear">',
                order: [
                    [0, 'desc']
                ],
                language: {
                    paginate: {
                        first: "Premier",
                        last: "Dernier",
                        next: "Suivant",
                        previous: "Précédent"
                    },
                    emptyTable: "Aucune donnée disponible dans le tableau",
                    zeroRecords: "Aucune donnée trouvée",
                    info: "Affichage de _START_ à _END_ sur _TOTAL_ enregistrements",
                    infoEmpty: "Aucun enregistrement disponible",
                    infoFiltered: "(filtré de _MAX_ enregistrements au total)"
                }
            });

        });
        $('#paymentRequeststable_filter input').attr('placeholder', 'Rechercher un employés...');

        const ctx = document.getElementById('staffChart').getContext('2d');
        const staffChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Pending', 'Approved', 'Rejected'],
                datasets: [{
                    label: 'Staff Applications',
                    data: [
                        `{{ $staffApplications->pending ?? 0 }}`,
                        `{{ $staffApplications->approved ?? 0 }}`,
                        `{{ $staffApplications->rejected ?? 0 }}`
                    ],
                    backgroundColor: ['#FDD835', '#4CAF50', '#F44336'],
                }]
            }
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <!-- -->
    <!-- BEGIN: Vendor JS-->
    <!-- <script src="../../../app-assets/vendors/js/vendors.min.js"></script> -->
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
        $(function () {
            'use strict';

            var dt_debats_table = $('#debatsTable');


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
                    displayLength: 7,
                    lengthMenu: [7, 10, 25, 50, 75, 100],
                    buttons: [{
                        extend: 'collection',
                        className: 'btn btn-outline-secondary dropdown-toggle mr-2',
                        text: feather.icons['share'].toSvg({
                            class: 'font-small-4 mr-50'
                        }) + 'Export',
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

@endpush