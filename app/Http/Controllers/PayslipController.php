<?php

namespace App\Http\Controllers;

use App\Models\AvanceRetenue;
use App\Models\Payslip;
use App\Models\Employee;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;

class PayslipController extends Controller
{
    /**
     * Display a listing of the payslips.
     */
    public function index()
    {
        $payslips = Payslip::latest()->paginate(10);
        return view('payslips.index', compact('payslips'));
    }

    /**
     * Show the form for creating a new payslip.
     */
    public function create()
    {
        $employees = Employee::all();
        return view('payslips.create', compact('employees'));
    }

    /**
     * Store a newly created payslip in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'title' => 'nullable|string|max:255',
            'grade' => 'nullable|string|max:255',
            'base_salary' => 'required|numeric',
            'housing_allowance' => 'required|numeric',
            'transport_allowance' => 'required|numeric',
            'public_services_allowance' => 'required|numeric',
            'tax_paye' => 'required|numeric',
            'cnss' => 'required|numeric',
            'total_deductions' => 'required|numeric',
            'gross_salary' => 'required|numeric', // Added to match the model
            'net_salary' => 'required|numeric',
            'payment_date' => now(), // Added to match the model
        ]);


        try {
            // Create Payslip
            $payslip = Payslip::create([
                'employee_id' => $request->employee_id,
                'title' => $request->title,
                'grade' => $request->grade,
                'base_salary' => $request->base_salary,
                'housing_allowance' => $request->housing_allowance,
                'transport_allowance' => $request->transport_allowance,
                'public_services_allowance' => $request->public_services_allowance ?? 0, // Default to 0 if not filled
                'tax_paye' => $request->tax_paye,
                'cnss' => $request->cnss,
                'total_deductions' => $request->total_deductions,
                'gross_salary' => $request->gross_salary, // Added to match validation
                'net_salary' => $request->net_salary,
                'payment_date' => now(), // Automatically set the payment date
                'reference_number' => strtoupper(\Illuminate\Support\Str::random(10)), // Random reference number
            ]);


            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Payslip created successfully!',
                    'data' => $payslip
                ], 201);
            }

            // Otherwise, return a redirect with a session message
            return redirect()->route('payslips.index')->with('success', 'Payslip created successfully!');
        } catch (QueryException $e) {
            Log::error('Payslip creation failed: ' . $e->getMessage());

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to create payslip. Please try again.',
                    'data' => $e
                ], 500);
            }

            return redirect()->back()->withInput()->with('error', 'Failed to create payslip. Please try again.');
        }
    }

    /**
     * Display the specified payslip.
     */
    public function show($id)
    {
        $payslip = Payslip::findOrFail($id);
        $company = Company::first();
        $employee = Employee::where('id', $payslip->employee_id)->first();
        $avanceRetenues = AvanceRetenue::where('employe_id', $payslip->employee_id)->first();
        // dd($employee);
        $json = response()->json([
            'success' => true,
            'message' => 'Payslip fetched successfully!',
            'data' => [
                'payslip' => $payslip,
                'employee' => $employee,
                'company' => $company
            ]
        ], 200);
        return view('admin.views.pages.payslip', compact('payslip', 'employee', 'avanceRetenues', 'company', 'json'));
    }

    public function data()
    {
        $payslip = Payslip::with('employee')->get();

        return response()->json([
            'success' => true,
            'message' => 'Payslip fetched successfully!',
            'data' => $payslip
        ], 201);
    }

    public function getSlip($id)
    {
        $payslip = Payslip::where('id', $id)->first();
        return response()->json([
            'success' => true,
            'message' => 'Payslip fetched successfully!',
            'data' => $payslip
        ], 201);
    }

    public function showPDF($id)
    {
        $payslip = Payslip::findOrFail($id);
        $company = Company::first();
        $employee = Employee::where('id', $payslip->employee_id)->first();
        $avanceRetenues = AvanceRetenue::where('employe_id', $payslip->employee_id)->first();

        // $data = YourModel::all(); // Fetch data from the database

        // Load the Blade view and pass the data
        $pdf = Pdf::loadView('admin.views.pages.payslip_pdf', compact('payslip', 'company', 'employee', 'avanceRetenues'))->setPaper('a4', 'portrait');
        // Enable external styles and remote assets
        $pdf->getDomPDF()->set_option('isHtml5ParserEnabled', true);
        $pdf->getDomPDF()->set_option('isRemoteEnabled', true);

        $filename = 'payslip_' . $employee->nom . '_'. $employee->prenoms . now()->format('Y-m-d') . '.pdf';
        return $pdf->stream('admin.views.pages.payslip_pdf'); // Stream the PDF for viewing
    }

    public function downloadPDF($id)
    {
        $payslip = Payslip::findOrFail($id);
        $company = Company::first();
        $employee = Employee::where('id', $payslip->employee_id)->first();
        $avanceRetenues = AvanceRetenue::where('employe_id', $payslip->employee_id)->first();

        // $data = YourModel::all(); // Fetch data from the database

        // Load the Blade view and pass the data
        $pdf = Pdf::loadView('admin.views.pages.payslip_pdf', compact('payslip', 'company', 'employee', 'avanceRetenues'))->setPaper('a4', 'portrait');
        // Enable external styles and remote assets
        $pdf->getDomPDF()->set_option('isHtml5ParserEnabled', true);
        $pdf->getDomPDF()->set_option('isRemoteEnabled', true);

        $filename = 'payslip_' . $employee->nom . '_'. $employee->prenoms . now()->format('Y-m-d') . '.pdf';
        return $pdf->download($filename); // Stream the PDF for viewing
    }

    /**
     * Show the form for editing the specified payslip.
     */
    public function edit($id)
    {
        $payslip = Payslip::findOrFail($id);
        $employees = Employee::all();
        return view('payslips.edit', compact('payslip', 'employees'));
    }

    /**
     * Update the specified payslip in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'title' => 'nullable|string|max:255',
            'grade' => 'nullable|string|max:255',
            'base_salary' => 'required|numeric',
            'housing_allowance' => 'nullable|numeric',
            'transport_allowance' => 'nullable|numeric',
            'public_services_allowance' => 'nullable|numeric',
            'tax_paye' => 'required|numeric',
            'cnss' => 'required|numeric',
            'total_deductions' => 'required|numeric',
            'net_salary' => 'required|numeric',
        ]);

        $payslip = Payslip::findOrFail($id);
        $payslip->update([
            'employee_id' => $request->employee_id,
            'title' => $request->title,
            'grade' => $request->grade,
            'base_salary' => $request->base_salary,
            'housing_allowance' => $request->housing_allowance,
            'transport_allowance' => $request->transport_allowance,
            'public_services_allowance' => $request->public_services_allowance ?? 0,
            'tax_paye' => $request->tax_paye,
            'cnss' => $request->cnss,
            'total_deductions' => $request->total_deductions,
            'net_salary' => $request->net_salary,
        ]);

        return redirect()->route('payslips.index')->with('success', 'Payslip updated successfully!');
    }

    /**
     * Remove the specified payslip from storage.
     */
    public function destroy($id)
    {
        Payslip::destroy($id);
        return redirect()->route('payslips.index')->with('success', 'Payslip deleted successfully!');
    }
}
