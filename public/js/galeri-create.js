// Galeri Create Form JavaScript with Repeater
document.addEventListener('DOMContentLoaded', function() {
    console.log('Galeri create page loaded');
    
    // Check if Alpine.js is loaded
    if (typeof Alpine === 'undefined') {
        console.error('Alpine.js not loaded!');
        alert('Error: Alpine.js tidak dimuat. Silakan refresh halaman.');
        return;
    }
    
    console.log('Alpine.js is loaded successfully');
    
    // Initialize Alpine.js component for media repeater
    Alpine.data('mediaRepeater', () => ({
        mediaItems: [],
        itemCounter: 0,
        
        init() {
            console.log('Alpine.js mediaRepeater component initialized');
            console.log('Component methods:', Object.getOwnPropertyNames(this));
            this.$nextTick(() => {
                console.log('Alpine.js nextTick completed');
                console.log('Initial mediaItems:', this.mediaItems);
                console.log('Component instance:', this);
            });
        },
        
        addMediaItem() {
            console.log('=== addMediaItem called ===');
            console.log('this:', this);
            console.log('Current mediaItems:', this.mediaItems);
            console.log('Current itemCounter:', this.itemCounter);
            
            const newItem = {
                id: ++this.itemCounter,
                file: null,
                fileName: '',
                fileSize: '',
                fileType: '',
                title: '',
                order: this.mediaItems.length + 1,
                type: 'foto',
                description: ''
            };
            
            this.mediaItems.push(newItem);
            
            console.log('New item created:', newItem);
            console.log('Updated mediaItems:', this.mediaItems);
            console.log('Total media items:', this.mediaItems.length);
            
            // Force Alpine.js to re-render
            this.$nextTick(() => {
                console.log('NextTick after adding item');
                console.log('Current mediaItems length:', this.mediaItems.length);
                
                // Check if template is rendered
                const mediaContainer = document.getElementById('media-container');
                const mediaItems = mediaContainer.querySelectorAll('.media-item');
                console.log('DOM media items found:', mediaItems.length);
                
                const titleInput = document.querySelector(`#media-title-${newItem.id}`);
                if (titleInput) {
                    titleInput.focus();
                    console.log('Title input focused:', titleInput);
                } else {
                    console.log('Title input not found for ID:', `media-title-${newItem.id}`);
                }
            });
        },
        
        removeMediaItem(index) {
            this.mediaItems.splice(index, 1);
            
            // Reorder remaining items
            this.mediaItems.forEach((item, i) => {
                item.order = i + 1;
            });
            
            console.log('Removed media item at index:', index);
            console.log('Total media items:', this.mediaItems.length);
        },
        
        handleFileSelect(event, itemId) {
            const file = event.target.files[0];
            if (!file) return;
            
            // Validate file
            const isValidType = file.type.startsWith('image/') || file.type.startsWith('video/');
            const isValidSize = file.size <= 10 * 1024 * 1024; // 10MB
            
            if (!isValidType) {
                alert(`File ${file.name} tidak didukung. Hanya file image dan video yang diizinkan.`);
                event.target.value = '';
                return;
            }
            
            if (!isValidSize) {
                alert(`File ${file.name} terlalu besar. Maksimal 10MB per file.`);
                event.target.value = '';
                return;
            }
            
            // Update item with file info
            const item = this.mediaItems.find(item => item.id === itemId);
            if (item) {
                item.file = file;
                item.fileName = file.name;
                item.fileSize = this.formatFileSize(file.size);
                item.fileType = file.type;
                
                // Auto-detect type based on file extension
                if (file.type.startsWith('image/')) {
                    item.type = 'foto';
                } else if (file.type.startsWith('video/')) {
                    item.type = 'video';
                }
                
                // Auto-fill title with filename (without extension)
                if (!item.title) {
                    item.title = file.name.replace(/\.[^/.]+$/, '');
                }
                
                console.log('File selected for item:', itemId, item);
            }
        },
        
        formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        },
        
        // Generate unique name for file input
        getFileInputName(itemId) {
            return `media_files_${itemId}`;
        }
    }));
    
    // Form validation
    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Get all media items from Alpine.js
            const mediaContainer = document.getElementById('media-container');
            const mediaItems = mediaContainer.querySelectorAll('.media-item');
            
            if (mediaItems.length === 0) {
                alert('Pilih minimal satu media untuk galeri ini');
                return false;
            }
            
            // Validate each media item
            let isValid = true;
            let hasFile = false;
            
            mediaItems.forEach((item, index) => {
                const fileInput = item.querySelector('input[type="file"]');
                const titleInput = item.querySelector('input[name="media_titles[]"]');
                const orderInput = item.querySelector('input[name="media_orders[]"]');
                const typeInput = item.querySelector('select[name="media_types[]"]');
                
                // Check if file is selected
                if (fileInput && fileInput.files.length > 0) {
                    hasFile = true;
                } else {
                    isValid = false;
                    fileInput.classList.add('border-red-500');
                    if (!hasFile) {
                        fileInput.focus();
                    }
                }
                
                // Check if title is filled
                if (!titleInput.value.trim()) {
                    isValid = false;
                    titleInput.classList.add('border-red-500');
                    if (isValid) {
                        titleInput.focus();
                    }
                } else {
                    titleInput.classList.remove('border-red-500');
                }
                
                // Check if order is valid
                if (!orderInput.value || orderInput.value < 1) {
                    isValid = false;
                    orderInput.classList.add('border-red-500');
                    if (isValid) {
                        orderInput.focus();
                    }
                } else {
                    orderInput.classList.remove('border-red-500');
                }
                
                // Check if type is selected
                if (!typeInput.value) {
                    isValid = false;
                    typeInput.classList.add('border-red-500');
                    if (isValid) {
                        typeInput.focus();
                    }
                } else {
                    typeInput.classList.remove('border-red-500');
                }
            });
            
            if (!hasFile) {
                alert('Pilih minimal satu file media');
                return false;
            }
            
            if (!isValid) {
                alert('Mohon lengkapi semua field yang wajib diisi');
                return false;
            }
            
            console.log('Form validation passed, submitting...');
            
            // Show loading state
            const submitBtn = document.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Menyimpan...';
            submitBtn.disabled = true;
            
            // Submit the form
            form.submit();
            
            // Re-enable button after 5 seconds as fallback
            setTimeout(() => {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }, 5000);
        });
    }
    
    // Debug: Check if Alpine.js component is working
    setTimeout(() => {
        console.log('Checking Alpine.js component...');
        const mediaSection = document.querySelector('[x-data*="mediaRepeater"]');
        if (mediaSection) {
            console.log('Media section found:', mediaSection);
            if (mediaSection.__x) {
                console.log('Alpine.js data:', mediaSection.__x.$data);
            } else {
                console.log('Alpine.js not initialized yet');
            }
        } else {
            console.log('Media section not found');
        }
    }, 500);
});
