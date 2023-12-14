<div class="drawer drawer-right slide" tabindex="-1" role="dialog" aria-labelledby="drawer-3-title" aria-hidden="true" id="documentDrawer">
    <div class="drawer-content drawer-content-scrollable" role="document">
        {{ html()->form('POST', route('document.save'))->class('theme-form frmDocument')->acceptsFiles()->open() }}
        @csrf
        <div class="card-header">
            <h3 class="mb-3 mt-3">Add New Document</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 form-group">
                    <label class="control-label req">Document</label>
                    {{ html()->file('document', old('document'))->class('form-control')->required() }}
                    <small>Max upload size is 1MB</small>
                    @error('document')
                    <small class="text-danger">{{ $errors->first('document') }}</small>
                    @enderror
                </div>
                <div class="col-md-12 form-group">
                    <label class="control-label req">Medical Record Number (MRN)</label>
                    {{ html()->text('mrn', old('mrn'))->class('form-control')->placeholder('Medical Record Number')->required() }}
                    @error('name')
                    <small class="text-danger">{{ $errors->first('name') }}</small>
                    @enderror
                </div>
                <div class="col-md-12 form-group">
                    <label class="control-label req">Description</label>
                    {{ html()->text('description', old('description'))->class('form-control')->placeholder('Description')->required() }}
                    @error('description')
                    <small class="text-danger">{{ $errors->first('description') }}</small>
                    @enderror
                </div>
            </div>
        </div>
        <div class="card-footer text-end">
            <a class="btn btn-danger" data-toggle="drawer" data-target="#documentDrawer">Cancel</a>
            <button class="btn btn-primary btn-submit">Save</button>
        </div>
        {{ html()->form()->close() }}
    </div>
</div>