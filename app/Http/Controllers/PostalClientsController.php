<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Seller;
use App\Order;
use App\User;
use Illuminate\Http\Request;

class PostalClientsController extends Controller
{
    public function destroy($id)
    {
        // $registeredPostsByThisUser = Order::where('seller_id', $id)->get()->count();
        //dd($registeredPostsByThisUser);

        if (Order::where('seller_id', $id)->get()->count() > 0)
            return redirect('admin/clients')->with('error', 'Client has already registerred orders. Can\'t be deleted');

        $client = User::find($id);
        $client->delete();

        return redirect('admin/clients')->with('success', 'Client ' . $client->name . ' deleted successfuly');
    }

    public function allOrders($sellerId)
    {
        $orders = Order::where('seller_id', $sellerId)->paginate(5);
        //dd($orders);
        return view('admin.orders_of')->with('orders', $orders);
    }
}
