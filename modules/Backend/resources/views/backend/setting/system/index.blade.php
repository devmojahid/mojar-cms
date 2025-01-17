@extends('cms::layouts.backend')
@section('content')
    <div class="row">
        @if($forms->count() > 1)
        <div class="col-md-3">
            <div class="list-group">
                @foreach($forms as $key => $form)
                <a class="list-group-item @if($key == $component) active @endif"
                   href="{{ route('admin.setting.form', [$page, $key]) }}">{{ $form->get('name') }}</a>
                @endforeach
            </div>
        </div>
        @endif

        <div class="col-md-{{ $forms->count() > 1 ? 9 : 12 }}">
            @if(isset($forms[$component]['view']))
                @if(is_string($forms[$component]['view']))
                    @if(view()->exists($forms[$component]['view']))
                        @include($forms[$component]['view'])
                    @endif
                @else
                    {{ $forms[$component]['view'] }}
                @endif
            @else
                <form action="{{ route('admin.setting.save') }}" method="post" class="form-ajax">
                    <input type="hidden" name="form" value="{{ $component }}">

                    <div class="card">
                        @if($forms[$component]['header'] ?? true)
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-6"></div>
                                    <div class="col-md-6">
                                        <div class="btn-group float-right">
                                            <button type="submit" class="btn btn-success"> {{ trans('cms::app.save') }} </button>
                                            <button type="reset" class="btn btn-default"> {{ trans('cms::app.reset') }} </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="card-body">
                            @foreach($configs as $key => $config)
                                @php
                                    if ($config['type'] == 'checkbox') {
                                        $config['data']['value'] = $config['data']['value'] ?? 1;
                                        $config['data']['checked'] = get_config($key, $config['data']['default'] ?? null) == ($config['data']['value'] ?? null);
                                    } else {
                                        $config['data']['value'] = get_config($key);
                                    }
                                @endphp

                                {{ Field::fieldByType($config) }}
                            @endforeach

                            @do_action("setting_form_{$component}")
                        </div>

                        @if($forms[$component]['footer'] ?? true)
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-6"></div>

                                    <div class="col-md-6">
                                        <div class="btn-group float-right">
                                            <button type="submit" class="btn btn-success">
                                                {{ trans('cms::app.save') }}
                                            </button>

                                            <button type="reset" class="btn btn-default">
                                                {{ trans('cms::app.reset') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </form>
            @endif
        </div>
    </div>
    <div class="card">
        <div class="row g-0">
          <div class="col-12 col-md-3 border-end">
            <div class="card-body">
              <div class="list-group list-group-transparent">
                <a href="./settings.html" class="list-group-item list-group-item-action d-flex align-items-center active">My Account</a>
                <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">My Notifications</a>
                <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">Connected Apps</a>
                <a href="./settings-plan.html" class="list-group-item list-group-item-action d-flex align-items-center">Plans</a>
                <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">Billing & Invoices</a>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-9 d-flex flex-column">
            <div class="card-body">
              <h2 class="mb-4">My Account</h2>
              <h3 class="card-title">Profile Details</h3>
              <div class="row align-items-center">
                <div class="col-auto"><span class="avatar avatar-xl" style="background-image: url(./static/avatars/000m.jpg)"></span>
                </div>
                <div class="col-auto"><a href="#" class="btn">
                    Change avatar
                  </a></div>
                <div class="col-auto"><a href="#" class="btn btn-ghost-danger">
                    Delete avatar
                  </a></div>
              </div>
              <h3 class="card-title mt-4">Business Profile</h3>
              <div class="row g-3">
                <div class="col-md">
                  <div class="form-label">Business Name</div>
                  <input type="text" class="form-control" value="Tabler">
                </div>
                <div class="col-md">
                  <div class="form-label">Business ID</div>
                  <input type="text" class="form-control" value="560afc32">
                </div>
                <div class="col-md">
                  <div class="form-label">Location</div>
                  <input type="text" class="form-control"
             value="Peimei, China">
                </div>
              </div>
              <h3 class="card-title mt-4">Email</h3>
              <p class="card-subtitle">This contact will be shown to others publicly, so choose it carefully.</p>
              <div>
                <div class="row g-2">
                  <div class="col-auto">
                    <input type="text" class="form-control w-auto" value="paweluna@howstuffworks.com">
                  </div>
                  <div class="col-auto"><a href="#" class="btn">
                      Change
                    </a></div>
                </div>
              </div>
              <h3 class="card-title mt-4">Password</h3>
              <p class="card-subtitle">You can set a permanent password if you don't want to use temporary login codes.</p>
              <div>
                <a href="#" class="btn">
                  Set new password
                </a>
              </div>
              <h3 class="card-title mt-4">Public profile</h3>
              <p class="card-subtitle">Making your profile public means that anyone on the Dashkit network will be able to find
                you.</p>
              <div>
                <label class="form-check form-switch form-switch-lg">
                  <input class="form-check-input" type="checkbox" >
                  <span class="form-check-label form-check-label-on">You're currently visible</span>
                  <span class="form-check-label form-check-label-off">You're
                    currently invisible</span>
                </label>
              </div>
            </div>
            <div class="card-footer bg-transparent mt-auto">
              <div class="btn-list justify-content-end">
                <a href="#" class="btn">
                  Cancel
                </a>
                <a href="#" class="btn btn-primary">
                  Submit
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
@endsection
