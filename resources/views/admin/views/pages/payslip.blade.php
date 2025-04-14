@extends('admin.views.layouts.app')
@section('title', 'Phenix ERP - Etat des paiements')
@section('pageCss')
    <link rel="stylesheet" type="text/css" href="/app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/pages/app-chat.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/pages/app-chat-list.css">


    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/plugins/forms/pickers/form-flat-pickr.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/app-invoice.css">
    <!-- END: Page CSS-->

    <style>

    </style>
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
                            <h2 class="content-header-title float-left mb-0">Paiements</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="/admin/etats_paiements">Etat des Paiements</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Bon de paiement</a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="content-body">
                <section class="invoice-preview-wrapper">
                    <div class="row invoice-preview">
                        <!-- Invoice -->


                        <div id="loader" class="col-xl-9 col-md-8 w-100 text-center">
                            {{-- <div class="spinner-border" role="status">
                            </div> --}}
                            <span class="visually-hidden  mt-4">chargement...</span>
                        </div>
                        <iframe class=" col-xl-9 col-md-8 w-100 vh-100" height="700px"
                            src="{{ url('/admin/generate-pdf/' . $payslip->id) }}" onload="hideLoader()"
                            frameborder="0"></iframe>

                        <!-- /Invoice -->

                        <script>
                            // Function to hide the loader once the iframe has loaded
                            function hideLoader() {
                                document.getElementById('loader').style.display = 'none';
                            }
                        </script>
                        <!-- Invoice Actions -->
                        <div class="col-xl-3 col-md-4 col-12 invoice-actions mt-md-0 mt-2">
                            <div class="card">
                                <div class="card-body">
                                    <a href="{{ url('/admin/download-generate-pdf/' . $payslip->id) }}">
                                        <button class="btn btn-primary btn-block btn-download-invoice mb-75">Télécharger PDF</button>
                                    </a>
{{-- 
                                    <button
                                        class="btn btn-outline-secondary btn-block btn-download-invoice mb-75">Télécharger</button> --}}
                                    {{-- <a class="btn btn-outline-secondary btn-block mb-75" href="#" onclick="printInvoice()">
                                        Imprimer
                                    </a> --}}
                                    {{-- <a class="btn btn-outline-secondary btn-block mb-75" href="#" onclick="editBon();">
                                        Modifier </a> --}}
                                    <a class="btn btn-outline-secondary btn-block mb-75 d-none" id="saveIn" href="#"
                                        onclick="saveBon();"> Enregistrer </a>

                                </div>
                            </div>
                        </div>
                        <!-- /Invoice Actions -->
                    </div>
                </section>

                <!-- Send Invoice Sidebar -->

            </div>
        </div>
    </div>




@endsection


@push('scripts')
    <script>
        function editBon() {
            document.getElementById('editResult').classList.remove('d-none');
            document.getElementById('displayResult').classList.add('d-none');
            document.getElementById("saveIn").classList.remove('d-none');
            document.getElementById("bon_id").disabled = false;
            document.getElementById("bon_date").disabled = false;
            document.getElementById("bon_client_id").disabled = false;
            document.getElementById("bon_montant").disabled = false;
        }

        function saveBon() {
            document.getElementById('editResult').classList.add('d-none');
            document.getElementById('displayResult').classList.remove('d-none');
            document.getElementById("saveIn").classList.add('d-none');
            document.getElementById("bon_id").disabled = true;
            document.getElementById("bon_date").disabled = true;
            document.getElementById("bon_client_id").disabled = true;
            document.getElementById("bon_montant").disabled = true;
            calculateTotal();
        }


        function calculateTotal() {
            let taxRate = parseFloat(document.getElementById('taxRate').value) || 0;
            let taxAmount = parseFloat(document.getElementById('taxAmount').value) || 0;
            let transportAllowance = parseFloat(document.getElementById('transportAllowance').value) || 0;
            let housingAllowance = parseFloat(document.getElementById('housingAllowance').value) || 0;

            let totalDeductions = taxAmount;
            let totalAllowances = transportAllowance + housingAllowance;
            let baseSalary = parseFloat("{{ $employee->base_salary }}") || 0;
            let netSalary = baseSalary + totalAllowances - totalDeductions;

            document.getElementById('totalDeductions').innerText = totalDeductions.toFixed(2);
            document.getElementById('transportTotal').innerText = transportAllowance.toFixed(2);
            document.getElementById('housingTotal').innerText = housingAllowance.toFixed(2);
            document.getElementById('netSalary').innerText = netSalary.toFixed(2);
        }

        function printInvoice() {
            let printContent = document.querySelector('.invoice-preview-card').outerHTML;
            let originalContent = document.body.outerHTML;
            document.body.innerHTML = printContent;
            window.print();
            document.body.innerHTML = originalContent;
            location.reload();
        }
    </script>
@endpush