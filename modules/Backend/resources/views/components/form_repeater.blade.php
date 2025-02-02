<div class="form-group repeater-field" id="{{ $id }}" data-min="{{ $repeater->getConfig()['min_items'] }}"
    data-max="{{ $repeater->getConfig()['max_items'] }}" data-sortable="{{ $repeater->getConfig()['sortable'] }}"
    data-collapsible="{{ $repeater->getConfig()['collapsible'] }}">

    <label class="form-label @if ($required) required @endif">
        {{ $repeater->getConfig()['label'] }}
    </label>

    <div class="repeater-items">
        @foreach ($repeater->getItems() as $index => $item)
            @include('cms::components.form_repeater_item', [
                'fields' => $repeater->getConfig()['fields'],
                'values' => $item,
                'index' => $index,
                'name' => $repeater->getConfig()['name'],
            ])
        @endforeach
    </div>

    <button type="button" class="btn btn-secondary btn-sm mt-2 add-repeater-item">
        <i class="fas fa-plus"></i> {{ $repeater->getConfig()['add_button_text'] }}
    </button>

    <template class="repeater-template">
        @include('cms::components.form_repeater_item', [
            'fields' => $repeater->getConfig()['fields'],
            'values' => $repeater->getConfig()['value'],
            'index' => '__INDEX__',
            'name' => $repeater->getConfig()['name'],

        ])
    </template>
</div>

<script type="text/javascript">
    class RepeaterField {
        constructor(element) {
            this.container = element;
            this.itemsContainer = this.container.querySelector('.repeater-items');
            this.template = this.container.querySelector('.repeater-template').innerHTML;
            this.addButton = this.container.querySelector('.add-repeater-item');

            this.minItems = parseInt(this.container.dataset.min) || 0;
            this.maxItems = parseInt(this.container.dataset.max) || null;
            this.sortable = this.container.dataset.sortable === 'true';

            this.initializeEvents();
            this.initializeSortable();
            this.ensureMinItems();
        }

        initializeEvents() {
            this.addButton.addEventListener('click', () => this.addItem());

            this.itemsContainer.addEventListener('click', (e) => {
                if (e.target.matches('.remove-repeater-item')) {
                    const confirmMessage = e.target.dataset.confirm;
                    if (confirmMessage && !confirm(confirmMessage)) {
                        return;
                    }
                    this.removeItem(e.target.closest('.repeater-item'));
                }
            });
        }

        initializeSortable() {
            if (this.sortable && window.Sortable) {
                new Sortable(this.itemsContainer, {
                    handle: '.handle',
                    animation: 150,
                    onEnd: () => this.reindexItems()
                });
            }
        }

        addItem() {
            const currentCount = this.itemsContainer.children.length;

            if (this.maxItems && currentCount >= this.maxItems) {
                return;
            }

            const newIndex = currentCount;
            const newItem = this.template.replace(/__INDEX__/g, newIndex);

            this.itemsContainer.insertAdjacentHTML('beforeend', newItem);
            this.initializeNewItemFields(this.itemsContainer.lastElementChild);
            this.reindexItems();
        }

        removeItem(item) {
            const currentCount = this.itemsContainer.children.length;

            if (currentCount <= this.minItems) {
                return;
            }

            item.remove();
            this.reindexItems();
        }

        reindexItems() {
            Array.from(this.itemsContainer.children).forEach((item, index) => {
                // Update index data attribute
                item.dataset.index = index;

                // Update collapse ID and triggers
                const collapseContent = item.querySelector('.collapse');
                if (collapseContent) {
                    const newId = `repeater-item-${index}`;
                    collapseContent.id = newId;
                    item.querySelector('.collapse-trigger').dataset.bsTarget = `#${newId}`;
                }

                // Update field names and IDs
                item.querySelectorAll('[name]').forEach(input => {
                    const name = input.getAttribute('name');
                    input.setAttribute('name', name.replace(/\[\d+\]/, `[${index}]`));

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
        }

        initializeNewItemFields(item) {
            // Initialize Select2
            item.querySelectorAll('select').forEach(select => {
                if (window.Select2) {
                    $(select).select2();
                }
            });

            // Initialize other field types
            item.querySelectorAll('.editor').forEach(editor => {
                if (window.CKEDITOR) {
                    CKEDITOR.replace(editor);
                }
            });

            // Trigger custom event for other initializations
            const event = new CustomEvent('repeater:item-added', {
                detail: {
                    item
                }
            });
            this.container.dispatchEvent(event);
        }

        ensureMinItems() {
            while (this.itemsContainer.children.length < this.minItems) {
                this.addItem();
            }
        }
    }

    // Initialize all repeater fields
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.repeater-field').forEach(element => {
            new RepeaterField(element);
        });
    });
</script>
