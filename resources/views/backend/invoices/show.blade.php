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
                    <div>
                        <div>
                            <div class="row invo-header">
                                <div class="col-sm-6">
                                    <div class="media">
                                        <div class="media-left"><a href="index.html" data-bs-original-title="" title=""><img class="media-object img-60" src="../assets/images/logo/logo-1.png" alt=""></a></div>
                                        <div class="media-body m-l-20">
                                            <h4 class="media-heading f-w-600">{{ Auth::user()->name }}</h4>
                                            <p>{{ Auth::user()->email }}<br><span class="digits">{{ Auth::user()->mobile }}</span></p>
                                        </div>
                                    </div>
                                    <!-- End Info-->
                                </div>
                                <div class="col-sm-6">
                                    <div class="text-md-end text-xs-center">
                                        <h3>Invoice #{{ $invoice->invoice_number }}</h3>
                                        <p>Issued:<span class="digits"> {{ $invoice->created_at->format('d, M, Y') }}</span><br> Payment Due: <span class="digits">{{ $invoice->due_date?->format('d, M, Y') }}</span></p>
                                    </div>
                                    <!-- End Title                                 -->
                                </div>
                            </div>
                        </div>
                        <!-- End InvoiceTop-->
                        <div>
                            <div class="table-responsive invoice-table" id="table">
                                <table class="table table-bordered table-striped">
                                    <tbody>
                                        <tr>
                                            <td class="item">
                                                <h6 class="p-2 mb-0">Item Description</h6>
                                            </td>
                                            <td class="Hours">
                                                <h6 class="p-2 mb-0">Qty</h6>
                                            </td>
                                            <td class="Rate">
                                                <h6 class="p-2 mb-0">Rate</h6>
                                            </td>
                                            <td class="subtotal">
                                                <h6 class="p-2 mb-0">Sub-total</h6>
                                            </td>
                                        </tr>
                                        @forelse($invoice->details as $key => $item)
                                        <tr>
                                            <td>
                                                <label>Slab {{ ucfirst($item->slab) }} (Price Breakup)</label>
                                                <p class="m-0">Number of consultations recorded</p>
                                            </td>
                                            <td>
                                                <p class="itemtext digits">{{ $item->qty }}</p>
                                            </td>
                                            <td>
                                                <p class="itemtext digits">{{ $item->price }}</p>
                                            </td>
                                            <td>
                                                <p class="itemtext digits">{{ $item->total }}</p>
                                            </td>
                                        </tr>
                                        @empty
                                        @endforelse
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td class="Rate">
                                                <h6 class="mb-0 p-2">Total</h6>
                                            </td>
                                            <td class="payment digits">
                                                <h6 class="mb-0 p-2">{{ $invoice->amount }}</h6>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- End Table-->
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <div>
                                        <p class="legal"><strong>Thank you for your business!</strong>&nbsp; Payment is expected within 10 days after issue the invoice; please process this invoice within that time.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End InvoiceBot-->
                    </div>
                    <div class="col-sm-12 text-center mt-3">
                        <button class="btn btn btn-primary me-2" type="button" id="rzp-button1">Pay Now</button>
                        <button class="btn btn-secondary" type="button" onclick="window.history.back();">Cancel</button>
                    </div>
                    <!-- End Invoice-->
                    <!-- End Invoice Holder-->
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    var options = {
        "key": "{{ env('RAZOR_PAY_ID') }}", // Enter the Key ID generated from the Dashboard
        "amount": "{{ $order->amount }}", // Amount is in currency subunits. Default currency is INR. Hence, 1000 refers to 1000 paise
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
            "address": "India"
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