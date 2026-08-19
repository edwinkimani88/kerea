<?php 
$base_url = "../";
$active_page = "news";

require_once __DIR__ . '/../backend/config/database.php';
require_once __DIR__ . '/../backend/core/Database.php';
require_once __DIR__ . '/../backend/models/Content.php';

$articles = [];
$categoryFilter = $_GET['category'] ?? '';
$searchQuery    = trim($_GET['q'] ?? '');

try {
    $contentModel = new Content();
    $newsData     = $contentModel->list('news', 1, 20, $searchQuery, 'published', $categoryFilter);
    $articles     = $newsData['items'] ?? [];
} catch (\Throwable $e) {
    // Fallback static data if DB table or connection is uninitialized
    $articles = [
        [
            'id' => 1,
            'title' => 'KEREA Launches 2026 Bio-Ethanol Certification Framework',
            'slug' => 'kerea-launches-2026-bio-ethanol-certification-framework',
            'category' => 'Press Release',
            'excerpt' => 'KEREA has officially launched the 2026 Bio-Ethanol Fuel Certification Framework, setting new quality and safety benchmarks across Kenya.',
            'image_url' => 'https://images.unsplash.com/photo-1509391366360-2e959784a276?auto=format&fit=crop&w=800&q=80',
            'published_at' => '2026-08-15 10:00:00',
            'author' => 'Secretariat Press',
            'read_time' => '4 min read'
        ],
        [
            'id' => 2,
            'title' => 'East Africa Solar Sector Report 2025 Now Available',
            'slug' => 'east-africa-solar-sector-report-2025',
            'category' => 'Industry News',
            'excerpt' => 'Our comprehensive annual report tracks the rapid growth, regulatory changes, and commercial opportunities across East African solar markets.',
            'image_url' => 'https://images.unsplash.com/photo-1548543604-a87a9989fd0f?auto=format&fit=crop&w=800&q=80',
            'published_at' => '2026-08-01 14:30:00',
            'author' => 'Research Desk',
            'read_time' => '6 min read'
        ],
        [
            'id' => 3,
            'title' => 'EPRA and KEREA Announce Updated Solar Installer Licensing Regulations',
            'slug' => 'epra-kerea-updated-solar-licensing-2026',
            'category' => 'Policy Update',
            'excerpt' => 'Joint guidelines published by EPRA and KEREA aim to streamline technician licensing and raise quality compliance for commercial installations.',
            'image_url' => 'https://images.unsplash.com/photo-1497435334941-8c899ee9e8e9?auto=format&fit=crop&w=800&q=80',
            'published_at' => '2026-07-22 09:15:00',
            'author' => 'Policy Committee',
            'read_time' => '5 min read'
        ],
        [
            'id' => 4,
            'title' => 'Scaling Commercial & Industrial Solar Storage in Rural Kenya',
            'slug' => 'scaling-commercial-industrial-solar-storage',
            'category' => 'Success Story',
            'excerpt' => 'How KEREA corporate members deployed 12MW battery storage systems to safeguard agricultural processing plants against grid instability.',
            'image_url' => 'https://images.unsplash.com/photo-1466611653911-95081537e5b7?auto=format&fit=crop&w=800&q=80',
            'published_at' => '2026-07-10 11:00:00',
            'author' => 'Market Desk',
            'read_time' => '7 min read'
        ]
    ];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../includes/head.php'; ?>
    <title>News & Press Releases | KEREA</title>
    <meta name="description" content="Stay updated with the latest renewable energy news, policy announcements, market insights, and press releases from KEREA.">
</head>
<body class="bg-slate-50 text-slate-900">
    <?php include '../includes/header.php'; ?>

    <main>
        <!-- ═══ HERO ═══════════════════════════════════════════════════════════════ -->
        <section class="relative bg-slate-900 pt-32 pb-44 overflow-hidden text-white">
            <div class="absolute inset-0 z-0">
                <img src="https://images.unsplash.com/photo-1497435334941-8c899ee9e8e9?auto=format&fit=crop&w=1800&q=80"
                     alt="KEREA News & Press"
                     class="w-full h-full object-cover opacity-20">
                <div class="absolute inset-0 bg-gradient-to-r from-slate-900 via-slate-900/90 to-slate-900/60"></div>
            </div>
            <div class="absolute top-0 right-0 w-1/2 h-full bg-gradient-to-l from-primary/20 via-primary/5 to-transparent pointer-events-none"></div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="max-w-3xl space-y-6">
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-primary/15 border border-primary/30 text-primary text-[10px] font-black uppercase tracking-[0.3em]">
                        <i data-lucide="newspaper" class="w-3.5 h-3.5 text-primary"></i> Press & Publications
                    </div>

                    <h1 class="text-4xl sm:text-6xl lg:text-7xl font-black text-white tracking-tighter leading-tight">
                        News, Insights & <br>
                        <span class="text-primary">Policy Updates</span>
                    </h1>

                    <p class="text-slate-300 text-base sm:text-xl leading-relaxed font-medium">
                        The official communications hub for Kenya’s renewable energy sector — featuring press announcements, market intelligence reports, and policy developments.
                    </p>

                    <!-- Search Form -->
                    <form action="./" method="GET" class="pt-4 flex flex-col sm:flex-row gap-3 max-w-xl">
                        <div class="relative flex-1">
                            <i data-lucide="search" class="w-5 h-5 text-slate-400 absolute left-4 top-1/2 -translate-y-1/2"></i>
                            <input type="text" name="q" value="<?php echo htmlspecialchars($searchQuery); ?>" 
                                   placeholder="Search articles, keywords, policy..." 
                                   class="w-full pl-12 pr-4 py-4 rounded-2xl bg-white/10 border border-white/20 text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-primary backdrop-blur-md text-sm font-medium">
                        </div>
                        <button type="submit" class="px-8 py-4 bg-primary hover:bg-emerald-400 text-black font-black rounded-2xl text-xs uppercase tracking-widest transition-all shadow-xl shadow-primary/25">
                            Search
                        </button>
                    </form>
                </div>
            </div>
        </section>

        <!-- ═══ FILTER BAR & ARTICLES GRID ═════════════════════════════════════════ -->
        <section class="py-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Categories Filter -->
            <div class="flex flex-wrap items-center justify-between gap-6 mb-16 pb-6 border-b border-slate-200">
                <div class="flex flex-wrap items-center gap-3">
                    <span class="text-xs font-black text-slate-400 uppercase tracking-widest mr-2">Category:</span>
                    <a href="./" class="px-5 py-2.5 rounded-xl text-xs font-black uppercase tracking-wider transition-all <?php echo empty($categoryFilter) ? 'bg-primary text-black shadow-md shadow-primary/20' : 'bg-white border border-slate-200 text-slate-700 hover:border-primary'; ?>">
                        All News
                    </a>
                    <a href="./?category=Press+Release" class="px-5 py-2.5 rounded-xl text-xs font-black uppercase tracking-wider transition-all <?php echo ($categoryFilter === 'Press Release') ? 'bg-primary text-black shadow-md shadow-primary/20' : 'bg-white border border-slate-200 text-slate-700 hover:border-primary'; ?>">
                        Press Releases
                    </a>
                    <a href="./?category=Industry+News" class="px-5 py-2.5 rounded-xl text-xs font-black uppercase tracking-wider transition-all <?php echo ($categoryFilter === 'Industry News') ? 'bg-primary text-black shadow-md shadow-primary/20' : 'bg-white border border-slate-200 text-slate-700 hover:border-primary'; ?>">
                        Industry News
                    </a>
                    <a href="./?category=Policy+Update" class="px-5 py-2.5 rounded-xl text-xs font-black uppercase tracking-wider transition-all <?php echo ($categoryFilter === 'Policy Update') ? 'bg-primary text-black shadow-md shadow-primary/20' : 'bg-white border border-slate-200 text-slate-700 hover:border-primary'; ?>">
                        Policy Updates
                    </a>
                    <a href="./?category=Success+Story" class="px-5 py-2.5 rounded-xl text-xs font-black uppercase tracking-wider transition-all <?php echo ($categoryFilter === 'Success Story') ? 'bg-primary text-black shadow-md shadow-primary/20' : 'bg-white border border-slate-200 text-slate-700 hover:border-primary'; ?>">
                        Success Stories
                    </a>
                </div>
                <div class="text-xs text-slate-500 font-bold">
                    Showing <span class="text-slate-900 font-black"><?php echo count($articles); ?></span> articles
                </div>
            </div>

            <!-- Grid -->
            <?php if (!empty($articles)): ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                    <?php foreach ($articles as $index => $item): 
                        $img = !empty($item['image_url']) ? $item['image_url'] : 'https://images.unsplash.com/photo-1466611653911-95081537e5b7?auto=format&fit=crop&w=800&q=80';
                        $dateStr = !empty($item['published_at']) ? date('M d, Y', strtotime($item['published_at'])) : date('M d, Y');
                    ?>
                        <article class="bg-white rounded-3xl overflow-hidden border border-slate-100 shadow-xl hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between group">
                            <div>
                                <div class="relative h-64 w-full overflow-hidden bg-slate-100">
                                    <img src="<?php echo htmlspecialchars($img); ?>" 
                                         alt="<?php echo htmlspecialchars($item['title']); ?>" 
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    <div class="absolute top-4 left-4">
                                        <span class="px-3.5 py-1.5 rounded-full bg-slate-900/80 backdrop-blur-md text-[10px] font-black text-primary uppercase tracking-widest">
                                            <?php echo htmlspecialchars($item['category'] ?? 'General'); ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="p-8 space-y-4">
                                    <div class="flex items-center gap-4 text-xs font-bold text-slate-400">
                                        <span class="flex items-center gap-1.5"><i data-lucide="calendar" class="w-3.5 h-3.5 text-primary"></i> <?php echo $dateStr; ?></span>
                                        <span>•</span>
                                        <span class="flex items-center gap-1.5"><i data-lucide="clock" class="w-3.5 h-3.5 text-primary"></i> <?php echo htmlspecialchars($item['read_time'] ?? '4 min read'); ?></span>
                                    </div>
                                    <h3 class="text-xl font-black text-slate-900 leading-snug group-hover:text-primary transition-colors">
                                        <a href="./#article-<?php echo $item['id']; ?>"><?php echo htmlspecialchars($item['title']); ?></a>
                                    </h3>
                                    <p class="text-slate-600 text-xs leading-relaxed font-medium line-clamp-3">
                                        <?php echo htmlspecialchars($item['excerpt'] ?? ''); ?>
                                    </p>
                                </div>
                            </div>
                            <div class="p-8 pt-0 border-t border-slate-50 flex items-center justify-between mt-4">
                                <span class="text-[10px] font-black uppercase text-slate-400 tracking-widest flex items-center gap-1.5">
                                    <i data-lucide="user" class="w-3.5 h-3.5 text-primary"></i> <?php echo htmlspecialchars($item['author'] ?? 'KEREA Desk'); ?>
                                </span>
                                <a href="./#article-<?php echo $item['id']; ?>" class="inline-flex items-center gap-1.5 text-xs font-black text-slate-900 group-hover:text-primary uppercase tracking-wider transition-colors">
                                    Read Article <i data-lucide="arrow-right" class="w-4 h-4 text-primary group-hover:translate-x-1 transition-transform"></i>
                                </a>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="text-center py-24 bg-white rounded-3xl border border-slate-200 space-y-4">
                    <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto text-slate-400">
                        <i data-lucide="newspaper" class="w-8 h-8"></i>
                    </div>
                    <h3 class="text-xl font-black text-slate-900">No articles found</h3>
                    <p class="text-slate-500 text-xs max-w-sm mx-auto font-medium">Try broadening your search keywords or resetting category filters.</p>
                    <a href="./" class="inline-block px-6 py-3 bg-primary text-black font-black text-xs uppercase tracking-widest rounded-xl">View All Articles</a>
                </div>
            <?php endif; ?>
        </section>

        <!-- ═══ NEWSLETTER SUBSCRIBE ═════════════════════════════════════════════════ -->
        <section class="py-20 bg-slate-900 text-white relative overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10 space-y-6">
                <span class="text-primary font-black text-xs uppercase tracking-[0.3em]">Stay Informed</span>
                <h2 class="text-3xl sm:text-5xl font-black tracking-tight">Subscribe to KEREA Industry Bulletins</h2>
                <p class="text-slate-300 max-w-xl mx-auto text-base font-medium leading-relaxed">
                    Get monthly policy analysis, EPRA regulatory alerts, and sector insights delivered directly to your inbox.
                </p>
                <form action="#" method="POST" onsubmit="event.preventDefault(); alert('Thank you for subscribing to KEREA Industry Bulletins!');" class="max-w-md mx-auto flex flex-col sm:flex-row gap-3 pt-4">
                    <input type="email" required placeholder="Enter your official email..." class="flex-1 px-5 py-4 rounded-xl bg-white/10 border border-white/20 text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-primary text-xs font-medium">
                    <button type="submit" class="px-8 py-4 bg-primary hover:bg-emerald-400 text-black font-black rounded-xl text-xs uppercase tracking-widest transition-all shadow-xl shadow-primary/25">
                        Subscribe
                    </button>
                </form>
            </div>
        </section>
    </main>

    <?php include '../includes/footer.php'; ?>
</body>
</html>
