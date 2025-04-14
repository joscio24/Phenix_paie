<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\{Employee, Memo, PaymentRequest, StaffApplication};

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin/views/index', [
            'employees' => Employee::all(),
            'memos' => Memo::all(),
            'paymentRequests' => PaymentRequest::all(),
            'staffApplications' => StaffApplication::first(),
        ]);
    }

    public function tb()
    {
        return view('dashboard', [
            'employees' => Employee::all(),
            'memos' => Memo::all(),
            'paymentRequests' => PaymentRequest::all(),
            'staffApplications' => StaffApplication::first(),
        ]);
    }
}
