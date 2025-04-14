@extends('admin.views.layouts.app')
@section('title', 'Phenix ERP - Créer un nouvel employé')
@section('pageCss')
<link rel="stylesheet" type="text/css" href="/app-assets/css/core/menu/menu-types/vertical-menu.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/pages/app-chat.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/pages/app-chat-list.css">
<!-- BEGIN: Vendor CSS-->
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/vendors.min.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/forms/select/select2.min.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css">
<!-- END: Vendor CSS-->

<!-- BEGIN: Theme CSS-->
<link rel="stylesheet" type="text/css" href="/app-assets/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/bootstrap-extended.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/colors.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/components.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/themes/dark-layout.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/themes/bordered-layout.css">

<!-- BEGIN: Page CSS-->
<link rel="stylesheet" type="text/css" href="/app-assets/css/core/menu/menu-types/vertical-menu.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/plugins/forms/pickers/form-flat-pickr.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/plugins/forms/form-validation.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/pages/app-user.css">
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
                        <h2 class="content-header-title float-left mb-0">Employés</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item"><a href="/admin/employes">Gestions des employés</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Ajouter un nouvel employé</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="content-body">
            <!-- Basic table -->
            <section class="app-user-edit">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-pills" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center active" id="account-tab" data-toggle="tab" href="#account" aria-controls="account" role="tab" aria-selected="true">
                                    <i data-feather="user"></i><span class="d-none d-sm-block">Informations personnelles</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center" id="information-tab" data-toggle="tab" href="#information" aria-controls="information" role="tab" aria-selected="false">
                                    <i data-feather="info"></i><span class="d-none d-sm-block">Détails professionnels</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center" id="social-tab" data-toggle="tab" href="#social" aria-controls="social" role="tab" aria-selected="false">
                                    <i data-feather="share-2"></i><span class="d-none d-sm-block">Informations salariales</span>
                                </a>
                            </li>
                            @if (session('success'))
                            <p class="badge badge-pill badge-light-success">{{ session('success') }} <a href="{{ route('employees') }}">Voir liste</a></p>
                            @endif
                            @if (session('error'))
                            <p class="badge badge-pill badge-light-danger">{{ session('error') }}</p>
                            @endif
                            <div class="p-1">
                                <li class="badge badge-pill badge-light-danger" id="errorHolder"></li>
                            </div>
                        </ul>
                        <form id="create-employee-form">
                            <div class="tab-content">
                                <!-- Account Tab starts -->
                                <div class="tab-pane active" id="account" aria-labelledby="account-tab" role="tabpanel">
                                    <!-- users edit media object start -->

                                    <div class="media mb-2 border p-3 rounded">
                                        <!-- Default User Icon Image -->
                                        <img id="profile-image" src="https://cdn-icons-png.flaticon.com/512/149/149071.png" alt="Avatar de l'utilisateur" class="user-avatar users-avatar-shadow rounded mr-2 my-25 cursor-pointer" height="90" width="90" />
                                        <div class="media-body mt-50">
                                            <!-- File Input Section -->
                                            <label for="this">Photo de profil</label>
                                            <br>
                                            <div class="col-12 d-flex mt-1 px-0">
                                                <!-- Button for selecting or changing photo -->
                                                <label class="btn btn-primary mr-75 mb-0" for="change-dp-picture" id="label-photo">
                                                    <span class="d-none d-sm-block" id="photo-label">Choisir une photo</span>
                                                    <input class="form-control" type="file" id="change-dp-picture" hidden accept="image/png, image/jpeg, image/jpg" />
                                                    <span class="d-block d-sm-none">
                                                        <i class="mr-0" data-feather="edit"></i>
                                                    </span>
                                                </label>
                                                <!-- Button for removing photo (hidden initially) -->
                                                <button class="btn btn-outline-secondary d-none" id="remove-photo">Retirer</button>
                                                <button class="btn btn-outline-secondary d-block d-sm-none" id="remove-photo-mobile">
                                                    <i class="mr-0" data-feather="trash-2"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- users edit account form start -->
                                    <div class="row">
                                        <!-- Nom -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="nom">Nom</label>
                                                <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom" required />
                                            </div>
                                        </div>
                                        <!-- Prénoms -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="prenoms">Prénoms</label>
                                                <input type="text" class="form-control" id="prenoms" name="prenoms" placeholder="Prénoms" required />
                                            </div>
                                        </div>
                                        <!-- Date de naissance -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="date_naissance">Date de naissance</label>
                                                <input type="date" class="form-control" id="date_naissance" name="date_naissance" required />
                                            </div>
                                        </div>
                                        <!-- Sexe -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="sexe">Sexe</label>
                                                <select class="form-control" id="sexe" name="sexe" required>
                                                    <option value="Masculin">Masculin</option>
                                                    <option value="Féminin">Féminin</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- État civil -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="etat_civil">État civil</label>
                                                <select class="form-control" id="etat_civil" name="etat_civil" required>
                                                    <option value="Mr">Mr</option>
                                                    <option value="Mme">Mme</option>
                                                    <option value="Mlle">Mlle</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- Adresse -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="adresse">Adresse</label>
                                                <input type="text" class="form-control" id="adresse" name="adresse" placeholder="Adresse" required />
                                            </div>
                                        </div>
                                        <!-- Téléphone -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="telephone">Téléphone</label>
                                                <input type="text" class="form-control" id="telephone" name="telephone" placeholder="Téléphone" required />
                                            </div>
                                        </div>
                                        <!-- Email -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control" id="email" name="email" placeholder="Email" required />
                                            </div>
                                        </div>
                                        <!-- Photo d'identité -->
                                        <div hidden class="col-md-4">
                                            <div class="form-group">
                                                <label for="photo_identite">Photo d'identité</label>
                                                <input type="file" class="form-control" id="photo_identite" name="photo_identite" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                        <button type="button" id="suivant-1" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Suivant</button>
                                        <button type="reset" class="btn btn-outline-secondary">Réinitialiser</button>
                                    </div>
                                </div>

                                <!-- Account Tab ends -->

                                <!-- Information Tab starts -->
                                <div class="tab-pane" id="information" aria-labelledby="information-tab" role="tabpanel">
                                    <!-- users edit Info form start -->
                                    <div class="row">
                                        <!-- Poste -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="employee_id">Identifiant Unique pour l'employé</label>
                                                <input type="text" class="form-control" id="employee_id" name="employee_id" placeholder="EPCDXXXX" required />
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="poste">Poste</label>
                                                <input type="text" class="form-control" id="poste" name="poste" placeholder="Poste" required />
                                            </div>
                                        </div>
                                        <!-- Département -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="departement">Département</label>
                                                <input type="text" class="form-control" id="departement" name="departement" placeholder="Département" required />
                                            </div>
                                        </div>
                                        <!-- Date d'embauche -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="date_embauche">Date d'embauche</label>
                                                <input type="date" class="form-control" id="date_embauche" name="date_embauche" required />
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="nombre_heure_assignee">Nombre d'heure assignée (par semaine)</label>
                                                <input type="number" class="form-control" id="nombre_heure_assigne" name="nombre_heure_sem_assignee">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="nombre_heure_assignee">Nombre d'heure assignée (par mois)</label>
                                                <input type="number" readonly class="form-control" id="nombre_heure_assignee" name="nombre_heure_assignee">
                                            </div>
                                        </div>
                                        <!-- Type de contrat -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="type_de_contrat">Type de contrat</label>
                                                <select class="form-control" id="type_de_contrat" name="type_de_contrat" required>
                                                    <option value="CDI">CDI</option>
                                                    <option value="CDD">CDD</option>
                                                    <option value="Freelance">Freelance</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- Durée du contrat -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="duree_contrat">Durée du contrat (en mois)</label>
                                                <input type="number" class="form-control" id="duree_contrat" name="duree_contrat" placeholder="Durée" />
                                            </div>
                                        </div>
                                        <!-- Lieu d'affectation -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="lieu_affectation">Lieu d'affectation</label>
                                                <input type="text" class="form-control" id="lieu_affectation" name="lieu_affectation" placeholder="Lieu" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                        <button type="button" id="suivant-2" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Suivant</button>
                                        <button type="reset" class="btn btn-outline-secondary">Réinitialiser</button>
                                    </div>
                                    <!-- users edit Info form ends -->
                                </div>
                                <!-- Information Tab ends -->

                                <!-- Social Tab starts -->
                                <div class="tab-pane" id="social" aria-labelledby="social-tab" role="tabpanel">
                                    <!-- users edit social form start -->

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="num_ifu">Numéro IFU</label>
                                                <input type="number" class="form-control" maxlength="13" id="num_ifu" name="num_ifu" placeholder="Numero CNSS" required />
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="num_securite_sociale">Numéro de sécurité social</label>
                                                <input type="number" class="form-control" id="num_securite_sociale" name="num_securite_sociale" placeholder="Numero CNSS" required />
                                            </div>
                                        </div>
                                        <!-- Salaire de base -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="salaire_base">Salaire de base</label>
                                                <input type="number" class="form-control" id="salaire_base" name="salaire_base" placeholder="Salaire" required />
                                            </div>
                                        </div>
                                        <!-- Mode de paiement -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="mode_paiement">Mode de paiement</label>
                                                <select class="form-control" id="mode_paiement" name="mode_paiement" required>
                                                    <option value="Virement bancaire">Virement bancaire</option>
                                                    <option value="Espèces">Espèces</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- Compte bancaire -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="compte_bancaire">Compte bancaire</label>
                                                <input type="text" class="form-control" id="compte_bancaire" name="compte_bancaire" placeholder="Compte bancaire" />
                                            </div>
                                        </div>
                                        <!-- Nom de la banque -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="nom_banque">Nom de la banque</label>
                                                <input type="text" class="form-control" id="nom_banque" name="nom_banque" placeholder="Nom de la banque" />
                                            </div>
                                        </div>
                                        <!-- Fréquence de paiement -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="frequence_paiement">Fréquence de paiement</label>
                                                <select class="form-control" id="frequence_paiement" name="frequence_paiement">
                                                    <option value="Mensuel">Mensuel</option>
                                                    <option value="Bimensuel">Bimensuel</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="taxe_appliquee">Taxe</label>
                                                <select class="form-control" id="taxe_appliquee" name="taxe_appliquee">
                                                    @foreach($taxes as $index => $tax)
                                                    <option value="{{$tax->rate }}">{{ $tax->name }} | Taux: {{ $tax->rate }} %</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                        <button type="submit" type="button" id="submit-btn" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Créer l'employé</button>
                                    </div>
                                    <!-- users edit social form ends -->
                                </div>
                                <!-- Social Tab ends -->
                            </div>
                        </form>
                    </div>
                </div>
            </section>
            <!--/ Basic table -->
        </div>
    </div>
