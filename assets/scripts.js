let loadedPosts = [];
let postIssues = {}; // Object to store fetched issue counts and HTML content
let lastFocusedElement;

async function fetchAPIResults(url) {
    try {
        const response = await fetch(`http://localhost:3000/test?url=${encodeURIComponent(url)}`);
        if (!response.ok) {
            throw new Error(`API Error: ${response.status}`);
        }
        const data = await response.json();
        return data;
    } catch (error) {
        console.error('API Error:', error);
        return { error: 'Unable to fetch results. Please try again later.' };
    }
}

async function fetchIssuesForRows(rows) {
    for (const row of rows) {
        const url = row.getAttribute('data-url');
        if (!url) {
            row.querySelector('td:nth-child(2)').textContent = 'Invalid URL';
            continue;
        }

        if (postIssues[url]) {
            continue; // Skip if issues are already fetched
        }

        // Show Bootstrap spinner initially
        row.querySelector('td:nth-child(2)').innerHTML = '<div class="small-spinner"><div class="spinner-border m-0" role="status"><span class="visually-hidden">Loading...</span></div></div>';

        const data = await fetchAPIResults(url);
        if (data.error || !data.axe) {
            row.querySelector('td:nth-child(2)').textContent = 'Retry';
        } else {
            const issuesCount = data.axe.issues || 0; // Extract issues count from API response
            postIssues[url] = data.axe; // Save the full response for the modal
            row.querySelector('td:nth-child(2)').textContent = issuesCount;
        }
    }
}

function showModal(row) {
    lastFocusedElement = row;

    const title = row.getAttribute('data-title');
    const postUrl = row.getAttribute('data-url');
    const modalTitle = document.getElementById('staticBackdropLabel');
    const modalBody = document.getElementById('modal-body-content');

    modalTitle.textContent = title;

    if (postIssues[postUrl]) {
        const htmlContent = postIssues[postUrl].axeHtml || '<div class="small-spinner"><div class="spinner-border m-0" role="status"><span class="visually-hidden">Loading...</span></div></div>';
        const updatedHtmlContent = htmlContent.replace(/<img src="\.\//g, `<img src="http://localhost:3000/screenshots/`);
        modalBody.innerHTML = updatedHtmlContent;
    } else {
        modalBody.innerHTML = 'Loading...';
        fetchAPIResults(postUrl).then(data => {
            if (!data.error) {
                postIssues[postUrl] = data.axe;
                updateModalContent(data, postUrl);
            } else {
                modalBody.innerHTML = 'Error loading data';
            }
        });
    }

    const modalElement = document.getElementById('staticBackdrop');
    const modal = new bootstrap.Modal(modalElement);
    modal.show();

    modalElement.addEventListener('hidden.bs.modal', () => {
        if (lastFocusedElement) {
            lastFocusedElement.focus();
        }
        document.body.classList.remove('modal-open');
        document.body.style.overflow = '';
        document.querySelectorAll('.modal-backdrop').forEach(backdrop => backdrop.remove());
        modal.dispose();
    });
}

function bindRowEvents(rows) {
    rows.forEach(row => {
        row.addEventListener('click', () => showModal(row));
        row.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' || e.key === ' ') {
                showModal(row);
            }
        });
    });
}

async function loadMorePosts(button) {
    const offset = parseInt(button.getAttribute('data-offset'), 10);

    const data = {
        action: 'load_more_lap_posts',
        offset,
        loaded_posts: loadedPosts,
    };

    jQuery.post(ajax_object.ajax_url, data, async (response) => {
        const postsContainer = document.getElementById('lap-posts-container');
        const postData = JSON.parse(response);

        if (postData.no_more_posts) {
            button.textContent = 'No more posts';
            button.disabled = true;
            return;
        }

        const newPosts = postData.filter(post => !loadedPosts.includes(post.id));
        newPosts.forEach(post => {
            const newRow = document.createElement('tr');
            newRow.setAttribute('tabindex', '0');
            newRow.setAttribute('role', 'button');
            newRow.setAttribute('data-id', post.id);
            newRow.setAttribute('data-title', post.title);
            newRow.setAttribute('data-url', `http://example.com/post?id=${post.id}`); // Dynamically set the URL
            newRow.classList.add('post-row');
            newRow.setAttribute('aria-label', post.aria_label);

            const titleCell = document.createElement('td');
            titleCell.textContent = post.title;
            const issuesCell = document.createElement('td');
            issuesCell.innerHTML = '<div class="small-spinner"><div class="spinner-border m-0" role="status"><span class="visually-hidden">Loading...</span></div></div>';
            newRow.appendChild(titleCell);
            newRow.appendChild(issuesCell);
            postsContainer.appendChild(newRow);

            loadedPosts.push(post.id);
        });

        const newRows = document.querySelectorAll('.post-row:not([data-processed])');
        newRows.forEach(row => {
            row.setAttribute('data-processed', 'true');
            bindRowEvents([row]);
        });
        await fetchIssuesForRows(newRows);

        button.setAttribute('data-offset', offset + 5);
    });
}

document.getElementById('load-more-lap').addEventListener('click', function () {
    loadMorePosts(this);
});

