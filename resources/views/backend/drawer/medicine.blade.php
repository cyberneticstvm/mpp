<div class="drawer drawer-right slide" tabindex="-1" role="dialog" aria-labelledby="drawer-3-title" aria-hidden="true" id="medicineDrawer">
    <div class="drawer-content drawer-content-scrollable" role="document">
        {{ html()->form('POST', route('medicine.save'))->class('theme-form frmMedicine')->open() }}
        @csrf
        <div class="card-header">
            <h3 class="mb-3 mt-3">Add New Medicine</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 form-group">
                    <label class="control-label">Medicine Name</label>
                    {{ html()->text('name', old('name'))->class('form-control')->attribute('id', 'medicineName')->placeholder('Medicine Name')->required() }}
                    @error('name')
                    <small class="text-danger">{{ $errors->first('name') }}</small>
                    @enderror
                </div>
            </div>
        </div>
        <div class="card-footer text-end">
            <a class="btn btn-danger" data-toggle="drawer" data-target="#medicineDrawer">Cancel</a>
            <button class="btn btn-primary btn-submit">Save</button>
        </div>
        {{ html()->form()->close() }}
    </div>
</div>