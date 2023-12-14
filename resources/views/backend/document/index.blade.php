@extends("backend.base")
@section("content")
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Upload Document</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Upload Document</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="file-content">
                        <div class="card">
                            <div class="card-header">
                                <div class="media">
                                    <form class="form-inline" action="{{ route('document.show') }}" method="post">
                                        @csrf
                                        <div class="form-group d-flex mb-0"> <i class="fa fa-search"></i>
                                            <input class="form-control-plaintext txtDocumentSearch" name="query_string" type="text" placeholder="Search..." data-container="body" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Search by MRN">
                                        </div>
                                    </form>
                                    <div class="media-body text-end">
                                        <div class="btn btn-primary addDocument"> <i data-feather="plus-square"></i>Add New</div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body file-manager">
                                <h4>All Files</h4>
                                <h6>Recently uploaded files</h6>
                                <ul class="files">
                                    @forelse($documents as $key => $item)
                                    <li class="file-box">
                                        <div class="file-top"> <i class="fa fa-file-text-o txt-primary"></i><i class="fa fa-ellipsis-v f-14 ellips"></i></div>
                                        <div class="file-bottom">
                                            <h6>{{ $item->description }}</h6>
                                            <p class="mb-1">Patient ID: {{ $item->patient->patient_id }}</p>
                                            <p class="mb-1">MRN: {{ $item->consultation->medical_record_number }}</p>
                                            <p> <b>Uploaded at : </b>{{ $item->created_at->format('d, F Y') }}</p>
                                        </div>
                                        <div class="d-flex mt-3">
                                            <div class="w-50">
                                                <a href="{{ asset($item->document) }}" target="_blank"><i class="fa fa-download fa-2x" data-container="body" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Download"></i>
                                            </div>
                                            <div class="w-50 text-end">
                                                <a href="{{ route('document.delete', encrypt($item->id)) }}" target="_blank" class="dlt"><i class="fa fa-trash fa-2x text-danger" data-container="body" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Delete"></i></a>
                                            </div>
                                        </div>
                                    </li>
                                    @empty
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include("backend.drawer.document");
@endsection