@extends("backend.base")
@section("content")
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Today's Appointment List</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Today's Appointment List</li>
                    </ol>
                </div>
                <div class="col-sm-6 text-end">
                    <a class="btn btn-primary" href="{{ route('appointment.create') }}">Create New</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="row card-body ui-sortable" id="draggableMultiple">
                        @forelse($appointments as $key => $item)
                        <div class="col-md-4">
                            <div class="card custom-card">
                                <div class="text-center profile-details">
                                    <h4><a href="social-app.html" alt="" data-bs-original-title="" title="">{{ $item->patient_name }}</a></h4>
                                    <h6>{{ $item->address }}</h6>
                                </div>
                                <div class="card-footer row">
                                    <div class="col-4 col-sm-4">
                                        <h6>Contact</h6>
                                        <p>{{ $item->mobile }}</p>
                                    </div>
                                    <div class="col-4 col-sm-4">
                                        <h6>Age</h6>
                                        <p>{{ $item->age }}&nbsp;{{ $item->old }}</p>
                                    </div>
                                    <div class="col-4 col-sm-4">
                                        <h6>Time</h6>
                                        <p>{{ $item->appointment_time->format('h:i A') }}</p>
                                    </div>
                                </div>
                                <div class="text-center mt-3"><a href="{{ route('patient.create', encrypt($item->id)) }}" class="btn btn-outline-primary" type="button" data-container="body" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Click here to register this patient">Register</a></div>
                            </div>
                        </div>
                        @empty
                        <h5 class="text-danger">No appointments has been scheduled today for current profile!
                            @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection