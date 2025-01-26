<form method="post" action="{{ route('admin.profile.change-password') }}" class="form-ajax" data-success="changePasswordSuccess">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Field::text(trans('cms::app.current_password'), 'current_password', [
                    'type' => 'password',
                    'required' => true,
                    'class' => 'form-control'
                ]) }}
            </div>

            <div class="form-group mb-3">
                {{ Field::text(trans('cms::app.password'), 'password', [
                    'type' => 'password',
                    'required' => true,
                    'class' => 'form-control'
                ]) }}
            </div>

            <div class="form-group mb-3">
                {{ Field::text(trans('cms::app.password_confirmation'), 'password_confirmation', [
                    'type' => 'password',
                    'required' => true,
                    'class' => 'form-control'
                ]) }}
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    <i class="ti ti-device-floppy me-2"></i>
                    {{ trans('cms::app.update') }}
                </button>
            </div>
        </div>
    </div>
</form>

<script>
    function changePasswordSuccess(form, response)
    {
        form.find('input').val('');
    }
</script>
