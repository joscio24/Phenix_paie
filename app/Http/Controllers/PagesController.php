<?php

namespace App\Http\Controllers;

use App\Models\Tax;
use App\Models\PaySlip;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Paiement;

use App\Models\AvanceRetenue;

use App\Models\{Employee, Memo, Taxe, PeriodeExercice, PeriodeFiscale, Company, PaymentRequest, StaffApplication};

use Illuminate\Http\Request;

class PagesController extends Controller
{
    //
    public function index()
    {
        $updated_at = now();

        return view('admin.views.index', [
            'updated_at' => $updated_at,
            'employees' => Employee::all(),
            'memos' => Memo::all(),
            'payslips' => Payslip::all(),
            'paymentRequests' => PaymentRequest::all(),
            'staffApplications' => StaffApplication::first(),
        ]);
        // return view('admin.views.index');
    }

    public function dashboard()
    {



        $updated_at = now();

        return view('index', [
            'updated_at' => $updated_at,
            'employees' => Employee::all(),
            'memos' => Memo::all(),
            'paymentRequests' => PaymentRequest::all(),
            'staffApplications' => StaffApplication::first(),
        ]);
    }

    public function employeCreer()
    {

        $taxes = Tax::all();
        return view('admin.views.pages.creer_employes', compact('taxes'));
    }
    public function employes()
    {
        $employees = Employee::all();
        // Récupérer les données des taxes
        $taxes = Tax::all();

        // Récupérer les bulletins de salaire
        $paySlips = PaySlip::all();
        return view('admin.views.pages.employes', compact('employees', 'taxes', 'paySlips'));
    }
    public function paiements()
    {
        $user = Auth::user();
        $employees = Employee::all();
        $paiements = Paiement::all();
        $avancesRetenues = AvanceRetenue::all(); //
        $periodes = PeriodeExercice::all();

        $taxe = Taxe::all();
        return view('admin.views.pages.paiements', compact('employees', 'avancesRetenues', 'periodes', 'taxe', 'paiements'));
    }
    public function etats_paiements()
    {
        $company = Company::first();
        return view('admin.views.pages.etats_paiements', [
            'employees' => Employee::all(),
            'company' => Company::first(),
            'avancesRetenues' => AvanceRetenue::all(),
            'paiements' => Paiement::with('employee')->get(),
        ]);
    }
    public function taxes_cotisations()
    {
        $taxe = Taxe::all();
        return view('admin.views.pages.taxes_cotisations', compact('taxe'));
    }
    public function gestion_conges()
    {
        return view('admin.views.pages.gestion_conges');
    }
    public function notifications()
    {
        return view('admin.views.pages.notifications');
    }
    public function parametres()
    {
        $company = Company::first();
        $periodes = PeriodeExercice::all();
        return view('admin.views.pages.parametres', compact('company', 'periodes'));
    }
    public function supports()
    {
        return view('admin.views.pages.supports');
    }
}
