@component('mail::message')
    <h1> Thank you for buying with us!</h1>
    <h4> Hi {{$order->receiver_name}}</h4>
    <p>Your order has been placed! Here are your order details:</p>
    <p>Order Name: {{$order->order_name}}</p>
    <p>Address: {{$order->state.", " .$order->city.", " .$order->address}}</p>
    <p>Price: {{$order->total_price}} €</p>

   <p>Order Code: <b>{{$order->id}}</b></p>
    <p>You can always track your order using your phone number and the Order Code we provided.</p>

@component('mail::button', ['url' => route('order.track.view')])
Track Your Order
@endcomponent

Thank you,<br>
{{ config('app.name') }}
@endcomponent
