<div class="repeater-item card mb-3" data-index="{{ $index }}">
    @if($repeater->getConfig()['collapsible'])
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <a href="#" class="collapse-trigger" data-bs-toggle="collapse" 
                    data-bs-target="#repeater-item-{{ $index }}">
                        {{ sprintf(trans('cms::app.item_num'), (int)$index + 1) }}
                    </a>
            </h5>
            <div class="item-actions">
                @if($repeater->getConfig()['sortable'])
                    <span class="handle btn btn-sm btn-light">
                        <i class="fas fa-grip-vertical"></i>
                    </span>
                @endif
                <button type="button" class="btn btn-sm btn-danger remove-repeater-item"
                        @if($repeater->getConfig()['confirm_remove'])
                        data-confirm="{{ trans('cms::app.confirm_remove') }}"
                        @endif
                >
                <span> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M4 7l16 0"></path><path d="M10 11l0 6"></path><path d="M14 11l0 6"></path><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path></svg></span>
                </button>
            </div>
        </div>
    @endif

    <div class="card-body @if($repeater->getConfig()['collapsible']) collapse show @endif" 
         id="repeater-item-{{ $index }}">
        @foreach($fields as $field)
            @php
                $fieldName = "{$name}[{$index}][{$field['name']}]";

                $fieldId = "field_{$name}_{$index}_{$field['name']}";
                $fieldValue = $values[$field['name']] ?? null;
                
                $fieldOptions = array_merge($field, [
                    'name' => $fieldName,
                    'id' => $fieldId,
                    'value' => $fieldValue,
                    'data' => [
                        'value' => $fieldValue
                    ]
                ]);
            @endphp
            

            {{ Field::fieldByType($fieldOptions) }}
        @endforeach
    </div>
</div>


