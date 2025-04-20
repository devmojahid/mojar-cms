<div class="form-group repeater-field" id="{{ $id }}" data-min="{{ $repeater->getConfig()['min_items'] }}"
    data-max="{{ $repeater->getConfig()['max_items'] }}" data-sortable="{{ $repeater->getConfig()['sortable'] }}"
    data-collapsible="{{ $repeater->getConfig()['collapsible'] }}" data-name="{{ $repeater->getConfig()['name'] }}">

    <label class="form-label @if ($required) required @endif">
        {{ $repeater->getConfig()['label'] }}
    </label>

    <div class="repeater-items">
        @php
            // Ensure items are properly formatted
            $items = $repeater->getItems();
            if (empty($items) && !empty($repeater->getConfig()['value'])) {
                $items = $repeater->getConfig()['value'];
            }
        @endphp
        
        @foreach ($items as $index => $item)
            @include('cms::components.form_repeater_item', [
                'fields' => $repeater->getConfig()['fields'],
                'values' => $item,
                'index' => $index,
                'name' => $repeater->getConfig()['name'],
            ])
        @endforeach
    </div>

    <button type="button" class="btn btn-secondary btn-sm mt-2 add-repeater-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M12 5l0 14" />
            <path d="M5 12l14 0" />
        </svg>
        {{ $repeater->getConfig()['add_button_text'] ?? trans('cms::app.add_item', ['label' => $repeater->getConfig()['label']]) }}
    </button>

    <template class="repeater-template">
        @include('cms::components.form_repeater_item', [
            'fields' => $repeater->getConfig()['fields'],
            'values' => [],
            'index' => '__INDEX__',
            'name' => $repeater->getConfig()['name'],
        ])
    </template>
</div>

