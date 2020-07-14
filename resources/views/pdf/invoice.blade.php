<style>
    table{
        border-collapse: collapse;
        border: 1px solid rgb(216, 216, 216);
    }
    td{
        border-collapse: collapse;
        border: 1px solid rgb(216, 216, 216);
        text-align: center;
        padding-top: 15px;
        padding-bottom: 15px;
        color: rgb(87, 87, 87);
    }

    th{
        border-collapse: collapse;
        border: 1px solid rgb(216, 216, 216);
        font-weight: bold;
        padding-top: 15px;
        padding-bottom: 15px;
        color: rgb(87, 87, 87);
    }
</style>

<h1 style="text-align: center; color: rgb(44, 44, 44);">Invoice for {{$name}}</h1>

<table>
    <tr>
        <th>Reciever</th>
        <th>Tel</th>
        <th>Full Address</th>
        <th>Qty</th>
        <th>Order Type</th>
        <th>Can Open</th>
        <th>Can Return</th>
        <th>Additional Notes</th>
        <th>Order Name</th>
        <th>Description</th>
        <th>Total Price</th>
    </tr>
    <tr>
        <td>{{$name}}</td>
        <td>{{$tel}}</td>
        <td>{{$address}}</td>
        <td>{{$quantity}}</td>
        <td>{{$order_type}}</td>
        <td>{{$openable}}</td>
        <td>{{$returnable}}</td>
        <td>{{$additional_notes}}</td>
        <td>{{$order_name}}</td>
        <td>{{$description}}</td>
        <td>{{$price}}</td>
    </tr>
</table>


{{--
    Gjenerimi i QR code nuk po punon, sepse po duhet ne PDF me e gjeneru ne
    formatin png (kodi posht) dhe po kerkon me instalu imagick (procedur e komplikume) 
    
    {!! (QrCode::format('png')->size(100)->generate('Make me into an QrCode!')) !!}

--}}