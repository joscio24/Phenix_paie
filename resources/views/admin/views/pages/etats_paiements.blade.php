@extends('admin.views.layouts.app')
@section('title', 'Phenix ERP - Etat des paiements')
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
                            <h2 class="content-header-title float-left mb-0">Paiements</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="/admin/paiements">Paiements</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Etat des paiements</a>
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
                                    <a class="nav-link d-flex align-items-center  active" id="fichepaie-tab"
                                        data-toggle="tab" href="#fichePaie" aria-controls="social" role="tab"
                                        aria-selected="false">
                                        <i data-feather="file"></i><span class="d-none d-sm-block">Créer Fiches de
                                            paie</span>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link d-flex align-items-center " id="payList-tab" data-toggle="tab"
                                        href="#paySlipList" aria-controls="social" role="tab" aria-selected="false">
                                        <i data-feather="list"></i><span class="d-ne d-sm-block">Listes des fiches de
                                            paiements</span>
                                    </a>
                                </li>

                                <li hidden class="nav-item">
                                    <a class="nav-link d-flex align-items-center" id="payerEmp-tab" data-toggle="tab"
                                        href="#payerEmp" aria-controls="social" role="tab" aria-selected="false">
                                        <i data-feather="dollar-sign"></i><span class="d-none d-sm-block">Bons de paiement
                                            (Vues générées)</span>
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

                                </div>


                                <!-- Social Tab starts -->
                                <div class="tab-pane   active" id="fichePaie" aria-labelledby="social-tab" role="tabpanel">
                                    <!-- users edit social form start -->

                                    <div class="container mt-4">
                                        <h2 class="mb-4">Créer une fiche de paie</h2>

                                        <form method="POST" id="payslipForm" action="{{ route('admin.payslips.store') }}">
                                            @csrf

                                            @if(session('success'))
                                                <div class="alert alert-success">{{ session('success') }}</div>
                                            @endif

                                            @if(session('error'))
                                                <div class="alert alert-danger">{{ session('error') }}</div>
                                            @endif
                                            <div id="formAlert"></div>

                                            <!-- Employee Selection -->
                                            <section class="mb-4">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="employee_id" class="form-label">Employé</label>
                                                        <select name="employee_id" id="employee_id"
                                                            class="form-select form-control @error('employee_id') is-invalid @enderror"
                                                            required>
                                                            <option value="">Sélectionner un Employé</option>
                                                            @foreach($paiements as $paiement)
                                                                <option value="{{ $paiement->employee_id }}">
                                                                    {{ $paiement->employee->nom }}
                                                                    {{ $paiement->employee->prenoms }} - Salaire de base:
                                                                    {{ $paiement->employee->salaire_base }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('employee_id')            <div class="invalid-feedback">{{ $message }}</div> @enderror
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label">Titre</label>
                                                        <input type="text" name="title" class="form-control">
                                                        @error('title')                   <div class="invalid-feedback">{{ $message }}</div> @enderror
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label">Grade</label>
                                                        <input type="text" name="grade" class="form-control">
                                                        @error('grade')                           <div class="invalid-feedback">{{ $message }}</div> @enderror
                                                    </div>
                                                </div>
                                            </section>

                                            <!-- Salary & Allowances -->
                                            <section class="mb-4">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label class="form-label">Salaire de base</label>
                                                        <input type="text" name="base_salary" id="base_salary"
                                                            class="form-control" readonly>
                                                        @error('base_salary')                                              <div class="invalid-feedback">{{ $message }}</div> @enderror
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label">Allocation de logement</label>
                                                        <input type="text" name="housing_allowance" value="0"
                                                            id="housing_allowance" class="form-control">
                                                        @error('housing_allowance')                   <div class="invalid-feedback">{{ $message }}</div> @enderror
                                                    </div>
                                                </div>

                                                <div class="row mt-3" id="allowance-container">
                                                    <div class="col-md-12">
                                                        <label class="form-label">Indemnité de transport</label>
                                                        <input type="text" name="transport_allowance" value="0"
                                                            id="transport_allowance" class="form-control">
                                                        @error('transport_allowance')                                      <div class="invalid-feedback">{{ $message }}</div> @enderror
                                                    </div>
                                                    <!-- <div class="col-md-6">
                                                        <label class="form-label">Allocation de services publics</label>
                                                        <input type="text" name="public_services_allowance" value="0" id="public_services_allowance" class="form-control">
                                                        @error('public_services_allowance') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                                    </div> -->


                                                    <div class="col-md-12">
                                                        <label class="form-label">Allocation de services publics</label>
                                                        <input type="text" id="total_allowance" name="add_allowance[]"
                                                            value="0" class="form-control allowance-input allowance-input">
                                                        <button type="button" class="btn btn-primary mt-2"
                                                            onclick="addAllowance()">+</button>
                                                    </div>

                                                    <!-- Container for dynamically added allowances -->
                                                    <div></div>


                                                    <!-- Hidden field to store the total sum
                                                    <input type="hidden"  name="" id="public_services_allowance"> -->

                                                </div>
                                                <!-- Button to add new allowance fields -->
                                                <div class="col-md-12 mt-5">
                                                    <label class="form-label"><strong>Allocations Totales</strong></label>
                                                    <input type="text" id="public_services_allowance"
                                                        name="public_services_allowance" value="0"
                                                        class="form-control allowance-input">
                                                </div>
                                            </section>

                                            <script>
                                                document.addEventListener('DOMContentLoaded', function () {
                                                    updateTotalAllowance(); // Initial calculation

                                                    // Recalculate when any allowance field is changed
                                                    document.getElementById('allowance-container').addEventListener('input', updateTotalAllowance);
                                                });

                                                // Function to add a new allowance input field
                                                function addAllowance() {
                                                    let container = document.getElementById('allowance-container');

                                                    let div = document.createElement('div');
                                                    div.classList.add('col-md-12', 'mt-2', 'd-flex', 'jsutify-content-between', 'form-group');
                                                    div.innerHTML = `
                                                        <input type="text" name="add_allowance[]" value="0" class="form-control allowance-input">

                                                            <button type="button" class="btn btn-danger " onclick="removeAllowance(this)">−</button>
                                                            <button type="button" class="btn btn-primary" onclick="addAllowance()">+</button>

                                                        `;

                                                    container.appendChild(div);
                                                    updateTotalAllowance();
                                                }

                                                // Function to remove an allowance input
                                                function removeAllowance(button) {
                                                    button.parentElement.remove();
                                                    updateTotalAllowance();
                                                }

                                                // Function to calculate total allowance
                                                function updateTotalAllowance() {
                                                    updateSalary();
                                                    let inputs = document.querySelectorAll('.allowance-input');
                                                    let total = 0;
                                                    document.getElementById('public_services_allowance').value = 0

                                                    inputs.forEach(input => {
                                                        total += parseFloat(input.value) || 0;
                                                    });

                                                    document.getElementById('public_services_allowance').value = total;
                                                }
                                            </script>

                                            <!-- Deductions & Salary Calculation -->
                                            <section class="mb-4">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label class="form-label">
                                                            <input type="checkbox" id="enable_tax" onclick="toggleTax()">
                                                            Enable TAX/PAYE
                                                        </label>
                                                        <input type="text" name="tax_paye" id="tax_paye"
                                                            class="form-control" readonly>
                                                        @error('tax_paye')                  <div class="invalid-feedback">{{ $message }}</div> @enderror
                                                    </div>



                                                    <div class="col-md-4">
                                                        <label class="form-label">CNSS</label>
                                                        <input type="text" name="cnss" id="cnss" value="0"
                                                            class="form-control">
                                                        @error('cnss')                                     <div class="invalid-feedback">{{ $message }}</div> @enderror
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label">Total des déductions</label>
                                                        <input type="text" name="total_deductions" id="total_deductions"
                                                            class="form-control" readonly>
                                                        @error('total_deductions')          <div class="invalid-feedback">{{ $message }}</div> @enderror
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
                                                </div>
                                            </section>

                                            <section>
                                                <div class="mb-3">
                                                    <label class="form-label">Salaire brut</label>
                                                    <input type="text" name="gross_salary" id="gross_salary"
                                                        class="form-control" readonly>
                                                    @error('gross_salary')                                            <div class="invalid-feedback">{{ $message }}</div> @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Salaire net</label>
                                                    <input type="text" name="net_salary" id="net_salary"
                                                        class="form-control" readonly>
                                                    @error('net_salary')          <div class="invalid-feedback">{{ $message }}</div> @enderror
                                                </div>

                                                <!-- Submit Button -->
                                                <button type="submit" class="btn btn-warning w-100">Créer le bon de
                                                    salaire</button>
                                            </section>
                                        </form>



                                    </div>

                                    <!-- users edit social form ends -->
                                </div>

                                <div class="tab-pane" id="payerEmp" aria-labelledby="payer-emp" role="tabpanel">

                                </div>


                                <div class="tab-pane " id="paySlipList" aria-labelledby="pay-list" role="tabpanel">
                                    <div class="row w-100">
                                        <div class="col-lg-12 container table-responsive mt-5">
                                            <table id="payslipTable" class="display table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Employee</th>
                                                        <th>Title</th>
                                                        <th>Grade</th>
                                                        <th>Base Salary</th>
                                                        <th>Housing Allowance</th>
                                                        <th>Transport Allowance</th>
                                                        <th>Tax</th>
                                                        <th>Total Deductions</th>
                                                        <th>Net Salary</th>
                                                        <th>Payment Date</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
                                        </div>
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



    <!-- Edit Payslip Modal -->
    <!-- Edit Payslip Modal -->
    <div class="modal fade" id="editPayslipModal" tabindex="-1" aria-labelledby="editPayslipModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPayslipModalLabel">Modifier le Bon de Paiement</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">x</button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="editPayslipForm">
                        @csrf
                        <input type="hidden" id="edit-payslip_id" name="id">

                        <div id="formAlert"></div>
                        <!-- Employee Selection -->
                        <section class="mb-4">
                            <div class="row">
                                <div class="col-md-4" hidden>
                                    <label for="edit-employee_id" class="form-label">Employé</label>
                                    <input type="text" id="edit-employee_id" name="employee_id" hidden class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Titre</label>
                                    <input type="text" name="title" id="edit-title" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Grade</label>
                                    <input type="text" name="grade" id="edit-grade" class="form-control">
                                </div>
                            </div>
                        </section>

                        <!-- Salary & Allowances -->
                        <section class="mb-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label">Salaire de base</label>
                                    <input type="text" name="base_salary" id="edit-base_salary" class="form-control"
                                        readonly>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Allocation de logement</label>
                                    <input type="text" name="housing_allowance" id="edit-housing_allowance"
                                        class="form-control">
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label class="form-label">Indemnité de transport</label>
                                    <input type="text" name="transport_allowance" id="edit-transport_allowance"
                                        class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Allocation de services publics</label>
                                    <input type="text" name="public_services_allowance" id="edit-public_services_allowance"
                                        class="form-control">
                                </div>
                            </div>
                        </section>


                        <!-- Deductions & Salary Calculation -->
                        <section class="mb-4">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="form-label">TAX/PAYE (%)</label>
                                    <input type="text" name="tax_paye" id="edit-tax_paye" class="form-control" readonly>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">CNSS</label>
                                    <input type="text" name="cnss" id="edit-cnss" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Total des déductions</label>
                                    <input type="text" name="total_deductions" id="edit-total_deductions"
                                        class="form-control" readonly>
                                </div>
                            </div>
                        </section>

                        <section>
                            <div class="mb-3">
                                <label class="form-label">Salaire brut</label>
                                <input type="text" name="gross_salary" id="edit-gross_salary" class="form-control" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Salaire net</label>
                                <input type="text" name="net_salary" id="edit-net_salary" class="form-control" readonly>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-warning w-100">Mettre à jour</button>
                        </section>
                    </form>
                </div>
            </div>
        </div>
    </div>



@endsection



@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Open Edit Modal and Fetch Data



            // Handle Form Submission
            document.getElementById("editPayslipForm").addEventListener("submit", function (event) {
                event.preventDefault();

                let payslipId = document.getElementById("payslip_id").value;
                let formData = new FormData(this);

                fetch(`/admin/payslips/${payslipId}/update`, {
                    method: "POST",
                    body: formData,
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert("Payslip updated successfully!");
                            location.reload();
                        } else {
                            alert("Error updating payslip.");
                        }
                    })
                    .catch(error => console.error("Error submitting form:", error));
            });
        });



        $(document).ready(function () {
            $('#payslipTable').DataTable({
                processing: true,
                serverSide: false,
                responsive: true,
                ordering: false,
                ajax: {
                    url: `/admin/payslips/`, // Fetch data from the created route
                    type: 'GET'
                },
                columnDefs: [{
                    targets: 10,
                    orderable: false,
                    responsivePriority: 1,
                }],
                columns: [{
                    data: null,
                    name: 'employee',
                    render: function (data, type, row) {
                        return `${row.employee.nom} ${row.employee.prenoms}`;
                    }
                },
                {
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'grade',
                    name: 'grade'
                },
                {
                    data: 'base_salary',
                    name: 'base_salary'
                },
                {
                    data: 'housing_allowance',
                    name: 'housing_allowance'
                },
                {
                    data: 'transport_allowance',
                    name: 'transport_allowance'
                },
                {
                    data: 'tax_paye',
                    name: 'tax_paye'
                },
                {
                    data: 'total_deductions',
                    name: 'total_deductions'
                },
                {
                    data: 'net_salary',
                    name: 'net_salary'
                },
                {
                    data: 'payment_date',
                    name: 'payment_date'
                },
                {
                    data: null,
                    render: function (data, type, row) {
                        return `<td>
                                <div class="dropdown">
                                        <button class="btn btn-primary text-white btn-sm " type="button" id="actionsMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Actions
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
                                            <li><a class="dropdown-item accept-action editPayslipBtn" onclick="editThis(${row.id})" href="#" data-id="${row.id}">Modifier</a></li>
                                            <li><a class="dropdown-item reject-action" href="/admin/payslips/${row.id}" data-kyc-id="${row.id}">Générer le bon de paiement</a></li>
                                        </ul>
                                    </div>
                            </td>`;
                    }
                }
                ]
            });
        });



        function editThis(payslipId) {
            fetch(`/admin/payslips/${payslipId}/show`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById("edit-payslip_id").value = data.data.id;
                    document.getElementById("edit-employee_id").value = data.data.employee_id;
                    document.getElementById("edit-title").value = data.data.title;
                    document.getElementById("edit-grade").value = data.data.grade;
                    document.getElementById("edit-base_salary").value = data.data.base_salary;
                    document.getElementById("edit-housing_allowance").value = data.data.housing_allowance;
                    document.getElementById("edit-transport_allowance").value = data.data.transport_allowance;
                    document.getElementById("edit-public_services_allowance").value = data.data.public_services_allowance;
                    document.getElementById("edit-tax_paye").value = data.data.tax_paye;
                    document.getElementById("edit-cnss").value = data.data.cnss;
                    document.getElementById("edit-total_deductions").value = data.data.total_deductions;
                    document.getElementById("edit-gross_salary").value = data.data.gross_salary;
                    document.getElementById("edit-net_salary").value = data.data.net_salary;

                    // calculateEditSalary(data.employee_id);

                    // Show the modal
                    new bootstrap.Modal(document.getElementById("editPayslipModal")).show();
                })
                .catch(error => console.error("Error fetching payslip data:", error));

        }


        // Function to calculate salary details
        function calculateEditSalary(employeeId) {


            // Fill in allowances and tax
            document.getElementById('edit-housing_allowance').value = paiement.allocation || 0;
            document.getElementById('edit-tax_paye').value = paiement.employee.taxe_appliquee || 0;

            // Calculate deductions (assuming "deduction" is a percentage)
            const baseSalary = parseFloat(paiement.employee.salaire_base) || 0;
            const deductionRate = parseFloat(paiement.deduction) || 0;
            const totalDeductions = (baseSalary * deductionRate) / 100;

            document.getElementById('edit-gross_salary').value = baseSalary;
            document.getElementById('edit-total_deductions').value = totalDeductions.toFixed(2);

            // Calculate net salary
            const netSalary = baseSalary - totalDeductions;
            document.getElementById('edit-net_salary').value = netSalary.toFixed(2);

        }

        // Function to clear edit modal fields
        function clearEditFields() {
            document.getElementById('edit-housing_allowance').value = "";
            document.getElementById('edit-tax_paye').value = "";
            document.getElementById('edit-gross_salary').value = "";
            document.getElementById('edit-total_deductions').value = "";
            document.getElementById('edit-net_salary').value = "";
        }

        // Open Edit Modal and Fetch Data


        // Handle Form Submission
        document.getElementById("editPayslipForm").addEventListener("submit", function (event) {
            event.preventDefault();

            let payslipId = document.getElementById("edit-payslip_id").value;
            let formData = new FormData(this);

            fetch(`/admin/payslips/${payslipId}/update`, {
                method: "POST",
                body: formData,
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert("Payslip updated successfully!");
                        location.reload();
                    } else {
                        alert("Error updating payslip.");
                    }
                })
                .catch(error => console.error("Error submitting form:", error));
        });
    </script>

    <script>
        // document.addEventListener('DOMContentLoaded', function() {
        //     document.getElementById('payslipForm').addEventListener('submit', function(event) {
        //         event.preventDefault(); // Prevent default form submission

        //         let form = this;
        //         let formData = new FormData(form);
        //         let submitButton = form.querySelector('button[type="submit"]');

        //         // Disable submit button & show loading
        //         submitButton.disabled = true;
        //         submitButton.innerHTML = 'Processing...';

        //         fetch(form.action, {
        //                 method: 'POST',
        //                 body: formData,
        //                 headers: {
        //                     'X-Requested-With': 'XMLHttpRequest',
        //                     'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        //                 }
        //             })
        //             .then(response => response.json())
        //             .then(data => {
        //                 submitButton.disabled = false;
        //                 submitButton.innerHTML = 'Créer le bon de salaire';

        //                 let alertBox = document.getElementById('formAlert');
        //                 if (data.success) {
        //                     alertBox.innerHTML = `<div class="alert alert-success">${data.message}</div>`;
        //                     form.reset(); // Reset form on success
        //                 } else {
        //                     alertBox.innerHTML = `<div class="alert alert-danger">${data.message}</div>`;
        //                 }
        //             })
        //             .catch(error => {
        //                 submitButton.disabled = false;
        //                 submitButton.innerHTML = 'Créer le bon de salaire';

        //                 console.error('Error:', error);
        //                 document.getElementById('formAlert').innerHTML = `<div class="alert alert-danger">Une erreur est survenue. Veuillez réessayer.</div>`;
        //             });
        //     });
        // });


        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('payslipForm').addEventListener('submit', function (event) {
                event.preventDefault(); // Prevent default form submission

                let form = this;
                let formData = new FormData(form);
                let submitButton = form.querySelector('button[type="submit"]');

                // Disable submit button & show loading
                submitButton.disabled = true;
                submitButton.innerHTML = 'Processing...';

                fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                        submitButton.disabled = false;
                        submitButton.innerHTML = 'Créer le bon de salaire';

                        let alertBox = document.getElementById('formAlert');
                        if (data.success) {
                            alertBox.innerHTML = `<div class="alert alert-success">${data.message}</div>`;
                            form.reset(); // Reset form on success
                        } else {
                            alertBox.innerHTML = `<div class="alert alert-danger">${data.message}</div>`;
                        }
                    })
                    .catch(error => {
                        submitButton.disabled = false;
                        submitButton.innerHTML = 'Créer le bon de salaire';

                        console.error('Error:', error);
                        document.getElementById('formAlert').innerHTML = `<div class="alert alert-danger">Une erreur est survenue. Veuillez réessayer.</div>`;
                    });
            });

            document.getElementById('gross_salary').addEventListener('input', updateSalary);
            document.getElementById('enable_tax').addEventListener('change', updateSalary);
        });

        function toggleTax() {
            let taxField = document.getElementById("tax_paye");
            let enableCheckbox = document.getElementById("enable_tax");

            if (enableCheckbox.checked) {
                taxField.removeAttribute("readonly");
            } else {
                taxField.setAttribute("readonly", true);
                // taxField.value = "0"; // Clear value so it's not submitted
            }
            updateSalary();
        }

        function updateSalary() {
            let grossSalary = parseFloat(document.getElementById("gross_salary").value) || 0;
            let taxRate = parseFloat(document.getElementById("tax_paye").value) || 0;
            let allocations = parseFloat(document.getElementById("public_services_allowance").value) || 0;
            let netDeduction = parseFloat(document.getElementById("total_deductions").value) || 0
            let isTaxEnabled = document.getElementById("enable_tax").checked;
            let previousDeduction = netDeduction;
            if (isTaxEnabled) {
                // netDeduction = netDeduction + (grossSalary * taxRate / 100);
                document.getElementById("total_deductions").value = (grossSalary * taxRate / 100);
            } else {
                document.getElementById("total_deductions").value = (grossSalary * taxRate / 100) * 0;
                // alert("Please select");
            }

            let netSalary = isTaxEnabled ? (grossSalary - (grossSalary * taxRate / 100) + allocations) : grossSalary + allocations;
            document.getElementById("net_salary").value = netSalary.toFixed(2);
        }
    </script>



    <script>
        document.addEventListener("DOMContentLoaded", function () {

            document.getElementById('employee_id').addEventListener('change', function () {
                const employeeId = this.value;

                if (employeeId) {
                    const employees = @json($employees);
                    const paiements = @json($paiements);
                    const avancesRetenues = @json($avancesRetenues);

                    const employee = employees.find(emp => emp.id == employeeId);
                    if (employee) {
                        // Salaire de base
                        document.getElementById('base_salary').value = employee.salaire_base || 0;

                        // Récupérer le paiement correspondant
                        const paiement = paiements.find(p => p.employee_id == employeeId);
                        if (paiement) {
                            // Allocation et taxe
                            document.getElementById('housing_allowance').value = paiement.allocation || 0;
                            document.getElementById('tax_paye').value = employee.taxe_appliquee || 0;

                            // Calcul des déductions fiscales (taxe appliquée)
                            const baseSalary = parseFloat(employee.salaire_base) || 0;
                            const deductionRate = parseFloat(paiement.deduction) || 0;
                            const taxDeductions = (baseSalary * deductionRate) / 100;

                            // Récupérer les avances et retenues
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

                            // Total des déductions (taxe + avances + retenues)
                            const totalDeductions = taxDeductions + avance + retenue;
                            document.getElementById('total_deductions').value = totalDeductions.toFixed(2);

                            // Calcul du salaire net
                            const netSalary = baseSalary - totalDeductions;
                            document.getElementById('gross_salary').value = baseSalary.toFixed(2);
                            document.getElementById('net_salary').value = netSalary.toFixed(2);
                        } else {
                            clearFields();
                        }
                    }
                } else {
                    clearFields();
                }
            });

            // Fonction pour vider les champs
            function clearFields() {
                document.getElementById('base_salary').value = '';
                document.getElementById('housing_allowance').value = '';
                document.getElementById('tax_paye').value = '';
                document.getElementById('avance_salaire').value = 0;
                document.getElementById('retenue_salaire').value = 0;
                document.getElementById('total_deductions').value = '';
                document.getElementById('gross_salary').value = '';
                document.getElementById('net_salary').value = '';
            }

            // function clearFields() {
            //     document.getElementById('base_salary').value = '';
            //     document.getElementById('housing_allowance').value = '';
            //     document.getElementById('tax_paye').value = '';
            //     document.getElementById('total_deductions').value = '';
            //     document.getElementById('net_salary').value = '';
            // }
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

            window.table = dt_debats_table;

            if (dt_debats_table.length) {
                var dt_debats = dt_debats_table.DataTable({
                    processing: true, // Show loading indicator while processing
                    serverSide: false, // Set this to true if using server-side processing
                    paging: true, // Enable pagination
                    searching: true, // Enable searching
                    ordering: false, // Enable sorting
                    order: ['DESC']
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