document.addEventListener('DOMContentLoaded', async function () {
    const tabs = document.querySelectorAll('.tab');
    const tabContents = document.querySelectorAll('.tab-content');

    function hideAllTabs() {
        tabContents.forEach(content => {
            content.style.display = 'none';
            content.setAttribute('aria-hidden', 'true');
        });
        tabs.forEach(tab => {
            tab.classList.remove('active');
            tab.setAttribute('aria-selected', 'false');
        });
    }

    function handleTabClick(tab) {
        const target = tab.getAttribute('data-target');
        hideAllTabs();

        const content = document.getElementById(target);
        content.style.display = 'block';
        content.setAttribute('aria-hidden', 'false');

        tab.classList.add('active');
        tab.setAttribute('aria-selected', 'true');

        if (target === 'automated-audits') {
            const lapContent = document.getElementById('lap-content');
            if (lapContent) {
                lapContent.style.display = 'block';
                lapContent.setAttribute('aria-hidden', 'false');
            }
        }
    }

    function handleContentKeyNavigation(event) {
        const activeTabContent = document.querySelector('.tab-content:not([aria-hidden="true"])');
        if (!activeTabContent) return;

        const focusableElements = activeTabContent.querySelectorAll('a, button, input, select, textarea, [tabindex]:not([tabindex="-1"])');
        const focusArray = Array.prototype.slice.call(focusableElements);
        const currentIndex = focusArray.indexOf(document.activeElement);
        let newIndex;

        if (event.key === 'ArrowDown') {
            newIndex = (currentIndex + 1) % focusArray.length;
        } else if (event.key === 'ArrowUp') {
            newIndex = (currentIndex - 1 + focusArray.length) % focusArray.length;
        }

        if (newIndex !== undefined) {
            event.preventDefault();
            focusArray[newIndex].focus();
        }
    }

    function initializeTabs() {
        tabs.forEach(tab => {
            tab.addEventListener('click', () => handleTabClick(tab));
            tab.addEventListener('keydown', (event) => {
                if (event.key === 'Enter' || event.key === ' ') {
                    event.preventDefault();
                    handleTabClick(tab);
                }
            });
        });

        if (tabs.length > 0) tabs[0].click();

        document.addEventListener('keydown', handleContentKeyNavigation);
    }

    const initialRows = document.querySelectorAll('.post-row');
    fetchIssuesForRows(initialRows); // Fetch issues for the first 5 posts on page load
    initializeTabs();
    bindRowEvents(initialRows);

    document.getElementById('load-more-lap').addEventListener('click', async function () {
        loadMorePosts(this);
    });
});

// Additional Code for Modal Operations
document.addEventListener('DOMContentLoaded', () => {
    const downloadButton = document.getElementById('download-modal-content');
    const rescanButton = document.getElementById('rescan-modal-content');
    const modalBodyContent = document.getElementById('modal-body-content');

    // Function to fetch data from the API
    async function fetchData(url) {
        try {
            const response = await fetch(`http://localhost:3000/test?url=${encodeURIComponent(url)}`);
            const data = await response.json();
            return data;
        } catch (error) {
            console.error('Error fetching data:', error);
            return { error: 'Unable to fetch results. Please try again later.' };
        }
    }

    // Function to update the modal content
    function updateModalContent(data) {
        const htmlContent = data.axe?.axeHtml || '<p>Retry Again</p>';
        modalBodyContent.innerHTML = htmlContent;
    }

    // Rescan button event listener
    rescanButton.addEventListener('click', async () => {
        const row = lastFocusedElement;
        if (!row) return;

        const url = row.getAttribute('data-url');
        modalBodyContent.innerHTML = 'Rescanning...';

        const data = await fetchData(url);
        if (!data.error) {
            updateModalContent(data);
        } else {
            modalBodyContent.innerHTML = 'Retry Again';
        }
    });

    // Download button event listener for Excel format
    downloadButton.addEventListener('click', () => {
        const accordionBodies = document.querySelectorAll('.accordion-body');
        const isDataAvailable = Array.from(accordionBodies).some(body => body.innerText.trim() !== '');
    
        if (!isDataAvailable) {
            alert('No data available to download.');
            return;
        }
    
        const wb = XLSX.utils.book_new();
        const ws_data = [['Content']];
    
        accordionBodies.forEach((body, index) => {
            const content = body.innerText.trim();
            ws_data.push([content]);
        });
    
        const ws = XLSX.utils.aoa_to_sheet(ws_data);
        XLSX.utils.book_append_sheet(wb, ws, 'Report');
        const wbout = XLSX.write(wb, { bookType: 'xlsx', type: 'binary' });
        const blob = new Blob([s2ab(wbout)], { type: "application/octet-stream" });
        const link = document.createElement('a');
        link.href = URL.createObjectURL(blob);
        link.download = 'report.xlsx';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    });
    
    function s2ab(s) {
        const buf = new ArrayBuffer(s.length);
        const view = new Uint8Array(buf);
        for (let i = 0; i < s.length; i++) view[i] = s.charCodeAt(i) & 0xFF;
        return buf;
    }
    
});

function showSuggestion(button, index) {
    const suggestion = document.getElementById(`suggestion-${index}`);
    const typingElement = document.getElementById(`typing-${index}`);
    const text = "This is a placeholder for the suggested fix from AI API."; // Placeholder text

    if (suggestion) {
        suggestion.style.display = 'block';
        typeEffect(typingElement, text);
    }
}

function typeEffect(element, text, speed = 50) {
    let i = 0;
    function typing() {
        if (i < text.length) {
            element.innerHTML += text.charAt(i);
            i++;
            setTimeout(typing, speed);
        }
    }
    typing();
}

