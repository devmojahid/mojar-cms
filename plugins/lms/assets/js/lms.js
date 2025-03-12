// LMS Manager - Enhanced version with better state management
class LMSManager {
    constructor(options = {}) {
        // Default configuration
        const courseElement = document.querySelector('[data-course-id]');
        this.config = {
            courseId: courseElement ? parseInt(courseElement.dataset.courseId) : 0,
            apiEndpoints: {
                topics: '/app/lms/topics',
                topicsList: '/app/courses/{courseId}/curriculum',
                topicDetails: '/app/lms/topics/{id}',
                lessons: '/api/lessons',
                quizzes: '/api/quizzes',
                assignments: '/api/assignments',
                reorderTopics: '/app/lms/topics/reorder',
                reorderItems: '/api/items/reorder'
            },
            selectors: {
                topicsContainer: '#lmsTopicsContainer',
                emptyState: '#lmsEmptyState',
                addMoreTopicBtn: '#lmsAddMoreTopicBtn',
                topicLoading: '#lmsTopicLoading',
                addTopicBtn: '.lms-add-topic-btn',
                toastContainer: '#lmsToastContainer',
                topicModal: '#topicModal',
                topicForm: '#topicForm',
                saveTopic: '#saveTopic',
                saveTopicText: '#saveTopicText',
                saveTopicLoading: '#saveTopicLoading',
                confirmationModal: '#confirmationModal',
                confirmAction: '#confirmAction',
                lessonModal: '#lessonModal',
                lessonForm: '#lessonForm',
                saveLesson: '#saveLesson',
                quizModal: '#quizModal',
                quizForm: '#quizForm',
                saveQuiz: '#saveQuiz',
                assignmentModal: '#assignmentModal',
                assignmentForm: '#assignmentForm',
                saveAssignment: '#saveAssignment'
            },
            templates: {
                topicTemplate: '#topicTemplate',
                lessonTemplate: '#lessonTemplate',
                quizTemplate: '#quizTemplate',
                assignmentTemplate: '#assignmentTemplate'
            },
            csrfToken: document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
            toastDuration: 3000,
            animationDuration: 300
        };

        // Merge user options with defaults
        this.config = this.mergeDeep(this.config, options);

        // Application state
        this.state = {
            topics: [],
            items: [],
            courseId: this.config.courseId,
            isLoading: {},
            currentAction: null,
            currentItemId: null,
            currentTopicId: null,
            isToastShowing: false,
            sortableInstances: {},
            errors: {},
            modals: {}
        };

        // Initialize the application
        this.init();
    }

    /**
     * Deep merge two objects
     */
    mergeDeep(target, source) {
        const isObject = obj => obj && typeof obj === 'object' && !Array.isArray(obj);

        if (!isObject(target) || !isObject(source)) {
            return source;
        }

        Object.keys(source).forEach(key => {
            if (isObject(source[key])) {
                if (!target[key]) Object.assign(target, { [key]: {} });
                this.mergeDeep(target[key], source[key]);
            } else {
                Object.assign(target, { [key]: source[key] });
            }
        });

        return target;
    }

    /**
     * Initialize the application
     */
    init() {
        this.initModals();
        this.bindEvents();
        this.initToastSystem();
        this.loadTopics();
    }

    /**
     * Initialize Bootstrap modals
     */
    initModals() {
        const modalSelectors = [
            'topicModal', 'lessonModal', 'quizModal', 'assignmentModal', 'confirmationModal'
        ];

        modalSelectors.forEach(selector => {
            const element = document.getElementById(selector);
            if (element) {
                this.state.modals[selector] = new bootstrap.Modal(element);
            }
        });
    }