</div>

@endsection



@push('scripts')

<script>
    var heureParSem = document.getElementById('nombre_heure_assigne')
    var heureParMois = document.getElementById('nombre_heure_assignee')
    heureParSem.addEventListener('keyup', function() {
        const perMois = parseInt(heureParSem.value);
        heureParMois.value = perMois * 4;
    });



    document.getElementById('create-employee-form').addEventListener('submit', function(e) {
        e.preventDefault(); // Prevent form from reloading the page

        // Get the form data
        let formData = new FormData(this);

        // Clear previous errors
        document.querySelectorAll('.text-danger').forEach(el => el.textContent = '');

        // Send the AJAX request using Axios
        axios.post("{{ route('employees.store') }}", formData, {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                }
            })
            .then(response => {
                if (response.data.message) {
                    // Success: Display success message or handle the success
                    // alert(response.data.message);
                    toastr.success(response.message); // Display Toastr success message

                    document.getElementById('employee-form').reset(); // Reset the form

                    window.location.href('/admin/employes');
                }
            })
            .catch(error => {
                if (error.response && error.response.status === 500) {
                    // Display validation errors
                    const errors = error.response.data.errors;
                    for (const [field, messages] of Object.entries(errors)) {
                        let input = document.querySelector(`[name="${field}"]`);
                        if (input) {
                            // Append error message next to the input
                            let container = document.getElementById('errorHolder');
                            let errorEl = document.createElement('small');

                            errorEl.classList.add('text-danger');
                            errorEl.textContent = messages[0];
                            // input.parentNode.appendChild(errorEl);
                            container.appendChild(errorEl);
                        }
                    }
                } else {
                    // General error
                    alert(error.response?.data?.message || 'Une erreur est survenue.');
                }
            });
    });
