<?php
/**
 * KEREA Admin — Live Dashboard
 * Real data from MySQL: member counts, content stats, recent activity.
 */
declare(strict_types=1);

require_once dirname(__DIR__) . '/backend/models/Content.php';
require_once dirname(__DIR__) . '/backend/models/User.php';

$stats = ['published_news' => 0, 'published_events' => 0, 'published_pubs' => 0, 'active_members' => 0];
$userStats = ['total' => 0, 'active' => 0, 'pending' => 0, 'suspended' => 0, 'this_month' => 0];
$recent = [];
$events = [];
$messages = [];
$dbError = null;

try {
    $contentModel = new Content();
    $userModel    = new User();
    $stats        = $contentModel->dashboardStats();
    $userStats    = $userModel->stats();

    $db     = Database::getInstance();
    $recent = $db->fetchAll(
        'SELECT l.action, l.entity_type, l.description, l.created_at, u.first_name, u.last_name
           FROM activity_log l
           LEFT JOIN users u ON u.id = l.user_id
          ORDER BY l.created_at DESC LIMIT 8'
    );
    $events = $db->fetchAll(
        "SELECT title, venue, start_date, event_type FROM events
          WHERE status = 'upcoming' AND start_date >= CURDATE()
          ORDER BY start_date ASC LIMIT 4"
    );
    $messages = $db->fetchAll(
        "SELECT name, subject, created_at FROM contact_messages
          WHERE status = 'unread'
          ORDER BY created_at DESC LIMIT 5"
    );
} catch (\Throwable $e) {
    $dbError = $e->getMessage();
}

require_once __DIR__ . '/includes/header.php';
?>