    /**
     * Bind all event listeners
     */
    bindEvents() {
        // Topic related events
        document.querySelectorAll(this.config.selectors.addTopicBtn).forEach(btn => {
            btn.addEventListener('click', () => this.openTopicModal());
        });

        // const saveTopicBtn = document.querySelector(this.config.selectors.saveTopic);
        // if (saveTopicBtn) {
        //     saveTopicBtn.addEventListener('click', () => this.saveTopic());
        // }
        const saveTopicBtn = document.querySelector(this.config.selectors.saveTopic);
        if (saveTopicBtn) {
            saveTopicBtn.addEventListener('click', (event) => {
                event.preventDefault(); // Prevent default form submission
                this.saveTopic(event);
            });
        }

        // Lesson related events
        const saveLessonBtn = document.querySelector(this.config.selectors.saveLesson);
        if (saveLessonBtn) {
            saveLessonBtn.addEventListener('click', () => this.saveLesson());
        }

        // Quiz related events
        const saveQuizBtn = document.querySelector(this.config.selectors.saveQuiz);
        if (saveQuizBtn) {
            saveQuizBtn.addEventListener('click', () => this.saveQuiz());
        }

        // Assignment related events
        const saveAssignmentBtn = document.querySelector(this.config.selectors.saveAssignment);
        if (saveAssignmentBtn) {
            saveAssignmentBtn.addEventListener('click', () => this.saveAssignment());
        }

        // Event delegation for dynamic elements
        document.addEventListener('click', e => {
            // Edit topic button
            if (e.target.closest('.edit-topic-btn')) {
                const topicEl = e.target.closest('.lms-topic');
                const topicId = topicEl.dataset.id;
                this.editTopic(topicId);
            }

            // Delete topic button
            if (e.target.closest('.delete-topic-btn')) {
                const topicEl = e.target.closest('.lms-topic');
                const topicId = topicEl.dataset.id;
                this.confirmDeleteTopic(topicId);
            }

            // Add lesson button
            if (e.target.closest('.add-lesson-btn')) {
                const topicId = e.target.closest('.add-lesson-btn').dataset.topicId;
                this.openLessonModal(topicId);
            }

            // Add quiz button
            if (e.target.closest('.add-quiz-btn')) {
                const topicId = e.target.closest('.add-quiz-btn').dataset.topicId;
                this.openQuizModal(topicId);
            }

            // Add assignment button
            if (e.target.closest('.add-assignment-btn')) {
                const topicId = e.target.closest('.add-assignment-btn').dataset.topicId;
                this.openAssignmentModal(topicId);
            }

            // Edit item button
            if (e.target.closest('.edit-item-btn')) {
                const itemEl = e.target.closest('.lms-lesson-item');
                const itemId = itemEl.dataset.id;
                const itemType = itemEl.dataset.type;
                this.editItem(itemId, itemType);
            }

            // Delete item button
            if (e.target.closest('.delete-item-btn')) {
                const itemEl = e.target.closest('.lms-lesson-item');
                const itemId = itemEl.dataset.id;
                const itemType = itemEl.dataset.type;
                this.confirmDeleteItem(itemId, itemType);
            }

            // Topic toggle
            if (e.target.closest('.lms-topic-toggle')) {
                const topicEl = e.target.closest('.lms-topic');
                this.toggleTopic(topicEl);
            }
        });

        // Confirmation action
        const confirmActionBtn = document.querySelector(this.config.selectors.confirmAction);
        if (confirmActionBtn) {
            confirmActionBtn.addEventListener('click', () => {
                if (this.state.currentAction) {
                    this.state.currentAction();
                    this.state.currentAction = null;
                    this.hideModal('confirmationModal');
                }
            });
        }

        // Form submission prevention
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', e => {
                e.preventDefault();
                return false;
            });
        });
    }

    /**
     * Initialize toast notification system
     */
    initToastSystem() {
        const container = document.querySelector(this.config.selectors.toastContainer);
        if (!container) {
            const toastContainer = document.createElement('div');
            toastContainer.id = this.config.selectors.toastContainer.replace('#', '');
            toastContainer.className = 'position-fixed bottom-0 end-0 p-3';
            toastContainer.style.zIndex = '9999';
            document.body.appendChild(toastContainer);
        }
    }

    /**
     * Load topics for the current course
     */
    loadTopics() {
        this.setLoading('topicLoading', true);

        const url = this.config.apiEndpoints.topicsList.replace('{courseId}', this.state.courseId);

        this.apiRequest(url)
            .then(data => {
                this.state.topics = data.topics || [];
                this.state.items = data.items || [];
                this.renderCurriculum();
            })
            .catch(error => {
                this.showToast(error.message, 'danger');
            })
            .finally(() => {
                this.setLoading('topicLoading', false);
            });
    }

    /**
     * Make an API request
     */
    apiRequest(url, options = {}) {
        const defaultOptions = {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': this.config.csrfToken
            }
        };

        const mergedOptions = { ...defaultOptions, ...options };

        // If content type is not multipart/form-data and method is not GET, set Content-Type header
        if (!options.body || !(options.body instanceof FormData)) {
            if (mergedOptions.method !== 'GET' && !mergedOptions.headers['Content-Type']) {
                mergedOptions.headers['Content-Type'] = 'application/json';
            }
        }

        return fetch(url, mergedOptions)
            .then(response => {
                return response.json().then(data => {
                    if (!response.ok) {
                        // Handle validation errors
                        if (response.status === 422 && data.errors) {
                            this.state.errors = data.errors;
                            throw new Error(data.message || 'Validation failed');
                        }
                        throw new Error(data.message || `Request failed with status ${response.status}`);
                    }
                    return data;
                });
            });
    }

    /**
     * Render the curriculum
     */
    renderCurriculum() {
        const topicsContainer = document.querySelector(this.config.selectors.topicsContainer);
        const emptyState = document.querySelector(this.config.selectors.emptyState);
        const addMoreTopicBtn = document.querySelector(this.config.selectors.addMoreTopicBtn);

        if (!topicsContainer) return;

        topicsContainer.innerHTML = ''; // Clear container

        if (this.state.topics.length === 0) {
            if (emptyState) emptyState.style.display = 'flex';
            if (addMoreTopicBtn) addMoreTopicBtn.style.display = 'none';
            return;
        }

        if (emptyState) emptyState.style.display = 'none';
        if (addMoreTopicBtn) addMoreTopicBtn.style.display = 'block';

        // Sort topics by order
        const sortedTopics = [...this.state.topics].sort((a, b) => a.order - b.order);

        sortedTopics.forEach(topic => {
            const topicEl = this.createTopicElement(topic);
            topicsContainer.appendChild(topicEl);
        });

        // Initialize sortable for topics
        this.initSortable('topics', topicsContainer, {
            handle: '.lms-topic-header',
            animation: 150,
            onEnd: (evt) => {
                const topicIds = Array.from(topicsContainer.children).map(topic => topic.dataset.id);
                this.updateTopicOrder(topicIds);
            }
        });

        // Initialize sortable for items in each topic
        sortedTopics.forEach(topic => {
            const container = topicsContainer.querySelector(`.lms-lessons-container[data-topic-id="${topic.id}"]`);
            if (container) {
                this.initSortable(`items-${topic.id}`, container, {
                    group: 'lessons',
                    animation: 150,
                    onEnd: (evt) => {
                        const newTopicId = evt.to.dataset.topicId;
                        const itemIds = Array.from(evt.to.children).map(item => item.dataset.id);
                        this.updateItemOrder(newTopicId, itemIds);
                    }
                });
            }
        });
    }

    /**
     * Create a topic element
     */
    createTopicElement(topic) {
        const template = document.querySelector(this.config.templates.topicTemplate);
        if (!template) return document.createElement('div');

        const clone = document.importNode(template.content, true);

        // Fill in the template
        const topicEl = clone.querySelector('.lms-topic');
        topicEl.dataset.id = topic.id;

        clone.querySelector('.lms-topic-title').textContent = topic.title;

        const description = topic.description || '';
        clone.querySelector('.lms-topic-description').textContent = description;

        const statusBadge = topic.status === 'publish' ? 'success' : 'secondary';
        const statusText = topic.status === 'publish' ? 'Published' : 'Draft';

        clone.querySelector('.badge').className = `badge bg-${statusBadge} ms-2`;
        clone.querySelector('.badge').textContent = statusText;

        clone.querySelector('.text-muted.small').textContent = `Order: ${topic.order || 0}`;

        // Get items for this topic
        const topicItems = this.state.items.filter(item => item.topic_id === topic.id);
        const lessonContainer = clone.querySelector('.lms-lessons-container');

        if (topicItems.length > 0) {
            lessonContainer.innerHTML = ''; // Clear default content

            // Sort items by order
            const sortedItems = [...topicItems].sort((a, b) => a.order - b.order);

            sortedItems.forEach(item => {
                const itemEl = this.createItemElement(item);
                lessonContainer.appendChild(itemEl);
            });
        }

        // Add buttons for all item types
        const topicFooter = clone.querySelector('.lms-topic-footer');
        const addLessonBtn = topicFooter.querySelector('.add-lesson-btn');

        // Add quiz button
        const addQuizBtn = document.createElement('button');
        addQuizBtn.type = 'button';
        addQuizBtn.className = 'btn btn-sm btn-outline-warning add-quiz-btn ms-2';
        addQuizBtn.dataset.topicId = topic.id;
        addQuizBtn.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24"
                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M12 5l0 14" />
                <path d="M5 12l14 0" />
            </svg>
            Add Quiz
        `;
        topicFooter.appendChild(addQuizBtn);

        // Add assignment button
        const addAssignmentBtn = document.createElement('button');
        addAssignmentBtn.type = 'button';
        addAssignmentBtn.className = 'btn btn-sm btn-outline-danger add-assignment-btn ms-2';
        addAssignmentBtn.dataset.topicId = topic.id;
        addAssignmentBtn.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24"
                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M12 5l0 14" />
                <path d="M5 12l14 0" />
            </svg>
            Add Assignment
        `;
        topicFooter.appendChild(addAssignmentBtn);

        return topicEl;
    }

    /**
     * Create an item element (lesson, quiz, assignment)
     */
    createItemElement(item) {
        const itemEl = document.createElement('div');
        itemEl.className = 'lms-lesson-item';
        itemEl.dataset.id = item.id;
        itemEl.dataset.type = item.type;

        // Get appropriate icon based on type
        let icon = '';
        let typeText = '';
        let typeClass = '';

        switch (item.type) {
            case 'lesson':
                icon = '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 19a9 9 0 0 1 9 0a9 9 0 0 1 9 0" /><path d="M3 6a9 9 0 0 1 9 0a9 9 0 0 1 9 0" /><path d="M3 6l0 13" /><path d="M12 6l0 13" /><path d="M21 6l0 13" /></svg>';
                typeText = 'Lesson';
                typeClass = 'primary';
                break;
            case 'quiz':
                icon = '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 9h6l3 3l-3 3h-6l-3 -3z" /><path d="M4 14v-4h4" /></svg>';
                typeText = 'Quiz';
                typeClass = 'warning';
                break;
            case 'assignment':
                icon = '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" /><path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" /><path d="M9 12l2 2l4 -4" /></svg>';
                typeText = 'Assignment';
                typeClass = 'danger';
                break;
        }

        // Create item structure
        itemEl.innerHTML = `
            <div class="lms-lesson-header">
                <div class="lms-lesson-type-icon text-${typeClass}">${icon}</div>
                <div class="lms-lesson-info">
                    <h6 class="lms-lesson-title">${item.title}</h6>
                    <span class="badge bg-${typeClass} lms-lesson-type">${typeText}</span>
                </div>
                <div class="lms-lesson-actions">
                    <button type="button" class="btn btn-sm btn-icon btn-outline-secondary edit-item-btn" title="Edit Item">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                    </button>
                    <button type="button" class="btn btn-sm btn-icon btn-outline-danger delete-item-btn" title="Delete Item">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                    </button>
                </div>
            </div>
        `;

        return itemEl;
    }

    /**
     * Initialize sortable for an element
     */
    initSortable(id, element, options) {
        // Destroy existing instance if it exists
        if (this.state.sortableInstances[id]) {
            this.state.sortableInstances[id].destroy();
        }

        // Check if Sortable is loaded
        if (typeof Sortable !== 'undefined' && element) {
            this.state.sortableInstances[id] = new Sortable(element, options);
        }
    }

    /**
     * Update topic order
     */
    updateTopicOrder(topicIds) {
        this.apiRequest(this.config.apiEndpoints.reorderTopics, {
            method: 'POST',
            body: JSON.stringify({ topics: topicIds })
        })
            .then(data => {
                this.showToast('Topic order updated successfully');

                // Update state
                data.topics.forEach(updatedTopic => {
                    const index = this.state.topics.findIndex(t => t.id === updatedTopic.id);
                    if (index !== -1) {
                        this.state.topics[index].order = updatedTopic.order;
                    }
                });
            })
            .catch(error => {
                this.showToast(error.message, 'danger');
            });
    }

    /**
     * Update item order
     */
    updateItemOrder(topicId, itemIds) {
        this.apiRequest(this.config.apiEndpoints.reorderItems, {
            method: 'POST',
            body: JSON.stringify({
                topic_id: topicId,
                items: itemIds
            })
        })
            .then(data => {
                this.showToast('Item order updated successfully');

                // Update state
                data.items.forEach(updatedItem => {
                    const index = this.state.items.findIndex(i => i.id === updatedItem.id);
                    if (index !== -1) {
                        this.state.items[index].order = updatedItem.order;
                        this.state.items[index].topic_id = updatedItem.topic_id;
                    }
                });
            })
            .catch(error => {
                this.showToast(error.message, 'danger');
            });
    }

    /**
     * Open topic modal
     */
    openTopicModal(topicId = null) {
        const modal = document.getElementById('topicModal');
        const modalTitle = document.getElementById('topicModalTitle');
        const form = document.getElementById('topicForm');

        if (!modal || !form) return;

        // Reset form
        form.reset();
        document.getElementById('topicId').value = '';
        document.getElementById('topicFormError').style.display = 'none';

        // Remove validation errors
        form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
        form.querySelectorAll('.invalid-feedback').forEach(el => el.textContent = '');

        if (topicId) {
            modalTitle.textContent = 'Edit Topic';
            document.getElementById('topicId').value = topicId;

            // Store current topic ID in state
            this.state.currentTopicId = topicId;

            // Get topic data
            this.setLoading('saveTopicLoading', true);

            this.apiRequest(this.config.apiEndpoints.topicDetails.replace('{id}', topicId))
                .then(topic => {
                    document.getElementById('topicTitle').value = topic.title || '';
                    document.getElementById('topicDescription').value = topic.description || '';
                    document.getElementById('topicOrder').value = topic.order || 0;
                    document.getElementById('topicStatus').checked = topic.status === 'publish';
                })
                .catch(error => {
                    this.showToast(error.message, 'danger');
                })
                .finally(() => {
                    this.setLoading('saveTopicLoading', false);
                });
        } else {
            modalTitle.textContent = 'Add New Topic';
            this.state.currentTopicId = null;

            // Set next order value
            const nextOrder = this.state.topics.length;
            document.getElementById('topicOrder').value = nextOrder;
        }

        // Show modal
        this.showModal('topicModal');
    }

    /**
     * Save topic
     */
    saveTopic(event) {
        // Since we're not using a real form element anymore, we need to collect the form data manually
        const formDiv = document.getElementById('topicForm');

        if (!formDiv) {
            console.error("Topic form not found");
            return;
        }

        // Create a new FormData object
        const formData = new FormData();

        // Manually add each form field
        formData.append('id', document.getElementById('topicId').value);
        formData.append('title', document.getElementById('topicTitle').value);
        formData.append('description', document.getElementById('topicDescription').value);
        formData.append('post_id', this.state.courseId);

        // Show loading
        this.setLoading('saveTopicLoading', true);
        document.getElementById('topicFormError').style.display = 'none';

        // Clear validation errors
        formDiv.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
        formDiv.querySelectorAll('.invalid-feedback').forEach(el => el.textContent = '');

        const topicId = document.getElementById('topicId').value;
        const endpoint = topicId ? this.config.apiEndpoints.topicDetails.replace('{id}', topicId) : this.config.apiEndpoints.topics;
        const method = topicId ? 'PUT' : 'POST';

        this.apiRequest(endpoint, {
            method: method,
            body: formData
        })
            .then(data => {
                if (topicId) {
                    // Update existing topic in state
                    const index = this.state.topics.findIndex(t => t.id === data.topic.id);
                    if (index !== -1) {
                        this.state.topics[index] = data.topic;
                    }
                    this.showToast('Topic updated successfully');
                } else {
                    // Add new topic to state
                    this.state.topics.push(data.topic);
                    this.showToast('Topic created successfully');
                }

                // Update UI
                this.renderCurriculum();

                // Close modal
                this.hideModal('topicModal');
            })
            .catch(error => {
                // Handle validation errors
                if (this.state.errors) {
                    Object.keys(this.state.errors).forEach(field => {
                        const input = document.getElementById('topic' + field.charAt(0).toUpperCase() + field.slice(1));
                        const error = document.getElementById('topic' + field.charAt(0).toUpperCase() + field.slice(1) + 'Error');

                        if (input && error) {
                            input.classList.add('is-invalid');
                            error.textContent = this.state.errors[field][0];
                        }
                    });
                }

                document.getElementById('topicFormError').textContent = error.message;
                document.getElementById('topicFormError').style.display = 'block';
            })
            .finally(() => {
                this.setLoading('saveTopicLoading', false);
            });
    }

    /**
     * Save topic
     */
    saveTopicOld(event) {
        const form = event.target.closest('form'); // Get form from event target

        console.log(form)

        if (!form) {
            console.error("Topic form not found. Attempting direct DOM traversal.");
            // Fallback: try to get the form directly from the modal
            const modal = document.querySelector('#topicModal');
            const formInModal = modal ? modal.querySelector('form') : null;

            if (!formInModal) {
                console.error("Could not find form even with direct modal traversal");
                return;
            }
        }


        const formData = new FormData(form);
        const topicId = formData.get('id');

        // Show loading
        this.setLoading('saveTopicLoading', true);
        document.getElementById('topicFormError').style.display = 'none';

        // Clear validation errors
        form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
        form.querySelectorAll('.invalid-feedback').forEach(el => el.textContent = '');

        const endpoint = topicId ? this.config.apiEndpoints.topicDetails.replace('{id}', topicId) : this.config.apiEndpoints.topics;
        const method = topicId ? 'PUT' : 'POST';

        this.apiRequest(endpoint, {
            method: method,
            body: formData
        })
            .then(data => {
                if (topicId) {
                    // Update existing topic in state
                    const index = this.state.topics.findIndex(t => t.id === data.topic.id);
                    if (index !== -1) {
                        this.state.topics[index] = data.topic;
                    }
                    this.showToast('Topic updated successfully');
                } else {
                    // Add new topic to state
                    this.state.topics.push(data.topic);
                    this.showToast('Topic created successfully');
                }

                // Update UI
                this.renderCurriculum();

                // Close modal
                this.hideModal('topicModal');
            })
            .catch(error => {
                // Handle validation errors
                if (this.state.errors) {
                    Object.keys(this.state.errors).forEach(field => {
                        const input = document.getElementById('topic' + field.charAt(0).toUpperCase() + field.slice(1));
                        const error = document.getElementById('topic' + field.charAt(0).toUpperCase() + field.slice(1) + 'Error');

                        if (input && error) {
                            input.classList.add('is-invalid');
                            error.textContent = this.state.errors[field][0];
                        }
                    });
                }

                document.getElementById('topicFormError').textContent = error.message;
                document.getElementById('topicFormError').style.display = 'block';
            })
            .finally(() => {
                this.setLoading('saveTopicLoading', false);
            });
    }

    /**
     * Edit topic
     */
    editTopic(topicId) {
        this.openTopicModal(topicId);
    }

    /**
     * Confirm delete topic
     */
    confirmDeleteTopic(topicId) {
        const topic = this.state.topics.find(t => t.id === topicId);
        if (!topic) return;

        const confirmationMessage = document.getElementById('confirmationMessage');
        confirmationMessage.textContent = `Are you sure you want to delete the topic "${topic.title}"? This will also delete all lessons, quizzes, and assignments associated with this topic.`;

        document.getElementById('confirmAction').textContent = 'Yes, delete topic';

        this.state.currentAction = () => this.deleteTopic(topicId);

        this.showModal('confirmationModal');
    }

    /**
     * Delete topic
     */
    deleteTopic(topicId) {
        this.apiRequest(this.config.apiEndpoints.topicDetails.replace('{id}', topicId), {
            method: 'DELETE'
        })
            .then(data => {
                // Remove topic from state
                this.state.topics = this.state.topics.filter(t => t.id !== topicId);

                // Remove associated items
                this.state.items = this.state.items.filter(i => i.topic_id !== topicId);

                // Update UI
                this.renderCurriculum();

                this.showToast('Topic deleted successfully');
            })
            .catch(error => {
                this.showToast(error.message, 'danger');
            });
    }

    /**
     * Show or hide loading indicator
     */
    // setLoading(elementId, show) {
    //     const element = document.getElementById(elementId);
    //     if (element) {
    //         element.style.display = show ? 'inline-block' : 'none';
    //     }
    // }

    /**
     * Show toast notification
     */
    showToast(message, type = 'success') {
        const toast = document.createElement('div');
        toast.className = `toast align-items-center text-bg-${type} border-0 show`;
        toast.setAttribute('role', 'alert');
        toast.setAttribute('aria-live', 'assertive');
        toast.setAttribute('aria-atomic', 'true');
        toast.innerHTML = `
            <div class="d-flex">
                <div class="toast-body">${message}</div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        `;

        const container = document.querySelector(this.config.selectors.toastContainer);
        container.appendChild(toast);

        setTimeout(() => {
            toast.remove();
            this.state.isToastShowing = false;
        }, this.config.toastDuration);
    }

    /**
     * Show/hide modal using Bootstrap instance
     */
    showModal(modalId) {
        if (this.state.modals[modalId]) {
            this.state.modals[modalId].show();
        }
    }

    hideModal(modalId) {
        if (this.state.modals[modalId]) {
            this.state.modals[modalId].hide();
        }
    }

    /**
 * Toggle topic visibility
 */
    toggleTopic(topicEl) {
        const content = topicEl.querySelector('.lms-topic-content');
        if (content) {
            content.style.display = content.style.display === 'none' ? 'block' : 'none';
        }
    }

    /**
     * Handle lesson modal
     */
    openLessonModal(topicId) {
        this.state.currentTopicId = topicId;
        const form = document.querySelector(this.config.selectors.lessonForm);
        form.reset();
        this.showModal('lessonModal');
    }

    async saveLesson() {
        const form = document.querySelector(this.config.selectors.lessonForm);
        const formData = new FormData(form);
        formData.append('topic_id', this.state.currentTopicId);

        try {
            const data = await this.apiRequest(this.config.apiEndpoints.lessons, {
                method: 'POST',
                body: formData
            });
            this.state.items.push(data.item);
            this.renderCurriculum();
            this.hideModal('lessonModal');
            this.showToast('Lesson saved successfully');
        } catch (error) {
            this.showToast(error.message, 'danger');
        }
    }

    /**
     * Handle quiz modal
     */
    openQuizModal(topicId) {
        this.state.currentTopicId = topicId;
        const form = document.querySelector(this.config.selectors.quizForm);
        form.reset();
        this.showModal('quizModal');
    }

    async saveQuiz() {
        const form = document.querySelector(this.config.selectors.quizForm);
        const formData = new FormData(form);
        formData.append('topic_id', this.state.currentTopicId);

        try {
            const data = await this.apiRequest(this.config.apiEndpoints.quizzes, {
                method: 'POST',
                body: formData
            });
            this.state.items.push(data.item);
            this.renderCurriculum();
            this.hideModal('quizModal');
            this.showToast('Quiz saved successfully');
        } catch (error) {
            this.showToast(error.message, 'danger');
        }
    }

    /**
     * Handle assignment modal
     */
    openAssignmentModal(topicId) {
        this.state.currentTopicId = topicId;
        const form = document.querySelector(this.config.selectors.assignmentForm);
        form.reset();
        this.showModal('assignmentModal');
    }

    async saveAssignment() {
        const form = document.querySelector(this.config.selectors.assignmentForm);
        const formData = new FormData(form);
        formData.append('topic_id', this.state.currentTopicId);

        try {
            const data = await this.apiRequest(this.config.apiEndpoints.assignments, {
                method: 'POST',
                body: formData
            });
            this.state.items.push(data.item);
            this.renderCurriculum();
            this.hideModal('assignmentModal');
            this.showToast('Assignment saved successfully');
        } catch (error) {
            this.showToast(error.message, 'danger');
        }
    }

    /**
     * Handle item editing
     */
    editItem(itemId, itemType) {
        const item = this.state.items.find(i => i.id === itemId && i.type === itemType);
        if (!item) return;

        switch (itemType) {
            case 'lesson':
                this.openLessonModal(item.topic_id);
                // Add code to populate lesson form
                break;
            case 'quiz':
                this.openQuizModal(item.topic_id);
                // Add code to populate quiz form
                break;
            case 'assignment':
                this.openAssignmentModal(item.topic_id);
                // Add code to populate assignment form
                break;
        }
    }

    /**
     * Handle item deletion
     */
    confirmDeleteItem(itemId, itemType) {
        this.state.currentItemId = itemId;
        this.state.currentAction = () => this.deleteItem(itemId, itemType);
        this.showModal('confirmationModal');
    }

    async deleteItem(itemId, itemType) {
        const endpointMap = {
            lesson: this.config.apiEndpoints.lessons,
            quiz: this.config.apiEndpoints.quizzes,
            assignment: this.config.apiEndpoints.assignments
        };

        try {
            await this.apiRequest(`${endpointMap[itemType]}/${itemId}`, {
                method: 'DELETE'
            });
            this.state.items = this.state.items.filter(i => i.id !== itemId);
            this.renderCurriculum();
            this.showToast('Item deleted successfully');
        } catch (error) {
            this.showToast(error.message, 'danger');
        }
    }

    /**
     * Handle loading states
     */
    setLoading(elementId, isLoading) {
        const element = document.querySelector(`#${elementId}`);
        if (!element) return;

        const loadingElement = element.querySelector('.loading-indicator');
        const contentElement = element.querySelector('.content');

        if (isLoading) {
            loadingElement?.classList.remove('d-none');
            contentElement?.classList.add('d-none');
        } else {
            loadingElement?.classList.add('d-none');
            contentElement?.classList.remove('d-none');
        }
    }


}
// Initialize LMSManager
document.addEventListener('DOMContentLoaded', () => {
    window.lmsManager = new LMSManager();
});
