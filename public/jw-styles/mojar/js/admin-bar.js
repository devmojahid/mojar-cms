document.addEventListener('DOMContentLoaded', () => {
    const speedDial     = document.getElementById('jwSpeedDial');
    const toggleBtn     = document.getElementById('jwSpeedDialToggle');
    const actionsList   = document.getElementById('jwSpeedDialActions');
    let isOpen          = false;

    // --- Toggle open/close ---
    toggleBtn.addEventListener('click', function() {
        isOpen = !isOpen;
        speedDial.classList.toggle('open', isOpen);
        toggleBtn.setAttribute('aria-expanded', String(isOpen));
        actionsList.setAttribute('aria-hidden', String(!isOpen));
    });

    // --- Draggable Items & Removal ---
    const dialItems = document.querySelectorAll('.jw-speed-dial-item');
    dialItems.forEach((item) => {
        const closeBtn = item.querySelector('.jw-close-item');

        // Close button removes the item
        closeBtn.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();
            item.remove();
            // Optionally update localStorage if you want to persist removals or order
            saveSpeedDialOrder();
        });

        // DRAG & DROP
        item.addEventListener('dragstart', onDragStart);
        item.addEventListener('dragend', onDragEnd);
    });

    actionsList.addEventListener('dragover', onDragOver);

    function onDragStart(e) {
        e.dataTransfer.effectAllowed = 'move';
        // Use the data-item-id for identifying
        e.dataTransfer.setData('text/plain', e.target.dataset.itemId);
        setTimeout(() => {
            e.target.classList.add('hide');
        }, 0);
        e.target.classList.add('dragging');
    }

    function onDragEnd(e) {
        e.target.classList.remove('hide');
        e.target.classList.remove('dragging');
        // Optionally persist order to localStorage
        saveSpeedDialOrder();
    }

    function onDragOver(e) {
        e.preventDefault();
        const draggingItem = document.querySelector('.dragging');
        const afterElement = getDragAfterElement(actionsList, e.clientY);
        if (!afterElement) {
            actionsList.appendChild(draggingItem);
        } else {
            actionsList.insertBefore(draggingItem, afterElement);
        }
    }

    function getDragAfterElement(container, y) {
        const draggableElements = [
            ...container.querySelectorAll('.jw-speed-dial-item:not(.hide):not(.dragging)')
        ];

        let closest = null;
        let closestOffset = Number.NEGATIVE_INFINITY;

        draggableElements.forEach(child => {
            const box = child.getBoundingClientRect();
            const offset = y - (box.top + box.height / 2);
            if (offset < 0 && offset > closestOffset) {
                closestOffset = offset;
                closest = child;
            }
        });

        return closest;
    }

    // --- OPTIONAL: Persist order to localStorage ---
    
    function saveSpeedDialOrder() {
        const items = document.querySelectorAll('.jw-speed-dial-item');
        const order = [];
        items.forEach((el) => {
            order.push(el.dataset.itemId);
        });
        localStorage.setItem('jwSpeedDialOrder', JSON.stringify(order));
    }

    function loadSpeedDialOrder() {
        const storedOrder = JSON.parse(localStorage.getItem('jwSpeedDialOrder') || '[]');
        if (storedOrder.length) {
            const itemsMap = {};
            document.querySelectorAll('.jw-speed-dial-item').forEach((el) => {
                itemsMap[el.dataset.itemId] = el;
            });
            storedOrder.forEach((itemId) => {
                if (itemsMap[itemId]) {
                    actionsList.appendChild(itemsMap[itemId]);
                }
            });
        }
    }

    // Call loadSpeedDialOrder() on page load
    loadSpeedDialOrder();
    

    // --- OPTIONAL: Simple Keyboard Navigation (Arrow keys) ---
    // If you want arrow navigation between items in an open Speed Dial:
    
    actionsList.addEventListener('keydown', function(e) {
        if (!isOpen) return;
        const focusableItems = [...actionsList.querySelectorAll('.jw-speed-dial-item')];
        const currentIndex = focusableItems.indexOf(document.activeElement);
        
        if (e.key === 'ArrowDown') {
            e.preventDefault();
            const nextIndex = currentIndex + 1 < focusableItems.length ? currentIndex + 1 : 0;
            focusableItems[nextIndex].focus();
        } else if (e.key === 'ArrowUp') {
            e.preventDefault();
            const prevIndex = currentIndex - 1 >= 0 ? currentIndex - 1 : focusableItems.length - 1;
            focusableItems[prevIndex].focus();
        } else if (e.key === 'Escape') {
            // Close the menu if desired
            toggleBtn.click();
            toggleBtn.focus();
        }
    });
    
});