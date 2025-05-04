document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('search-prodi-dashboard');
        const prodiCards = document.querySelectorAll('.prodi-card');

        searchInput.addEventListener('keyup', function () {
            const searchTerm = searchInput.value.toLowerCase();

            prodiCards.forEach(function (card) {
                const text = card.textContent.toLowerCase();

                if (text.includes(searchTerm)) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });