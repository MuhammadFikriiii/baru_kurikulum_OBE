
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('search');
        const table = document.querySelector('table');
        const rows = table.querySelectorAll('tbody tr');

        let debounceTimer;

        searchInput.addEventListener('keyup', function() {
            clearTimeout(debounceTimer);
            const searchTerm = searchInput.value.toLowerCase();

            debounceTimer = setTimeout(function () {
            let anyVisible = 1;
            let visibleIndex = 1;

            rows.forEach(function (row) {
                const cells = row.getElementsByTagName('td');
                let found = false;

                for (let i = 0; i < cells.length - 1; i++) {
                    const cellText = cells[i].textContent || cells[i].innerText;
                    const lowerCaseCellText = cellText.toLowerCase();

                    if (lowerCaseCellText.includes(searchTerm)) {
                        found = true;
                        const regex = new RegExp(`(${searchTerm})`, 'gi');
                        cells[i].innerHTML = cellText.replace(regex, '<span class="bg-yellow-300">$1</span>');
                    } else {
                        cells[i].innerHTML = cellText;
                    }
                }

                if (found) {
                    row.style.display = '';
                    cells[0].textContent = visibleIndex++;
                } else {
                    row.style.display = 'none';
                }
            });

            const noResultsDiv = document.getElementById('noResults');
            if (noResultsDiv) {
                noResultsDiv.classList.toggle('hidden', anyVisible);
            }
        }, 300);// tunda 300 milidetik setelah pengguna berhenti mengetik
        });
    });