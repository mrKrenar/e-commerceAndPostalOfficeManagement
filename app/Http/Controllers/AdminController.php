<?php

namespace App\Http\Controllers;

use App\Order;
use App\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.admin');
    }

    /**
     * List of orders.
     *
     * @return \Illuminate\Http\Response
     */
    public function list_new_orders()
    {
        $orders = Order::where('poster_id', null)->orderBy('created_at', 'DESC')->paginate(5);
        $users = User::get();
        return view('/admin/list_new_orders', compact('orders', 'users'));
    }

    public function list_orders()
    {
        $orders = Order::whereNotNull('poster_id')->where('status', '<>', 'delivered')->orderBy('created_at', 'DESC')->paginate(5);;
        $users = User::get();
        return view('/admin/list_orders', compact('orders', 'users'));
    }

    public function list_delivered_orders()
    {
        $orders = Order::where('status', 'delivered')->orderBy('created_at', 'DESC')->paginate(5);
        $users = User::get();
        return view('/admin/list_delivered_orders', compact('orders', 'users'));
    }

    public function post_settings()
    {
        return view('/admin/post_settings');
    }

    public function showAllClients()
    {
        $clients = User::where('role_id', 3)->paginate(5);
        return view('admin/all_clients')->with('clients', $clients);
    }

    public function disableAccount(User $id)
    {
        $id->isActive = !$id->isActive;
        $id->save();

        return redirect('admin/clients')->with('success', 'Changes saved successfully');
    }

    public function showAllWorkers()
    {
        $workers = User::where('role_id', 2)->paginate(5);
        //dd($workers);
        return view('all_workers')->with('workers', $workers);
    }

    public function showOrder($id)
    {
        $order = Order::find($id);
        $users = User::get();
        return view('admin.view_orders', compact('order', 'users'));
    }

    public function showDeliveredOrder($id)
    {
        $order = Order::find($id);
        $users = User::get();
        return view('admin.view_delivered_orders', compact('order', 'users'));
    }

    public function generateContract(User $id)
    {
        $data = ['name' => $id->name, 'last_name' => $id->last_name, 'state' => $id->state, 'city' => $id->city];
        //dd($data);
        $pdf = PDF::loadView('pdf.contract', $data);
        return $pdf->download('contract' . $id->id . ' ' . Carbon::now()->toDateTimeString() . '.pdf');
    }

    public function searchClients(Request $request)
    {
        //Following code translates to
        //SELECT * FROM User WHERE role_id = 3 and (name LIKE $request OR last_name LIKE $request...)

        $users = User::where(function ($query) use ($request) {
            $query->orWhere('name', 'LIKE', '%' . $request['query'] . '%')
                ->orWhere('last_name', 'LIKE', '%' . $request['query'] . '%')
                ->orWhere('company', 'LIKE', '%' . $request['query'] . '%')
                ->orWhere('email', 'LIKE', '%' . $request['query'] . '%')
                ->orWhere('tel', 'LIKE', '%' . $request['query'] . '%')
                ->orWhere('tel2', 'LIKE', '%' . $request['query'] . '%')
                ->orWhere('state', 'LIKE', '%' . $request['query'] . '%')
                ->orWhere('city', 'LIKE', '%' . $request['query'] . '%');
        })
            ->where('role_id', '=', '3')
            ->paginate(5);

        if (count($users) > 0) {
            return view('admin/all_clients')->with('clients', $users);
        } else {
            return view('admin/all_clients')->with('clients', User::where('role_id', 3)->paginate(5))->with('error', 'No results found for ' . $request['query'] . '. We\'re showing all users instead.');
        }
    }
}
