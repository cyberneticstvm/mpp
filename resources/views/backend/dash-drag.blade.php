@extends("backend.base")
@section("content")
<div class="page-body">
    <div class="container-fluid">
        <div class="row ui-sortable" id="draggableMultiple">
            <div class="col-xl-6 box-col-12 des-xl-50">
                <div class="card">
                    <div class="card-header">
                        <div class="header-top d-sm-flex align-items-center">
                            <h5>Patient Registrations</h5>
                            <div class="center-content">
                            </div>
                            <div class="setting-list">
                                <ul class="list-unstyled setting-option">
                                    <li>
                                        <div class="setting-primary"><i class="icon-settings"></i></div>
                                    </li>
                                    <li><i class="icofont icofont-maximize full-card font-primary"></i></li>
                                    <li><i class="icofont icofont-minus minimize-card font-primary"></i></li>
                                </ul>
                            </div>
                        </div>
                        <p>Last 12 months data</p>
                    </div>
                    <div class="card-body p-0">
                        <div id="user-activation-dash-2"></div>
                        <div class="code-box-copy">
                            <button class="code-box-copy__btn btn-clipboard" data-clipboard-target="#user-activations" title="Copy"><i class="icofont icofont-copy-alt"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection