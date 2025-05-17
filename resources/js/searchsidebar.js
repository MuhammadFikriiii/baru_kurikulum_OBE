document.addEventListener('DOMContentLoaded', function() {
    const searchInputSidebar = document.getElementById('search-sidebar');
    const menuItems = document.querySelectorAll('aside#sidebar ul li');

    searchInputSidebar.addEventListener('keyup', function() {
        const searchTerm = searchInputSidebar.value.toLowerCase();

        menuItems.forEach(function(li) {
            const text = li.textContent.toLowerCase();
            if(text.includes(searchTerm)) {
                li.style.display = '';
            } else {
                li.style.display = 'none';
            }
        });
    });
});