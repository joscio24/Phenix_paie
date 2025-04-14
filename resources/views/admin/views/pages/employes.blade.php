@extends('admin.views.layouts.app')
@section('title', 'Phenix ERP - Gestion des employés')
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
                            <h2 class="content-header-title float-left mb-0">Employés</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Gestions des employés</a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="content-body">
                <!-- Basic table -->
                <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div hidden class="p-2">
                                    <button class="toggle btn btn-success "
                                        onclick="filterStatus('acceptés')">Acceptés</button>
                                    <button class="toggle  btn btn-warning "
                                        onclick="filterStatus('refusés')">Refusés</button>
                                </div>

                                <table id="employeesTable" class="datatables-basic table">
                                    @if (session('success'))
                                        <p class="text-success">{{ session('success') }} <a href="{{ route('employees') }}">Voir
                                                liste</a></p>
                                    @endif
                                    @if (session('error'))
                                        <p class="text-danger">{{ session('error') }}</p>
                                    @endif
                                    <thead>
                                        <tr>

                                            <th></th>
                                            <th>Action</th>
                                            <th>Id Employé</th>
                                            <th>Nom et Prénom</th>
                                            <th>Poste</th>
                                            <th>Type de contrat</th>
                                            <th>Salaire brut</th>
                                            <th>Numero de Compte</th>
                                            <th>Date de prise de service</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($employees->reverse() as $index => $employee)
                                            <tr>
                                                <td></td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button
                                                            class="btn-icon btn btn-transparent hide-arrow btn-sm dropdown-toggle"
                                                            type="button" data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            <i data-feather="more-vertical" id="chat-header-actions"
                                                                class="font-medium-2"></i>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-left"
                                                            aria-labelledby="chat-header-actions">
                                                            <a class="dropdown-item edit-button" href="javascript:void(0);"
                                                                data-id="{{ $employee->id }}">Modifier</a>
                                                            <a class="dropdown-item edit-butt" href="http://127.0.0.1:8000/admin/paiements?emp_id={{ $employee->id }}#payerEmp" data-id="{{ $employee->id }}">Payer</a>
                                                            <a class="dropdown-item  delete-button" href="javascript:void(0);"
                                                                data-id="{{ $employee->id }}">Supprimer</a>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ $employee->employee_id }}</td>
                                                <td>{{ $employee->nom }} {{ $employee->prenoms }}</td>
                                                <td>{{ $employee->poste }}</td>
                                                <td>{{ $employee->type_de_contrat }}</td>
                                                <td>{{ $employee->salaire_base }}</td>
                                                <td>{{ $employee->compte_bancaire }}</td>
                                                <td>{{ $employee->date_embauche }}</td>

                                                <td>
                                                    <div class="dropdown">
                                                        <button
                                                            class="btn-icon btn btn-transparent hide-arrow btn-sm dropdown-toggle"
                                                            type="button" data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            <i data-feather="more-vertical" id="chat-header-actions"
                                                                class="font-medium-2"></i>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right" style="z-index: 9999;"
                                                            aria-labelledby="chat-header-actions">
                                                            <a class="dropdown-item edit-button" href="javascript:void(0);"
                                                                data-id="{{ $employee->id }}">Modifier</a>
                                                            <a class="dropdown-item pay-button" href="javascript:void(0);"
                                                                data-id="{{ $employee->id }}">Payer</a>
                                                            <a class="dropdown-item see-button" href="javascript:void(0);"
                                                                data-id="{{ $employee->id }}">Voir fiche de paie</a>
                                                            <a class="dropdown-item  delete-button" href="javascript:void(0);"
                                                                data-id="{{ $employee->id }}">Supprimer</a>
                                                        </div>
                                                    </div>
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- add employee modal here -->
                    <div class="modal modal-slide- fade" id="modals-slide-in">
                        <div class="modal-dialog sidebar-sm">
                            <form id="employee-form" class="add-new-record modal-content pt-0" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="modal-header mb-1">
                                    <h5 class="modal-title" id="exampleModalLabel">Ajouter un nouvel employé</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                                </div>
                                <div class="modal-body flex-grow-1">
                                    <!-- Success/Error Messages -->
                                    @if (session('success'))
                                        <p class="text-success">{{ session('success') }} <a href="{{ route('employees') }}">Voir
                                                liste</a></p>
                                    @endif
                                    @if (session('error'))
                                        <p class="text-danger">{{ session('error') }}</p>
                                    @endif

                                    <!-- Step 1: Personal Information -->
                                    <div class="step" id="step-1">
                                        <h4>Informations personnelles</h4>

                                        <div class="form-group">
                                            <label for="nom">Nom</label>
                                            <input type="text" class="form-control" id="nom" name="nom"
                                                value="{{ old('nom') }}" required>
                                            @error('nom')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="prenoms">Prénoms</label>
                                            <input type="text" class="form-control" id="prenoms" name="prenoms"
                                                value="{{ old('prenoms') }}" required>
                                            @error('prenoms')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="date_naissance">Date de naissance</label>
                                            <input type="date" class="form-control" id="date_naissance"
                                                name="date_naissance" value="{{ old('date_naissance') }}" required>
                                            @error('date_naissance')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="sexe">Sexe</label>
                                            <select class="form-control" id="sexe" name="sexe" required>
                                                <option value="Masculin" {{ old('sexe') == 'Masculin' ? 'selected' : '' }}>
                                                    Masculin</option>
                                                <option value="Féminin" {{ old('sexe') == 'Féminin' ? 'selected' : '' }}>
                                                    Féminin</option>
                                                <option value="Autres" {{ old('sexe') == 'Autres' ? 'selected' : '' }}>Autres
                                                </option>
                                            </select>
                                            @error('sexe')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="etat_civil">État Civil</label>
                                            <select class="form-control" id="etat_civil" name="etat_civil" required>
                                                <option value="Mr" {{ old('etat_civil') == 'Mr' ? 'selected' : '' }}>Mr
                                                </option>
                                                <option value="Mme" {{ old('etat_civil') == 'Mme' ? 'selected' : '' }}>Mme
                                                </option>
                                                <option value="Mlle" {{ old('etat_civil') == 'Mlle' ? 'selected' : '' }}>Mlle
                                                </option>
                                            </select>
                                            @error('etat_civil')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="adresse">Adresse</label>
                                            <input type="text" class="form-control" id="adresse" name="adresse"
                                                value="{{ old('adresse') }}" required>
                                            @error('adresse')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="telephone">Téléphone</label>
                                            <input type="text" class="form-control" id="telephone" name="telephone"
                                                value="{{ old('telephone') }}" required>
                                            @error('telephone')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                value="{{ old('email') }}" required>
                                            @error('email')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <button type="button" class="btn btn-primary next-step">Suivant</button>
                                        </div>
                                    </div>

                                    <!-- Step 2: Professional Information -->
                                    <div class="step" id="step-2" style="display:none;">
                                        <h4>Informations professionnelles</h4>

                                        <div class="form-group">
                                            <label for="employee_id">ID Employé</label>
                                            <input type="text" class="form-control" id="employee_id" name="employee_id"
                                                value="{{ old('employee_id') }}" required>
                                            @error('employee_id')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="poste">Poste</label>
                                            <input type="text" class="form-control" id="poste" name="poste"
                                                value="{{ old('poste') }}" required>
                                            @error('poste')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="departement">Département</label>
                                            <input type="text" class="form-control" id="departement" name="departement"
                                                value="{{ old('departement') }}" required>
                                            @error('departement')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="date_embauche">Date d'embauche</label>
                                            <input type="date" class="form-control" id="date_embauche" name="date_embauche"
                                                value="{{ old('date_embauche') }}" required>
                                            @error('date_embauche')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="type_contrat">Type de contrat</label>
                                            <select class="form-control" id="type_contrat" name="type_contrat" required>
                                                <option value="CDI" {{ old('type_contrat') == 'CDI' ? 'selected' : '' }}>CDI
                                                </option>
                                                <option value="CDD" {{ old('type_contrat') == 'CDD' ? 'selected' : '' }}>CDD
                                                </option>
                                                <option value="Freelance" {{ old('type_contrat') == 'Freelance' ? 'selected' : '' }}>Freelance</option>
                                            </select>
                                            @error('type_contrat')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="duree_contrat">Durée du contrat (mois)</label>
                                            <input type="number" class="form-control" id="duree_contrat"
                                                name="duree_contrat" value="{{ old('duree_contrat') }}" required>
                                            @error('duree_contrat')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="lieu_affectation">Lieu d'affectation</label>
                                            <input type="text" class="form-control" id="lieu_affectation"
                                                name="lieu_affectation" value="{{ old('lieu_affectation') }}" required>
                                            @error('lieu_affectation')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <button type="button" class="btn btn-secondary prev-step">Précédent</button>
                                            <button type="button" class="btn btn-primary next-step">Suivant</button>
                                        </div>
                                    </div>

                                    <!-- Step 3: Salary Information -->
                                    <div class="step" id="step-3" style="display:none;">
                                        <h4>Informations salariales et fiscales</h4>

                                        <div class="form-group">
                                            <label for="salaire_base">Salaire de base</label>
                                            <input type="number" class="form-control" id="salaire_base" name="salaire_base"
                                                value="{{ old('salaire_base') }}" required>
                                            @error('salaire_base')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="compte_bancaire">Compte bancaire</label>
                                            <input type="text" class="form-control" id="compte_bancaire"
                                                name="compte_bancaire" value="{{ old('compte_bancaire') }}" required>
                                            @error('compte_bancaire')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="nom_banque">Nom de la banque</label>
                                            <input type="text" class="form-control" id="nom_banque" name="nom_banque"
                                                value="{{ old('nom_banque') }}" required>
                                            @error('nom_banque')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="frequence_paiement">Fréquence de paiement</label>
                                            <select class="form-control" id="frequence_paiement" name="frequence_paiement"
                                                required>
                                                <option value="Mensuel" {{ old('frequence_paiement') == 'Mensuel' ? 'selected' : '' }}>Mensuel</option>
                                                <option value="Bimensuel" {{ old('frequence_paiement') == 'Bimensuel' ? 'selected' : '' }}>Bimensuel</option>
                                                <option value="Hebdomadaire" {{ old('frequence_paiement') == 'Hebdomadaire' ? 'selected' : '' }}>Hebdomadaire</option>
                                            </select>
                                            @error('frequence_paiement')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="num_securite_sociale">Numéro de sécurité sociale</label>
                                            <input type="text" class="form-control" id="num_securite_sociale"
                                                name="num_securite_sociale" value="{{ old('num_securite_sociale') }}"
                                                required>
                                            @error('num_securite_sociale')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="num_ifu">Numéro IFU</label>
                                            <input type="text" class="form-control" id="num_ifu" name="num_ifu"
                                                value="{{ old('num_ifu') }}" required>
                                            @error('num_ifu')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <button type="button" class="btn btn-secondary prev-step">Précédent</button>
                                            <button type="submit" class="btn btn-primary">Soumettre</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>

                </section>
                <!--/ Basic table -->
            </div>
        </div>
    </div>

    <div class="modal fade" id="editEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="editEmployeeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form id="edit-employee-form" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editEmployeeModalLabel">Modifier l'employé</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <!-- Nom -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit-nom">Nom</label>
                                    <input type="text" class="form-control" id="edit-nom" name="nom" placeholder="Nom">
                                </div>
                            </div>

                            <!-- Prénoms -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit-prenoms">Prénoms</label>
                                    <input type="text" class="form-control" id="edit-prenoms" name="prenoms"
                                        placeholder="Prénoms">
                                </div>
                            </div>

                            <!-- Date de naissance -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit-date_naissance">Date de naissance</label>
                                    <input type="date" class="form-control" id="edit-date_naissance" name="date_naissance">
                                </div>
                            </div>

                            <!-- Sexe -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit-sexe">Sexe</label>
                                    <select class="form-control" id="edit-sexe" name="sexe">
                                        <option value="Masculin">Masculin</option>
                                        <option value="Féminin">Féminin</option>
                                        <option value="Autres">Autres</option>
                                    </select>
                                </div>
                            </div>

                            <!-- État civil -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit-etat_civil">État civil</label>
                                    <select class="form-control" id="edit-etat_civil" name="etat_civil">
                                        <option value="Mr">M.</option>
                                        <option value="Mme">Mme</option>
                                        <option value="Mlle">Mlle</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Adresse -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit-adresse">Adresse</label>
                                    <input type="text" class="form-control" id="edit-adresse" name="adresse"
                                        placeholder="Adresse">
                                </div>
                            </div>

                            <!-- Téléphone -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit-telephone">Téléphone</label>
                                    <input type="text" class="form-control" id="edit-telephone" name="telephone"
                                        placeholder="Téléphone">
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit-email">Email</label>
                                    <input type="email" class="form-control" id="edit-email" name="email"
                                        placeholder="Email">
                                </div>
                            </div>

                            <!-- ID de l'employé -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit-employee_id">ID de l'employé</label>
                                    <input type="text" class="form-control" id="edit-employee_id" name="employee_id"
                                        placeholder="ID de l'employé">
                                </div>
                            </div>

                            <!-- Poste -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit-poste">Poste</label>
                                    <input type="text" class="form-control" id="edit-poste" name="poste"
                                        placeholder="Poste">
                                </div>
                            </div>

                            <!-- Département -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit-departement">Département</label>
                                    <input type="text" class="form-control" id="edit-departement" name="departement"
                                        placeholder="Département">
                                </div>
                            </div>

                            <!-- Date d'embauche -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit-date_embauche">Date d'embauche</label>
                                    <input type="date" class="form-control" id="edit-date_embauche" name="date_embauche">
                                </div>
                            </div>

                            <!-- heure assignée par semaine -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit-nombre_heure_assignee">Nombre d'heure assignée (par semaine)</label>
                                    <input type="number" class="form-control" id="edit-nombre_heure_assigne"
                                        name="nombre_heure_sem_assignee">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit-nombre_heure_assignee">Nombre d'heure assignée (par mois)</label>
                                    <input type="number" disabled class="form-control" id="edit-nombre_heure_assignee"
                                        name="nombre_heure_assignee">
                                </div>
                            </div>


                            <!-- heeur par mois -->
                            <!-- Type de contrat -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit-type_de_contrat">Type de contrat</label>
                                    <input type="text" class="form-control" id="edit-type_de_contrat" name="type_contrat"
                                        placeholder="Type de contrat">
                                </div>
                            </div>

                            <!-- Durée du contrat -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit-duree_contrat">Durée du contrat</label>
                                    <input type="text" class="form-control" id="edit-duree_contrat" name="duree_contrat"
                                        placeholder="Durée du contrat">
                                </div>
                            </div>

                            <!-- Lieu d'affectation -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit-lieu_affectation">Lieu d'affectation</label>
                                    <input type="text" class="form-control" id="edit-lieu_affectation"
                                        name="lieu_affectation" placeholder="Lieu d'affectation">
                                </div>
                            </div>

                            <!-- Salaire de base -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit-salaire_base">Salaire de base</label>
                                    <input type="number" class="form-control" id="edit-salaire_base" name="salaire_base"
                                        placeholder="Salaire de base">
                                </div>
                            </div>

                            <!-- Mode de paiement -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit-mode_paiement">Mode de paiement</label>
                                    <input type="text" class="form-control" id="edit-mode_paiement" name="mode_paiement"
                                        placeholder="Mode de paiement">
                                </div>
                            </div>

                            <!-- Compte bancaire -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit-compte_bancaire">Compte bancaire</label>
                                    <input type="text" class="form-control" id="edit-compte_bancaire" name="compte_bancaire"
                                        placeholder="Compte bancaire">
                                </div>
                            </div>

                            <!-- Nom de la banque -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit-nom_banque">Nom de la banque</label>
                                    <input type="text" class="form-control" id="edit-nom_banque" name="nom_banque"
                                        placeholder="Nom de la banque">
                                </div>
                            </div>

                            <!-- Fréquence de paiement -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit-frequence_paiement">Fréquence de paiement</label>
                                    <input type="text" class="form-control" id="edit-frequence_paiement"
                                        name="frequence_paiement" placeholder="Fréquence de paiement">
                                </div>
                            </div>

                            <!-- Numéro de sécurité sociale -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit-num_securite_sociale">Numéro de sécurité sociale</label>
                                    <input type="text" class="form-control" id="edit-num_securite_sociale"
                                        name="num_securite_sociale" placeholder="Numéro de sécurité sociale">
                                </div>
                            </div>

                            <!-- Numéro IFU -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit-num_ifu">Numéro IFU</label>
                                    <input type="text" class="form-control" id="edit-num_ifu" name="num_ifu"
                                        placeholder="Numéro IFU">
                                </div>
                            </div>

                            <!-- Retraite -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit-retraite">Retraite</label>
                                    <input type="text" class="form-control" id="edit-retraite" name="retraite"
                                        placeholder="Retraite">
                                </div>
                            </div>

                            <!-- Taxe appliquée -->

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="edit-taxe_appliquee">Taxe appliquée ()</label>
                                    <select class="form-control" id="edit-taxe_appliquee" name="taxe_appliquee">
                                        @foreach($taxes as $index => $tax)
                                            <option value="{{$tax->rate }}">{{ $tax->name }} | Taux: {{ $tax->rate }} %</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="edit-taxe_appliquee">Cotisation appliquée ()</label>
                                    <select class="form-control" id="edit-taxe_appliquee" name="cotisation_appliquee">
                                        @foreach($taxes as $index => $tax)
                                            <option value="{{$tax->rate }}">{{ $tax->name }} | Taux: {{ $tax->rate }} %</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Contrat signé -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit-contrat_signe">Contrat signé</label>
                                    <input type="file" class="form-control" id="edit-contrat_signe" name="contrat_signe">
                                </div>
                            </div>

                            <!-- Carte d'identité -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit-carte_identite">Carte d'identité</label>
                                    <input type="file" class="form-control" id="edit-carte_identite" name="carte_identite">
                                </div>
                            </div>

                            <!-- Certificats et diplômes -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit-certificats_diplomes">Certificats et diplômes</label>
                                    <input type="file" class="form-control" id="edit-certificats_diplomes"
                                        name="certificats_diplomes">
                                </div>
                            </div>

                            <!-- RIB -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit-rib">RIB</label>
                                    <input type="file" class="form-control" id="edit-rib" name="rib">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Sauvegarder les modifications</button>
                    </div>
                </form>
            </div>
        </div>
    </div>




