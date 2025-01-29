@extends('cms::layouts.backend')

@section('content')
    <div class="menu-management-wrap">
        <div id="menu-container" class="container-fluid px-0">
            <!-- Selection / Creation Section -->
            <div class="card border-0 shadow-none mb-4">
                <div class="card-body p-3">
                    <div class="row alert alert-light m-0 no-radius align-items-center">
                        <!-- Existing Menu Selection -->
                        <div class="form-select-menu d-flex align-items-center justify-content-between">
                            @if ($menu)
                                <div class="menus-list">
                                    <span class="mb-1">
                                        {{ trans('cms::app.select_menu_to_edit') }}:
                                    </span>
                                    <select name="id" class="form-control load-menu w-auto mt-2">
                                        <option value="{{ $menu->id }}" selected>{{ $menu->name }}</option>
                                    </select>
                                </div>
                            @endif
                            <div class="btn-group">
                                <a href="javascript:void(0)" class="btn btn-tabler btn-add-menu" data-toggle="modal"
                                    data-target="#add-menu-modal">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M12 5l0 14"></path>
                                            <path d="M5 12l14 0"></path>
                                        </svg>
                                    </span>
                                    {{ trans('cms::app.create_new_menu') }}
                                </a>
                            </div>
                        </div>
                        <!-- /Existing Menu Selection -->

                        <!-- Add New Menu Form -->
                        {{-- <div class="col-md-6 form-add-menu box-hidden d-flex justify-content-end">
                        <form action="{{ route('admin.menu.store') }}"
                              method="post"
                              class="form-ajax">
                            @csrf
                            <div class="form-group mr-2">
                                <input type="text"
                                       name="name"
                                       class="form-control"
                                       autocomplete="off"
                                       required
                                       placeholder="{{ trans('cms::app.menu_name') }}">
                            </div>
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-plus"></i>
                                {{ trans('cms::app.add_menu') }}
                            </button>
                        </form>
                    </div> --}}
                        <!-- /Add New Menu Form -->
                    </div>
                    @if (empty($menu))
                        <div class="empty">
                            <div class="empty-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-menu-2"
                                    width="50" height="50" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M4 6l16 0"></path>
                                    <path d="M4 12l16 0"></path>
                                    <path d="M4 18l16 0"></path>
                                </svg>
                            </div>
                            <p class="empty-title">No menus found</p>
                            <p class="empty-subtitle text-muted">
                                Start by creating your first menu to organize your site's navigation structure.
                            </p>

                        </div>
                    @endif
                </div>
            </div>
            <!-- /Selection / Creation Section -->

            @if (!empty($menu))
                <div class="row row-cards">
                    <!-- Left Column: Add Menu Items -->
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">
                                    {{ trans('cms::app.add_menu_items') }}
                                </h4>
                            </div>
                            <div class="card-body">
                                @do_action('mojar.add_menu_items')
                            </div>
                        </div>
                    </div>
                    <!-- /Left Column: Add Menu Items -->

                    <!-- Right Column: Menu Structure & Settings -->
                    <div class="col-md-8">
                        <div class="card">
                            <!-- Card Header: Menu Info -->
                            <div class="card-header">
                                <div class="row w-100 m-0 align-items-center">
                                    <div class="col-md-9 p-0">
                                        <div class="form-group row mb-0">
                                            <label for="name" class="col-sm-3 col-form-label">
                                                {{ trans('cms::app.menu_name') }}
                                            </label>
                                            <div class="col-sm-9">
                                                <input type="text" name="name" id="name" class="form-control"
                                                    value="{{ $menu->name ?? '' }}" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 d-flex justify-content-end">
                                        <!-- The "Save" button will submit the form below via JS or direct submit -->
                                        <button form="menu-structure-form" type="submit" class="btn btn-primary">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path
                                                        d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2">
                                                    </path>
                                                    <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                                    <path d="M14 4l0 4l-6 0l0 -4"></path>
                                                </svg>
                                            </span>
                                            {{ trans('cms::app.save') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- /Card Header: Menu Info -->

                            <!-- Card Body: Nested Menu + Locations -->
                            <div class="card-body">
                                <form id="menu-structure-form" action="{{ route('admin.menu.update', [$menu->id]) }}"
                                    method="post" class="form-ajax form-menu-structure">
                                    @csrf
                                    @method('PUT')

                                    <input type="hidden" name="id" value="{{ $menu->id }}">
                                    <input type="hidden" name="reload_after_save" value="0">

                                    <!-- Menu Builder (Draggable) -->
                                    <div class="dd" id="jw-menu-builder">
                                        <ol class="dd-list">
                                            {!! jw_nav_backend_menu([
                                                'menu' => $menu,
                                                'item_view' => view('cms::backend.items.menu_item'),
                                            ]) !!}
                                        </ol>
                                    </div>
                                    <!-- /Menu Builder -->

                                    <hr>

                                    <!-- Menu Locations -->
                                    <div class="form-group mb-3">
                                        <label class="mb-1 font-weight-bold">
                                            {{ trans('cms::app.display_locations') }}
                                        </label>
                                        @foreach ($navMenus as $key => $navMenu)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="location[]"
                                                    value="{{ $key }}" id="location-{{ $key }}"
                                                    @if (isset($location[$key]) && $location[$key] == $menu->id) checked @endif>
                                                <label class="form-check-label" for="location-{{ $key }}">
                                                    {{ $navMenu->get('location') }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <!-- /Menu Locations -->

                                    <!-- Hidden JSON Output -->
                                    {{-- <textarea name="content" id="items-output" class="form-control box-hidden"></textarea> --}}

                                    <!-- Actions -->
                                    <div class="d-flex justify-content-between align-items-center">
                                        <a href="javascript:void(0)" class="text-danger delete-menu"
                                            data-id="{{ $menu->id }}">
                                            {{ trans('cms::app.delete_menu') }}
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" <svg="" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path
                                                        d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2">
                                                    </path>
                                                    <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                                    <path d="M14 4l0 4l-6 0l0 -4"></path>
                                                </svg>
                                            </span>
                                            {{ trans('cms::app.save') }}
                                        </button>
                                    </div>
                                    <!-- /Actions -->
                                </form>
                            </div>
                            <!-- /Card Body: Nested Menu + Locations -->
                        </div>
                    </div>
                    <!-- /Right Column: Menu Structure & Settings -->
                </div>
            @endif

        </div>
    </div>

    {{-- Add this modal component at the end of the file, before scripts --}}
    <div class="modal fade" id="add-menu-modal" tabindex="-1" role="dialog" aria-labelledby="add-menu-modal-label"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add-menu-modal-label">
                        <span class="me-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M12 5l0 14"></path>
                                <path d="M5 12l14 0"></path>
                            </svg>
                        </span>
                        {{ trans('cms::app.add_menu') }}
                    </h5>
                    <button type="button" class="btn-close" data-dismiss="modal"
                        aria-label="{{ trans('cms::app.close') }}"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.menu.store') }}" method="post" class="form-ajax">
                        <div id="form-add-menu">
                            {{-- Existing form content will be moved here via JavaScript --}}
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" autocomplete="off" required
                                    placeholder="{{ trans('cms::app.menu_name') }}">
                            </div>
                            <button type="submit" class="btn btn-tabler">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M12 5l0 14"></path>
                                        <path d="M5 12l14 0"></path>
                                    </svg>
                                </span>
                                {{ trans('cms::app.add_menu') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


{{-- @extends('cms::layouts.backend')

@section('content')
    <div id="menu-container">
        <div class="row alert alert-light p-3 no-radius">

            <div class="col-md-6 form-select-menu">
                <div class="alert-default">
                    @if ($menu)
                        {{ trans('cms::app.select_menu_to_edit') }}:
                        <select name="id" class="w-25 form-control load-menu">
                            <option value="{{ $menu->id }}" selected>{{ $menu->name }}</option>
                        </select>

                        {{ trans('cms::app.or') }}
                    @endif

                    <a href="javascript:void(0)" class="ml-1 btn-add-menu"><i class="fa fa-plus"></i>
                        {{ trans('cms::app.create_new_menu') }}</a>
                </div>
            </div>

            <div class="col-md-6 form-add-menu box-hidden">
                <form action="{{ route('admin.menu.store') }}" method="post" class="form-ajax">
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" autocomplete="off" required
                            placeholder="{{ trans('cms::app.menu_name') }}">
                    </div>

                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>
                        {{ trans('cms::app.add_menu') }}</button>
                </form>
            </div>
        </div>

        @if (!empty($menu))
            <div class="row mt-5">
                <div class="col-md-4">
                    <h5 class="mb-2 font-weight-bold">{{ trans('cms::app.add_menu_items') }}</h5>

                    @do_action('mojar.add_menu_items')
                </div>

                <div class="col-md-8">
                    <h5 class="mb-2 font-weight-bold">{{ trans('cms::app.menu_structure') }}</h5>

                    <form action="{{ route('admin.menu.update', [$menu->id]) }}" method="post"
                        class="form-ajax form-menu-structure">
                        <input type="hidden" name="id" value="{{ $menu->id }}">
                        <input type="hidden" name="reload_after_save" value="0">

                        @method('PUT')

                        <div class="card">
                            <div class="card-header bg-light pb-1">
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="form-group row">
                                            <label for="name"
                                                class="col-sm-3">{{ trans('cms::app.menu_name') }}</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="name" id="name" class="form-control"
                                                    value="{{ $menu->name ?? '' }}" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="btn-group float-right">
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>
                                                {{ trans('cms::app.save') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body" id="form-menu">
                                <div class="dd" id="jw-menu-builder">
                                    <ol class="dd-list">
                                        {!! jw_nav_backend_menu([
                                            'menu' => $menu,
                                            'item_view' => view('cms::backend.items.menu_item'),
                                        ]) !!}
                                    </ol>
                                </div>

                                <hr>

                                @foreach ($navMenus as $key => $navMenu)
                                    <div class="form-check mb-2">
                                        <label class="form-check-label">
                                            <input class="form-check-input" name="location[]" type="checkbox"
                                                value="{{ $key }}"
                                                @if (isset($location[$key]) && $location[$key] == $menu->id) checked @endif>
                                            {{ $navMenu->get('location') }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                            <div class="card-footer">
                                <div class="btn-group">
                                    <a href="javascript:void(0)" class="text-danger delete-menu"
                                        data-id="{{ $menu->id }}">{{ trans('cms::app.delete_menu') }}</a>
                                </div>

                                <div class="btn-group float-right">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>
                                        {{ trans('cms::app.save') }}</button>
                                </div>
                            </div>

                            <textarea name="content" id="items-output" class="form-control box-hidden"></textarea>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    </div>
@endsection --}}
