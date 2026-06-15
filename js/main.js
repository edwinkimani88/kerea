document.addEventListener('DOMContentLoaded', () => {
    // Add to Cart feedback
    const cartButtons = document.querySelectorAll('.btn-add-cart');
    cartButtons.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            const btnOriginalContent = btn.innerHTML;
            btn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>';
            btn.style.background = 'var(--emerald-600)';
            btn.style.color = 'white';
            
            setTimeout(() => {
                btn.innerHTML = btnOriginalContent;
                btn.style.background = '';
                btn.style.color = '';
            }, 2000);
            
            console.log('Product added to mock cart');
        });
    });

    // Simple Search Filter Mock
    const filterForm = document.getElementById('filter-form');
    if (filterForm) {
        filterForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const searchInput = filterForm.querySelector('.search-input').value;
            console.log('Filtering marketplace for:', searchInput);
            alert('Frontend-only demo: Filtering for "' + searchInput + '"');
        });
    }
});
