document.addEventListener('DOMContentLoaded', () => {
    const speedDial     = document.getElementById('jwSpeedDial');
    const toggleBtn     = document.getElementById('jwSpeedDialToggle');
    const actionsList   = document.getElementById('jwSpeedDialActions');
    let isOpen          = false;

    // --- Toggle with animation and click outside handling ---
    toggleBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        toggleSpeedDial();
    });

    document.addEventListener('click', (e) => {
        if (isOpen && !speedDial.contains(e.target)) {
            toggleSpeedDial(false);
        }
    });

    function toggleSpeedDial(force) {
        isOpen = typeof force === 'boolean' ? force : !isOpen;
        speedDial.classList.toggle('open', isOpen);
        toggleBtn.setAttribute('aria-expanded', String(isOpen));
        actionsList.setAttribute('aria-hidden', String(!isOpen));
        
        // Animate toggle button
        toggleBtn.style.transform = isOpen ? 'rotate(45deg)' : 'rotate(0deg)';
    }

    // --- Enhanced Drag & Drop ---
    const dialItems = document.querySelectorAll('.jw-speed-dial-item');
    
    dialItems.forEach((item) => {
        setupItem(item);
    });

    function setupItem(item) {
        const closeBtn = item.querySelector('.jw-close-item');
        
        // Enhanced removal with animation
        closeBtn?.addEventListener('click', async (e) => {
            e.preventDefault();
            e.stopPropagation();
            
            item.style.transform = 'translateX(100%)';
            item.style.opacity = '0';
            
            await new Promise(resolve => setTimeout(resolve, 200));
            item.remove();
            saveSpeedDialOrder();
        });

        // Enhanced drag and drop
        item.setAttribute('draggable', 'true');
        item.addEventListener('dragstart', onDragStart);
        item.addEventListener('dragend', onDragEnd);
        item.addEventListener('dragenter', onDragEnter);
        item.addEventListener('dragleave', onDragLeave);
    }

    actionsList.addEventListener('dragover', onDragOver);

    function onDragStart(e) {
        e.dataTransfer.effectAllowed = 'move';
        e.dataTransfer.setData('text/plain', e.target.dataset.itemId);
        
        requestAnimationFrame(() => {
            e.target.classList.add('dragging');
            e.target.style.opacity = '0.5';
        });
    }

    function onDragEnd(e) {
        e.target.classList.remove('dragging');
        e.target.style.opacity = '';
        document.querySelectorAll('.drag-over').forEach(el => {
            el.classList.remove('drag-over');
        });
        saveSpeedDialOrder();
    }

    function onDragEnter(e) {
        e.preventDefault();
        if (!e.target.classList.contains('dragging')) {
            e.target.classList.add('drag-over');
        }
    }

    function onDragLeave(e) {
        e.target.classList.remove('drag-over');
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
    

    // --- Enhanced keyboard navigation ---
    actionsList.addEventListener('keydown', (e) => {
        if (!isOpen) return;
        
        const focusableItems = [...actionsList.querySelectorAll('.jw-speed-dial-item')];
        const currentIndex = focusableItems.indexOf(document.activeElement);
        
        switch (e.key) {
            case 'ArrowDown':
                e.preventDefault();
                const nextIndex = (currentIndex + 1) % focusableItems.length;
                focusableItems[nextIndex]?.focus();
                break;
            case 'ArrowUp':
                e.preventDefault();
                const prevIndex = currentIndex - 1 >= 0 ? currentIndex - 1 : focusableItems.length - 1;
                focusableItems[prevIndex]?.focus();
                break;
            case 'Escape':
                toggleSpeedDial(false);
                toggleBtn.focus();
                break;
        }
    });
    

    // --- Search functionality ---
    const searchInput = document.createElement('input');
    searchInput.type = 'text';
    searchInput.className = 'jw-speed-dial-search';
    searchInput.placeholder = 'Search actions...';
    actionsList.insertBefore(searchInput, actionsList.firstChild);

    searchInput.addEventListener('input', (e) => {
        const searchTerm = e.target.value.toLowerCase();
        dialItems.forEach(item => {
            const text = item.textContent.toLowerCase();
            item.style.display = text.includes(searchTerm) ? '' : 'none';
        });
    });

    // --- Moveable Speed Dial ---
    let isDragging = false;
    let currentX;
    let currentY;
    let initialX;
    let initialY;
    let xOffset = parseInt(localStorage.getItem('speedDialX')) || 0;
    let yOffset = parseInt(localStorage.getItem('speedDialY')) || 0;

    // Apply saved position
    if (xOffset || yOffset) {
        speedDial.style.transform = `translate(${xOffset}px, ${yOffset}px)`;
    }

    speedDial.addEventListener('mousedown', dragStart);
    document.addEventListener('mousemove', drag);
    document.addEventListener('mouseup', dragEnd);

    function dragStart(e) {
        if (e.target === toggleBtn) return;
        
        initialX = e.clientX - xOffset;
        initialY = e.clientY - yOffset;

        if (e.target === speedDial) {
            isDragging = true;
            speedDial.classList.add('moving');
        }
    }

    function drag(e) {
        if (isDragging) {
            e.preventDefault();

            currentX = e.clientX - initialX;
            currentY = e.clientY - initialY;

            xOffset = currentX;
            yOffset = currentY;

            setTranslate(currentX, currentY, speedDial);
        }
    }

    function dragEnd() {
        if (isDragging) {
            isDragging = false;
            speedDial.classList.remove('moving');
            
            // Save position
            localStorage.setItem('speedDialX', xOffset);
            localStorage.setItem('speedDialY', yOffset);
        }
    }

    function setTranslate(xPos, yPos, el) {
        el.style.transform = `translate(${xPos}px, ${yPos}px)`;
    }

    // --- Enhanced Link Handling ---
    const speedDialLinks = document.querySelectorAll('.jw-speed-dial-link');
    speedDialLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            // Prevent click if we're dragging
            if (isDragging) {
                e.preventDefault();
                return;
            }
            
            // Add loading state
            const item = link.closest('.jw-speed-dial-item');
            item.classList.add('loading');
            
            // Close speed dial
            toggleSpeedDial(false);
        });
    });

    // --- Double Click to Reset Position ---
    speedDial.addEventListener('dblclick', (e) => {
        if (e.target === toggleBtn) return;
        
        xOffset = 0;
        yOffset = 0;
        localStorage.removeItem('speedDialX');
        localStorage.removeItem('speedDialY');
        speedDial.style.transform = 'translate(0, 0)';
    });
});