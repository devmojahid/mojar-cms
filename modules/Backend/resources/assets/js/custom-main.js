document.addEventListener('DOMContentLoaded', function () {
    const sidebarMenu = document.querySelector('#sidebar-menu .navbar-nav');
    if (!sidebarMenu) return; // Guard if not found

    // Grab all top-level sidebar items (li.nav-item).
    const originalItems = Array.from(sidebarMenu.querySelectorAll('.nav-item'));

    // A helper to compute a simple "match score" (longer matches => higher score).
    // For real fuzzy searching, consider external libraries or more complex logic.
    function getMatchScore(text, query) {
        // Example: simple substring check
        let score = 0;
        const index = text.toLowerCase().indexOf(query.toLowerCase());
        if (index !== -1) {
            // Closer to start => slightly higher score, plus length factor
            score = 100 - index * 5 + query.length;
        }
        return score;
    }

    // Re-render the sorted items in the sidebar
    function renderSidebarItems(items) {
        // Clear existing list
        sidebarMenu.innerHTML = '';
        // Append the sorted items
        items.forEach(item => sidebarMenu.appendChild(item));
    }

    // Listen to changes in the search input
    const searchInput = document.getElementById('topbarSearchInput');
    if (!searchInput) return;

    searchInput.addEventListener('input', function () {
        const query = this.value.trim();
        if (!query) {
            // If search is empty, revert to the original ordering
            renderSidebarItems(originalItems);
            return;
        }

        // Build a new array that includes each item + its match score
        const scoredItems = originalItems.map(item => {
            // For each nav-link, we can check .nav-link-title text
            const linkTitleEl = item.querySelector('.nav-link-title');
            const linkText = linkTitleEl ? linkTitleEl.textContent : '';
            const score = getMatchScore(linkText, query);
            return { item, score };
        });

        // Sort them by descending score
        scoredItems.sort((a, b) => b.score - a.score);

        // If you prefer to HIDE items that do not match, do something like:
        // scoredItems = scoredItems.filter(obj => obj.score > 0);

        // Extract items in new order
        const sortedItems = scoredItems.map(obj => obj.item);

        // Re-render the sidebar with sorted items
        renderSidebarItems(sortedItems);
    });
});