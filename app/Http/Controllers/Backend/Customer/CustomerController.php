<?php

namespace App\Http\Controllers\Backend\Customer;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use function view;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = User::where('role_id', 2)->get();
        return view('backend.customers.customers', compact('customers'));
    }
}
