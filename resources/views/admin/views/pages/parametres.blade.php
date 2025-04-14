@extends('admin.views.layouts.app')
@section('title', 'Phenix ERP - Paramètres')
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
                            <h2 class="content-header-title float-left mb-0">Paramètres</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Paramètres</a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="content-body">
                <!-- Basic table -->

                <!--/ Basic table -->
                <section class="app-user-edit">
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-pills" role="tablist">

                                <li class="nav-item">
                                    <a class="nav-link d-flex align-items-center active" id="profil-Entreprise"
                                        data-toggle="tab" href="#profilEntreprise" aria-controls="social" role="tab"
                                        aria-selected="false">
                                        <i data-feather="user"></i><span class="d-none d-sm-block">Profil de
                                            l'entreprise</span>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link d-flex align-items-center" id="salaire-tab" data-toggle="tab"
                                        href="#definition" aria-controls="account" role="tab" aria-selected="true">
                                        <i data-feather="dollar-sign"></i><span class="d-none d-sm-block">Définition de
                                            salaire</span>
                                    </a>
                                </li>
                                <li hidden class="nav-item">
                                    <a class="nav-link d-flex align-items-center" id="payList-tab" data-toggle="tab"
                                        href="#payList" aria-controls="social" role="tab" aria-selected="false">
                                        <i data-feather="list"></i><span class="d-ne d-sm-block">Listes de paiements</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link d-flex align-items-center" id="fichepaie-tab" data-toggle="tab"
                                        href="#exoFsci" aria-controls="social" role="tab" aria-selected="false">
                                        <i data-feather="file"></i><span class="d-none d-sm-block">Créer une période
                                            d'exercice fiscal</span>
                                    </a>
                                </li>
                                <div class="p-1">
                                    <li class="badge badge-pill badge-light-danger" id="errorHolder"></li>
                                </div>
                            </ul>
                            <div class="tab-content">
                                <!-- Account Tab starts -->
                                <div class="tab-pane" id="definition" aria-labelledby="account-tab" role="tabpanel">
                                    <!-- users edit media object start -->
                                    <div class="shadow card">
                                        <div class="card-header">
                                            <h4 class="m-">Créer une définition de salaire</h4>
                                        </div>
                                        <div class="p-2">
                                            <form>
                                                <div class="row g-3">

                                                    <div class="col-md-4">
                                                        <label for="titre" class="form-label">Titre</label>
                                                        <div class="custom-dropdown">
                                                            <input type="text" id="titre-search"
                                                                class="form-control search-input" placeholder="Search..."
                                                                onkeyup="filterDropdown(this)">
                                                            <div class="dropdown-options">
                                                                <div class="option" data-value="1">PDG</div>
                                                                <div class="option" data-value="2">Superviseur</div>
                                                                <div class="option" data-value="3">RH</div>
                                                                <div class="option" data-value="4">Comptable</div>
                                                                <div class="option" data-value="5">Employées</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <style>
                                                        .custom-dropdown {
                                                            position: relative;
                                                            width: 100%;
                                                        }

                                                        .search-input {
                                                            width: 100%;
                                                            padding: 10px;
                                                            margin-bottom: 5px;
                                                            box-sizing: border-box;
                                                        }

                                                        .dropdown-options {
                                                            position: absolute;
                                                            top: 100%;
                                                            left: 0;
                                                            right: 0;
                                                            max-height: 150px;
                                                            overflow-y: auto;
                                                            border: 1px solid #ddd;
                                                            border-radius: 5px;
                                                            background: #fff;
                                                            z-index: 1000;
                                                            display: none;
                                                        }

                                                        .dropdown-options .option {
                                                            padding: 10px;
                                                            cursor: pointer;
                                                        }

                                                        .dropdown-options .option:hover {
                                                            background: #f0f0f0;
                                                        }

                                                        .custom-dropdown.active .dropdown-options {
                                                            display: block;
                                                        }
                                                    </style>



                                                    <!-- Grade -->
                                                    <div class="col-md-4">
                                                        <label for="grade" class="form-label">Grade</label>
                                                        <select id="grade" class="form-select form-control">
                                                            <option selected>Choisir un grade</option>
                                                            <option value="1">Grade 1</option>
                                                            <option value="2">Grade 2</option>
                                                            <option value="3">Grade 3</option>
                                                        </select>
                                                    </div>

                                                    <!-- Salaire de base -->
                                                    <div class="col-md-4">
                                                        <label for="salaireBase" class="form-label">Salaire de base</label>
                                                        <input type="number" class="form-control" id="salaireBase"
                                                            placeholder="Entrer un montant">
                                                    </div>

                                                    <!-- Allocation -->
                                                    <div class="col-md-4">
                                                        <label for="allocation" class="form-label">Allocation</label>
                                                        <input type="number" class="form-control" id="allocation"
                                                            placeholder="Entrer un montant">
                                                    </div>

                                                    <!-- Salaire brut -->
                                                    <div class="col-md-4">
                                                        <label for="salaireBrut" class="form-label">Salaire brut</label>
                                                        <input type="number" class="form-control" id="salaireBrut"
                                                            placeholder="Entrer un montant">
                                                    </div>

                                                    <!-- Deductions -->
                                                    <div class="col-md-4">
                                                        <label for="deductions" class="form-label">Deductions</label>
                                                        <input type="number" class="form-control" id="deductions"
                                                            placeholder="Entrer un montant">
                                                    </div>

                                                    <!-- Salaire net -->
                                                    <div class="col-md-4">
                                                        <label for="salaireNet" class="form-label">Salaire net</label>
                                                        <input type="number" class="form-control" id="salaireNet"
                                                            placeholder="Entrer un montant">
                                                    </div>
                                                </div>

                                                <!-- Submit Button -->
                                                <div class="mt-4">
                                                    <button type="submit" class="btn btn-warning">Créer une définition de
                                                        salaire</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>


                                <!-- Social Tab starts -->
                                <div class="tab-pane  active" id="profilEntreprise" aria-labelledby="social-tab"
                                    role="tabpanel">
                                    <!-- users edit social form start -->

                                    <form id="create-company-form" method="POST"
                                        action="{{ isset($company) ? route('company.update', $company->id) : route('companies.store') }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @if(isset($company))
                                            @method('PUT')
                                        @endif

                                        <div class="tab-content">
                                            <div class="tab-pane active" id="account" aria-labelledby="account-tab"
                                                role="tabpanel">
                                                <div class="media mb-2 border p-3 rounded">
                                                    <img id="profile-image"
                                                        src="/{{ $company->logo ?? 'https://cdn-icons-png.flaticon.com/512/149/149071.png' }}"
                                                        alt="Logo de l'entreprise"
                                                        class="user-avatar users-avatar-shadow rounded mr-2 my-25 cursor-pointer"
                                                        height="90" width="90" />
                                                    <div class="media-body mt-50">
                                                        <label for="this">Logo de l'entreprise</label>
                                                        <br>
                                                        <div class="col-12 d-flex mt-1 px-0">
                                                            <label class="btn btn-primary mr-75 mb-0"
                                                                for="change-dp-picture">
                                                                <span class="d-none d-sm-block">Choisir une photo</span>
                                                                <input class="form-control" hidden type="file"
                                                                    id="change-dp-picture" name="logo"
                                                                    accept="image/png, image/jpeg, image/jpg" />
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="nom">Nom de la structure</label>
                                                            <input type="text" class="form-control" id="nom" name="nom"
                                                                value="{{ $company->nom ?? '' }}"
                                                                placeholder="Nom de l'entreprise" required />
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="ifu">IFU</label>
                                                            <input type="text" class="form-control" id="ifu" name="ifu"
                                                                value="{{ $company->ifu ?? '' }}"
                                                                placeholder="65xxxxxxxx (13 caractères)" required />
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="date_creation">Date de création</label>
                                                            <input type="date" class="form-control" id="date_creation"
                                                                name="date_creation"
                                                                value="{{ $company->date_creation ?? '' }}" required />
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="adresse">Adresse</label>
                                                            <input type="text" class="form-control" id="adresse"
                                                                name="adresse" value="{{ $company->adresse ?? '' }}"
                                                                placeholder="Adresse" required />
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="telephone">Téléphone</label>
                                                            <input type="text" class="form-control" id="telephone"
                                                                name="telephone" value="{{ $company->telephone ?? '' }}"
                                                                placeholder="Téléphone" required />
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="email">Email</label>
                                                            <input type="email" class="form-control" id="email" name="email"
                                                                value="{{ $company->email ?? '' }}" placeholder="Email"
                                                                required />
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                                    <button type="submit" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">
                                                        {{ isset($company) ? 'Mettre à jour' : 'Soumettre' }}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                    <!-- users edit social form ends -->
                                </div>

                                <div class="tab-pane" id="exoFsci" aria-labelledby="payer-emp" role="tabpanel">
                                    <div class="container">
                                        <h2>Gestion des périodes d'exercice fiscal</h2>

                                        <!-- Bouton pour générer automatiquement la période -->
                                        <div class="d-flex justify-content-between">
                                            <form action="{{ route('periodes.generate') }}" method="POST">
                                                @csrf
                                                <button type="submit" name="generate_all" value="1" class="btn btn-success">
                                                    Générer automatiquement Période pour les 12 Mois
                                                </button>
                                            </form>


                                            <!-- Bouton pour ouvrir le modal de création -->
                                            <button type="button" class="btn btn-info" data-toggle="modal"
                                                data-target="#createPeriodeModal">
                                                Ajouter une période fiscale
                                            </button>
                                        </div>


                                        @if(session('success'))
                                            <div class="alert alert-success mt-3">{{ session('success') }}</div>
                                        @endif


                                        @if(session('error'))
                                            <div class="alert alert-danger mt-3">{{ session('error') }}</div>
                                        @endif
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        <table class="table mt-4">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Date Début</th>
                                                    <th>Date Fin</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Boutons pour ouvrir les modals d'édition -->
                                                @foreach ($periodes as $periode)
                                                    <tr>
                                                        <td>{{ $periode->id }}</td>
                                                        <td>{{ $periode->date_debut }}</td>
                                                        <td>{{ $periode->date_fin }}</td>
                                                        <td>
                                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                                data-target="#editPeriodeModal-{{ $periode->id }}">
                                                                Modifier
                                                            </button>
                                                            <form action="{{ route('periodes.destroy', $periode->id) }}"
                                                                method="POST" style="display:inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger"
                                                                    onclick="return confirm('Supprimer cette période ?')">Supprimer</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>



                                <!-- Social Tab ends -->
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>



    <!-- Modal de création -->
    <div class="modal fade" id="createPeriodeModal" tabindex="-1" aria-labelledby="createPeriodeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createPeriodeModalLabel">Créer une période fiscale</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">x</button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('periodes.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="date_debut" class="form-label">Date de début</label>
                            <input type="date" class="form-control" id="date_debut" name="date_debut" required>
                        </div>
                        <div class="mb-3">
                            <label for="date_fin" class="form-label">Date de fin</label>
                            <input type="date" class="form-control" id="date_fin" name="date_fin" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Créer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal d'édition -->
    @foreach ($periodes as $periode)
        <div class="modal fade" id="editPeriodeModal-{{ $periode->id }}" tabindex="-1"
            aria-labelledby="editPeriodeModalLabel-{{ $periode->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editPeriodeModalLabel-{{ $periode->id }}">Modifier la période fiscale</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">x</button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('periodes.update', $periode->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="date_debut" class="form-label">Date de début</label>
                                <input type="date" class="form-control" id="date_debut" name="date_debut"
                                    value="{{ $periode->date_debut }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="date_fin" class="form-label">Date de fin</label>
                                <input type="date" class="form-control" id="date_fin" name="date_fin"
                                    value="{{ $periode->date_fin }}" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Mettre à jour</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

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

        document.addEventListener("DOMContentLoaded", function () {
            let hash = window.location.hash; // Get the ID from URL (e.g., #exoFsci)

            if (hash) {
                let activeTab = document.querySelector(`a[href="${hash}"]`); // Find the corresponding tab link
                if (activeTab) {
                    let tabInstance = new bootstrap.Tab(activeTab); // Bootstrap tab activation
                    tabInstance.show();
                }
            }
        });
        document.addEventListener('DOMContentLoaded', function () {






            const getProfileCompany = function () {
                $.ajax({
                    url: '/api/get-company',
                    type: 'GET',
                    success: function (response) {
                        console.log(response);
                        $('#company_name').text(response.company_name);
                    },
                    error: function (error) {
                        console.error(error);
                    }
                });
            }

            // getProfileCompany();
            var CompanyForm = document.getElementById('create-company-form');

            // CompanyForm.addEventListener('submit', function(e) {
            //     e.preventDefault();
            //     var formData = new FormData(CompanyForm);

            //     $.ajax({
            //         url: '/companies/store',
            //         type: 'POST',
            //         data: formData,
            //         contentType: false,
            //         processData: false,
            //         success: function(response) {
            //             console.log(response);
            //         },
            //         error: function(error) {
            //             console.error(error);
            //         }
            //     });
            // })

            document.getElementById('create-company-form').addEventListener('submit', function (e) {
                e.preventDefault();

                var formData = new FormData(this);
                var formAction = this.getAttribute('action');

                $.ajax({
                    url: formAction,
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if (response.success) {
                            alert(response.message);
                            showToast(response.message, 'success');
                        } else {
                            showToast("Une erreur inattendue s'est produite.", 'error');
                        }
                    },
                    error: function (xhr) {
                        let errorMessage = "Une erreur s'est produite. Veuillez réessayer.";

                        // Check if response is JSON and contains a message
                        if (xhr.responseJSON) {
                            if (xhr.responseJSON.message) {
                                errorMessage = xhr.responseJSON.message;
                            } else if (xhr.responseJSON.errors) {
                                // Handle validation errors (e.g., Laravel form validation)
                                errorMessage = Object.values(xhr.responseJSON.errors).flat().join('<br>');
                            }
                        }

                        showToast(errorMessage, 'error');
                    }
                });

            });

            /**
             * Function to display toast messages
             */


        });

        const profileImage = document.getElementById('profile-image');
        const fileInput = document.getElementById('change-dp-picture');
        const labelPhoto = document.getElementById('photo-label');
        const photoIdentiteInput = document.getElementById('photo_identite');
        // const removePhotoButton = document.getElementById('remove-photo');
        const removePhotoMobileButton = document.getElementById('remove-photo-mobile');
        const labelText = document.getElementById('label-photo');


        // Handle file input change
        fileInput.addEventListener('change', function (event) {
            // alert('Hello world');
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    // Update the profile image with the selected file
                    profileImage.src = e.target.result;
                    // Show "Changer photo" option
                    labelText.innerText = "Choisir une autre photo";
                    labelPhoto.classList.remove("btn-primary");
                    labelPhoto.classList.add("btn-warning");
                    // Display the remove button
                    // removePhotoButton.classList.remove("d-none");
                    removePhotoMobileButton.classList.remove("d-none");
                };
                reader.readAsDataURL(file);
            }
        });

        // Handle remove photo button click
        // removePhotoButton.addEventListener('click', function() {
        //     profileImage.src = "https://cdn-icons-png.flaticon.com/512/149/149071.png";
        //     labelText.innerText = "Choisir une photo";
        //     labelPhoto.classList.remove("btn-warning");
        //     labelPhoto.classList.add("btn-primary");
        //     removePhotoButton.classList.add("d-none");
        //     removePhotoMobileButton.classList.add("d-none");
        //     fileInput.value = ''; // Reset the input value
        // });

        // removePhotoMobileButton.addEventListener('click', function() {
        //     removePhotoButton.click(); // Trigger the same action for mobile
        // });

        $(function () {
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