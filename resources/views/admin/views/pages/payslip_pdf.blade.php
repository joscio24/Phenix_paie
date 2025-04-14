<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fiche de paie</title>

    <style>
        /* Import External Styles */
        @import url("{{ public_path('app-assets/vendors/css/vendors.min.css') }}");
        @import url("{{ public_path('app-assets/vendors/css/charts/apexcharts.css') }}");
        @import url("{{ public_path('app-assets/vendors/css/extensions/toastr.min.css') }}");
        @import url("{{ public_path('app-assets/css/bootstrap.css') }}");
        @import url("{{ public_path('app-assets/css/bootstrap-extended.css') }}");
        @import url("{{ public_path('app-assets/css/colors.css') }}");
        @import url("{{ public_path('app-assets/css/components.css') }}");
        @import url("{{ public_path('app-assets/css/themes/dark-layout.css') }}");
        @import url("{{ public_path('app-assets/css/themes/bordered-layout.css') }}");
        @import url("{{ public_path('app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css') }}");
        @import url("{{ public_path('app-assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css') }}");
        @import url("{{ public_path('app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css') }}");
        @import url("{{ public_path('app-assets/vendors/css/tables/datatable/rowGroup.bootstrap4.min.css') }}");
        @import url("{{ public_path('app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css') }}");
        @import url("{{ public_path('app-assets/css/core/menu/menu-types/vertical-menu.css') }}");
        @import url("{{ public_path('app-assets/css/pages/app-chat.css') }}");
        @import url("{{ public_path('app-assets/css/pages/app-chat-list.css') }}");
        @import url("{{ public_path('app-assets/css/pages/app-invoice.css') }}");

        /* Additional inline styles for PDF compatibility */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            
            width: 100%;
            text-align: left;
            align-items: flex-start;
        }
        td.bordered_td{
            border: 1px solid #ddd;
            
            padding: 8px;
        }

        th {
            background-color: #2d2d2d;
            color: #ffffff;
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo img {
            max-width: 150px;
        }
    </style>
</head>

<body class="">


    <div class="content-body">
        <section class="invoice-preview-wrapper">
            <div class="row bg-white">
                <div class="col-xl-9 col-md-8 col-12">
                    <div class=" ">
                        <table class=" w-100">
                            <tbody >
                                <td >

                                        @if($company)
                                            <div class="logo-wrapper">
                                                <img id="logo-img" width="120px" height="auto"
                                                    src="{{ public_path('/'.$company->logo) ?? 'https://cdn-icons-png.flaticon.com/512/149/149071.png' }}"
                                                    alt="Logo" />
                                            </div>
                                            <p class="card-text mb-25">{{ $company->nom }}</p>
                                            <p class="card-text mb-25">{{ $company->adresse }}</p>
                                            <p class="card-text mb-0">{{ $company->email }}</p>
                                            <p class="card-text mb-0">{{ $company->telephone }}</p>
                                        @else
                                            <p><a href="/admin/parametres">Veuillez Configurer <br> le profile
                                                    d'entreprise</a>
                                            </p>
                                        @endif
                                </td>

                                <td>

                                    <div class="mt-md-0 mt-2">
                                        <h4 class="invoice-title">
                                            Bon de paiement
                                            <span class="invoice-number">#BNP-00{{ $payslip->id }}PBJ</span>
                                        </h4>
                                        <div class="invoice-date-wrapper">
                                            <p class="invoice-date-title">Date : le - {{ now() }}</p>
                                        </div>
                                        <div class="invoice-date-wrapper">
                                            <p class="invoice-date-title w-100">Date de paiement:  {{ $payslip->payment_date }}
                                               
                                            </p>
                                        </div>
                                    </div>

                                </td>
                            </tbody>
                        </table>

                        <hr class="invoice-spacing" />

                        <!-- Address and Contact starts -->
                        <div class="">
                            <div class="row invoice-spacing">
                                <table class="w-100">
                                    <tbody>
                                        <tr class="w-100">
                                            <td colspan="2" class="bordered_td" >

                                                <table>
                                                    <tr>
                                                        <td><h6 class="mb-2">Payé à:</h6></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2"><h1>{{ $employee->etat_civil }} {{ $employee->nom }} {{ $employee->prenoms }}</h1></td>
                                                        
                                                    </tr>
                                                    <tr>
                                                        <td><p class="card-text mb-25"><strong>Titre:</strong></p></td>
                                                        <td> {{ $payslip->title ?? '-' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><p class="card-text mb-25"><strong>Grade:</strong> </p></td>
                                                        <td>{{ $payslip->grade ?? '-' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Adresse: </strong></td>
                                                        <td>{{ $employee->adresse }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><p class="card-text mb-0"><strong>Contacts:</strong> </p></td>
                                                        <td>{{ $employee->telephone }} - {{ $employee->email }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><p class="card-text mb-0"><strong>IFU:</strong></p></td>
                                                        <td> {{ $employee->num_ifu }} </td>
                                                    </tr>
                                                    {{-- <tr>
                                                        <td colspan="4" style="width: 100%; padding: 0;">
                                                            <div class="col-xl-7 p-0">
                                                                <h6 class="mb-25">{{ $employee->etat_civil }} {{ $employee->nom }} {{ $employee->prenoms }}</h6>
                                                                <p class="card-text mb-25"><strong>Titre:</strong> {{ $payslip->title ?? '-' }}</p>
                                                                <p class="card-text mb-25"><strong>Grade:</strong> {{ $payslip->grade ?? '-' }}</p>
                                                                <p class="card-text mb-25" style="word-break: break-all; max-width: 170px;">
                                                                    <strong>Adresse: </strong>{{ $employee->adresse }}
                                                                </p>
                                                                <p class="card-text mb-0"><strong>Contacts:</strong> {{ $employee->telephone }}<br> {{ $employee->email }}</p>
                                                                <p class="card-text mb-0"><strong>IFU:</strong> {{ $employee->num_ifu }} </p>
                                                            </div>
                                                        </td>
                                                    </tr> --}}
                                                </table>
                                                
                                            </td>
                                            <td colspan="4" class="bordered_td" style="width: 100%;">
                                                   <h6 class="mb-2">Détails de paiement:</h6>
                                                    <table>
                                                        <tbody>
                                                            <tr>
                                                                <td class="pr-1">Total Net:</td>
                                                                <td><span
                                                                        class="font-weight-bold">{{ $payslip->net_salary ?? '-' }}</span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="pr-1">Nom de banque</td>
                                                                <td>{{ $employee->nom_banque ?? '-' }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="pr-1">N° de compte</td>
                                                                <td>{{ $employee->compte_bancaire ?? '-' }}</td>
                                                            </tr>


                                                        </tbody>
                                                    </table>
                                                
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                        <!-- Address and Contact ends -->

                        <!-- Invoice Description starts -->
                        <div id="displayResult" class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="py-1">Taxe/allocations description</th>
                                        <th class="py-1">Taux</th>
                                        <th class="py-1">Montant</th>
                                        <th class="py-1">Total déductions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="py-1">
                                            <p class="card-text font-weight-bold mb-25">Cotisations et Taxe</p>
                                            <p class="card-text text-nowrap">

                                            </p>
                                        </td>
                                        <td class="py-1">
                                            <span class="font-weight-bold">{{ $employee->taxe_appliquee }}%

                                                <p>Cotisation</p>
                                            <span
                                                class="font-weight-bold">{{ $employee->cotisation_appliquee ?? '0'}} %</span>
                                            </span>
                                        </td>
                                        <td class="py-1">
                                            <p>Cotisation</p>
                                            <span
                                                class="font-weight-bold">{{ ($payslip->gross_salary * ($employee->taxe_appliquee / 100)) }}</span>
                                        </td>
                                        <td class="py-1">
                                            <span
                                                class="font-weight-bold">{{ ($payslip->gross_salary * ($employee->cotisation_appliquee / 100)) + ($payslip->gross_salary * ($employee->taxe_appliquee / 100)) }}</span>
                                        </td>
                                    </tr>

                                    <tr class="border-bottom">
                                        <td class="py-1">
                                            <p class="card-text font-weight-bold mb-25">Allocations</p>
                                            <p class="card-text text-nowrap">Transport</p>
                                        </td>
                                        <td class="py-1">
                                            <span class="font-weight-bold">-</span>
                                        </td>
                                        <td class="py-1">
                                            <span class="font-weight-bold">{{ $payslip->transport_allowance }}</span>
                                        </td>
                                        <td class="py-1">
                                            <span class="font-weight-bold">{{ $payslip->transport_allowance }}</span>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="py-1">
                                            <p class="card-text font-weight-bold mb-25">Allocations</p>
                                            <p class="card-text text-nowrap">logement</p>
                                        </td>
                                        <td class="py-1">
                                            <span class="font-weight-bold">-</span>
                                        </td>
                                        <td class="py-1">
                                            <span
                                                class="font-weight-bold">{{ $payslip->housing_allowance ?? '-'}}</span>
                                        </td>
                                        <td class="py-1">
                                            <span
                                                class="font-weight-bold">{{ $payslip->housing_allowance ?? '-' }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-1">Avance sur salaire</td>
                                        <td class="py-1">-</td>
                                        <td class="py-1">-</td>
                                        @if (isset($avanceRetenues))
                                            <td class="py-1">
                                                <span class="font-weight-bold" id="avance">
                                                    {{ $avanceRetenues->where('type', 'avance')->first()->montant ?? '0' }}
                                                </span>
                                            </td>
                                            @else
                                            <td></td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td class="py-1">Retenus</td>
                                        <td class="py-1">-</td>
                                        <td class="py-1">-</td>
                                        @if (isset($avanceRetenues))
                                            <td class="py-1"><span class="font-weight-bold"
                                                    id="reduction">{{ $avanceRetenues->where('type', 'retenue')->first()->montant ?? '0' }}</span>
                                            </td>
                                            @else
                                            <td></td>
                                        @endif
                                        <!-- <td class="py-1"><span class="font-weight-bold">{{ $payslip->reduction ?? '0' }}</span></td> -->
                                    </tr>

                                    
                                    <tr>
                                        <td colspan="2"></td> <!-- Empty first td with colspan 2 -->
                                        <td class="text-end">
                                            <p class="invoice-total-title">Salaire de base:</p>
                                        </td>
                                        <td class="text-end">
                                            <p class="invoice-total-amount">{{ $employee->salaire_base }}</p>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td colspan="2"></td>
                                        <td class="text-end">
                                            <p class="invoice-total-title">Allocations</p>
                                        </td>
                                        <td class="text-end">
                                            <p class="invoice-total-amount">{{ ($payslip->housing_allowance + $payslip->transport_allowance) }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td class="text-end">
                                            <p class="invoice-total-title">Deductions (taxes/ avances/ retenues)</p>
                                        </td>
                                        <td class="text-end">
                                            <p class="invoice-total-amount">{{ $payslip->total_deductions }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td class="text-end">
                                            <p class="invoice-total-title">Taxe:</p>
                                        </td>
                                        <td class="text-end">
                                            <p class="invoice-total-amount">{{ $payslip->tax_paye }}%</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td class="text-end">
                                            <hr class="my-50" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td class="text-end">
                                            <p class="invoice-total-title"><strong>Total:</strong></p> <!-- Bold for the total -->
                                        </td>
                                        <td class="text-end">
                                            <p class="invoice-total-amount"><strong>{{ $payslip->net_salary ?? '-' }}</strong></p> <!-- Bold total value -->
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                       

                        <!-- Invoice Description ends -->

                        <hr class="invoice-spacing" />

                        <!-- Invoice Note starts -->
                        <div class="card-body invoice-padding pt-0">
                            <div class="row">
                                <div class="col-12">
                                    <span class="font-weight-bold">Note:</span>
                                    <span>Ce fut un plaisir de travailler avec vous</span>
                                </div>
                            </div>
                        </div>
                        <!-- Invoice Note ends -->
                    </div>
                </div>
            </div>
        </section>
    </div>


</body>

</html>