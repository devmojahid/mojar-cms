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
                lessons: '/app/lms/lessons', // still not working
                quizzes: '/app/lms/quizzes', // still not working
                assignments: '/app/lms/assignments', // still not working
                reorderTopics: '/app/lms/topics/reorder', // still not working
                reorderItems: '/app/lms/items/reorder' // still not working
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
        console.log('LMSManager initializing with course ID:', this.state.courseId);

        // Use a delayed initialization to prevent conflicts with other scripts
        setTimeout(() => {
            // Initialize modals
            this.initModals();

            // Initialize toast system
            this.initToastSystem();

            // Bind events
            this.bindEvents();

            // Load topics if course ID is available
            if (this.state.courseId) {
                this.loadTopics();
            }
        }, 300); // Delay initialization to allow other scripts to load first
    }

    /**
     * Initialize Bootstrap modals
     */
    initModals() {
        console.log('Initializing modals');

        const modalSelectors = [
            'topicModal', 'lessonModal', 'quizModal', 'assignmentModal', 'confirmationModal'
        ];

        modalSelectors.forEach(selector => {
            const element = document.getElementById(selector);
            if (element) {
                console.log(`Initializing modal: ${selector}`);
                try {
                    this.state.modals[selector] = new bootstrap.Modal(element);
                } catch (error) {
                    console.error(`Error initializing modal ${selector}:`, error);
                }
            } else {
                console.warn(`Modal element not found: ${selector}`);
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
        // document.querySelectorAll('form').forEach(form => {
        //     form.addEventListener('submit', e => {
        //         e.preventDefault();
        //         return false;
        //     });
        // });
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
        console.log('Loading topics for course ID:', this.state.courseId);
        this.setLoading('topicLoading', true);

        const url = this.config.apiEndpoints.topicsList.replace('{courseId}', this.state.courseId);
        console.log('Fetching from URL:', url);

        this.apiRequest(url)
            .then(data => {
                console.log('API response:', data);

                // Check if data is wrapped in a 'data' property
                if (data.data && (data.data.topics || data.data.items)) {
                    this.state.topics = data.data.topics || [];
                    this.state.items = data.data.items || [];
                } else {
                    this.state.topics = data.topics || [];
                    this.state.items = data.items || [];
                }

                console.log('Processed topics:', this.state.topics);
                console.log('Processed items:', this.state.items);

                this.renderCurriculum();
            })
            .catch(error => {
                console.error('Error loading topics:', error);
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
        console.log('Making API request to:', url, 'with options:', options);

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
                console.log('API response status:', response.status);

                return response.json().then(data => {
                    console.log('API response data:', data);

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
            })
            .catch(error => {
                console.error('API request error:', error);
                throw error;
            });
    }

    /**
     * Render the curriculum
     */
    renderCurriculum() {
        console.log('Rendering curriculum');
        const topicsContainer = document.querySelector(this.config.selectors.topicsContainer);
        const emptyState = document.querySelector(this.config.selectors.emptyState);
        const addMoreTopicBtn = document.querySelector(this.config.selectors.addMoreTopicBtn);

        if (!topicsContainer) {
            console.error('Topics container not found:', this.config.selectors.topicsContainer);
            return;
        }

        console.log('Topics container found:', topicsContainer);
        topicsContainer.innerHTML = ''; // Clear container

        if (!this.state.topics || this.state.topics.length === 0) {
            console.log('No topics found, showing empty state');
            if (emptyState) {
                emptyState.style.display = '';
            } else {
                console.error('Empty state element not found:', this.config.selectors.emptyState);
            }

            if (addMoreTopicBtn) {
                addMoreTopicBtn.style.display = 'none';
            } else {
                console.error('Add more topic button not found:', this.config.selectors.addMoreTopicBtn);
            }
            return;
        }

        console.log('Topics found, hiding empty state');
        if (emptyState) {
            emptyState.style.display = 'none';
        }

        if (addMoreTopicBtn) {
            addMoreTopicBtn.style.display = 'block';
        }

        // Sort topics by order
        const sortedTopics = [...this.state.topics].sort((a, b) => a.order - b.order);
        console.log('Sorted topics:', sortedTopics);

        sortedTopics.forEach(topic => {
            console.log('Creating element for topic:', topic);
            const topicEl = this.createTopicElement(topic);
            if (topicEl) {
                topicsContainer.appendChild(topicEl);
            } else {
                console.error('Failed to create element for topic:', topic);
            }
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
            } else {
                console.error('Lessons container not found for topic:', topic);
            }
        });

        console.log('Curriculum rendering complete');
        
        // Auto-expand the first topic after rendering if there are any topics
        if (sortedTopics.length > 0) {
            const firstTopicEl = topicsContainer.querySelector('.lms-topic');
            if (firstTopicEl) {
                setTimeout(() => {
                    // First ensure all topics are collapsed
                    document.querySelectorAll('.lms-topic').forEach(topic => {
                        const content = topic.querySelector('.lms-topic-content');
                        if (content) {
                            content.style.display = 'none';
                            topic.classList.remove('lms-topic-expanded');
                            const toggleIcon = topic.querySelector('.lms-topic-toggle svg');
                            if (toggleIcon) {
                                toggleIcon.style.transform = 'rotate(0deg)';
                            }
                        }
                    });
                    
                    // Then explicitly expand the first topic
                    const firstContent = firstTopicEl.querySelector('.lms-topic-content');
                    if (firstContent) {
                        firstContent.style.display = 'block';
                        firstTopicEl.classList.add('lms-topic-expanded');
                        const toggleIcon = firstTopicEl.querySelector('.lms-topic-toggle svg');
                        if (toggleIcon) {
                            toggleIcon.style.transform = 'rotate(90deg)';
                        }
                    }
                }, 100);
            }
        }
    }

    /**
     * Create a topic element
     */
    createTopicElement(topic) {
        console.log('Creating topic element for:', topic);
        const template = document.querySelector(this.config.templates.topicTemplate);
        if (!template) {
            console.error('Topic template not found:', this.config.templates.topicTemplate);
            return document.createElement('div');
        }

        try {
            const clone = document.importNode(template.content, true);

            // Fill in the template
            const topicEl = clone.querySelector('.lms-topic');
            if (!topicEl) {
                console.error('Topic element not found in template');
                return document.createElement('div');
            }

            topicEl.dataset.id = topic.id;
            topicEl.dataset.topicId = topic.id;

            const titleEl = clone.querySelector('.lms-topic-title');
            if (titleEl) {
                titleEl.textContent = topic.title || 'Untitled Topic';
            }

            const description = topic.description || '';
            const descEl = clone.querySelector('.lms-topic-description');
            if (descEl) {
                descEl.textContent = description;
            }

            const statusBadge = topic.status === 'publish' ? 'success' : 'secondary';
            const statusText = topic.status === 'publish' ? 'Published' : 'Draft';

            const badgeEl = clone.querySelector('.badge');
            if (badgeEl) {
                badgeEl.className = `badge bg-${statusBadge} ms-2`;
                badgeEl.textContent = statusText;
            }

            const orderEl = clone.querySelector('.text-muted.small');
            if (orderEl) {
                orderEl.textContent = `Order: ${topic.order || 0}`;
            }

            // Set the topic_id in the lessons container
            const lessonContainer = clone.querySelector('.lms-lessons-container');
            if (lessonContainer) {
                lessonContainer.dataset.topicId = topic.id;

                // Get items for this topic
                // First try to match by topic_id, if that fails, match by id (since we're using topics as items)
                let topicItems = this.state.items.filter(item => item.topic_id == topic.id);

                // If no items found by topic_id, try matching by id
                if (topicItems.length === 0) {
                    topicItems = this.state.items.filter(item => item.id == topic.id);
                }

                console.log(`Found ${topicItems.length} items for topic ${topic.id}:`, topicItems);

                if (topicItems.length > 0) {
                    lessonContainer.innerHTML = ''; // Clear default content

                    // Sort items by order
                    const sortedItems = [...topicItems].sort((a, b) => a.order - b.order);

                    sortedItems.forEach(item => {
                        const itemEl = this.createItemElement(item);
                        lessonContainer.appendChild(itemEl);
                    });
                }
            } else {
                console.error('Lessons container not found in template');
            }

            // Add buttons for all item types
            const topicFooter = clone.querySelector('.lms-topic-footer');
            if (topicFooter) {
                const addLessonBtn = topicFooter.querySelector('.add-lesson-btn');
                if (addLessonBtn) {
                    addLessonBtn.dataset.topicId = topic.id;
                }

                // Add quiz button
                const addQuizBtn = document.createElement('button');
                addQuizBtn.type = 'button';
                addQuizBtn.className = 'btn btn-sm btn-outline-warning add-quiz-btn ms-2 d-none';
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
                addAssignmentBtn.className = 'btn btn-sm btn-outline-danger add-assignment-btn ms-2 d-none';
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
            } else {
                console.error('Topic footer not found in template');
            }

            // Add event listeners
            const toggleBtn = clone.querySelector('.lms-topic-toggle');
            if (toggleBtn) {
                toggleBtn.addEventListener('click', (e) => {
                    e.stopPropagation(); // Prevent event bubbling
                    this.toggleTopic(topicEl);
                });
            }

            const editBtn = clone.querySelector('.edit-topic-btn');
            if (editBtn) {
                editBtn.addEventListener('click', (e) => {
                    e.stopPropagation(); // Prevent event bubbling
                    this.editTopic(topic.id);
                });
            }

            const deleteBtn = clone.querySelector('.delete-topic-btn');
            if (deleteBtn) {
                deleteBtn.addEventListener('click', (e) => {
                    e.stopPropagation(); // Prevent event bubbling
                    this.confirmDeleteTopic(topic.id);
                });
            }

            // Make the entire header clickable for toggling
            const header = clone.querySelector('.lms-topic-header');
            if (header) {
                header.addEventListener('click', () => {
                    this.toggleTopic(topicEl);
                });
            }

            return topicEl;
        } catch (error) {
            console.error('Error creating topic element:', error);
            return document.createElement('div');
        }
    }

    /**
     * Create an item element (lesson, quiz, assignment)
     */
    createItemElement(item) {
        const itemEl = document.createElement('div');
        itemEl.className = 'lms-lesson-item';
        itemEl.dataset.id = item.id;

        // Default to 'lesson' if type is empty
        const itemType = item.type || 'lesson';
        itemEl.dataset.type = itemType;

        // Get appropriate icon based on type
        let icon = '';
        let typeText = '';
        let typeClass = '';

        switch (itemType) {
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
            default:
                // Default to lesson if type is not recognized
                icon = '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 19a9 9 0 0 1 9 0a9 9 0 0 1 9 0" /><path d="M3 6a9 9 0 0 1 9 0a9 9 0 0 1 9 0" /><path d="M3 6l0 13" /><path d="M12 6l0 13" /><path d="M21 6l0 13" /></svg>';
                typeText = 'Lesson';
                typeClass = 'primary';
                break;
        }

        // Create item structure
        itemEl.innerHTML = `
            <div class="lms-lesson-header">
                <div class="lms-lesson-type-icon text-${typeClass}">${icon}</div>
                <div class="lms-lesson-info">
                    <h6 class="lms-lesson-title">${item.title || 'Untitled'}</h6>
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

        console.log(topicId, "inside openTopicModal");

        // Reset form
        // form.reset();
        let topicTitleElement = document.getElementById('topicTitle');
        let topicDescElement = document.getElementById('topicDescription');
        // Reset form elemt
        topicTitleElement.value = "";
        topicDescElement.value = "";
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
                    console.log(topic, "inside openTopicModal then");
                    topicTitleElement.value = topic?.data?.title || '';
                    topicDescElement.value = topic?.data?.description || '';
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
        if (topicId) {
            formData.append('_method', 'PUT');
        }

        this.apiRequest(endpoint, {
            method: 'POST', // Always use POST
            body: formData
        })
            .then(data => {
                const topicData = data.data;
                console.log(data, "inside saveTopic then");
                if (topicId) {
                    console.log(topicData, "inside saveTopic then if");
                    // Update existing topic in state
                    const index = this.state.topics.findIndex(t => t.id === topicData.id);
                    if (index !== -1) {
                        this.state.topics[index] = topicData;
                    }
                    this.showToast('Topic updated successfully');
                } else {
                    console.log(topicData, "inside saveTopic else");
                    // Add new topic to state
                    this.state.topics.push(topicData);
                    this.showToast('Topic created successfully');
                }
                console.log(this.state.topics, "inside saveTopic then");

                // Update UI
                this.loadTopics();
                // this.renderCurriculum();

                // Close modal
                this.hideModal('topicModal');
                
                // Add a small delay to allow the DOM to update, then handle the topic expansion
                setTimeout(() => {
                    // First ensure all topics are collapsed
                    document.querySelectorAll('.lms-topic').forEach(topic => {
                        const content = topic.querySelector('.lms-topic-content');
                        if (content) {
                            content.style.display = 'none';
                            topic.classList.remove('lms-topic-expanded');
                            const toggleIcon = topic.querySelector('.lms-topic-toggle svg');
                            if (toggleIcon) {
                                toggleIcon.style.transform = 'rotate(0deg)';
                            }
                        }
                    });
                    
                    // Then find and expand the topic that was just created or edited
                    const targetTopicElement = document.querySelector(`[data-topic-id="${topicData.id}"]`);
                    if (targetTopicElement) {
                        // Scroll to the topic if it was newly created
                        if (!topicId) {
                            targetTopicElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        }
                        
                        // Expand the topic
                        const content = targetTopicElement.querySelector('.lms-topic-content');
                        if (content) {
                            content.style.display = 'block';
                            targetTopicElement.classList.add('lms-topic-expanded');
                            const toggleIcon = targetTopicElement.querySelector('.lms-topic-toggle svg');
                            if (toggleIcon) {
                                toggleIcon.style.transform = 'rotate(90deg)';
                            }
                        }
                    }
                }, 300);
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
     * Show a modal
     */
    showModal(modalId) {
        console.log(`Showing modal: ${modalId}`);

        if (this.state.modals[modalId]) {
            try {
                this.state.modals[modalId].show();
            } catch (error) {
                console.error(`Error showing modal ${modalId}:`, error);

                // Fallback: try to get the modal directly
                const modalEl = document.getElementById(modalId);
                if (modalEl) {
                    try {
                        const modal = new bootstrap.Modal(modalEl);
                        modal.show();
                        this.state.modals[modalId] = modal;
                    } catch (fallbackError) {
                        console.error(`Fallback error showing modal ${modalId}:`, fallbackError);
                    }
                } else {
                    console.error(`Modal element not found: ${modalId}`);
                }
            }
        } else {
            console.warn(`Modal not initialized: ${modalId}`);

            // Try to initialize and show the modal
            const modalEl = document.getElementById(modalId);
            if (modalEl) {
                try {
                    const modal = new bootstrap.Modal(modalEl);
                    modal.show();
                    this.state.modals[modalId] = modal;
                } catch (error) {
                    console.error(`Error initializing and showing modal ${modalId}:`, error);
                }
            }
        }
    }

    /**
     * Hide a modal
     */

    hideModal(modalId) {
        console.log(`Hiding modal: ${modalId}`);

        const modal = this.state.modals[modalId];
        if (modal) {
            modal.hide(); // Properly hide the Bootstrap modal
        }

        // Add this to remove the backdrop
        document.querySelectorAll('.modal-backdrop').forEach(backdrop => backdrop.remove());
        // Also make sure the body doesn't have the 'modal-open' class
        document.body.classList.remove('modal-open');
        document.body.style.paddingRight = '';

        if (this.state.modals[modalId]) {
            try {
                this.state.modals[modalId].hide();
            } catch (error) {
                console.error(`Error hiding modal ${modalId}:`, error);

                // Fallback: try to get the modal directly
                const modalEl = document.getElementById(modalId);
                if (modalEl) {
                    try {
                        const modal = bootstrap.Modal.getInstance(modalEl);
                        if (modal) {
                            modal.hide();
                        }
                    } catch (fallbackError) {
                        console.error(`Fallback error hiding modal ${modalId}:`, fallbackError);
                    }
                }
            }
        } else {
            console.warn(`Modal not initialized: ${modalId}`);

            // Try to get the modal instance and hide it
            const modalEl = document.getElementById(modalId);
            if (modalEl) {
                try {
                    const modal = bootstrap.Modal.getInstance(modalEl);
                    if (modal) {
                        modal.hide();
                    }
                } catch (error) {
                    console.error(`Error getting and hiding modal ${modalId}:`, error);
                }
            }
        }
    }

    /**
     * Toggle topic visibility
     */
    toggleTopic(topicEl) {
        if (!topicEl) {
            console.error('Topic element is null or undefined');
            return;
        }

        console.log('Toggling topic:', topicEl);

        const content = topicEl.querySelector('.lms-topic-content');
        if (!content) {
            console.error('Topic content element not found');
            return;
        }

        // Toggle display
        if (content.style.display === 'none' || content.style.display === '') {
            console.log('Expanding topic');
            content.style.display = 'block';
            // Add expanded class to the topic
            topicEl.classList.add('lms-topic-expanded');
            // Rotate the toggle icon if it exists
            const toggleIcon = topicEl.querySelector('.lms-topic-toggle svg');
            if (toggleIcon) {
                toggleIcon.style.transform = 'rotate(90deg)';
            }
        } else {
            console.log('Collapsing topic');
            content.style.display = 'none';
            // Remove expanded class from the topic
            topicEl.classList.remove('lms-topic-expanded');
            // Reset the toggle icon if it exists
            const toggleIcon = topicEl.querySelector('.lms-topic-toggle svg');
            if (toggleIcon) {
                toggleIcon.style.transform = 'rotate(0deg)';
            }
        }
    }

    /**
     * Handle lesson modal
     */
    openLessonModal(topicId) {
        this.state.currentTopicId = topicId;
        const lessonForm = document.querySelector(this.config.selectors.lessonForm);
        
        // Reset form fields
        if (lessonForm) {
            const inputs = lessonForm.querySelectorAll('input, select, textarea');
            inputs.forEach(input => {
                if (input.type === 'checkbox') {
                    input.checked = false;
                } else if (input.type === 'select-one') {
                    input.selectedIndex = 0;
                } else {
                    input.value = '';
                }
            });
        }
        
        this.showModal('lessonModal');
    }

    async saveLesson() {
        // Don't rely on the form element directly
        const lessonFormDiv = document.getElementById('lessonForm');

        if (!lessonFormDiv) {
            console.error("Lesson form not found");
            return;
        }

        // Show loading animation
        this.setLoading('saveLessonLoading', true);
        document.getElementById('saveLessonText').classList.add('d-none');

        // Create a new FormData object
        const formData = new FormData();

        // Manually collect form fields
        const inputs = lessonFormDiv.querySelectorAll('input, select, textarea');
        inputs.forEach(input => {
            if (input.type === 'checkbox') {
                formData.append(input.name, input.checked ? '1' : '0');
            } else {
                formData.append(input.name, input.value);
            }
        });

        // Add the topic ID
        formData.append('course_topic_id', this.state.currentTopicId);
        
        // Determine if this is a create or update operation
        const isUpdate = this.state.currentItemId !== null;
        let url = this.config.apiEndpoints.lessons;
        let method = 'POST';
        
        if (isUpdate) {
            url = `${url}/${this.state.currentItemId}`;
            formData.append('_method', 'PUT');
        }

        try {
            const data = await this.apiRequest(url, {
                method: method,
                body: formData
            });

            // Add or update the lesson in the items array
            const itemData = data.data || data.item;
            if (itemData) {
                if (isUpdate) {
                    // Update existing item
                    const index = this.state.items.findIndex(i => i.id === this.state.currentItemId);
                    if (index !== -1) {
                        this.state.items[index] = itemData;
                    }
                } else {
                    // Add new item
                    this.state.items.push(itemData);
                }
            }
            
            // Reset form inputs
            inputs.forEach(input => {
                if (input.type === 'checkbox') {
                    input.checked = false;
                } else if (input.type === 'select-one') {
                    input.selectedIndex = 0;
                } else {
                    input.value = '';
                }
            });
            
            // Load topics to ensure we have the latest data
            await this.loadTopics();

            // Hide modal
            this.hideModal('lessonModal');

            // Expand the parent topic
            setTimeout(() => {
                const parentTopic = document.querySelector(`.lms-lessons-container[data-topic-id="${this.state.currentTopicId}"]`)?.closest('.lms-topic');
                if (parentTopic) {
                    // Ensure parent topic is expanded
                    const content = parentTopic.querySelector('.lms-topic-content');
                    if (content && (content.style.display === 'none' || content.style.display === '')) {
                        content.style.display = 'block';
                        parentTopic.classList.add('lms-topic-expanded');
                        const toggleIcon = parentTopic.querySelector('.lms-topic-toggle svg');
                        if (toggleIcon) {
                            toggleIcon.style.transform = 'rotate(90deg)';
                        }
                    }
                    
                    // Scroll to the parent topic
                    parentTopic.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            }, 100);

            // Show success message
            const actionText = isUpdate ? 'updated' : 'saved';
            this.showToast(`Lesson ${actionText} successfully`);
        } catch (error) {
            this.showToast(error.message, 'danger');
        } finally {
            // Hide loading animation
            this.setLoading('saveLessonLoading', false);
            document.getElementById('saveLessonText').classList.remove('d-none');
            this.state.currentItemId = null; // Reset current item ID
        }
    }

    /**
     * Handle quiz modal
     */
    openQuizModal(topicId) {
        this.state.currentTopicId = topicId;
        const quizForm = document.querySelector(this.config.selectors.quizForm);
        
        // Reset form fields
        if (quizForm) {
            const inputs = quizForm.querySelectorAll('input, select, textarea');
            inputs.forEach(input => {
                if (input.type === 'checkbox') {
                    input.checked = false;
                } else if (input.type === 'select-one') {
                    input.selectedIndex = 0;
                } else {
                    input.value = '';
                }
            });
        }
        
        this.showModal('quizModal');
    }

    async saveQuiz() {
        const form = document.querySelector(this.config.selectors.quizForm);
        const formData = new FormData(form);
        formData.append('topic_id', this.state.currentTopicId);
        
        // Determine if this is a create or update operation
        const isUpdate = this.state.currentItemId !== null;
        let url = this.config.apiEndpoints.quizzes;
        let method = 'POST';
        
        if (isUpdate) {
            url = `${url}/${this.state.currentItemId}`;
            formData.append('_method', 'PUT');
        }

        try {
            const data = await this.apiRequest(url, {
                method: method,
                body: formData
            });
            
            // Add or update the quiz in the items array
            const itemData = data.data || data.item;
            if (itemData) {
                if (isUpdate) {
                    // Update existing item
                    const index = this.state.items.findIndex(i => i.id === this.state.currentItemId);
                    if (index !== -1) {
                        this.state.items[index] = itemData;
                    }
                } else {
                    // Add new item
                    this.state.items.push(itemData);
                }
            }
            
            this.renderCurriculum();
            this.hideModal('quizModal');
            
            // Expand the parent topic
            setTimeout(() => {
                const parentTopic = document.querySelector(`.lms-lessons-container[data-topic-id="${this.state.currentTopicId}"]`)?.closest('.lms-topic');
                if (parentTopic) {
                    // Ensure parent topic is expanded
                    const content = parentTopic.querySelector('.lms-topic-content');
                    if (content && (content.style.display === 'none' || content.style.display === '')) {
                        content.style.display = 'block';
                        parentTopic.classList.add('lms-topic-expanded');
                        const toggleIcon = parentTopic.querySelector('.lms-topic-toggle svg');
                        if (toggleIcon) {
                            toggleIcon.style.transform = 'rotate(90deg)';
                        }
                    }
                    
                    // Scroll to the parent topic
                    parentTopic.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            }, 100);

            // Show success message
            const actionText = isUpdate ? 'updated' : 'saved';
            this.showToast(`Quiz ${actionText} successfully`);
        } catch (error) {
            this.showToast(error.message, 'danger');
        } finally {
            this.state.currentItemId = null; // Reset current item ID
        }
    }

    /**
     * Handle assignment modal
     */
    openAssignmentModal(topicId) {
        this.state.currentTopicId = topicId;
        const assignmentForm = document.querySelector(this.config.selectors.assignmentForm);
        
        // Reset form fields
        if (assignmentForm) {
            const inputs = assignmentForm.querySelectorAll('input, select, textarea');
            inputs.forEach(input => {
                if (input.type === 'checkbox') {
                    input.checked = false;
                } else if (input.type === 'select-one') {
                    input.selectedIndex = 0;
                } else {
                    input.value = '';
                }
            });
        }
        
        this.showModal('assignmentModal');
    }

    async saveAssignment() {
        const form = document.querySelector(this.config.selectors.assignmentForm);
        const formData = new FormData(form);
        formData.append('topic_id', this.state.currentTopicId);
        
        // Determine if this is a create or update operation
        const isUpdate = this.state.currentItemId !== null;
        let url = this.config.apiEndpoints.assignments;
        let method = 'POST';
        
        if (isUpdate) {
            url = `${url}/${this.state.currentItemId}`;
            formData.append('_method', 'PUT');
        }

        try {
            const data = await this.apiRequest(url, {
                method: method,
                body: formData
            });
            
            // Add or update the assignment in the items array
            const itemData = data.data || data.item;
            if (itemData) {
                if (isUpdate) {
                    // Update existing item
                    const index = this.state.items.findIndex(i => i.id === this.state.currentItemId);
                    if (index !== -1) {
                        this.state.items[index] = itemData;
                    }
                } else {
                    // Add new item
                    this.state.items.push(itemData);
                }
            }
            
            this.renderCurriculum();
            this.hideModal('assignmentModal');
            
            // Expand the parent topic
            setTimeout(() => {
                const parentTopic = document.querySelector(`.lms-lessons-container[data-topic-id="${this.state.currentTopicId}"]`)?.closest('.lms-topic');
                if (parentTopic) {
                    // Ensure parent topic is expanded
                    const content = parentTopic.querySelector('.lms-topic-content');
                    if (content && (content.style.display === 'none' || content.style.display === '')) {
                        content.style.display = 'block';
                        parentTopic.classList.add('lms-topic-expanded');
                        const toggleIcon = parentTopic.querySelector('.lms-topic-toggle svg');
                        if (toggleIcon) {
                            toggleIcon.style.transform = 'rotate(90deg)';
                        }
                    }
                    
                    // Scroll to the parent topic
                    parentTopic.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            }, 100);

            // Show success message
            const actionText = isUpdate ? 'updated' : 'saved';
            this.showToast(`Assignment ${actionText} successfully`);
        } catch (error) {
            this.showToast(error.message, 'danger');
        } finally {
            this.state.currentItemId = null; // Reset current item ID
        }
    }

    /**
     * Handle item editing
     */
    editItem(itemId, itemType) {
        const item = this.state.items.find(i => i.id === Number(itemId));
        if (!item) return;

        this.state.currentItemId = itemId;
        this.state.currentTopicId = item.topic_id;

        const itemEndpoint = this.getEndpointForItemType(itemType) + '/' + itemId;
        
        // Show loading indicator
        this.setLoading('topicLoading', true);
        
        // First fetch the item details
        this.apiRequest(itemEndpoint)
            .then(data => {
                const itemData = data.data || data.item || {};
                
                switch (itemType.toLowerCase()) {
                    case 'lesson':
                        this.openLessonModal(item.topic_id);
                        
                        // Populate lesson form with data
                        const lessonForm = document.querySelector(this.config.selectors.lessonForm);
                        if (lessonForm) {
                            const inputs = lessonForm.querySelectorAll('input, select, textarea');
                            inputs.forEach(input => {
                                if (input.name && itemData[input.name] !== undefined) {
                                    if (input.type === 'checkbox') {
                                        input.checked = Boolean(itemData[input.name]);
                                    } else {
                                        input.value = itemData[input.name];
                                    }
                                }
                            });
                        }
                        break;
                        
                    case 'quiz':
                        this.openQuizModal(item.topic_id);
                        
                        // Populate quiz form with data
                        const quizForm = document.querySelector(this.config.selectors.quizForm);
                        if (quizForm) {
                            const inputs = quizForm.querySelectorAll('input, select, textarea');
                            inputs.forEach(input => {
                                if (input.name && itemData[input.name] !== undefined) {
                                    input.value = itemData[input.name];
                                }
                            });
                        }
                        break;
                        
                    case 'assignment':
                        this.openAssignmentModal(item.topic_id);
                        
                        // Populate assignment form with data
                        const assignmentForm = document.querySelector(this.config.selectors.assignmentForm);
                        if (assignmentForm) {
                            const inputs = assignmentForm.querySelectorAll('input, select, textarea');
                            inputs.forEach(input => {
                                if (input.name && itemData[input.name] !== undefined) {
                                    input.value = itemData[input.name];
                                }
                            });
                        }
                        break;
                }
            })
            .catch(error => {
                this.showToast(`Error loading ${itemType}: ${error.message}`, 'danger');
            })
            .finally(() => {
                this.setLoading('topicLoading', false);
            });
    }

    /**
     * Get API endpoint for item type
     */
    getEndpointForItemType(itemType) {
        switch (itemType.toLowerCase()) {
            case 'lesson':
                return this.config.apiEndpoints.lessons;
            case 'quiz':
                return this.config.apiEndpoints.quizzes;
            case 'assignment':
                return this.config.apiEndpoints.assignments;
            default:
                return null;
        }
    }

    /**
     * Handle item deletion
     */
    confirmDeleteItem(itemId, itemType) {
        const item = this.state.items.find(i => i.id === Number(itemId));
        if (!item) return;

        const confirmationMessage = document.getElementById('confirmationMessage');
        confirmationMessage.textContent = `Are you sure you want to delete this ${itemType}?`;

        document.getElementById('confirmAction').textContent = `Yes, delete ${itemType}`;

        this.state.currentAction = () => this.deleteItem(itemId, itemType);

        this.showModal('confirmationModal');
    }
    /**
     * Delete item (lesson, quiz, assignment)
     */
    deleteItem(itemId, itemType) {
        const endpoint = this.getEndpointForItemType(itemType);
        if (!endpoint) {
            this.showToast(`Invalid item type: ${itemType}`, 'danger');
            return;
        }

        this.apiRequest(`${endpoint}/${itemId}`, {
            method: 'DELETE'
        })
            .then(data => {
                // Remove item from state
                this.state.items = this.state.items.filter(i => i.id !== itemId);

                // Load topics to ensure we have the latest data
                this.loadTopics();

                this.showToast(`${itemType.charAt(0).toUpperCase() + itemType.slice(1)} deleted successfully`);
            })
            .catch(error => {
                this.showToast(error.message, 'danger');
            });
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
    console.log('DOM content loaded, initializing LMSManager');

    // Check if the lmsManager element exists
    const lmsManagerElement = document.getElementById('lmsManager');
    if (lmsManagerElement) {
        console.log('LMSManager element found with course ID:', lmsManagerElement.dataset.courseId);

        try {
            window.lmsManager = new LMSManager();
            console.log('LMSManager initialized successfully');
        } catch (error) {
            console.error('Error initializing LMSManager:', error);
        }
    } else {
        console.warn('LMSManager element not found');
    }
});
