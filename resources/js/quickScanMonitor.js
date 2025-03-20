export function initQuickScanMonitor() {
    // Find scan containers on the page
    const scanContainers = document.querySelectorAll('[data-scan-id]');
    
    // If no scan containers exist on this page, do nothing
    if (!scanContainers.length) return;
    
    // Set up listeners for each scan container
    scanContainers.forEach(container => {
        const scanId = container.dataset.scanId;
        console.log('Scan container found: ', scanId);
        setupEchoListener(scanId, container);
    });
}

function setupEchoListener(scanId, container) {
    // Check if Echo is available
    if (!window.Echo) {
        console.error('Echo is not available. Make sure bootstrap.js is loaded first.');
        return;
    }
    
    // Listen for updates to this scan
    window.Echo.private(`quick-scan.${scanId}`)
        .listen('QuickScanUpdated', (event) => {
            console.log('Update event detected: ', event);
            updateUI(container, event);
            // checkForNewData(scanId, container);
        });
}

function updateUI(container, event) {
    // Update progress bar if it exists
    const progressBar = container.querySelector('.quick-scan__status__progress-bar__progress');
    if (progressBar) {
        progressBar.style.width = `${event.progress}%`;
    }
    
    // Update progress text
    const progressVal = container.querySelector('.quick-scan__status__progress__counter');
    if (progressVal) {
        progressVal.textContent = `${event.progress}`;
    }
    
    // Update status text
    const statusText = container.querySelector('.status-text');
    if (statusText) {
        statusText.textContent = event.status;
    }
}

function checkForNewData(scanId, container) {
    fetch(`/api/quick-scans/${scanId}/status`)
        .then(response => response.json())
        .then(data => {
            // Check for new sections to display
            if (data.has_messaging_results) {
                showSection(container, '.messaging-results');
            }
            
            if (data.has_performance_results) {
                showSection(container, '.performance-results');
            }
            
            // If completed, refresh the page for full results
            if (data.status === 'completed') {
                window.location.reload();
            }
        });
}

function showSection(container, selector) {
    const section = container.querySelector(selector);
    if (section) {
        section.classList.remove('hidden');
        
        // If using Alpine, you might need this:
        // section.dispatchEvent(new CustomEvent('alpine:update'));
    }
}