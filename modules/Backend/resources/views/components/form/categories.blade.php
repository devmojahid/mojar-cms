<div class="form-group form-taxonomy">
    <div class="card">
        <div class="card-header justify-content-between">
            <div class="card-title-area">
                <h4 class="card-title"> {{ $taxonomy->get('label') }}</h5>
            </div>
            <div class="card-action-area">
                <span>
                    <a href="javascript:void(0)" class="float-right add-new">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-square-rounded-plus"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 3c7.2 0 9 1.8 9 9s-1.8 9 -9 9s-9 -1.8 -9 -9s1.8 -9 9 -9z" /><path d="M15 12h-6" /><path d="M12 9v6" /></svg>
                        {{ trans('cms::app.add_new') }}
                    </a>
                </span>
            </div>
        </div>
        <div class="card-body">
                @php
                    $items = \Juzaweb\Backend\Models\Taxonomy::with(['children'])
                        ->whereNull('parent_id')
                        ->where('taxonomy', '=', $taxonomy->get('taxonomy'))
                        ->where('post_type', '=', $taxonomy->get('post_type'))
                        ->get();
                    $value = $model->taxonomies->where('taxonomy', '=', $taxonomy->get('taxonomy'))->pluck('id')->toArray();
                @endphp

                <div class="show-taxonomies taxonomy-{{ $taxonomy->get('taxonomy') }}">
                    <ul class="mt-2 p-0">
                        @foreach ($items as $item)
                            @component('cms::components.form.taxonomy_item', [
                                'taxonomy' => $taxonomy,
                                'item' => $item,
                                'value' => $value,
                            ])
                            @endcomponent
                        @endforeach
                    </ul>
                </div>

                <div class="form-add mt-2 form-add-taxonomy box-hidden" style="display: none;">
                    <div class="form-group">
                        <label class="form-label required">{{ trans('cms::app.name') }}</label>
                        <input type="text" class="form-control taxonomy-name" autocomplete="off">
                    </div>

                    @if (in_array('hierarchical', $taxonomy->get('supports', [])))
                        <div class="form-group mb-1">
                            <label class="form-label">{{ trans('cms::app.parent') }}</label>
                            <select type="text" class="form-control taxonomy-parent load-taxonomies" autocomplete="off"
                                data-post-type="{{ $taxonomy->get('post_type') }}" data-taxonomy="{{ $taxonomy->get('taxonomy') }}">
                            </select>
                        </div>
                    @endif

                    <button type="button" class="btn btn-tabler mt-2" data-type="{{ $taxonomy->get('type') }}"
                        data-post_type="{{ $taxonomy->get('post_type') }}" data-taxonomy="{{ $taxonomy->get('taxonomy') }}">
                        <span class="icon-tabler-square-rounded-plus">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-square-rounded-plus">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M15 12h-6" />
                                <path d="M12 9v6" />
                            </svg>
                        </span>
                        {{ trans('cms::app.add') }}
                    </button>
                </div>
        </div>
    </div>
</div>
