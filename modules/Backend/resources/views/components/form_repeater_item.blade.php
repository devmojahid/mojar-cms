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
                    <i class="fas fa-trash"></i>
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


