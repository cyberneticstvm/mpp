<div class="drawer drawer-right slide" tabindex="-1" role="dialog" aria-labelledby="drawer-3-title" aria-hidden="true" id="planDrawer">
    <div class="drawer-content drawer-content-scrollable" role="document">
        {{ html()->form('POST', route('plan.update'))->class('theme-form')->open() }}
        @csrf
        <div class="card-header">
            <h3 class="mb-3 mt-3">Change Your Current Plan</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 form-group">
                    <label class="control-label req">Select Plan</label>
                    {{ html()->select('plan', getPlans(), old('plan'))->class('form-control')->placeholder('Select')->required() }}
                    @error('plan')
                    <small class="text-danger">{{ $errors->first('plan') }}</small>
                    @enderror
                </div>
            </div>
        </div>
        <div class="card-footer text-end">
            <a class="btn btn-danger" data-toggle="drawer" data-target="#planDrawer">Cancel</a>
            <button class="btn btn-primary btn-submit">Update</button>
        </div>
        {{ html()->form()->close() }}
    </div>
</div>