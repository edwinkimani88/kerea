<?php include_once 'config.php'; ?>
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
                        DEFAULT: '<?php echo $settings['primary_color']; ?>',
                        light: '<?php echo $settings['primary_color']; ?>cc',
                        dark: '<?php echo $settings['primary_color']; ?>ee',
                    },
                    accent: {
                        DEFAULT: '<?php echo $settings['accent_color']; ?>',
                        light: '<?php echo $settings['accent_color']; ?>cc',
                        dark: '<?php echo $settings['accent_color']; ?>ee',
                    },
                    black: '<?php echo $settings['hero_bg_color']; ?>',
                    white: '<?php echo $settings['header_bg']; ?>',
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
            @apply font-sans antialiased text-slate-900 bg-white;
            overflow-x: clip; /* Use clip instead of hidden so scroll events are not blocked */
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
    .gsap-reveal, .reveal-on-scroll, .stagger-reveal > * {
        opacity: 0;
        visibility: hidden;
    }

    .stroke-text {
        -webkit-text-stroke: 2px currentColor;
        color: transparent;
    }

    /* Fix Header Legibility */
    #main-nav {
        @apply shadow-sm border-b border-slate-100;
    }

    /* Dashboard Scrollbar */
    .custom-scrollbar {
        scrollbar-width: thin;
        scrollbar-color: #e2e8f0 transparent;
    }
    .custom-scrollbar::-webkit-scrollbar {
        width: 5px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #e2e8f0;
        border-radius: 99px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #cbd5e1;
    }
</style>
