@extends("backend.base")
@section("content")
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Make Payment</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Make Payment</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <button id="rzp-button1">Pay</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    var options = {
        "key": "{{ env('rzp_test_ZxIv1ry85W4GDo') }}", // Enter the Key ID generated from the Dashboard
        "amount": "1000", // Amount is in currency subunits. Default currency is INR. Hence, 1000 refers to 1000 paise
        "currency": "INR",
        "name": "Medical Prescription Pro", //your business name
        "description": "Medical Prescription Pro Payment",
        "image": "{{ asset('/frontend/assets/img/logo-mpp-dark.png') }}",
        "order_id": "{{ $order->id }}", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
        "callback_url": "{{ route('payment.success') }}",
        "prefill": { //We recommend using the prefill parameter to auto-fill customer's contact information especially their phone number
            "name": "{{ Auth::user()->name }}", //your customer's name
            "email": "{{ Auth::user()->email }}",
            "contact": "{{ Auth::user()->mobile }}" //Provide the customer's phone number for better conversion rates 
        },
        "notes": {
            "address": "Trivandrum, Kerala, India"
        },
        "theme": {
            "color": "#215684"
        }
    };
    var rzp1 = new Razorpay(options);
    rzp1.on('payment.failed', function(response) {
        location.href = "/billing/invoice/payment/failed/" + response.error.code;
    });
    document.getElementById('rzp-button1').onclick = function(e) {
        rzp1.open();
        e.preventDefault();
    }
</script>
@endsection