@endsection



@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let currentStep = 1;
            const steps = document.querySelectorAll('.step');
            const nextButtons = document.querySelectorAll('.next-step');
            const prevButtons = document.querySelectorAll('.prev-step');

            function showStep(stepNumber) {
                steps.forEach((step, index) => {
                    step.style.display = (index + 1 === stepNumber) ? 'block' : 'none';
                });
            }

            nextButtons.forEach(button => {
                button.addEventListener('click', () => {
                    if (currentStep < steps.length) {
                        currentStep++;
                        showStep(currentStep);
                    }
                });
            });

            prevButtons.forEach(button => {
                button.addEventListener('click', () => {
                    if (currentStep > 1) {
                        currentStep--;
                        showStep(currentStep);
                    }
                });
            });

            showStep(currentStep); // Initialize the first step
        });
    </script>

    <script>
        var edit_heureParSem = document.getElementById('edit-nombre_heure_assigne')
        var edit_heureParMois = document.getElementById('edit-nombre_heure_assignee')
        edit_heureParSem.addEventListener('keyup', function () {
            const perMois = parseInt(heureParSem.value);
            edit_heureParMois.value = perMois * 4;
        });

        document.querySelectorAll('.delete-button').forEach(button => {
            button.addEventListener('click', function () {
                const employeeId = this.getAttribute('data-id');

                // Prompt user for confirmation
                if (confirm('Are you sure you want to delete this employee?')) {
                    deleteEmployee(employeeId);
                }
            });
        });

        function deleteEmployee(employeeId) {
            fetch(`/employees/${employeeId}/delete`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Employee deleted successfully');
                        // Optionally, remove the deleted employee row from the UI or reload the page
                        location.reload(); // This reloads the page to reflect the deletion
                    } else {
                        alert('Failed to delete employee');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while deleting the employee');
                });
        }

        // Example usage of the deleteEmployee function
        document.addEventListener('DOMContentLoaded', function () {
            // Handle edit button click
            const editEmployeeModalEl = document.getElementById('editEmployeeModal');
            const editEmployeeModal = new bootstrap.Modal(editEmployeeModalEl); // Bootstrap's modal instance

            document.querySelectorAll('.edit-button').forEach(button => {
                button.addEventListener('click', function () {
                    const employeeId = this.getAttribute('data-id');

                    // Clear previous errors
                    document.querySelectorAll('.text-danger').forEach(el => el.textContent = '');

                    // Fetch employee data
                    axios.get(`/employees/${employeeId}/edit`)
                        .then(response => {
                            if (response.data.success) {
                                const employee = response.data.data;

                                // Populate the modal fields
                                document.getElementById('edit-nom').value = employee.nom;
                                document.getElementById('edit-prenoms').value = employee.prenoms;
                                document.getElementById('edit-employee_id').value = employee.employee_id;
                                document.getElementById('edit-date_naissance').value = employee.date_naissance;
                                document.getElementById('edit-sexe').value = employee.sexe;
                                document.getElementById('edit-etat_civil').value = employee.etat_civil;
                                document.getElementById('edit-adresse').value = employee.adresse;
                                document.getElementById('edit-telephone').value = employee.telephone;
                                document.getElementById('edit-email').value = employee.email;
                                document.getElementById('edit-poste').value = employee.poste;
                                document.getElementById('edit-departement').value = employee.departement;
                                document.getElementById('edit-date_embauche').value = employee.date_embauche;
                                document.getElementById('edit-type_de_contrat').value = employee.type_de_contrat;
                                document.getElementById('edit-duree_contrat').value = employee.duree_contrat;
                                document.getElementById('edit-lieu_affectation').value = employee.lieu_affectation;
                                document.getElementById('edit-salaire_base').value = employee.salaire_base;
                                document.getElementById('edit-mode_paiement').value = employee.mode_paiement;
                                document.getElementById('edit-compte_bancaire').value = employee.compte_bancaire;
                                document.getElementById('edit-nom_banque').value = employee.nom_banque;
                                document.getElementById('edit-frequence_paiement').value = employee.frequence_paiement;
                                document.getElementById('edit-num_securite_sociale').value = employee.num_securite_sociale;
                                document.getElementById('edit-num_ifu').value = employee.num_ifu;
                                document.getElementById('edit-retraite').value = employee.retraite;
                                document.getElementById('edit-taxe_appliquee').value = employee.taxe_appliquee;

                                // Show the modal
                                // $('#editEmployeeModal').modal('show');
                                editEmployeeModal.show();
                            } else {
                                alert(response.message);
                            }
                        })
                        .catch(error => {
                            alert('An error occurred while fetching employee data.');
                            console.error(error);
                        });
                });
            });

            // Handle form submission
            document.getElementById('edit-employee-form').addEventListener('submit', function (e) {
                e.preventDefault();
                const employeeId = document.querySelector('.edit-button[data-id]').getAttribute('data-id');
                const formData = new FormData(this);

                // Send the updated data
                axios.put(`/employees/${employeeId}/update`, formData)
                    .then(response => {
                        if (response.data.success) {
                            alert('Employee updated successfully.');
                            editEmployeeModal.hide();
                            location.reload(); // Reload the page to reflect changes
                        } else {
                            alert(response.data.message);
                        }
                    })
                    .catch(error => {
                        if (error.status === 422) {
                            // Display validation errors
                            const errors = error.response.data.errors;
                            for (const [field, messages] of Object.entries(errors)) {
                                let input = document.querySelector(`#edit-${field}`);
                                if (input) {
                                    let errorEl = document.createElement('small');
                                    errorEl.classList.add('text-danger');
                                    errorEl.textContent = messages[0];
                                    input.parentNode.appendChild(errorEl);
                                }
                            }
                        } else {
                            alert('An error occurred while updating the employee.');
                            console.error(error);
                        }
                    });
            });
        });
    </script>


    <script>
        document.getElementById('employee-form').addEventListener('submit', function (e) {
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
                        alert(response.data.message);
                        document.getElementById('employee-form').reset(); // Reset the form

                        window.location.reload();
                    }
                })
                .catch(error => {
                    if (error.response && error.response.status === 422) {
                        // Display validation errors
                        const errors = error.response.data.errors;
                        for (const [field, messages] of Object.entries(errors)) {
                            let input = document.querySelector(`[name="${field}"]`);
                            if (input) {
                                // Append error message next to the input
                                let errorEl = document.createElement('small');
                                errorEl.classList.add('text-danger');
                                errorEl.textContent = messages[0];
                                input.parentNode.appendChild(errorEl);
                            }
                        }
                    } else {
                        // General error
                        alert(error.response?.data?.message || 'Une erreur est survenue.');
                    }
                });
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

            var dt_debats_table = $('#employeesTable');

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
                    order: [
                        [0, 'desc']
                    ],
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
                                columns: [1, 2, 3, 4, 5, 7, 8, 9]
                            }
                        },
                        {
                            extend: 'csv',
                            text: feather.icons['file-text'].toSvg({
                                class: 'font-small-4 mr-50'
                            }) + 'Csv',
                            className: 'dropdown-item',
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 7, 8, 9]
                            }
                        },
                        {
                            extend: 'excel',
                            text: feather.icons['file'].toSvg({
                                class: 'font-small-4 mr-50'
                            }) + 'Excel',
                            className: 'dropdown-item',
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 7, 8, 9]
                            }
                        },
                        {
                            extend: 'pdf',
                            text: feather.icons['clipboard'].toSvg({
                                class: 'font-small-4 mr-50'
                            }) + 'Pdf',
                            className: 'dropdown-item',
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 7, 8, 9]
                            }
                        },
                        {
                            extend: 'copy',
                            text: feather.icons['copy'].toSvg({
                                class: 'font-small-4 mr-50'
                            }) + 'Copy',
                            className: 'dropdown-item',
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 7, 8, 9]
                            }
                        }
                        ]
                    },
                    {
                        text: feather.icons['plus'].toSvg({
                            class: 'mr-50 font-small-4'
                        }) + 'Ajouter un employé',
                        className: 'create-new btn btn-primary',
                        action: function () {
                            window.location.href = '/admin/employees/creer'; // Navigate to the route
                        }

                    }
                    ],
                    responsive: true,
                    language: {
                        search: "Rechercher:",
                        lengthMenu: "Afficher _MENU_ employés par page",
                        info: "Affichage de _START_ à _END_ sur _TOTAL_ employés",
                        infoEmpty: "Aucun enregistrement disponible",
                        infoFiltered: "(filtré à partir de _MAX_ employés au total)",
                        paginate: {
                            first: "Premier",
                            last: "Dernier",
                            next: "Suivant",
                            previous: "Précédent"
                        },
                        emptyTable: "Aucune donnée disponible dans le tableau",
                    }
                });
                $('div.head-label').html('<h6 class="mb-0">Liste des employés</h6>');
                $('#employeesTable_filter input').attr('placeholder', 'Rechercher un employés...');

            }

        });
    </script>

    <script>
        window.filterStatus = (tables, status) => {
            table.column(6).search(status).draw();
        };
    </script>
@endpush