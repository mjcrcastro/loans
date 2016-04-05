<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Customer;

class CustomersController extends Controller
{
    //returns a list of customers
    public function index() {
        $customers = Customer::paginate(10);
        return view('customers.index', compact('customers'));
    }
}
