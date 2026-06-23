        </div>
    </main>

    <script>
        // Page title map based on filename
        const pageTitles = {
            'index.php': 'Dashboard',
            'vendors.php': 'Vendor Management',
            'products.php': 'Marketplace Oversight',
            'analytics.php': 'Sector Intelligence',
            'content.php': 'Content Management',
            'support.php': 'Support Desk',
            'customization.php': 'Appearance Hub'
        };

        // Initialize all page-level scripts
        document.addEventListener('DOMContentLoaded', () => {
            lucide.createIcons();

            // Active link highlighting & page title
            const currentFile = window.location.pathname.split('/').pop() || 'index.php';
            document.querySelectorAll('.sidebar-link').forEach(link => {
                const linkHref = link.getAttribute('href');
                if (linkHref === currentFile || (currentFile === '' && linkHref === 'index.php')) {
                    link.classList.add('active');
                }
            });

            // Set page title from map
            const titleEl = document.getElementById('page-title');
            if (titleEl && pageTitles[currentFile]) {
                titleEl.innerText = pageTitles[currentFile];
            }

            // GSAP Animations
            gsap.registerPlugin(ScrollTrigger);

            // Stagger reveal for all gsap-reveal elements
            gsap.to('.gsap-reveal', {
                opacity: 1,
                y: 0,
                duration: 0.8,
                stagger: 0.12,
                ease: 'power3.out',
                delay: 0.15
            });

            // Hover lift animations for cards
            document.querySelectorAll('.card-bg').forEach(card => {
                card.addEventListener('mouseenter', () => {
                    gsap.to(card, { y: -5, boxShadow: '0 20px 40px -15px rgba(0,0,0,0.12)', duration: 0.3 });
                });
                card.addEventListener('mouseleave', () => {
                    gsap.to(card, { y: 0, boxShadow: '0 10px 30px -10px rgba(0,0,0,0.05)', duration: 0.3 });
                });
            });
        });
    </script>
</body>
</html>