<div class="space-y-10">
    <?php if ($dbError): ?>
    <div class="p-6 bg-amber-50 border border-amber-200 rounded-2xl flex items-start gap-4 text-amber-800">
        <i data-lucide="database-backup" class="w-6 h-6 text-amber-600 mt-0.5 flex-shrink-0"></i>
        <div>
            <h4 class="font-bold text-amber-900 text-sm">Database Connection Notice</h4>
            <p class="text-xs text-amber-700 mt-1 leading-relaxed">
                The dashboard is running in offline mode (`<?php echo htmlspecialchars($dbError); ?>`). Please verify MySQL database status and environment configuration (`DB_HOST`, `DB_USER`, `DB_PASS`, `DB_NAME`).
            </p>
        </div>
    </div>
    <?php endif; ?>
    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Members -->
        <a href="/admin/users.php" class="gsap-reveal card-bg p-7 rounded-[2rem] shadow-premium hover:border-primary transition-all group cursor-pointer">
            <div class="flex items-center justify-between mb-5">
                <div class="w-12 h-12 bg-primary/10 rounded-2xl flex items-center justify-center text-primary group-hover:scale-110 transition-transform">
                    <i data-lucide="users" class="w-6 h-6"></i>
                </div>
                <span class="text-[10px] font-black text-emerald-600 bg-emerald-50 px-2 py-1 rounded-lg uppercase"><?php echo $userStats['this_month']; ?> this month</span>
            </div>
            <h3 class="text-3xl font-black tracking-tight"><?php echo number_format($userStats['active']); ?></h3>
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-1">Active Members</p>
            <p class="text-[9px] text-slate-400 mt-2"><?php echo $userStats['pending']; ?> pending · <?php echo $userStats['suspended']; ?> suspended</p>
        </a>

        <!-- News -->
        <a href="/admin/content.php?type=news" class="gsap-reveal card-bg p-7 rounded-[2rem] shadow-premium hover:border-blue-400 transition-all group cursor-pointer">
            <div class="flex items-center justify-between mb-5">
                <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 group-hover:scale-110 transition-transform">
                    <i data-lucide="newspaper" class="w-6 h-6"></i>
                </div>
                <span class="text-[10px] font-black text-blue-600 bg-blue-50 px-2 py-1 rounded-lg uppercase">Published</span>
            </div>
            <h3 class="text-3xl font-black tracking-tight"><?php echo $stats['news']; ?></h3>
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-1">News Articles</p>
        </a>

        <!-- Events -->
        <a href="/admin/events.php" class="gsap-reveal card-bg p-7 rounded-[2rem] shadow-premium hover:border-accent transition-all group cursor-pointer">
            <div class="flex items-center justify-between mb-5">
                <div class="w-12 h-12 bg-accent/10 rounded-2xl flex items-center justify-center text-accent group-hover:scale-110 transition-transform">
                    <i data-lucide="calendar" class="w-6 h-6"></i>
                </div>
                <span class="text-[10px] font-black text-amber-700 bg-amber-50 px-2 py-1 rounded-lg uppercase">Upcoming</span>
            </div>
            <h3 class="text-3xl font-black tracking-tight"><?php echo $stats['events']; ?></h3>
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-1">Upcoming Events</p>
        </a>

        <!-- Unread Messages -->
        <div class="gsap-reveal card-bg p-7 rounded-[2rem] shadow-premium hover:border-purple-400 transition-all group <?php echo $stats['messages'] > 0 ? 'ring-2 ring-purple-200' : ''; ?>">
            <div class="flex items-center justify-between mb-5">
                <div class="w-12 h-12 bg-purple-50 rounded-2xl flex items-center justify-center text-purple-600 group-hover:scale-110 transition-transform">
                    <i data-lucide="mail" class="w-6 h-6"></i>
                </div>
                <?php if ($stats['messages'] > 0): ?>
                <span class="text-[10px] font-black text-red-600 bg-red-50 px-2 py-1 rounded-lg uppercase animate-pulse"><?php echo $stats['messages']; ?> Unread</span>
                <?php endif; ?>
            </div>
            <h3 class="text-3xl font-black tracking-tight"><?php echo $stats['messages']; ?></h3>
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-1">Unread Messages</p>
        </div>
    </div>

    <!-- Middle Row -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Activity Feed -->
        <div class="gsap-reveal lg:col-span-8 card-bg p-8 rounded-[2rem] shadow-premium">
            <div class="flex items-center justify-between border-b border-slate-100 pb-5 mb-6">
                <div>
                    <h3 class="text-xl font-black tracking-tight">Activity Feed</h3>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-0.5">Live system activity log</p>
                </div>
                <a href="/admin/analytics.php" class="px-5 py-2.5 bg-slate-50 text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-primary transition-all flex items-center gap-2">
                    <i data-lucide="bar-chart-2" class="w-3.5 h-3.5"></i> View All
                </a>
            </div>

            <div class="space-y-3">
                <?php if (empty($recent)): ?>
                    <div class="text-center py-8 text-slate-400">
                        <i data-lucide="activity" class="w-8 h-8 mx-auto mb-2 opacity-30"></i>
                        <p class="text-xs font-bold uppercase">No activity yet</p>
                    </div>
                <?php else: foreach ($recent as $log):
                    $icon = match(true) {
                        str_contains($log['action'], 'login')    => ['check-circle','emerald'],
                        str_contains($log['action'], 'create')   => ['plus-circle','blue'],
                        str_contains($log['action'], 'update')   => ['edit-3','amber'],
                        str_contains($log['action'], 'delete')   => ['trash-2','red'],
                        str_contains($log['action'], 'settings') => ['settings','purple'],
                        default                                   => ['activity','slate'],
                    };
                    $timeAgo = human_time_diff($log['created_at']);
                ?>
                <div class="flex items-start gap-4 p-4 rounded-2xl hover:bg-slate-50 transition-all">
                    <div class="w-9 h-9 bg-<?php echo $icon[1]; ?>-100 rounded-xl flex items-center justify-center text-<?php echo $icon[1]; ?>-600 shrink-0">
                        <i data-lucide="<?php echo $icon[0]; ?>" class="w-4 h-4"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex justify-between items-start gap-2">
                            <p class="text-xs font-black text-slate-800 uppercase tracking-tight truncate">
                                <?php echo Security::esc(str_replace('.', ' › ', $log['action'])); ?>
                            </p>
                            <span class="text-[9px] font-black text-slate-400 bg-slate-100 px-2 py-0.5 rounded shrink-0"><?php echo $timeAgo; ?></span>
                        </div>
                        <p class="text-[11px] text-slate-500 font-bold mt-0.5 truncate"><?php echo Security::esc($log['description'] ?? ''); ?></p>
                        <?php if ($log['first_name']): ?>
                        <p class="text-[9px] text-slate-400 mt-0.5">by <?php echo Security::esc($log['first_name'] . ' ' . $log['last_name']); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; endif; ?>
            </div>
        </div>

        <!-- Right Column -->
        <div class="gsap-reveal lg:col-span-4 space-y-6">
            <!-- Upcoming Events -->
            <div class="card-bg p-7 rounded-[2rem] shadow-premium">
                <div class="flex items-center justify-between mb-5">
                    <h3 class="text-base font-black">Upcoming Events</h3>
                    <a href="/admin/events.php" class="text-[10px] font-black text-primary uppercase tracking-widest hover:underline">Manage</a>
                </div>
                <div class="space-y-3">
                    <?php if (empty($events)): ?>
                        <p class="text-xs text-slate-400 font-bold text-center py-4">No upcoming events</p>
                    <?php else: foreach ($events as $ev):
                        $d = new DateTime($ev['start_date']);
                    ?>
                    <div class="flex gap-4 items-center p-3 hover:bg-slate-50 rounded-xl transition-all">
                        <div class="w-12 h-12 bg-slate-900 rounded-xl flex flex-col items-center justify-center shrink-0">
                            <span class="text-[8px] font-black uppercase text-primary"><?php echo $d->format('M'); ?></span>
                            <span class="text-sm font-black text-white"><?php echo $d->format('d'); ?></span>
                        </div>
                        <div class="min-w-0">
                            <p class="text-[11px] font-black text-slate-800 uppercase tracking-tight truncate"><?php echo Security::esc($ev['title']); ?></p>
                            <p class="text-[9px] font-bold text-slate-400 uppercase truncate mt-0.5"><?php echo Security::esc($ev['venue'] ?? ''); ?></p>
                        </div>
                    </div>
                    <?php endforeach; endif; ?>
                </div>
                <a href="/admin/events.php#create" class="w-full mt-4 py-3 bg-slate-50 hover:bg-primary text-[10px] font-black uppercase tracking-widest rounded-xl flex items-center justify-center gap-2 transition-all">
                    <i data-lucide="plus" class="w-3.5 h-3.5"></i> Add Event
                </a>
            </div>

            <!-- Quick Content Links -->
            <div class="card-bg p-7 rounded-[2rem] shadow-premium">
                <h3 class="text-base font-black mb-5">Quick Actions</h3>
                <div class="space-y-2">
                    <?php $quickLinks = [
                        ['url'=>'/admin/content.php?type=news&action=create','icon'=>'newspaper','label'=>'Post News Article'],
                        ['url'=>'/admin/content.php?type=publication&action=create','icon'=>'file-text','label'=>'Add Publication'],
                        ['url'=>'/admin/events.php#create','icon'=>'calendar-plus','label'=>'Schedule Event'],
                        ['url'=>'/admin/media.php','icon'=>'upload-cloud','label'=>'Upload Media'],
                        ['url'=>'/admin/customization.php','icon'=>'settings','label'=>'Edit Settings'],
                    ]; foreach ($quickLinks as $ql): ?>
                    <a href="<?php echo Security::esc($ql['url']); ?>"
                        class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-50 text-xs font-black text-slate-600 hover:text-primary transition-all group">
                        <i data-lucide="<?php echo $ql['icon']; ?>" class="w-4 h-4 shrink-0 text-slate-400 group-hover:text-primary transition-colors"></i>
                        <?php echo Security::esc($ql['label']); ?>
                    </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Unread Contact Messages -->
    <?php if (!empty($messages)): ?>
    <div class="gsap-reveal card-bg rounded-[2rem] shadow-premium overflow-hidden">
        <div class="p-6 border-b border-slate-100 flex items-center justify-between">
            <h3 class="text-base font-black flex items-center gap-2">
                <i data-lucide="inbox" class="w-5 h-5 text-purple-500"></i>
                Unread Contact Messages
                <span class="inline-flex items-center justify-center w-5 h-5 bg-red-500 text-white text-[9px] font-black rounded-full"><?php echo count($messages); ?></span>
            </h3>
        </div>
        <div class="divide-y divide-slate-50">
            <?php foreach ($messages as $msg): ?>
            <div class="flex items-center justify-between px-6 py-4 hover:bg-slate-50 transition-all">
                <div>
                    <p class="text-sm font-black text-slate-800"><?php echo Security::esc($msg['name']); ?></p>
                    <p class="text-xs text-slate-500 font-bold"><?php echo Security::esc($msg['subject'] ?? 'No subject'); ?></p>
                </div>
                <span class="text-[9px] font-black text-slate-400 uppercase"><?php echo human_time_diff($msg['created_at']); ?></span>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>
</div>

<?php
function human_time_diff(string $dateStr): string {
    $now  = new DateTime();
    $then = new DateTime($dateStr);
    $diff = $now->getTimestamp() - $then->getTimestamp();
    if ($diff < 60)     return $diff . 's ago';
    if ($diff < 3600)   return floor($diff/60) . 'm ago';
    if ($diff < 86400)  return floor($diff/3600) . 'h ago';
    return floor($diff/86400) . 'd ago';
}

require_once __DIR__ . '/includes/footer.php';
?>
