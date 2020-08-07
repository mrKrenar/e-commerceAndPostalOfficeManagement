<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        switch (Auth::user()->role_id) {
            case '1':
                return redirect(route('admin.newOrders')); //admin
                break;
            case '2':
                return redirect(route('postalworker')); //postal worker
                break;
            case '3':
                return redirect(route('list_orders')); // seller
                break;
            case '4':
            default:
                return redirect(route('dashboard')); // buyer and default
                break;
        }
    }
}
