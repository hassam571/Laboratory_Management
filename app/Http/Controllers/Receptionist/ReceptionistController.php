<?php

namespace App\Http\Controllers\Receptionist;

use App\Models\Customer;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;

class ReceptionistController extends Controller
{
    public function index()
    {
        $customers = Customer::with(['tests'])->get(); // Fetch customers with their tests
        return view('receptionist.pages.customers.index', compact('customers'));
    }
        public function show($id)
    {
        $customer = Customer::with('tests')->where('customerId', $id)->firstOrFail();
        return view('receptionist.pages.customers.details', compact('customer'));
    }


}
