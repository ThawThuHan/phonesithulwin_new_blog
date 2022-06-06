@extends('layouts.admin_layout')

@section('content')
    <h3 class="py-2">Orders</h3>

    @if (session("status"))
        <div class="alert alert-info alert-dismissible fade show mt-2" role="alert">
        <strong>{{ session('status') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
              <th scope="col">#</th>
                <th>Order</th>
              <th scope="col">Customer Name</th>
              <th>Contact</th>
              <th scope="col">Payment Screenshot</th>
              <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @if($orders)
                @foreach ($orders as $order)
                    <tr>
                        <td>{{$order->id}}</td>
                        <td>
                            @php
                                $images = json_decode($order->book->images);
                                $image = $images[0];
                            @endphp
                            <a href="{{ asset('storage/book_images/'.$image) }}">
                                <img src="{{ asset('storage/book_images/'.$image) }}" class="image-thumbnail" style="width: 80px; height: 100px" alt="">
                            </a>
                        </td>
                        <td>{{ $order->name }}</td>
                        <td>
                          {{ $order->email }} <br>
                          {{ $order->phone }} <br>
                          {{ $order->address }} <br>
                        </td>
                        <td>
                          <a href="{{ asset('storage/payment_screenshot/'.$order->payment_screenshot) }}">
                            <img src="{{ asset('storage/payment_screenshot/'.$order->payment_screenshot) }}" class="image-thumbnail" style="width: 80px; height: 100px" alt="">
                          </a>
                        </td>
                        <td>
                            @if ($order->confirm === null)
                                <form action="{{ route('order.confirm', ['order' => $order->id]) }}" method="POST">
                                    @csrf
                                    @method('put')
                                    <button class="btn btn-outline-primary">confirm</button>
                                </form>

                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-outline-danger mt-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    cancel
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                        <form action="{{ route('order.cancel', ['order' => $order->id]) }}" id="send_message" method="POST">
                                            @csrf
                                            @method('put')
                                            <h3>Reply Message to</h3>
                                            <textarea name="message" class="form-control" ></textarea>
                                        </form>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" onclick="event.preventDefault(); document.querySelector('#send_message').submit();" class="btn btn-primary">Send Message</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            @else
                                @if ($order->confirm == 1)
                                    <span class="btn btn-success disabled">Confirmed</span>
                                @elseif($order->confirm == 0)
                                    <span class="btn btn-dark disabled">Canceled</span>
                                @endif
                                <form action="{{ route('order.destroy', ['order' => $order->id]) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger mt-2">Delete</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            @endif
          </tbody>
    </table>      
@endsection