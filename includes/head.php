<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">
<?php if(!isset($base_url)) $base_url = "/"; ?>
<link rel="icon" type="image/png" href="<?php echo $base_url; ?>assets/kerea-logo-main.png">

<!-- Tailwind CDN -->
<script src="https://cdn.tailwindcss.com"></script>

<!-- Libraries CDNs -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
<script src="https://unpkg.com/lucide@latest"></script>
<script src="https://cdn.jsdelivr.net/gh/studio-freight/lenis@1.0.19/bundled/lenis.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    primary: {
                        DEFAULT: '#39DE4F',
                        light: '#5be66d',
                        dark: '#2fb741',
                    },
                    accent: {
                        DEFAULT: '#F59E0B',
                        light: '#fbbf24',
                        dark: '#d97706',
                    },
                    black: '#000000',
                    white: '#FFFFFF',
                },
                fontFamily: {
                    sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                },
                borderRadius: {
                    '3xl': '1.5rem',
                    '4xl': '2rem',
                }
            }
        }
    }
</script>

<style>
    @layer base {
        body {
            @apply font-sans antialiased text-slate-900 bg-white overflow-x-hidden;
        }
    }

    /* Smooth Scroll Classes */
    html.lenis {
        height: auto;
    }
    .lenis.lenis-smooth {
        scroll-behavior: auto !important;
    }
    .lenis.lenis-smooth [data-lenis-prevent] {
        overscroll-behavior: contain;
    }
    .lenis.lenis-stopped {
        overflow: hidden;
    }

    .text-gradient {
        @apply bg-clip-text text-transparent bg-gradient-to-r from-primary to-accent;
    }

    /* Preloader Styles - Using Logo Load */
    #preloader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: white;
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }

    .loader-content {
        @apply flex flex-col items-center gap-4;
    }

    .loader-logo {
        width: 100px;
        @apply animate-pulse;
    }

    /* GSAP reveal Initial State */
    .gsap-reveal {
        opacity: 0;
        visibility: hidden;
    }

    /* Fix Header Legibility */
    #main-nav {
        @apply shadow-sm border-b border-slate-100;
    }
</style>
