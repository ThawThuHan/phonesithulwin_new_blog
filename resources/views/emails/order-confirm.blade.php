<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
    <h1 style="text-align: center; {{ $details['confirm'] ? "background-color:green;" : "background-color:red;" }}">{{ $details['confirm'] ? "Your Order Received!" : "Your Order Canceled!" }}</h1>
    <p style="text-align: center">{{ $details['message'] }}</p>
    <table>
        <th>
            <th>No.</th>
            <th>Item</th>
            <th>Image</th>
            <th>Price</th>
        </th>
        <tr>
            <td>1</td>
            <td>{{$order->book->name}}</td>
            <td>
                @php
                    $images = json_decode($order->book->images);
                    $image = $images[0];
                @endphp
                <img src="{{ asset('storage/book_images/'.$image) }}" style="width: 80px; height: 100px" alt="">
            </td>
            <td>{{$order->book->price}} MMK</td>
        </tr>
    </table>
    <br>
    <hr>
    <h6>Here, Your Payment Screenshot</h6>
    <img src="{{ asset('storage/book_images/'.$order->payment_screenshot) }}" style="width: 80px; height: 100px" alt="" >
</body>
</html>