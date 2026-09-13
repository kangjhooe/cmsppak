// Simple Media Repeater Test
document.addEventListener('DOMContentLoaded', function() {
    console.log('Simple media repeater loaded');
    
    // Wait for Alpine.js to be ready
    if (typeof Alpine === 'undefined') {
        console.error('Alpine.js not loaded!');
        return;
    }
    
    console.log('Alpine.js is loaded');
    
    // Create a simple test component
    Alpine.data('simpleMediaRepeater', () => ({
        count: 0,
        items: [],
        
        init() {
            console.log('Simple component initialized');
            console.log('Component methods:', Object.getOwnPropertyNames(this));
        },
        
        addItem() {
            console.log('=== addItem called ===');
            this.count++;
            this.items.push({
                id: this.count,
                name: `Item ${this.count}`
            });
            console.log('Items:', this.items);
            console.log('Count:', this.count);
        },
        
        removeItem(index) {
            console.log('Removing item at index:', index);
            this.items.splice(index, 1);
            console.log('Items after removal:', this.items);
        }
    }));
    
    // Test if component is accessible
    setTimeout(() => {
        console.log('Testing component access...');
        const testSection = document.querySelector('[x-data*="simpleMediaRepeater"]');
        if (testSection) {
            console.log('Test section found:', testSection);
            if (testSection.__x) {
                console.log('Alpine.js data:', testSection.__x.$data);
                console.log('Methods:', Object.getOwnPropertyNames(testSection.__x.$data));
            } else {
                console.log('Alpine.js not initialized yet');
            }
        } else {
            console.log('Test section not found');
        }
    }, 1000);
});
