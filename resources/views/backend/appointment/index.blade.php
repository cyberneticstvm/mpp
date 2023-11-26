@extends("backend.base")
@section("content")
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Today's Appointments List</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Today's Appointments List</li>
                    </ol>
                </div>
                <div class="col-sm-6 text-end">
                    <a class="btn btn-primary" href="{{ route('appointment.create') }}">Create New</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row ui-sortable" id="draggableMultiple">
            @forelse($appointments as $key => $item)
            <div class="col-xl-3 col-md-5 box-col-5">
                <div class="card custom-card">
                    <div class="text-center profile-details">
                        <h4><a href="social-app.html" alt="" data-bs-original-title="" title="">{{ $item->patient_name }}</a></h4>
                        <h6>{{ $item->place }}</h6>
                    </div>
                    <div class="card-footer row">
                        <div class="col-4 col-sm-4">
                            <h6>Contact</h6>
                            <h3 class="counter">{{ $item->mobile }}</h3>
                        </div>
                        <div class="col-4 col-sm-4">
                            <h6>Age</h6>
                            <h3>{{ $item->age }}&nbsp;{{ $item->old }}</h3>
                        </div>
                        <div class="col-4 col-sm-4">
                            <h6>Time</h6>
                            <h3>{{ $item->appointment_time }}</h3>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <h5 class="text-danger">No appointments has been scheduled today for current profile!
                @endforelse
        </div>
    </div>
</div>
@endsection