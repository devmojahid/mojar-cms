class MediaManager {
    constructor() {
        this.initializeVariables();
        this.initializeDropzone();
        this.bindEvents();
        this.initializeUploadOptions();
        this.initializeTouchGestures();
    }

    initializeVariables() {
        this.uploadModal = document.getElementById('upload-modal');
        this.uploadForm = document.getElementById('uploadForm');
        this.uploadOptions = document.querySelector('.upload-options');
        this.uploadContainer = document.querySelector('.upload-container');
        this.previewPanel = document.getElementById('preview-file');
        this.totalProgress = document.querySelector('.upload-progress-total .progress-bar');
        this.uploadCount = document.querySelector('.upload-count');
        this.uploadSize = document.querySelector('.upload-size');
        this.mediaItems = document.querySelectorAll('.media-item');
    }

    initializeDropzone() {
        this.dropzone = new Dropzone(this.uploadForm, {
            paramName: "upload",
            uploadMultiple: false,
            parallelUploads: 5,
            timeout: 0,
            clickable: '#upload-button',
            previewTemplate: document.querySelector('#upload-template').innerHTML,
            previewsContainer: ".upload-list",
            init: () => this.initializeDropzoneEvents(),
            accept: (file, done) => this.handleFileAccept(file, done),
            thumbnail: (file, dataUrl) => this.handleThumbnail(file, dataUrl)
        });
    }

    initializeDropzoneEvents() {
        this.dropzone.on('addedfile', file => this.handleFileAdded(file));
        this.dropzone.on('uploadprogress', (file, progress) => this.handleUploadProgress(file, progress));
        this.dropzone.on('success', (file, response) => this.handleUploadSuccess(file, response));
        this.dropzone.on('error', (file, message) => this.handleUploadError(file, message));
        this.dropzone.on('queuecomplete', () => this.handleQueueComplete());
    }

    bindEvents() {
        // Toggle upload options
        document.getElementById('toggle-upload-options')?.addEventListener('click', () => {
            this.uploadOptions.classList.toggle('show');
        });

        // Handle folder selection
        document.getElementById('upload-folder')?.addEventListener('change', (e) => {
            document.getElementById('folder_id').value = e.target.value;
        });

        // Handle image optimization toggle
        document.getElementById('optimize-images')?.addEventListener('change', (e) => {
            document.getElementById('optimize').value = e.target.checked ? '1' : '0';
        });

        // Handle media item selection
        this.mediaItems.forEach(item => {
            item.addEventListener('click', (e) => this.handleMediaItemClick(e, item));
        });

        // Handle view switching
        document.querySelectorAll('.view-switcher .btn').forEach(btn => {
            btn.addEventListener('click', () => this.handleViewSwitch(btn));
        });

        // Handle preview panel close
        document.getElementById('close-preview')?.addEventListener('click', () => {
            this.previewPanel.classList.remove('has-preview');
        });

        // Handle keyboard shortcuts
        document.addEventListener('keydown', (e) => this.handleKeyboardShortcuts(e));
    }

    handleFileAdded(file) {
        this.updateUploadStats();
        file.previewElement.querySelector('.upload-status').textContent = 'Preparing...';
    }

    handleUploadProgress(file, progress) {
        const progressText = file.previewElement.querySelector('.progress-text');
        const progressRing = file.previewElement.querySelector('.progress-ring path');
        const circumference = 2 * Math.PI * 15.9155; // Based on SVG path
        
        const offset = circumference - (progress / 100) * circumference;
        progressRing.style.strokeDasharray = `${circumference} ${circumference}`;
        progressRing.style.strokeDashoffset = offset;
        
        progressText.textContent = `${Math.round(progress)}%`;
        this.updateTotalProgress();
    }

    handleUploadSuccess(file, response) {
        const statusElement = file.previewElement.querySelector('.upload-status');
        statusElement.textContent = 'Uploaded';
        statusElement.classList.add('success');
        
        setTimeout(() => {
            file.previewElement.classList.add('fade-out');
            setTimeout(() => {
                file.previewElement.remove();
                this.updateUploadStats();
            }, 300);
        }, 1000);
    }

    handleUploadError(file, message) {
        const statusElement = file.previewElement.querySelector('.upload-status');
        const errorElement = file.previewElement.querySelector('.upload-error span');
        
        statusElement.textContent = 'Failed';
        statusElement.classList.add('error');
        
        // Handle array or string error messages
        const errorMessage = Array.isArray(message) ? message.join('\n') : message;
        errorElement.textContent = errorMessage;
        
        // Show error notification
        if (window.Notyf) {
            new Notyf().error({
                message: errorMessage,
                duration: 4000,
                position: { x: 'right', y: 'top' }
            });
        }
    }

    handleQueueComplete() {
        setTimeout(() => {
            if (this.dropzone.getUploadingFiles().length === 0 && 
                this.dropzone.getQueuedFiles().length === 0) {
                window.location.reload();
            }
        }, 1500);
    }

    updateUploadStats() {
        const files = this.dropzone.files;
        const totalSize = files.reduce((size, file) => size + file.size, 0);
        
        this.uploadCount.textContent = files.length;
        this.uploadSize.textContent = this.formatFileSize(totalSize);
    }

    updateTotalProgress() {
        const files = this.dropzone.files;
        const totalProgress = files.reduce((sum, file) => sum + (file.upload?.progress || 0), 0);
        const averageProgress = files.length ? totalProgress / files.length : 0;
        
        this.totalProgress.style.width = `${averageProgress}%`;
    }

    formatFileSize(bytes) {
        const units = ['B', 'KB', 'MB', 'GB'];
        let size = bytes;
        let unitIndex = 0;
        
        while (size >= 1024 && unitIndex < units.length - 1) {
            size /= 1024;
            unitIndex++;
        }
        
        return `${Math.round(size * 100) / 100} ${units[unitIndex]}`;
    }

    handleKeyboardShortcuts(e) {
        // ESC to close preview
        if (e.key === 'Escape' && this.previewPanel.classList.contains('has-preview')) {
            this.previewPanel.classList.remove('has-preview');
        }
        
        // CTRL + U to open upload modal
        if (e.ctrlKey && e.key === 'u') {
            e.preventDefault();
            document.querySelector('[data-target="#upload-modal"]').click();
        }
    }

    initializeTouchGestures() {
        let touchStartY = 0;
        let touchEndY = 0;

        // Swipe down to close preview on mobile
        this.previewPanel?.addEventListener('touchstart', (e) => {
            touchStartY = e.touches[0].clientY;
        }, { passive: true });

        this.previewPanel?.addEventListener('touchmove', (e) => {
            if (!this.previewPanel.classList.contains('has-preview')) return;
            
            touchEndY = e.touches[0].clientY;
            const diff = touchEndY - touchStartY;
            
            if (diff > 0) {
                this.previewPanel.style.transform = `translateY(${diff}px)`;
                e.preventDefault();
            }
        }, { passive: false });

        this.previewPanel?.addEventListener('touchend', () => {
            const diff = touchEndY - touchStartY;
            
            if (diff > 100) {
                this.previewPanel.classList.remove('has-preview');
            }
            
            this.previewPanel.style.transform = '';
            touchStartY = 0;
            touchEndY = 0;
        });

        // Horizontal scroll for quick filters
        const quickFilters = document.querySelector('.quick-filters');
        if (quickFilters) {
            let isScrolling = false;
            let startX;
            let scrollLeft;

            quickFilters.addEventListener('touchstart', (e) => {
                isScrolling = true;
                startX = e.touches[0].pageX - quickFilters.offsetLeft;
                scrollLeft = quickFilters.scrollLeft;
            }, { passive: true });

            quickFilters.addEventListener('touchmove', (e) => {
                if (!isScrolling) return;
                
                const x = e.touches[0].pageX - quickFilters.offsetLeft;
                const walk = (x - startX) * 2;
                quickFilters.scrollLeft = scrollLeft - walk;
            }, { passive: true });

            quickFilters.addEventListener('touchend', () => {
                isScrolling = false;
            });
        }
    }

    handleFileAccept(file, done) {
        // Get allowed extensions from form data attribute
        const allowedExtensions = (this.uploadForm.getAttribute('data-accepted-files') || '')
            .split(',')
            .map(ext => ext.trim().toLowerCase());

        // Get file extension
        const fileExtension = `.${file.name.split('.').pop().toLowerCase()}`;

        // Check if file type is allowed
        if (!allowedExtensions.includes(fileExtension)) {
            done(`File type "${fileExtension}" not allowed. Allowed types: ${allowedExtensions.join(', ')}`);
            return;
        }

        // Check file size
        const maxSize = parseInt(this.uploadForm.getAttribute('data-max-size') || 0) * 1024 * 1024; // Convert to bytes
        if (maxSize && file.size > maxSize) {
            done(`File size exceeds ${this.formatFileSize(maxSize)}`);
            return;
        }

        done();
    }

    handleThumbnail(file, dataUrl) {
        if (file.type.startsWith('image/')) {
            const img = file.previewElement.querySelector('[data-dz-thumbnail]');
            img.src = dataUrl;
            img.style.display = 'block';
        } else {
            // Show file type icon for non-images
            const thumbnail = file.previewElement.querySelector('.upload-thumbnail');
            thumbnail.innerHTML = this.getFileTypeIcon(file.type);
        }
    }

    getFileTypeIcon(mimeType) {
        const iconMap = {
            'video': 'fa-file-video-o',
            'audio': 'fa-file-audio-o',
            'application/pdf': 'fa-file-pdf-o',
            'application/msword': 'fa-file-word-o',
            'application/vnd.ms-excel': 'fa-file-excel-o',
            'application/vnd.ms-powerpoint': 'fa-file-powerpoint-o',
            'text': 'fa-file-text-o',
            'application/zip': 'fa-file-archive-o'
        };

        const iconClass = Object.entries(iconMap).find(([key]) => mimeType.includes(key))?.[1] || 'fa-file-o';
        return `<i class="fa ${iconClass} fa-3x"></i>`;
    }
}

// Initialize on document ready
document.addEventListener('DOMContentLoaded', () => {
    window.mediaManager = new MediaManager();
}); 