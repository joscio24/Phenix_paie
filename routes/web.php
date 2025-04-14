<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PayslipController;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\CircularController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\CongeController;
use App\Http\Controllers\PeriodeExerciceController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplyController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\TaxeController;
use App\Http\Controllers\CompanyController;

use App\Http\Controllers\AvanceRetenueController;


use App\Http\Controllers\Auth\LoginController;

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    // Employees


    Route::resource('avances_retenues', AvanceRetenueController::class);

    Route::prefix('admin')->name('admin.')->group(function () {
        // Payslip Routes
        Route::resource('payslips', PayslipController::class);
        Route::get('payslips', [PayslipController::class, 'index'])->name('payslips.index');
        Route::get('payslips/create', [PayslipController::class, 'create'])->name('payslips.create');
        Route::post('payslips/add', [PayslipController::class, 'store'])->name('payslips.store');
        Route::get('payslips/', [PayslipController::class, 'data'])->name('payslips.data');
        Route::get('payslips/{id}/show', [PayslipController::class, 'getSlip'])->name('payslips.show');
        Route::get('payslips/{id}/edit', [PayslipController::class, 'edit'])->name('payslips.edit');
        Route::put('payslips/{id}', [PayslipController::class, 'update'])->name('payslips.update');
        Route::delete('payslips/{id}', [PayslipController::class, 'destroy'])->name('payslips.destroy');
        Route::resource('conges', CongeController::class);
        Route::get('/generate-pdf/{id}', [PayslipController::class, 'showPDF']);
        Route::get('/download-generate-pdf/{id}', [PayslipController::class, 'downloadPDF']);
        Route::post('conges/store', [CongeController::class, 'store'])->name('conges.store');
        Route::post('conges/{conge}/terminer', [CongeController::class, 'changerStatut'])->name('conges.terminer');
    });

    Route::post('/periodes/generate', [PeriodeExerciceController::class, 'store'])->name('periodes.generate');
    Route::post('/periodes/store', [PeriodeExerciceController::class, 'createFiscalPeriod'])->name('periodes.store');
    Route::put('/periodes/update/{id}', [PeriodeExerciceController::class, 'update'])->name('periodes.update');
    Route::get('/periodes/list', [PeriodeExerciceController::class, 'getPeriodes']);

    // Routes pour l'édition et la suppression avec modals
    Route::get('/periodes/{id}/edit', [PeriodeExerciceController::class, 'edit'])->name('periodes.edit');
    Route::delete('/periodes/{id}', [PeriodeExerciceController::class, 'destroy'])->name('periodes.destroy');

    Route::post('conges/{conge}/terminer', [CongeController::class, 'changerStatut'])->name('conges.terminer');
    Route::post('conges/store', [CongeController::class, 'store'])->name('conges.store');
    Route::put('conges/update', [CongeController::class, 'update'])->name('conges.update');
    Route::delete('conges/delete', [CongeController::class, 'destroy'])->name('conges.destroy');
    Route::get('/admin/dashboard', [PagesController::class, 'index'])->name('dashboard');
    Route::get('/admin/tb', [DashboardController::class, 'tb'])->name('dashboard');

    Route::get('/employees', [EmployeeController::class, 'index'])->name('employees');
    Route::get('/employees/create_employee', [EmployeeController::class, 'create'])->name('employees.create');
    Route::post('/employees/create', [EmployeeController::class, 'store'])->name('employees.store');
    Route::get('/employees/{id}/edit', [EmployeeController::class, 'show'])->name('employees.edit');
    Route::put('/employees/{id}/update', [EmployeeController::class, 'update'])->name('employees.update');
    Route::delete('/employees/{id}/delete', [EmployeeController::class, 'destroy'])->name('employees.delete');
    // Route::resource('employees', EmployeeController::class);
    // Route::resource('taxes', TaxController::class);
    // Route::resource('pay-slips', PaySlipController::class);
    Route::post('/companies/store', [CompanyController::class, 'store'])->name('companies.store');
    Route::put('/company/update/{id}', [CompanyController::class, 'update'])->name('company.update');


    Route::post('taxte', [TaxeController::class, 'store'])->name('taxes.store');
    Route::put('taxes/update/{id}', [TaxeController::class, 'update'])->name('taxes.update');
    Route::delete('taxes/delete/{id}', [TaxeController::class, 'destroy'])->name('taxe.destroy');
    Route::put('/taxes/{id}', [TaxeController::class, 'update'])->name('tax.update');
    Route::delete('/taxes/{id}', [TaxeController::class, 'destroy'])->name('tax.destroy');

    Route::get('/admin/employees/creer', [PagesController::class, 'employeCreer']);
    Route::get('/admin/employes', [PagesController::class, 'employes']);
    Route::get('/admin/paiements', [PagesController::class, 'paiements'])->name('admin.paiements');
    Route::get('/admin/etats_paiements', [PagesController::class, 'etats_paiements']);
    Route::get('/admin/taxes_cotisations', [PagesController::class, 'taxes_cotisations']);
    Route::get('/admin/gestion_conges', [CongeController::class, 'index']);
    Route::get('/admin/notifications', [PagesController::class, 'notifications']);
    Route::get('/admin/parametres', [PagesController::class, 'parametres']);
    Route::get('/admin/supports', [PagesController::class, 'supports']);


    // Bons de paiement
    Route::get('/bons-paiement', [PaymentController::class, 'bonsPaiement'])->name('bons-paiement');

    // Paiements
    Route::get('/paiements', [PaymentController::class, 'index'])->name('paiements');
    Route::get('/paiements/payer_employe', [PaymentController::class, 'payer'])->name('paiements.payer');
    Route::post('/paiements/payer', [PaymentController::class, 'store'])->name('paiements.store');

    // Notes
    Route::get('/notes', [NoteController::class, 'index'])->name('notes');

    // Circulaires
    Route::get('/circulaires', [CircularController::class, 'index'])->name('circulaires');

    // Entretien
    Route::get('/entretien', [MaintenanceController::class, 'index'])->name('entretien');

    // Ressources
    Route::get('/ressources', [ResourceController::class, 'index'])->name('ressources');

    // Budget de projet
    Route::get('/budget-projet', [BudgetController::class, 'index'])->name('budget-projet');

    // Stocks et inventaires
    Route::get('/stocks-inventaires', [StockController::class, 'index'])->name('stocks-inventaires');

    // Notifications
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications');

    // Produits
    Route::get('/produits', [ProductController::class, 'index'])->name('produits');

    // Approvisionnement
    Route::get('/approvisionnement', [SupplyController::class, 'index'])->name('approvisionnement');


    Route::get('/', [PagesController::class, 'index']);
});
