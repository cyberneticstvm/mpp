@extends("backend.base")
@section("content")
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Pending Invoices</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Pending Invoices</li>
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
                        <table class="display table table-sm table-striped" id="basic-2">
                            <thead>
                                <tr>
                                    <th>SL No</th>
                                    <th>Invoice Number</th>
                                    <th>Invoice Month</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Payment</th>
                                    <th>Download</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($invoices as $key => $invoice)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $invoice->invoice_number }}</td>
                                    <td>{{ $invoice->month.'/'.$invoice->year }}</td>
                                    <td>{{ $invoice->amount }}</td>
                                    <td>{{ $invoice->payment_status }}</td>
                                    <td><a href="{{ route('payment.show', encrypt($invoice->id)) }}" class="fw-bold">PAY NOW</a></td>
                                    <td class="text-center"><a href="{{ route('invoice.pdf', encrypt($invoice->id)) }}" target="_blank"><i class="fa fa-file-pdf-o text-danger fa-lg"></i></a></td>
                                </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection