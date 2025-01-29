 @extends('cms::layouts.backend')

 @section('content')
     <div id="menu-container">
         <div class="row alert alert-light p-3 no-radius align-items-center justify-content-between">
             <div class="col-md-6 form-select-menu">
                 <div class="alert-default">
                     @if ($menu)
                         {{ trans('cms::app.select_menu_to_edit') }}:
                         <select name="id" class="w-25 form-control load-menu">
                             <option value="{{ $menu->id }}" selected>{{ $menu->name }}</option>
                         </select>

                         {{ trans('cms::app.or') }}
                     @endif
                 </div>
             </div>
             <div class="col-md-6">
                <a href="javascript:void(0)" class="ml-1 btn-add-menu btn btn-tabler">
                    <span>
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-plus"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                    </span>
                     {{ trans('cms::app.create_new_menu') }}
                </a>
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
                             <div class="card-header">
                                    <div class="col-md-9">
                                        <div class="form-group row align-items-center">
                                            <label for="name" class="col-sm-2">{{ trans('cms::app.menu_name') }}</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="name" id="name" class="form-control"
                                                    value="{{ $menu->name ?? '' }}" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="btn-group float-right">
                                            <button type="submit" class="btn btn-primary">
                                                <span>
                                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" /></svg>
                                                </span>
                                                {{ trans('cms::app.save') }}</button>
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
                                     <a href="javascript:void(0)" class="delete-menu btn btn-danger" data-id="{{ $menu->id }}">
                                        <span>
                                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                        </span>
                                         {{ trans('cms::app.delete_menu') }}
                                        </a>
                                 </div>

                                 <div class="btn-group float-right">
                                     <button type="submit" class="btn btn-primary">
                                        <span><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" /></svg></span>
                                         {{ trans('cms::app.save') }}</button>
                                 </div>
                             </div>

                             <textarea name="content" id="items-output" style="display:none" class="form-control box-hidden"></textarea>
                         </div>
                     </form>
                 </div>
             </div>
         @endif
     </div>

     <form action="{{ route('admin.menu.store') }}" method="post" class="form-ajax">
         <div class="modal fade" id="customAlertModal" tabindex="-1" aria-hidden="true">
             <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                 <div class="modal-content">
                     <button type="button" class="btn-close m-2 ms-auto" data-bs-dismiss="modal"
                         aria-label="Close"></button>
                     <div class="modal-status" id="customAlertModalStatus"></div>
                     <div class="modal-body text-center py-4">
                         <svg id="customAlertModalIcon" xmlns="http://www.w3.org/2000/svg" class="icon mb-2 icon-lg"
                             width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                             fill="none" stroke-linecap="round" stroke-linejoin="round">
                             <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                             <path d="M12 9v2m0 4v.01" />
                             <path
                                 d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" />
                         </svg>
                         <h3 id="customAlertModalTitle">Add New Menu</h3>
                         <div class="form-group">
                            <input type="text" name="name" class="form-control" autocomplete="off" required
                                placeholder="{{ trans('cms::app.menu_name') }}">
                        </div>
                     </div>

                     <div class="modal-footer">
                         <div class="w-100">
                             <div class="row">
                                 <div class="col">
                                     <button type="button" class="btn w-100" data-bs-dismiss="modal">
                                         {{ trans('cms::app.cancel') }}
                                     </button>
                                 </div>


                                 <div class="col">
                                     <button type="submit" class="btn w-100 btn-tabler">
                                         {{ trans('cms::app.add_menu') }}
                                     </button>
                                 </div>

                             </div>

                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </form>
 @endsection
