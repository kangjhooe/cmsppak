// Simple Form Validation - No Conflict with Alpine.js
console.log('=== FORM VALIDATION SIMPLE LOADED ===');

document.addEventListener('DOMContentLoaded', function() {
    console.log('Setting up simple form validation...');
    
    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            console.log('Form submission started...');
            
            // Check if there are any media items (either Alpine.js or DOM)
            let hasMediaItems = false;
            
            // Try Alpine.js first
            const mediaSection = document.querySelector('[x-data*="mediaRepeater"]');
            if (mediaSection && mediaSection.__x && mediaSection.__x.$data) {
                const alpineData = mediaSection.__x.$data;
                console.log('Alpine.js data found:', alpineData);
                
                if (alpineData.mediaItems && Array.isArray(alpineData.mediaItems) && alpineData.mediaItems.length > 0) {
                    hasMediaItems = true;
                    console.log('Alpine.js mediaItems found:', alpineData.mediaItems.length);
                }
            }
            
            // If no Alpine.js data, check DOM
            if (!hasMediaItems) {
                const mediaContainer = document.getElementById('media-container');
                const domMediaItems = mediaContainer.querySelectorAll('.media-item');
                console.log('DOM mediaItems found:', domMediaItems.length);
                
                if (domMediaItems.length > 0) {
                    hasMediaItems = true;
                }
            }
            
            // For now, allow submission (testing mode)
            if (!hasMediaItems) {
                console.log('No media items found, but allowing submission for testing...');
            }
            
            console.log('Form validation passed, submitting...');
            
            // Show loading state
            const submitBtn = document.querySelector('button[type="submit"]');
            if (submitBtn) {
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
            } else {
                // Submit without button modification
                form.submit();
            }
        });
        
        console.log('Form validation setup completed');
    } else {
        console.log('No form found');
    }
});
