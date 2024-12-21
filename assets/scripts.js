document.addEventListener('DOMContentLoaded', function () {
    const tabs = document.querySelectorAll('.tab');
    const tabContents = document.querySelectorAll('.tab-content');
    const ajaxurl = window.ajax_object.ajax_url;
    let lastFocusedElement;
    let loadedPosts = []; // Ensure this array is initialized globally

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

    function bindRowEvents(rows) {
        rows.forEach(row => {
            row.addEventListener('click', function() {
                lastFocusedElement = this;
                showModal(this);
            });
            row.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    lastFocusedElement = this;
                    showModal(this);
                }
            });
        });
    }

    function showModal(row) {
        const title = row.getAttribute('data-title');
        const issuesOrScore = row.getAttribute('data-issues') || row.getAttribute('data-score');
        const modalTitle = document.getElementById('staticBackdropLabel');
        const modalBody = document.getElementById('modal-body-content');

        // Use innerHTML to include the prefix "Audit Report on"
        modalTitle.innerHTML = '<span>Audit Report on</span> "' + title + '"';

        modalBody.textContent = 'Details: ' + issuesOrScore;

        const modalElement = document.getElementById('staticBackdrop');
        const modal = new bootstrap.Modal(modalElement);
        modal.show();

        modalElement.addEventListener('hidden.bs.modal', function () {
            if (lastFocusedElement) {
                lastFocusedElement.focus();
            }

            document.querySelectorAll('.modal-backdrop').forEach(backdrop => backdrop.remove());
            document.body.classList.remove('modal-open');
            document.body.style.removeProperty('padding-right');

            modal.dispose();
        });
    }

    function loadMorePosts(button, type) {
        const offset = parseInt(button.getAttribute('data-offset'), 10);
        button.textContent = 'Loading...';
        button.setAttribute('aria-live', 'polite');
    
        const data = {
            action: 'load_more_lap_posts', // Match the PHP action hook
            offset: offset,
            loaded_posts: loadedPosts,
        };
    
        jQuery.post(ajaxurl, data, function(response) {
            const postsContainer = document.getElementById(type + '-posts-container');
            const postData = JSON.parse(response);
    
            if (postData.no_more_posts) {
                button.textContent = 'No more posts';
                button.disabled = true;
                button.setAttribute('aria-live', 'polite');
                return;
            }
    
            postData.forEach(post => {
                const ariaLabel = `${post.title}. ${post.issues} issues - Click to view audit details`;
                const newRow = `<tr tabindex="0" role="button" data-id="${post.id}" data-title="${post.title}" data-issues="${post.issues}" class="post-row" aria-label="${ariaLabel}">
                                    <td>${post.title}</td>
                                    <td>${post.issues}</td>
                                </tr>`;
                postsContainer.insertAdjacentHTML('beforeend', newRow);
                if (!loadedPosts.includes(post.id)) {
                    loadedPosts.push(post.id);
                }
            });
    
            bindRowEvents(document.querySelectorAll('.post-row'));
            button.textContent = 'Load More...';
            button.setAttribute('data-offset', offset + 5);
    
            if (lastFocusedElement) {
                lastFocusedElement.focus();
            }
        }).fail(function() {
            button.textContent = 'Error loading posts';
            button.disabled = true;
            button.setAttribute('aria-live', 'polite');
        });
    }
    
    initializeTabs();
    bindRowEvents(document.querySelectorAll('.post-row'));
    
    document.getElementById('load-more-lap').addEventListener('click', function() {
        loadMorePosts(this, 'lap');
    });
    
    document.getElementById('load-more-lighthouse').addEventListener('click', function() {
        loadMorePosts(this, 'lighthouse');
    });
});
