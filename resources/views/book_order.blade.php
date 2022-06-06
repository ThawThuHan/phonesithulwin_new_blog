@extends('layouts.master')

@section('title', 'Book Order')

@section('content')
<div class="container-fluid container-md">
    <div class="row" style="margin-top: 35px;">
        <div class="col-12 col-md-6 d-flex flex-column align-items-center" id="">
            <?php
            $images = json_decode($book->images);
            ?>
            <img src="{{ URL("storage/book_images/".$images[0]) }}" alt="" class="book" style="width: 50%; object-fit: scale-down;">
            <!-- modal -->
            <div class="text-center mt-4 mb-2">
                <i class="fas fa-search-plus"></i>
                <span>View larger image</span>
            </div>
            <div class="d-flex justify-content-center align-items-center">
                <ul class="list-unstyled d-flex">
                    <!-- first -->
                    @php
                       $id = "1";
                    @endphp
                    @foreach ($images as $image)
                    @php
                        $id .= "1";
                    @endphp
                    <li class="me-2" style="width: 50px; height: 50px;">
                        <a href="{{ URL("storage/book_images/".$image) }}">
                            <img src="{{ URL("storage/book_images/".$image) }}" alt="" style="width: 100%; height: 100%; object-fit: cover;">
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="col-12 col-md-6 d-flex flex-column justify-content-evenly">
            <div class="mb-4">
                <h3 class="text-center text-md-start"><b><?= $book->name ?></b></h3>
            </div>
            <div class="mb-4">
                <h6>by <b>Dr.Phone Sithu Lwin</b></h6>
            </div>
            <div class="mb-4">
                <p><?= $book->preview_content ?></p>
            </div>

            <hr>
            <table class="table">
                <tbody>
                    <tr>
                        <th>Editors</th>
                        <td>Dr.Phone Sithu Lwin</td>
                        <th>Features</th>
                        <td><?= $book->features ?></td>
                    </tr>
                    <tr>
                        <th>Released Date</th>
                        <td><?= $book->release_date ?></td>
                        <th>Language</th>
                        <td>Burmese</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    @if($errors->any())
        <div class="alert alert-warning">
            @foreach($errors->all() as $error)
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <strong>{{ $error }}</strong>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endforeach
        </div>
    @endif

    @if (session('error'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong>{{ session('error') }}</strong> You should check in on some of those fields below.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>{{ session('success') }}</strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- order form -->
    <form action="" class="needs-validation" method="POST" enctype="multipart/form-data" novalidate>
        @csrf
        <div class="form-group mb-3">
            <label for="validationCustom01" class="form-label">Name:</label>
            <input type="text" class="form-control" name="name" id="validationCustom01" required placeholder="Enter your name">
            <div class="invalid-feedback">
                Name is required!
            </div>
        </div>
        <div class="row">
            <div class="form-group mb-3 col-6">
                <label for="validationCustom02" class="form-label">Email:</label>
                <input type="text" class="form-control" name="email" id="validationCustom02" required placeholder="Enter your email">
                <div class="invalid-feedback">
                    Email is required!
                </div>
            </div>
            <div class="form-group mb-3 col-6">
                <label for="validationCustom04" class="form-label">Phone No.:</label>
                <input type="text" class="form-control" name="phone" id="validationCustom04" required placeholder="Enter your Phone">
                <div class="invalid-feedback">
                    Phone Number is required!
                </div>
            </div>
        </div>

        <div class="form-group mb-3">
            <label for="validationCustomUsername" class="form-label">Address:</label>
            <div class="input-group has-validation">
                <input type="text" class="form-control" name="address" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required placeholder="Enter your address">
                <div class="invalid-feedback">
                    Address is required!
                </div>
            </div>
        </div>
        <input type="hidden" name="book_id" id="book_id" value="{{ $book->id }}">
        <div class="form-group mb-3">
            <label for="validationCustom04" class="form-label">Payment Method:</label>
            <div class="ms-3">
                <div class="btn btn-info me-2 text-white" data-bs-toggle="modal" data-bs-target="#kbz">KBZ Pay</div>
                {{-- <div class="btn btn-info me-2 text-white" data-bs-toggle="modal" data-bs-target="#wave">Wave Pay</div> --}}
            </div>
            <div class="invalid-feedback">
                Please select one of them
            </div>
            <!-- Modal KBZ -->
            <div class="modal" id="kbz" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">SCAN HERE TO PAY</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body d-flex justify-content-center align-items-center">
                            <img src="{{asset("assets/images/kbzpay.jpg")}}" alt="" style="height: 300px">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Got it!</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group mb-3">
            <label for="validationCustom05" class="form-label">Payment screenshot:</label>
            <input type="file" name="payment_screenshot" class="form-control" id="validationCustom05" required>
            <div class="invalid-feedback">
                Payment screenshot!
            </div>
            <span class="form-text">အပေါ်တွင်ဖော်ပြထားသော QR code များမှတဆင့် ငွေပေးချေမှုပြုလုပ်ပြီး screenshot ကို ပို့ပေးပါ</span>
        </div>
        <div class="form-group mb-3">
            <button class="btn btn-primary" type="submit">Order now</button>
        </div>
    </form>
</div>
@endsection

@section('script')
<script>
    (function() {
        'use strict'

        var forms = document.querySelectorAll('.needs-validation')

        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()

    // modal
    var myModal = document.getElementById('myModal')
    var myInput = document.getElementById('myInput')

    myModal.addEventListener('shown.bs.modal', function() {
        myInput.focus()
    })
</script>
@endsection