<script type="text/javascript">
    // Only define RepeaterField class if it doesn't already exist
    if (typeof window.RepeaterField === 'undefined') {
        window.RepeaterField = class {
            constructor(element) {
                this.container = element;
                this.itemsContainer = this.container.querySelector('.repeater-items');
                this.template = this.container.querySelector('.repeater-template').innerHTML;
                this.addButton = this.container.querySelector('.add-repeater-item');
                this.fieldName = this.container.dataset.name;

                this.minItems = parseInt(this.container.dataset.min) || 0;
                this.maxItems = parseInt(this.container.dataset.max) || null;
                this.sortable = this.container.dataset.sortable === 'true';

                this.initializeEvents();
                this.initializeSortable();
                this.ensureMinItems();
            }

            initializeEvents() {
                if (this.addButton) {
                    this.addButton.addEventListener('click', () => this.addItem());
                }

                this.itemsContainer.addEventListener('click', (e) => {
                    const removeButton = e.target.closest('.remove-repeater-item');
                    if (removeButton) {
                        const confirmMessage = removeButton.dataset.confirm;
                        if (confirmMessage && !confirm(confirmMessage)) {
                            return;
                        }
                        this.removeItem(removeButton.closest('.repeater-item'));
                    }
                });
            }

            initializeSortable() {
                if (this.sortable && typeof Sortable !== 'undefined') {
                    new Sortable(this.itemsContainer, {
                        handle: '.handle',
                        animation: 150,
                        onEnd: () => this.reindexItems()
                    });
                }
            }

            addItem() {
                try {
                    const currentCount = this.itemsContainer.children.length;

                    if (this.maxItems && currentCount >= this.maxItems) {
                        return;
                    }

                    const newIndex = currentCount;
                    let templateHTML = this.template.replace(/__INDEX__/g, newIndex);
                    
                    // Create a temporary div to safely parse the HTML
                    const tempDiv = document.createElement('div');
                    // Clean any problematic characters from the template HTML
                    templateHTML = templateHTML.trim();
                    tempDiv.innerHTML = templateHTML;
                    
                    // Get the first child as the new item
                    const itemElement = tempDiv.firstElementChild;
                    if (!itemElement) {
                        console.error('Failed to create new repeater item - no valid element found in template');
                        return;
                    }

                    try {
                        // Safely append the new item to the container
                        this.itemsContainer.appendChild(itemElement);
                        this.initializeNewItemFields(itemElement);
                        this.reindexItems();
                    } catch (error) {
                        console.error('Error adding repeater item to DOM:', error);
                    }
                } catch (error) {
                    console.error('Error adding repeater item:', error);
                }
            }

            removeItem(item) {
                const currentCount = this.itemsContainer.children.length;

                if (currentCount <= this.minItems) {
                    return;
                }

                if (item) {
                    item.remove();
                    this.reindexItems();
                }
            }

            reindexItems() {
                try {
                    Array.from(this.itemsContainer.children).forEach((item, index) => {
                        // Update index data attribute
                        item.dataset.index = index;

                        // Update collapse ID and triggers
                        const collapseContent = item.querySelector('.collapse, .collapse.show');
                        if (collapseContent) {
                            const newId = `repeater-item-${index}`;
                            collapseContent.id = newId;
                            const collapseTrigger = item.querySelector('.collapse-trigger');
                            if (collapseTrigger) {
                                collapseTrigger.dataset.bsTarget = `#${newId}`;
                            }
                        }

                        // Update field names and IDs
                        item.querySelectorAll('[name]').forEach(input => {
                            const name = input.getAttribute('name');
                            if (name) {
                                const newName = name.replace(/\[\d+\]/, `[${index}]`);
                                input.setAttribute('name', newName);
                            }

                            const id = input.getAttribute('id');
                            if (id) {
                                const newId = id.replace(/_\d+_/, `_${index}_`);
                                input.setAttribute('id', newId);

                                // Update associated label
                                const label = item.querySelector(`label[for="${id}"]`);
                                if (label) {
                                    label.setAttribute('for', newId);
                                }
                            }
                        });
                    });
                } catch (error) {
                    console.error('Error reindexing items:', error);
                }
            }

            initializeNewItemFields(item) {
                try {
                    // Find the parent block or modal
                    const parentBlock = this.container.closest('.form-block-edit');
                    const parentModal = this.container.closest('.modal');
                    const dropdownParent = parentBlock || parentModal || document.body;

                    // Initialize Select2
                    if (item.querySelectorAll('select').length > 0) {
                        setTimeout(() => {
                            item.querySelectorAll('select').forEach(select => {
                                if (typeof $ !== 'undefined' && $.fn.select2) {
                                    try {
                                        // Destroy if already initialized
                                        if ($(select).hasClass('select2-hidden-accessible')) {
                                            $(select).select2('destroy');
                                        }
                                        
                                        // Handle different select types
                                        if ($(select).hasClass('load-taxonomies')) {
                                            $(select).select2({
                                                allowClear: true,
                                                dropdownParent: $(dropdownParent),
                                                width: '100%',
                                                placeholder: function(params) {
                                                    return {
                                                        id: null,
                                                        text: params.placeholder || 'Select an option',
                                                    };
                                                },
                                                ajax: {
                                                    method: 'GET',
                                                    url: mojar.adminUrl + '/load-data/loadTaxonomies',
                                                    dataType: 'json',
                                                    data: function(params) {
                                                        const postType = $(select).data('post-type');
                                                        const taxonomy = $(select).data('taxonomy');
                                                        let explodes = $(select).data('explodes');
                                                        
                                                        if (explodes) {
                                                            explodes = $("." + explodes).map(function() {
                                                                return $(this).val();
                                                            }).get();
                                                        }
                                                        
                                                        return {
                                                            search: $.trim(params.term || ''),
                                                            page: params.page || 1,
                                                            explodes: explodes,
                                                            post_type: postType,
                                                            taxonomy: taxonomy
                                                        };
                                                    }
                                                }
                                            });
                                        } else {
                                            // Regular select2
                                            $(select).select2({
                                                dropdownParent: $(dropdownParent),
                                                width: '100%',
                                                placeholder: $(select).data('placeholder') || 'Select an option'
                                            });
                                        }
                                    } catch (error) {
                                        console.error('Error initializing select2:', error);
                                    }
                                }
                            });
                        }, 100);
                    }

                    // Initialize other field types
                    item.querySelectorAll('.editor').forEach(editor => {
                        if (typeof CKEDITOR !== 'undefined') {
                            CKEDITOR.replace(editor);
                        }
                    });

                    // Initialize nested repeaters
                    setTimeout(() => {
                        item.querySelectorAll('.repeater-field').forEach(repeater => {
                            if (!repeater.classList.contains('initialized')) {
                                repeater.classList.add('initialized');
                                new RepeaterField(repeater);
                            }
                        });
                    }, 100);

                    // Trigger custom event for other initializations
                    const event = new CustomEvent('repeater:item-added', {
                        detail: {
                            item
                        },
                        bubbles: true
                    });
                    this.container.dispatchEvent(event);
                } catch (error) {
                    console.error('Error initializing field:', error);
                }
            }

            ensureMinItems() {
                while (this.itemsContainer.children.length < this.minItems) {
                    this.addItem();
                }
            }
        };
    }

    // Initialize all repeater fields on DOM ready
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.repeater-field:not(.initialized)').forEach(element => {
            element.classList.add('initialized');
            new RepeaterField(element);
        });
    });

    // Re-initialize repeaters added dynamically via AJAX
    document.addEventListener('repeater:init', (event) => {
        if (event.target && event.target.classList.contains('repeater-field') && !event.target.classList.contains('initialized')) {
            event.target.classList.add('initialized');
            new RepeaterField(event.target);
        }
    });

    // Global function to handle select2 initialization in various contexts
    if (typeof window.initializeSelect2Elements !== 'function') {
        window.initializeSelect2Elements = function(container) {
            if (!container) return;
            
            try {
                // Find the closest context (modal, page block, etc.)
                const $container = $(container);
                const $modal = $container.closest('.modal');
                const $pageBlock = $container.closest('.form-block-edit');
                const dropdownParent = $pageBlock.length ? $pageBlock : ($modal.length ? $modal : document.body);
                
                // Initialize regular select2 elements
                $container.find('select:not(.load-taxonomies)').each(function() {
                    if (!$(this).hasClass('select2-hidden-accessible')) {
                        try {
                            $(this).select2({
                                dropdownParent: $(dropdownParent),
                                width: '100%',
                                placeholder: $(this).data('placeholder') || 'Select an option'
                            });
                        } catch (error) {
                            console.error('Error initializing select2:', error);
                        }
                    }
                });
                
                // Initialize taxonomy select2 elements
                $container.find('.load-taxonomies').each(function() {
                    if (!$(this).hasClass('select2-hidden-accessible')) {
                        try {
                            $(this).select2({
                                allowClear: true,
                                dropdownParent: $(dropdownParent),
                                width: '100%',
                                placeholder: function(params) {
                                    return {
                                        id: null,
                                        text: params.placeholder || 'Select an option',
                                    };
                                },
                                ajax: {
                                    method: 'GET',
                                    url: mojar.adminUrl + '/load-data/loadTaxonomies',
                                    dataType: 'json',
                                    data: function(params) {
                                        const postType = $(this).data('post-type');
                                        const taxonomy = $(this).data('taxonomy');
                                        let explodes = $(this).data('explodes');
                                        
                                        if (explodes) {
                                            explodes = $("." + explodes).map(function() {
                                                return $(this).val();
                                            }).get();
                                        }
                                        
                                        return {
                                            search: $.trim(params.term || ''),
                                            page: params.page || 1,
                                            explodes: explodes,
                                            post_type: postType,
                                            taxonomy: taxonomy
                                        };
                                    }
                                }
                            });
                        } catch (error) {
                            console.error('Error initializing taxonomy select2:', error);
                        }
                    }
                });
                
                // Initialize repeater fields
                $container.find('.repeater-field:not(.initialized)').each(function() {
                    try {
                        $(this).addClass('initialized');
                        new RepeaterField(this);
                    } catch (error) {
                        console.error('Error initializing repeater field:', error);
                    }
                });
            } catch (error) {
                console.error('Error in initializeSelect2Elements:', error);
            }
        };
    }
</script>