</script>
<script>
    const tabButtons = document.querySelectorAll('.btn');
    const tabContents = document.querySelectorAll('.tab-pane');
    const accountTab = document.getElementById('account-tab');
    const informationTab = document.getElementById('information-tab');
    const socialTab = document.getElementById('social-tab');

    function hideTabs() {
        tabContents.forEach(content => content.classList.remove('active'));

    }

    function showTab(tabId) {
        hideTabs();
        document.getElementById(tabId).classList.add('active');
    }

    // Event listeners for each button click to navigate to the respective tab
    document.getElementById('suivant-1').addEventListener('click', function() {
        informationTab.classList.add('active');
        accountTab.classList.remove('active');
        socialTab.classList.remove('active');
        showTab('information');
    });

    document.getElementById('suivant-2').addEventListener('click', function() {
        socialTab.classList.add('active');
        accountTab.classList.remove('active');
        informationTab.classList.remove('active');
        showTab('social');
    });
    // JavaScript to handle the image change and button behavior
    const profileImage = document.getElementById('profile-image');
    const fileInput = document.getElementById('change-dp-picture');
    const labelPhoto = document.getElementById('photo-label');
    const photoIdentiteInput = document.getElementById('photo_identite');
    const removePhotoButton = document.getElementById('remove-photo');
    const removePhotoMobileButton = document.getElementById('remove-photo-mobile');
    const labelText = document.getElementById('label-photo');


    // Handle file input change
    fileInput.addEventListener('change', function(event) {
        // alert('Hello world');
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                // Update the profile image with the selected file
                profileImage.src = e.target.result;
                // Show "Changer photo" option
                labelText.innerText = "Choisir une autre photo";
                labelPhoto.classList.remove("btn-primary");
                labelPhoto.classList.add("btn-warning");
                // Display the remove button
                removePhotoButton.classList.remove("d-none");
                removePhotoMobileButton.classList.remove("d-none");
            };
            reader.readAsDataURL(file);
        }
    });

    // Handle remove photo button click
    removePhotoButton.addEventListener('click', function() {
        profileImage.src = "https://cdn-icons-png.flaticon.com/512/149/149071.png";
        labelText.innerText = "Choisir une photo";
        labelPhoto.classList.remove("btn-warning");
        labelPhoto.classList.add("btn-primary");
        removePhotoButton.classList.add("d-none");
        removePhotoMobileButton.classList.add("d-none");
        fileInput.value = ''; // Reset the input value
    });

    removePhotoMobileButton.addEventListener('click', function() {
        removePhotoButton.click(); // Trigger the same action for mobile
    });
</script>

<!-- BEGIN: Page Vendor JS-->
<script src="../../../app-assets/vendors/js/forms/select/select2.full.min.js"></script>
<script src="../../../app-assets/vendors/js/forms/validation/jquery.validate.min.js"></script>
<script src="../../../app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>
<!-- END: Page Vendor JS-->
<!-- - END: Page JS-->

<script>

</script>

<script>
    window.filterStatus = (tables, status) => {
        table.column(6).search(status).draw();
    };
</script>
@endpush
