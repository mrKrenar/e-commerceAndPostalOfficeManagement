<?php

namespace App\Http\Controllers;

use App\Order;
use App\PostalSetting;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Carbon;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::where('seller_id', auth()->id())->orderBy('created_at', 'DESC')->paginate(5);
        return view('list_orders', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $transfer_fee = PostalSetting::find(1)->transfer_fee;
        // dd($transfer_fee);
        return view('order')->with('transfer_fee', $transfer_fee);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //dd($request);
        if (!Auth::check())
            return redirect('/login');

        $this->validate(
            $request,
            [
                'receiver_name' => 'required|max:255',
                'receiver_tel' => 'required',
                'receiver_tel2' => 'nullable',
                'state' => 'required|max:255',
                'city' => 'required|max:255',
                'address' => 'nullable|max:255',
                'quantity' => 'required|numeric|min:1',
                'weight' => 'nullable|numeric|min:0',
                'order_type' => 'required|max:255',
                'additional_notes' => 'nullable|max:255',
                'order_name' => 'required|max:255',
                'description' => 'nullable|max:255',
                'price' => 'required|numeric|gte:0',
                'tvsh' => 'required|numeric|gte:0|lte:100'
            ]
        );

        if (
            strcasecmp($request['state'], 'Kosove') != 0 &&
            strcasecmp($request['state'], 'Albania') != 0 &&
            strcasecmp($request['state'], 'Maccedonia') != 0
        ) {
            return redirect('/order')->with('error', 'Me inspect element po don me haku a? -_-');
        }

        if (
            strcasecmp($request['order_type'], 'Normal') != 0 &&
            strcasecmp($request['order_type'], 'Fragile') != 0
        ) {
            return redirect('/order')->with('error', 'Me inspect element po don me haku a? -_-');
        }

        Order::create([
            'receiver_name' => $request['receiver_name'],
            'receiver_tel' => $request['receiver_tel'],
            'receiver_tel2' => $request['receiver_tel2'],
            'state' => $request['state'],
            'city' => $request['city'],
            'address' => $request['address'],
            'quantity' => $request['quantity'],
            'weight' => $request['weight'],
            'order_type' => $request['order_type'],
            'additional_notes' => $request['additional_notes'],
            'order_name' => $request['order_name'],
            'description' => $request['description'],
            'price' => $request['price'],
            'tvsh' => $request['tvsh'],
            'status' => 'Processing',
            'seller_id' => Auth::user()->id,
            'total_price' => (float) $request['price'] * (int) $request['quantity'] + PostalSetting::find(1)->transfer_fee
        ]);

        return redirect()->route('list_orders')->with('success', 'Order added successfully');
        // return redirect()->back()->with('success', 'Order added successfully ');
    }

    public function choosePostalWorker(Request $request, $id)
    {
        $order = Order::find($id);

        $order->poster_id = $request->get('postman');
        $order->status = 'Delivering';
        $order->save();
        return redirect(route('admin.newOrders'));
    }

    public function editPostalWorker($id)
    {
        $order = Order::find($id);
        $users = User::all();
        return view('admin/editPostalWorker', compact('order', 'users'));
    }

    public function updatePostalWorker(Request $request, $id)
    {
        $order = Order::find($id);

        $order->poster_id = $request->get('postman');
        $order->status = 'Delivering';
        $order->update();
        return redirect(route('admin.allOrders'));
    }

    public function downloadReport(Order $id)
    {
        $data = ['name' => $id->receiver_name, 'tel' => $id->receiver_tel . ' | ' . $id->receiver_tel2, 'address' => $id->address, 'quantity' => $id->quantity, 'order_type' => $id->order_type, 'openable' => $id->is_openable ? 'Yes' : 'No', 'returnable' => $id->is_returnable ? 'Yes' : 'No', 'additional_notes' => $id->additional_notes, 'order_name' => $id->order_name, 'description' => $id->description, 'price' => $id->total_price];
        $pdf = PDF::loadView('pdf.invoice', $data);
        return $pdf->download('invoice' . $id->id . ' ' . Carbon::now()->toDateTimeString() . '.pdf');
    }
}
