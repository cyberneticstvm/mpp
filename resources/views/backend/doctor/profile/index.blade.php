@extends("backend.base")
@section("content")
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Current User's Profile List</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Current User's Profile List</li>
                    </ol>
                </div>
                <div class="col-sm-6 text-end">
                    <a class="btn btn-primary" href="{{ route('user.profile.create') }}">Create New</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="card user-profile">
            <div class="row card-body">
                @forelse($profiles as $key => $item)
                <div class="col-sm-3">
                    <div class="userpro-box">
                        <div class="img-wrraper text-center">
                            <div class="avatar"><img class="img-90 rounded-circle" src="{{ asset('/backend/assets/images/dashboard/1.png') }}" alt=""></div><a class="icon-wrapper" href="{{ route('user.profile.edit', encrypt($item->id)) }}"><i class="icofont icofont-pencil-alt-5"></i></a>
                        </div>
                        <div class="user-designation">
                            <div class="title text-center">
                                <a target="_blank" href="">
                                    <h4>{{ $item->name }}</h4>
                                    <h6>{{ $item->designation }}</h6>
                                    <h6>{{ $item->registration_number }}</h6>
                                    <h6>₹{{ $item->consultation_fee }}</h6>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection