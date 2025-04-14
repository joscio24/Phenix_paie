@extends('admin.views.layouts.app')
@section('title', 'Phenix ERP - Gestions des paiements')
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
                            <h2 class="content-header-title float-left mb-0">Paiments</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Gestions des paiements</a>
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
                                    <a class="nav-link d-flex align-items-center active" id="payerEmp-tab" data-toggle="tab"
                                        href="#payerEmp" aria-controls="social" role="tab" aria-selected="false">
                                        <i data-feather="dollar-sign"></i><span class="d-none d-sm-block">Payer un
                                            employé</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link d-flex align-items-center" id="payList-tab" data-toggle="tab"
                                        href="#payList" aria-controls="social" role="tab" aria-selected="false">
                                        <i data-feather="list"></i><span class="d-ne d-sm-block">Avance ou retenues sur
                                            salaire</span>
                                    </a>
                                </li>
                                <div class="p-1">
                                    <li class="badge badge-pill badge-light-danger" id="errorHolder"></li>
                                </div>
                            </ul>



                            <div class="tab-content">



                                <div class="tab-pane active" id="payerEmp" aria-labelledby="payer-emp" role="tabpanel">
                                    <div class="row">
                                        <div class="card col-12 shadow ">
                                            <div class="card-header">
                                                <h4 class="card-title">Formulaire de lancement de processus de paiment <h4>
                                            </div>
                                            <div class="card-body ">
                                                <form method="POST" id="salary-form"
                                                    action="{{ route('paiements.store') }} ">
                                                    @csrf

                                                    @if(session('success'))
                                                        <div class="alert alert-success">
                                                            {{ session('success') }} <a href="/admin/etats_paiements">Finaliser
                                                                les détails de paiements; et Créer fiche de paie</a>
                                                        </div>
                                                    @endif

                                                    @if(session('error'))
                                                        <div class="alert alert-danger">
                                                            {{ session('error') }}
                                                        </div>
                                                    @endif

                                                    <div class="row">
                                                        <!-- Employee selection -->
                                                        <div class="col-12 mb-3">
                                                            <label for="employee_id" class="form-label">Employé</label>
                                                            <select name="employee_id" id="employee_id"
                                                                class="form-select form-control @error('employee_id') is-invalid @enderror"
                                                                required>
                                                                <option value="">Sélectionner un Employé</option>
                                                                @foreach($employees as $employee)
                                                                    <option value="{{ $employee->id }}">
                                                                        {{ $employee->nom }} {{ $employee->prenoms }} - Salaire
                                                                        de base: {{ $employee->salaire_base }} - Taxe :
                                                                        {{ $employee->taxe_appliquee }}%
                                                                    </option>
                                                                @endforeach
                                                            </select>



                                                            @error('employee_id')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                        <!-- Start Date -->
                                                        <div class="col-4 mb-3">
                                                            <label for="periode_fiscale" class="form-label">Période
                                                                Fiscale</label>
                                                            <select id="periode_fiscale" name="periode_fiscale_id"
                                                                class="form-control">
                                                                <option value="">Sélectionner une période</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-4  form-group ">
                                                            <label for="avance_salaire">Avance sur Salaire </label>
                                                            <input type="number" id="avance_salaire" name="avance_salaire"
                                                                class="form-control" value="0" readonly>
                                                        </div>

                                                        <div class="col-4  form-group ">
                                                            <label for="retenue_salaire">Retenues sur Salaire</label>
                                                            <input type="number" id="retenue_salaire" name="retenue_salaire"
                                                                class="form-control" value="0" readonly>
                                                        </div>



                                                        <!-- Date de début -->
                                                        <div class="col-4 mb-3">
                                                            <label for="temps_de_travail_a_payer_debut"
                                                                class="form-label">Début de la période de travail</label>
                                                            <input type="date" class="form-control"
                                                                id="temps_de_travail_a_payer_debut"
                                                                name="temps_de_travail_a_payer_debut" required>
                                                        </div>

                                                        <!-- Date de fin -->
                                                        <div class="col-4 mb-3">
                                                            <label for="temps_de_travail_a_payer_fin" class="form-label">Fin
                                                                de la période de travail</label>
                                                            <input type="date" class="form-control"
                                                                id="temps_de_travail_a_payer_fin"
                                                                name="temps_de_travail_a_payer_fin" required>
                                                        </div>


                                                        <!-- Hours Worked -->
                                                        <!-- <div class="col-4 mb-3">
                                                            <label for="nombre_heure_assignée" class="form-label">Nombre d'heures assignées (par mois)</label>
                                                            <input type="number" readonly value="{{ $employee->nombre_heure_assignée }}" class="form-control @error('nombre_heure_assignée') is-invalid @enderror" id="nombre_heure_assignée" name="nombre_heure_assignée" required>
                                                            @error('nombre_heure_assignée')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div> -->



                                                        <!-- Initial Salary (Base Salary) -->
                                                        <div class="col-4 mb-3">
                                                            <label for="salaire_base" class="form-label">Salaire de
                                                                base</label>
                                                            <input type="number"
                                                                class="form-control @error('salaire_base') is-invalid @enderror"
                                                                id="salaire_base" name="salaire_base" readonly>
                                                            @error('salaire_base')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-4 mb-3">
                                                            <label for="deduction" class="form-label">Déduction - Taxe
                                                                (%)</label>
                                                            <input type="text"
                                                                class="form-control @error('deduction') is-invalid @enderror"
                                                                id="taxe_deduit" name="deduction" readonly>
                                                            <span class="text-muted" id="resulDeduct"></span>
                                                            @error('deduction')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>

                                                        <!-- Overtime Rate (Optional) -->
                                                        <div class="col-4 mb-3">
                                                            <label for="salaire_brut" class="form-label">Salaire brut
                                                                TTC</label>
                                                            <input type="number"
                                                                class="form-control @error('salaire_brut') is-invalid @enderror"
                                                                id="salaire_brut" name="salaire_brut" readonly>
                                                            @error('salaire_brut')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>


                                                        <!-- <div hidden class="col-4 mb-3">
                                                            <label for="nombre_heure_travaillée" class="form-label">Nombre d'heures travaillées</label>
                                                            <input type="number" class="form-control @error('nombre_heure_travaillée') is-invalid @enderror" id="nombre_heure_travaillée" name="nombre_heure_travaillée" required>
                                                            @error('nombre_heure_travaillée')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>

                                                        Overtime Hours (Optional)
                                                        <div hidden class="col-4 mb-3">
                                                            <label for="heures_supplementaire" class="form-label">Heures supplémentaires (facultatif)</label>
                                                            <input type="number" class="form-control @error('heures_supplementaire') is-invalid @enderror" id="heures_supplementaire" name="heures_supplementaire">
                                                            @error('heures_supplementaire')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div> -->
                                                        <div class="col-4 mb-3">
                                                            <label for="allocation" class="form-label">Allocation</label>
                                                            <input type="number" placeholder="allocation ex= 10000"
                                                                class="form-control @error('allocation') is-invalid @enderror"
                                                                id="allocation" name="allocation">
                                                            @error('allocation')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                        <!-- prime -->
                                                        <div class="col-12   form-group">
                                                            <label for="prime" class="form-label">Prime</label>
                                                            <br>
                                                            <input type="number" placeholder="Entrer prime ex=20000"
                                                                class="form-control @error('prime') is-invalid @enderror"
                                                                id="prime" name="prime">
                                                            <button hidden class="btn btn-primary">+</button>
                                                            @error('prime')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>

                                                        <div class="col-12 mb-3">
                                                            <label for="salaire_net" class="form-label">Salaire Net à
                                                                payer</label>
                                                            <input type="number"
                                                                class="form-control @error('salaire_brut') is-invalid @enderror"
                                                                id="salaire_net" name="salaire_net" readonly>
                                                            @error('salaire_net')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>

                                                    </div>
                                                    <!-- Submit Button -->
                                                    <div class="col-4">
                                                        <button type="submit" class="btn btn-primary"
                                                            id="salarypay-submit-button">Créer le Paiement</button>
                                                    </div>
                                                </form>

                                                <script>
                                                    document.addEventListener('DOMContentLoaded', function () {
                                                        fetch('/periodes/list')
                                                            .then(response => response.json())
                                                            .then(data => {

                                                                let select = document.getElementById('periode_fiscale');

                                                                    if (data && data.length > 0) {
                                                                        data.forEach(periode => {
                                                                            let option = document.createElement('option');
                                                                            option.value = periode.id;
                                                                            option.textContent = `Du ${periode.date_debut} au ${periode.date_fin}`;
                                                                            option.setAttribute('data-debut', periode.date_debut);
                                                                            option.setAttribute('data-fin', periode.date_fin);
                                                                            select.appendChild(option);
                                                                        });
                                                                    } else {
                                                                        // Replace select with an anchor tag
                                                                        let anchor = document.createElement('a');
                                                                        anchor.href = "/admin/parametres#exoFsci";
                                                                        anchor.textContent = "Configurer période fiscale";
                                                                        anchor.classList.add('btn', 'btn-primary'); // Optional: Add button styling
                                                                        
                                                                        select.replaceWith(anchor); // Replace select with the anchor
                                                                    }

                                                                });

                                                        document.getElementById('periode_fiscale').addEventListener('change', function () {
                                                            let selectedOption = this.options[this.selectedIndex];
                                                            if (selectedOption.value) {
                                                                document.getElementById('temps_de_travail_a_payer_debut').value = selectedOption.getAttribute('data-debut');
                                                                document.getElementById('temps_de_travail_a_payer_fin').value = selectedOption.getAttribute('data-fin');
                                                            }
                                                        });
                                                    });
                                                </script>


                                                <!-- <script>

                                                    var $avancesRetenues = @json($avancesRetenues);
                                                    document.getElementById('employee_id').addEventListener('change', function() {
                                                        const selectedOption = this.options[this.selectedIndex];
                                                        if (selectedOption.value) {

                                                            const salaireBase = selectedOption.text.match(/Salaire de base: (\d+(\.\d{1,2})?)/);
                                                            // const nombreHeureParSemaine = selectedOption.text.match(/heure assignée: (\d+)/);
                                                            const taxe = selectedOption.text.match(/Taxe : (\d+)/);

                                                            if (salaireBase) {
                                                                document.getElementById('salaire_base').value = salaireBase[1];
                                                                document.getElementById('taxe_deduit').value = taxe[1];
                                                                document.getElementById('resulDeduct').textContent = taxe[1] + "% = " + parseFloat(salaireBase[1] * (taxe[1] / 100)).toFixed(2)
                                                                document.getElementById('salaire_brut').value = salaireBase[1] - (salaireBase[1] * (taxe[1] / 100));
                                                                calculateNetSalary();
                                                                // document.getElementById('salaire_net').value = parseFloat(document.getElementById('salaire_brut').value) || 0;
                                                                function calculateNetSalary() {
                                                                    const baseAmount = parseFloat(document.getElementById('salaire_brut').value) || 0;
                                                                    const allocation = parseFloat(document.getElementById('allocation').value) || 0;
                                                                    const prime = parseFloat(document.getElementById('prime').value) || 0;
                                                                    document.getElementById('salaire_net').value = (baseAmount + allocation + prime).toFixed(2);
                                                                }

                                                                document.getElementById('allocation').addEventListener('keydown', calculateNetSalary);
                                                                document.getElementById('prime').addEventListener('keydown', calculateNetSalary);
                                                            }


                                                        } else {
                                                            document.getElementById('salaire_base').value = '';
                                                            // document.getElementById('nombre_heure_assignée').value = '';
                                                            document.getElementById('taxe_deduit').value = '';
                                                            document.getElementById('salaire_brut').value = '';
                                                        }
                                                    });
                                                </script> -->

                                                <script>
                                                    var avancesRetenues = @json($avancesRetenues);

                                                    document.getElementById('employee_id').addEventListener('change', function () {
                                                        const selectedOption = this.options[this.selectedIndex];
                                                        if (selectedOption.value) {
                                                            const employeeId = selectedOption.value;

                                                            // Récupérer le salaire de base et la taxe depuis l'option sélectionnée
                                                            const salaireBase = selectedOption.text.match(/Salaire de base: (\d+(\.\d{1,2})?)/);
                                                            const taxe = selectedOption.text.match(/Taxe : (\d+)/);

                                                            if (salaireBase) {
                                                                let salaireBaseValue = parseFloat(salaireBase[1]);
                                                                let taxeValue = parseFloat(taxe ? taxe[1] : 0);

                                                                document.getElementById('salaire_base').value = salaireBaseValue;
                                                                document.getElementById('taxe_deduit').value = taxeValue;
                                                                document.getElementById('resulDeduct').textContent = taxeValue + "% = " + (salaireBaseValue * (taxeValue / 100)).toFixed(2);

                                                                let salaireBrut = salaireBaseValue - (salaireBaseValue * (taxeValue / 100));

                                                                // Récupérer les avances et retenues pour cet employé
                                                                let avance = 0;
                                                                let retenue = 0;
                                                                avancesRetenues.forEach(item => {
                                                                    if (item.employe_id == employeeId) {
                                                                        if (item.type === 'avance') avance += parseFloat(item.montant);
                                                                        if (item.type === 'retenue') retenue += parseFloat(item.montant);
                                                                    }
                                                                });

                                                                // Mettre à jour les champs avances et retenues
                                                                document.getElementById('avance_salaire').value = avance || 0;
                                                                document.getElementById('retenue_salaire').value = retenue || 0;

                                                                // Déduire avances et retenues du salaire brut
                                                                let salaireNet = salaireBrut - avance - retenue;
                                                                document.getElementById('salaire_brut').value = salaireBrut.toFixed(2);
                                                                document.getElementById('salaire_net').value = salaireNet.toFixed(2);

                                                                // Gérer allocation et prime
                                                                function calculateNetSalary() {
                                                                    const baseAmount = parseFloat(document.getElementById('salaire_brut').value) || 0;
                                                                    const allocation = parseFloat(document.getElementById('allocation').value) || 0;
                                                                    const prime = parseFloat(document.getElementById('prime').value) || 0;
                                                                    const salaireFinal = baseAmount + allocation + prime - avance - retenue;
                                                                    document.getElementById('salaire_net').value = salaireFinal.toFixed(2);
                                                                }

                                                                document.getElementById('allocation').addEventListener('keydown', calculateNetSalary);
                                                                document.getElementById('prime').addEventListener('keydown', calculateNetSalary);
                                                            }
                                                        } else {
                                                            document.getElementById('salaire_base').value = '';
                                                            document.getElementById('taxe_deduit').value = '';
                                                            document.getElementById('salaire_brut').value = '';
                                                            document.getElementById('avance_salaire').value = 0;
                                                            document.getElementById('retenue_salaire').value = 0;
                                                        }
                                                    });
                                                </script>



                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="tab-pane" id="payList" aria-labelledby="pay-list" role="tabpanel">
                                    <div class=" card ">
                                        <!-- Tableau des employés -->
                                        <div class="container">
                                            <h2 class="mb-4">Liste des Avances et Retenues</h2>

                                            <!-- Bouton pour ouvrir le modal d'ajout -->


                                            <div class="d-flex g-4" style="gap: 20px">
                                                <button class="btn btn-info mb-3" data-toggle="modal"
                                                    data-target="#addAvanceModal">
                                                    Payer un employé en avance
                                                </button>

                                                <button class="btn btn-success mb-3" data-toggle="modal"
                                                    data-target="#addRetenuModal">
                                                    Appliquer une retenue pour un employé
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
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Employé</th>
                                                        <th>Période Fiscale</th>
                                                        <th>Type</th>
                                                        <th>Montant</th>
                                                        <th>Reste à percevoir</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($avancesRetenues as $item)
                                                        <tr>
                                                            <td>{{ $item->employe->nom }} {{ $item->employe->prenoms }}</td>
                                                            <td>{{ $item->periodeFiscale->date_debut }} -
                                                                {{ $item->periodeFiscale->date_fin }}</td>
                                                            <td>{{ ucfirst($item->type) }}</td>
                                                            <td>{{ number_format($item->montant, 2) }}</td>
                                                            <td>{{ number_format($item->reste_a_percevoir, 2) }} </td>
                                                            <td>
                                                                <button class="btn btn-info btn-sm"
                                                                    onclick="openEditModal({{ $item->id }}, '{{ $item->montant }}')">Modifier</button>
                                                                <form
                                                                    action="{{ route('avances_retenues.destroy', $item->id) }}"
                                                                    method="POST" style="display:inline-block;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                                        onclick="return confirm('Voulez-vous vraiment supprimer ?')">Supprimer</button>
                                                                </form>
                                                            </td>
                                                        </tr>

                                                        <div class="modal fade" id="editModal" tabindex="-1"
                                                            aria-labelledby="editModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="editModalLabel">Modifier
                                                                            Avance/Retenue</h5>
                                                                        <button type="button" class="close" data-dismiss="modal"
                                                                            aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <form id="editForm" method="POST">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <div class="modal-body">

                                                                            <div class="form-group">
                                                                                <label for="employe_id">Employé</label>
                                                                                <select class="form-control" id="employe_id"
                                                                                    name="employe_id" required>

                                                                                    <option value="{{ $item->employe->id }}">
                                                                                        {{ $item->employe->nom }}
                                                                                        {{ $item->employe->prenoms }}</option>

                                                                                </select>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="periode_fiscale_id">Période
                                                                                    Fiscale</label>
                                                                                @if ($periodes->count() > 0)

                                                                                    <select class="form-control"
                                                                                        id="periode_fiscale_id"
                                                                                        name="periode_fiscale_id" required>
                                                                                        @foreach($periodes as $periode)
                                                                                            <option value="{{ $periode->id }}">
                                                                                                {{ $periode->date_debut }} -
                                                                                                {{ $periode->date_fin }}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                @else
                                                                                    <a href="/admin/">Configurez la période
                                                                                        fiscale</a>
                                                                                @endif
                                                                            </div>
                                                                            <input type="hidden" name="type"
                                                                                value="{{ $item->type }}">
                                                                            <div class="form-group">
                                                                                <label for="montant">Montant</label>
                                                                                <input type="number" class="form-control"
                                                                                    id="montant" name="montant" required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary"
                                                                                data-dismiss="modal">Annuler</button>
                                                                            <button type="submit"
                                                                                class="btn btn-primary">Enregistrer</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>


                                        <!-- Modal d'ajout -->
                                        <div class="modal fade" id="addAvanceModal" tabindex="-1"
                                            aria-labelledby="addAvanceModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="addAvanceModalLabel">Payer un employé en
                                                            avance</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('avances_retenues.store') }}" method="POST">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="employe_id">Employé</label>
                                                                <select class="form-control" id="employe_id"
                                                                    name="employe_id" required>
                                                                    @foreach($employees as $employe)
                                                                        <option value="{{ $employe->id }}">{{ $employe->nom }}
                                                                            {{ $employe->prenoms }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="periode_fiscale_id">Période Fiscale</label>
                                                                <select class="form-control" id="periode_fiscale_id"
                                                                    name="periode_fiscale_id" required>
                                                                    @foreach($periodes as $periode)
                                                                        <option value="{{ $periode->id }}">
                                                                            {{ $periode->date_debut }} -
                                                                            {{ $periode->date_fin }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="text" hidden name="type" value="avance">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="montant">Montant</label>
                                                                <input type="number" class="form-control" id="montant"
                                                                    name="montant" required>
                                                            </div>
                                                            <input type="hidden" name="type" value="avance">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Annuler</button>
                                                            <button type="submit"
                                                                class="btn btn-success">Enregistrer</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>


                                        <!-- Modal d'ajout -->
                                        <div class="modal fade" id="addRetenuModal" tabindex="-1"
                                            aria-labelledby="addRetenuModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="addRetenuModalLabel">Appliquer une
                                                            retenue pour un employé</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('avances_retenues.store') }}" method="POST">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="employe_id">Employé</label>
                                                                <select class="form-control" id="employe_id"
                                                                    name="employe_id" required>
                                                                    @foreach($employees as $employe)
                                                                        <option value="{{ $employe->id }}">{{ $employe->nom }}
                                                                            {{ $employe->prenoms }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="periode_fiscale_id">Période Fiscale</label>
                                                                @if ($periodes->count() > 0)

                                                                    <select class="form-control" id="periode_fiscale_id"
                                                                        name="periode_fiscale_id" required>
                                                                        @foreach($periodes as $periode)
                                                                            <option value="{{ $periode->id }}">
                                                                                {{ $periode->date_debut }} -
                                                                                {{ $periode->date_fin }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                @else
                                                                    <a href="/admin/">Configurez la période fiscale</a>
                                                                @endif
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="montant">Montant</label>
                                                                <input type="number" class="form-control" id="montant"
                                                                    name="montant" required>
                                                            </div>
                                                            <input type="hidden" name="type" value="retenue">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Annuler</button>
                                                            <button type="submit"
                                                                class="btn btn-success">Enregistrer</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal d'édition -->


                                        <script>
                                            function openEditModal(id, montant) {
                                                document.getElementById('montant').value = montant;
                                                document.getElementById('editForm').action = `/avances_retenues/${id}`;
                                                $('#editModal').modal('show');
                                            }
                                        </script>
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

@endsection



@push('scripts')
    <!-- Bootstrap CSS -->

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

    <script>

        document.addEventListener("DOMContentLoaded", function () {
            // Get the URL parameters
            let params = new URLSearchParams(window.location.search);
            let empId = params.get("emp_id"); // Get emp_id from URL

            if (empId) {
                let select = document.getElementById("employee_id"); // Get the select element
                let option = select.querySelector(`option[value="${empId}"]`);

                if (option) {
                    option.selected = true; // Set the selected option
                    select.dispatchEvent(new Event("change")); // Trigger the change event
                }
            }
        });


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

        $(document).on('click', '.nav-link', function () {
            const tabId = $(this).attr('href'); // Get the href (e.g., #tab2)
            window.location.hash = tabId; // Set it as the URL hash
        });

        $(document).ready(function () {
            const hash = window.location.hash; // Get the current URL hash
            if (hash) {
                // Find the tab with the corresponding href
                const tabTrigger = document.querySelector(`a[href="${hash}"]`);
                if (tabTrigger) {
                    const tab = new bootstrap.Tab(tabTrigger); // Create a Bootstrap Tab instance
                    tab.show(); // Show the tab
                }
            }
        });
    </script>

    <script>
        // toastr.success("holla");
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
        function filterDropdown(input) {
            const dropdown = input.closest('.custom-dropdown');
            const filter = input.value.toLowerCase();
            const options = dropdown.querySelectorAll('.option');

            // Show dropdown
            dropdown.classList.add('active');

            // Filter options
            options.forEach(option => {
                const text = option.textContent.toLowerCase();
                option.style.display = text.includes(filter) ? '' : 'none';
            });

            // Close dropdown if input is empty
            if (filter === '') {
                dropdown.classList.remove('active');
            }
        }

        // Event listener for selecting options
        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('option')) {
                const dropdown = e.target.closest('.custom-dropdown');
                const searchInput = dropdown.querySelector('.search-input');
                searchInput.value = e.target.textContent; // Set the selected value
                dropdown.classList.remove('active'); // Close dropdown
            } else if (!e.target.closest('.custom-dropdown')) {
                // Close all dropdowns if clicked outside
                document.querySelectorAll('.custom-dropdown').forEach(dropdown => {
                    dropdown.classList.remove('active');
                });
            }
        });
    </script>

    <script>
        $(function () {
            'use strict';

            var dt_debats_table = $('#paimentHistTable');

            window.table = dt_debats_table;

            if (dt_debats_table.length) {
                var dt_debats = dt_debats_table.DataTable({
                    processing: true, // Show loading indicator while processing
                    serverSide: false,
                    responsive: true, // Set this to true if using server-side processing
                    paging: true, // Enable pagination
                    searching: true, // Enable searching
                    ordering: true, // Enable sorting
                    lengthChange: true, // Allow changing page length
                    info: true, // Display table info
                    dom: '<"card-header border-bottom p-1"<"head-label"><"dt-action-buttons text-right"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                    displayLength: 10,
                    columnDefs: [{
                        targets: [0, 2, 8],
                        orderable: false,
                        className: 'text-center',
                        responsivePriority: 1
                    }],
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
                    }],
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
                $('div.head-label').html('<h6 class="mb-0">Liste des paiments</h6>');
                $('#paimentHistTable_filter input').attr('placeholder', 'Rechercher un paiement...');

            }

        });
    </script>

    <script>

    </script>
@endpush