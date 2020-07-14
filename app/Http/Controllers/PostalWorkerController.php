<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\User;

class PostalWorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::where('poster_id', auth()->id())->where('status','Delivering')->paginate(5);
        return view('postal_worker_orders', compact('orders'));
    }
    public function listDeliveredOrders(){
        $orders = Order::where('poster_id', auth()->id())->where('status','Delivered')->paginate(5);
        return view('postalworker_delivered', compact('orders'));
    }

    public function changeOrderStatus(Request $request, $id){
        $order = Order::find($id);
        if (isset($request->status)) {
            $order->status = $request->get('status');
            $order->save();
        }
        return redirect(route('listDeliveredOrders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('addworker');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'tel' => ['required'],
            'state' => ['required'],
            'city' => ['required']
        ]);
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
        $user = new User();
        $user->name = $request['name'];
        $user->last_name = $request['last_name'];
        $user->email = $request['email'];
        $user->password = Hash::make($request['password']);
        $user->tel = $request['tel'];
        $user->state = $request['state'];
        $user->city = $request['city'];
        $user->role_id = 2;

        $user->save();

        return redirect('admin/workers')->with('success', 'User added successfuly');

        // User::create([
        //     'name' => $request['name'],
        //     'last_name' => $request['last_name'],
        //     'email' => $request['email'],
        //     'password' => $request['password'],
        //     'tel' => $request['tel'],
        //     'state' => $request['state'],
        //     'city' => $request['city']
        // ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $worker = User::find($id);
        $worker->delete();

        return redirect('admin/workers')->with('success', 'Worker ' . $worker->name . ' deleted successfuly');
    }
}
