<form method="post" action="" class="form-ajax">
    @method('put')
    @csrf

    @php
        $languages = array_merge(['' => '------'], $languages ?? []);
        $countries = array_merge(['' => '------'], $countries ?? []);
    @endphp

    <div class="row g-3">
        <div class="col-md-8">
            <div class="row g-3">
                <div class="col-md-12">
                    <div class="form-group">
                        {{ Field::text($jw_user, 'name', [
                            'class' => 'form-control'
                        ]) }}
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        {{ Field::text($jw_user, 'email', [
                            'disabled' => true,
                            'class' => 'form-control'
                        ]) }}
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        {{ Field::text('birthday', 'metas[birthday]', [
                            'value' => $jw_user->getMeta('birthday'),
                            'class' => 'datepicker form-control'
                        ]) }}
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        {{ Field::select('country', 'metas[country]', [
                            'value' => $jw_user->getMeta('country'),
                            'options' => $countries,
                            'class' => 'form-select'
                        ]) }}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group mb-3">
                {{ Field::image($jw_user, 'avatar', [
                    'class' => 'profile-avatar-upload'
                ]) }}
            </div>

            <div class="form-group">
                {{ Field::select($jw_user, 'language', [
                    'options' => $languages,
                    'class' => 'form-select'
                ]) }}
            </div>
        </div>
    </div>

    <div class="form-group mt-4">
        <button type="submit" class="btn btn-primary">
            <i class="ti ti-device-floppy me-2"></i>
            {{ trans('cms::app.update') }}
        </button>
    </div>
</form>
