<form method="post" action="{{ route('admin.setting.save') }}" class="form-ajax">
    <input type="hidden" name="form" value="recaptcha">

    <div class="card">
        <div class="card-header bg-transparent justify-content-end align-items-center">
            <div class="actions-buttons">
                <button type="submit" class="btn btn-tabler me-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" <svg
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                        <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                        <path d="M14 4l0 4l-6 0l0 -4" />
                    </svg>
                    {{ trans('cms::app.save') }}
                </button>
                <button type="reset" class="btn btn-teal cancel-button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-refresh">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" />
                        <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" />
                    </svg>
                    {{ trans('cms::app.reset') }}
                </button>
            </div>
        </div>

        <div class="card-body">

            <div class="row">
                @foreach($socials as $social)
                    <div class="col-md-6">
                        <h5>{{ trans("cms::app.socials.{$social}") }}</h5>

                        {{ Field::checkbox(trans('cms::app.enable'), "socialites[{$social}][enable]", [
                            'value' => '1',
                            'checked' => $data[$social]['enable'] ?? false
                        ]) }}

                        {{ Field::security(trans('cms::app.client_id'), "socialites[{$social}][client_id]", [
                            'value' => $data[$social]['client_id'] ?? ''
                        ]) }}

                        {{ Field::security(trans('cms::app.client_secret'), "socialites[{$social}][client_secret]", [
                            'value' => $data[$social]['client_secret'] ?? ''
                        ]) }}

                        {{ Field::text(trans('cms::app.callback_url'), "socialites[{$social}][redirect_url]", [
                            'disabled' => true,
                            'value' => route('auth.socialites.callback', [$social])
                        ]) }}

                        {{ Field::text(trans('cms::app.redirect_url'), "socialites[{$social}][redirect_url]", [
                            'disabled' => true,
                            'value' => route('auth.socialites.redirect', [$social])
                        ]) }}
                    </div>
                @endforeach
            </div>
        </div>

        <div class="card-footer bg-transparent mt-auto">
            <div class="row g-2 align-items-center">
                <div class="col-md-6"></div>
                <div class="col-md-6 d-flex justify-content-end">
                    <button type="submit" class="btn btn-tabler me-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                            <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                            <path d="M14 4l0 4l-6 0l0 -4" />
                        </svg>
                        {{ trans('cms::app.save') }}
                    </button>

                    <button type="reset" class="btn btn-teal cancel-button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-refresh">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" />
                            <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" />
                        </svg>
                        {{ trans('cms::app.reset') }}
                    </button>
                </div>
            </div>
        </div>
    </div>

</form>
