@extends("backend.base")
@section("content")
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Payment Status</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Payment Status</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body table-responsive">
                        <h5 class="text-success">Thank You! Your payment was success.</h5>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Order Id</td>
                                    <td>{{ $data['razorpay_order_id'] }}</td>
                                </tr>
                                <tr>
                                    <td>Payment Id</td>
                                    <td>{{ $data['razorpay_payment_id'] }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection