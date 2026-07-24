<?php
/**
 * KEREA Admin — Site Customization & Settings
 * Saves all settings to MySQL via the backend Settings API.
 */

// ── DB Settings Save Handler (proxied to backend API) ───────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action']) && $_GET['action'] === 'save') {
    header('Content-Type: application/json');
    try {
        // Bootstrap the backend stack so we can call the Setting model directly
        require_once dirname(__DIR__) . '/backend/config/database.php';
        require_once dirname(__DIR__) . '/backend/core/Database.php';
        require_once dirname(__DIR__) . '/backend/core/Auth.php';
        require_once dirname(__DIR__) . '/backend/core/Security.php';
        require_once dirname(__DIR__) . '/backend/core/Uploader.php';
        require_once dirname(__DIR__) . '/backend/models/Setting.php';

        Auth::startSession();
        Auth::requireRole('content_manager', BASE_URL . '/auth/');
        Auth::requireCsrf();

        $allowedFields = [
            'site_name', 'site_tagline', 'primary_color', 'accent_color',
            'font_family', 'nav_style', 'announcement_text', 'footer_bg_color',
            'footer_text', 'header_email', 'header_phone', 'contact_email',
            'contact_phone', 'contact_address', 'social_facebook',
            'social_twitter', 'social_linkedin', 'social_youtube',
            'hero_title', 'hero_subtitle', 'hero_cta_text', 'hero_cta_url',
            'marketplace_url', 'show_market_counter',
            'meta_description', 'google_analytics',
            'smtp_host', 'smtp_port', 'smtp_user', 'smtp_pass',
            'smtp_from', 'smtp_from_name',
        ];

        $toSave = [];
        foreach ($allowedFields as $field) {
            if (array_key_exists($field, $_POST)) {
                $toSave[$field] = Security::clean((string)$_POST[$field]);
            }
        }

        // Handle logo uploads via Uploader
        $assetsDir = dirname(__DIR__) . '/assets/';
        if (!is_dir($assetsDir)) mkdir($assetsDir, 0755, true);

        foreach (['logo_main', 'logo_load'] as $logoField) {
            if (isset($_FILES[$logoField]) && $_FILES[$logoField]['error'] === UPLOAD_ERR_OK) {
                $result = Uploader::upload($_FILES[$logoField], 'logos', ['image']);
                if ($result['success']) {
                    $destName = $logoField . '_' . time() . '.' .
                                pathinfo($result['file']['filename'], PATHINFO_EXTENSION);
                    copy($result['file']['file_path'], $assetsDir . $destName);
                    $toSave[$logoField] = '/assets/' . $destName;
                }
            }
        }

        if (empty($toSave)) {
            echo json_encode(['success' => false, 'message' => 'No valid settings to save.']);
            exit;
        }

        $model  = new Setting();
        $result = $model->saveMultiple($toSave);

        if ($result['success']) {
            echo json_encode([
                'success' => true,
                'message' => 'Settings saved to database. Changes are now live.',
                'saved'   => $result['saved'],
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Some settings could not be saved.']);
        }

    } catch (Throwable $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
    exit;
}

// ── Load the admin shell ────────────────────────────────────────────────────
include 'includes/header.php';

// $settings is loaded in header.php; provide base_url for logo preview paths
$base_url = '';
?>

<div class="space-y-12">
    <div class="flex items-center justify-between">
        <div class="gsap-reveal">
            <h2 class="text-3xl font-black text-slate-800 tracking-tight">Appearance Hub</h2>
            <p class="text-sm font-bold text-slate-400 uppercase tracking-widest mt-1">Global Branding & UI Configuration</p>
        </div>
        <button id="save-branding-btn" onclick="saveBranding()" class="gsap-reveal px-8 py-4 bg-primary text-black rounded-2xl text-xs font-black uppercase tracking-widest shadow-xl shadow-primary/20 flex items-center gap-3 hover:scale-105 transition-all">
            <i data-lucide="save" class="w-4 h-4"></i> Save Global Changes
        </button>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
        <!-- Configuration Forms -->
        <div class="gsap-reveal lg:col-span-8 space-y-10">
            <!-- Branding Section -->
            <div class="card-bg p-10 rounded-[3rem] shadow-premium space-y-10">
                <div class="border-b border-slate-50 pb-6 flex items-center gap-4">
                    <div class="w-10 h-10 bg-primary/10 rounded-xl flex items-center justify-center text-primary">
                        <i data-lucide="palette" class="w-5 h-5"></i>
                    </div>
                    <h3 class="text-xl font-black">Brand Identity</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-3">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Primary Brand Color</label>
                        <div class="flex gap-4">
                            <input type="color" id="primary-color-picker" value="<?php echo htmlspecialchars($settings['primary_color'] ?? '#39DE4F'); ?>" oninput="syncColor('primary')" class="w-14 h-14 rounded-xl border-none cursor-pointer overflow-hidden p-0 bg-transparent">
                            <input type="text" id="primary-color-text" value="<?php echo htmlspecialchars($settings['primary_color'] ?? '#39DE4F'); ?>" oninput="syncColorText('primary')" class="flex-1 px-5 py-4 bg-slate-50 border border-slate-100 rounded-xl text-xs font-bold uppercase outline-none focus:ring-2 focus:ring-primary/20">
                        </div>
                    </div>
                    <div class="space-y-3">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Accent UI Color</label>
                        <div class="flex gap-4">
                            <input type="color" id="accent-color-picker" value="<?php echo htmlspecialchars($settings['accent_color'] ?? '#F59E0B'); ?>" oninput="syncColor('accent')" class="w-14 h-14 rounded-xl border-none cursor-pointer overflow-hidden p-0 bg-transparent">
                            <input type="text" id="accent-color-text" value="<?php echo htmlspecialchars($settings['accent_color'] ?? '#F59E0B'); ?>" oninput="syncColorText('accent')" class="flex-1 px-5 py-4 bg-slate-50 border border-slate-100 rounded-xl text-xs font-bold uppercase outline-none focus:ring-2 focus:ring-amber-500/20">
                        </div>
                    </div>
                </div>

                <?php $active_font = $settings['font_family'] ?? 'Plus Jakarta Sans'; ?>
                <div class="space-y-3">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Global Font Family</label>
                    <select id="font-family-select" onchange="UI.toast('Font changed to ' + this.value, 'info')" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-xl text-xs font-bold outline-none cursor-pointer hover:border-primary transition-colors">
                        <option value="Plus Jakarta Sans" <?php if ($active_font === 'Plus Jakarta Sans') echo 'selected'; ?>>Plus Jakarta Sans (KEREA Standard)</option>
                        <option value="Inter" <?php if ($active_font === 'Inter') echo 'selected'; ?>>Inter Responsive</option>
                        <option value="Outfit" <?php if ($active_font === 'Outfit') echo 'selected'; ?>>Outfit Geometric</option>
                    </select>
                </div>
            </div>

            <!-- Structural Customization -->
            <div class="card-bg p-10 rounded-[3rem] shadow-premium space-y-10">
                <div class="border-b border-slate-50 pb-6 flex items-center gap-4">
                    <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center text-blue-600">
                        <i data-lucide="layout" class="w-5 h-5"></i>
                    </div>
                    <h3 class="text-xl font-black">Header & Navigation Style</h3>
                </div>

                <div class="space-y-8">
                    <div class="space-y-3">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Header Navigation Style</label>
                        <?php $nav_style = $settings['nav_style'] ?? 'static'; ?>
                        <div class="grid grid-cols-2 gap-4">
                            <div id="nav-style-glass" onclick="setStyle('nav', 'glass')" class="nav-style-btn p-4 border-2 rounded-2xl cursor-pointer <?php echo ($nav_style === 'glass') ? 'border-primary bg-primary/5' : 'border-slate-100 bg-white'; ?>">
                                <p class="text-xs font-black text-slate-800">Glassmorphic Floating</p>
                                <p class="text-[9px] text-slate-400 uppercase mt-1">Recommended</p>
                            </div>
                            <div id="nav-style-static" onclick="setStyle('nav', 'static')" class="nav-style-btn p-4 border-2 rounded-2xl cursor-pointer <?php echo ($nav_style === 'static') ? 'border-primary bg-primary/5' : 'border-slate-100 bg-white'; ?>">
                                <p class="text-xs font-black text-slate-800">Static Solid</p>
                                <p class="text-[9px] text-slate-400 uppercase mt-1">Legacy Style</p>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-3">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Announcement Bar Text</label>
                            <input type="text" id="announcement_text" oninput="updatePreview()" value="<?php echo htmlspecialchars($settings['announcement_text'] ?? "Kenya's Industry Peak Body · Est. 2002"); ?>" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-xl text-xs font-bold focus:ring-2 focus:ring-primary/20 outline-none">
                        </div>
                        <div class="space-y-3 text-right">
                             <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Show Marketplace Counter</label>
                             <div class="flex items-center justify-end h-full">
                                  <?php $market_active = $settings['show_market_counter'] ?? true; ?>
                                  <div id="market-toggle" onclick="toggleSwitch('market')" class="w-14 h-8 <?php echo $market_active ? 'bg-primary' : 'bg-slate-200'; ?> rounded-full relative p-1 cursor-pointer transition-all duration-300">
                                      <div id="market-toggle-thumb" class="w-6 h-6 bg-white rounded-full <?php echo $market_active ? 'ml-auto' : 'ml-0'; ?> shadow-sm transition-all duration-300"></div>
                                  </div>
                             </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Brand Logos -->
            <div class="card-bg p-10 rounded-[3rem] shadow-premium space-y-10">
                <div class="border-b border-slate-50 pb-6 flex items-center gap-4">
                    <div class="w-10 h-10 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-600">
                        <i data-lucide="image" class="w-5 h-5"></i>
                    </div>
                    <h3 class="text-xl font-black">Brand Logos</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Main Logo -->
                    <div class="space-y-4">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2 block">Main Site Logo</label>
                        <div class="flex items-center gap-4 bg-slate-50 p-4 rounded-2xl border border-slate-100">
                            <div class="w-16 h-16 bg-white border border-slate-200/50 rounded-xl overflow-hidden flex items-center justify-center p-2 shrink-0">
                                <img id="preview-logo-main" src="<?php echo $base_url . ltrim($settings['logo_main'] ?? 'assets/kerea-logo-main.png', '/'); ?>" class="max-h-full max-w-full object-contain">
                            </div>
                            <div class="flex-1">
                                <input type="file" id="logo-main-file" accept="image/*" onchange="previewImage(this, 'preview-logo-main', 'mock-logo-preview', 'mock-logo-footer')" class="hidden">
                                <button type="button" onclick="document.getElementById('logo-main-file').click()" class="px-4 py-2.5 bg-white border border-slate-200 hover:border-primary text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-slate-50 transition-all">Upload Main Logo</button>
                                <p class="text-[9px] text-slate-400 mt-1 uppercase font-bold">PNG/SVG Preferred</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Preloader Logo -->
                    <div class="space-y-4">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2 block">Preloader Logo</label>
                        <div class="flex items-center gap-4 bg-slate-50 p-4 rounded-2xl border border-slate-100">
                            <div class="w-16 h-16 bg-white border border-slate-200/50 rounded-xl overflow-hidden flex items-center justify-center p-2 shrink-0">
                                <img id="preview-logo-load" src="<?php echo $base_url . ltrim($settings['logo_load'] ?? 'assets/logo-load.png', '/'); ?>" class="max-h-full max-w-full object-contain">
                            </div>
                            <div class="flex-1">
                                <input type="file" id="logo-load-file" accept="image/*" onchange="previewImage(this, 'preview-logo-load')" class="hidden">
                                <button type="button" onclick="document.getElementById('logo-load-file').click()" class="px-4 py-2.5 bg-white border border-slate-200 hover:border-primary text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-slate-50 transition-all">Upload Load Logo</button>
                                <p class="text-[9px] text-slate-400 mt-1 uppercase font-bold">Square Icon</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contacts Info -->
            <div class="card-bg p-10 rounded-[3rem] shadow-premium space-y-10">
                <div class="border-b border-slate-50 pb-6 flex items-center gap-4">
                    <div class="w-10 h-10 bg-amber-50 rounded-xl flex items-center justify-center text-amber-600">
                        <i data-lucide="phone-call" class="w-5 h-5"></i>
                    </div>
                    <h3 class="text-xl font-black">Contact Details & Communications</h3>
                </div>

                <div class="space-y-6">
                    <h4 class="text-sm font-black text-slate-800 border-b border-slate-50 pb-2">Header Utilities Bar Contacts</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-3">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Header Email Address</label>
                            <input type="email" id="header_email" oninput="updatePreview()" value="<?php echo htmlspecialchars($settings['header_email'] ?? 'info@kerea.org'); ?>" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-xl text-xs font-bold focus:ring-2 focus:ring-primary/20 outline-none">
                        </div>
                        <div class="space-y-3">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Header Phone Line</label>
                            <input type="text" id="header_phone" value="<?php echo htmlspecialchars($settings['header_phone'] ?? '(+254) 740 541 896'); ?>" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-xl text-xs font-bold focus:ring-2 focus:ring-primary/20 outline-none">
                        </div>
                    </div>
                </div>

                <div class="space-y-6 pt-6 border-t border-slate-100">
                    <h4 class="text-sm font-black text-slate-800 border-b border-slate-50 pb-2">Secretariat Hub & Footer Contacts</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-3">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Secretariat Official Email</label>
                            <input type="email" id="contact_email" oninput="updatePreview()" value="<?php echo htmlspecialchars($settings['contact_email'] ?? 'info@kerea.org'); ?>" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-xl text-xs font-bold focus:ring-2 focus:ring-primary/20 outline-none">
                        </div>
                        <div class="space-y-3">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Secretariat Support Hotline</label>
                            <input type="text" id="contact_phone" value="<?php echo htmlspecialchars($settings['contact_phone'] ?? '(+254) 740 541 896'); ?>" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-xl text-xs font-bold focus:ring-2 focus:ring-primary/20 outline-none">
                        </div>
                        <div class="space-y-3 col-span-full">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Physical Location / Address</label>
                            <textarea id="contact_address" rows="3" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-xl text-xs font-bold focus:ring-2 focus:ring-primary/20 outline-none resize-none"><?php echo htmlspecialchars($settings['contact_address'] ?? "Keri Road, Nairobi West,\nNairobi"); ?></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Design & Brand Copy -->
            <div class="card-bg p-10 rounded-[3rem] shadow-premium space-y-10">
                <div class="border-b border-slate-50 pb-6 flex items-center gap-4">
                    <div class="w-10 h-10 bg-indigo-50 rounded-xl flex items-center justify-center text-indigo-600">
                        <i data-lucide="layout-panel-left" class="w-5 h-5"></i>
                    </div>
                    <h3 class="text-xl font-black">Footer Style & Copy</h3>
                </div>

                <div class="space-y-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-3">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Footer Background Color</label>
                            <div class="flex gap-4">
                                <input type="color" id="footer-bg-picker" value="<?php echo htmlspecialchars($settings['footer_bg_color'] ?? '#0a0a0a'); ?>" oninput="syncFooterColor()" class="w-14 h-14 rounded-xl border-none cursor-pointer overflow-hidden p-0 bg-transparent">
                                <input type="text" id="footer-bg-text" value="<?php echo htmlspecialchars($settings['footer_bg_color'] ?? '#0a0a0a'); ?>" oninput="syncFooterColorText()" class="flex-1 px-5 py-4 bg-slate-50 border border-slate-100 rounded-xl text-xs font-bold uppercase outline-none focus:ring-2 focus:ring-indigo-500/20">
                            </div>
                        </div>
                        <div class="space-y-3 col-span-full">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Footer Brand Description</label>
                            <textarea id="footer_text" oninput="updatePreview()" rows="3" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-xl text-xs font-bold focus:ring-2 focus:ring-primary/20 outline-none resize-none"><?php echo htmlspecialchars($settings['footer_text'] ?? 'The primary representative body for all sustainable energy practitioners and corporate stakeholders across East Africa.'); ?></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Social Media Profiles -->
            <div class="card-bg p-10 rounded-[3rem] shadow-premium space-y-10">
                <div class="border-b border-slate-50 pb-6 flex items-center gap-4">
                    <div class="w-10 h-10 bg-sky-50 rounded-xl flex items-center justify-center text-sky-600">
                        <i data-lucide="share-2" class="w-5 h-5"></i>
                    </div>
                    <h3 class="text-xl font-black">Social Media Channels</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="space-y-3">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Facebook URL</label>
                        <input type="text" id="social_facebook" value="<?php echo htmlspecialchars($settings['social_facebook'] ?? '#'); ?>" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-xl text-xs font-bold focus:ring-2 focus:ring-primary/20 outline-none">
                    </div>
                    <div class="space-y-3">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Twitter / X URL</label>
                        <input type="text" id="social_twitter" value="<?php echo htmlspecialchars($settings['social_twitter'] ?? '#'); ?>" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-xl text-xs font-bold focus:ring-2 focus:ring-primary/20 outline-none">
                    </div>
                    <div class="space-y-3">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">LinkedIn URL</label>
                        <input type="text" id="social_linkedin" value="<?php echo htmlspecialchars($settings['social_linkedin'] ?? '#'); ?>" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-xl text-xs font-bold focus:ring-2 focus:ring-primary/20 outline-none">
                    </div>
                </div>
            </div>
        </div>

        <!-- Live Preview Sidebar -->
        <div class="gsap-reveal lg:col-span-4 space-y-10 focus:outline-none">
            <div class="card-bg p-8 rounded-[2.5rem] shadow-premium space-y-6 sticky top-24">
                <div class="flex items-center justify-between">
                    <h3 class="font-black text-sm">Design Preview</h3>
                    <span class="px-2 py-1 bg-emerald-50 text-emerald-600 rounded text-[9px] font-black uppercase">Live Mockup</span>
                </div>
                
                <!-- Live Page Layout Mock -->
                <div class="w-full bg-slate-50 border border-slate-200/60 rounded-[2rem] p-4 space-y-4 shadow-inner">
                    <!-- Mini Announcement Bar -->
                    <div class="bg-black text-[7px] text-white px-2.5 py-1.5 flex justify-between items-center rounded-lg select-none">
                        <span class="text-primary truncate w-24 font-bold" id="mock-announce"><?php echo htmlspecialchars($settings['announcement_text'] ?? 'Kerea Guaranteed Compliance'); ?></span>
                        <span id="mock-email" class="text-slate-400 truncate w-24 text-right font-medium"><?php echo htmlspecialchars($settings['header_email'] ?? 'info@kerea.org'); ?></span>
                    </div>
                    
                    <!-- Mini Navbar -->
                    <div id="mock-navbar" class="bg-white border border-slate-200/50 rounded-xl p-2.5 flex justify-between items-center transition-all">
                        <div class="flex items-center gap-1">
                            <img id="mock-logo-preview" src="<?php echo $base_url . ltrim($settings['logo_main'] ?? '/assets/kerea-logo-main.png', '/'); ?>" class="h-5 w-auto object-contain">
                            <span class="text-[8px] font-black text-slate-800">KEREA</span>
                        </div>
                        <div class="flex gap-2 text-[6px] text-slate-450 font-bold select-none">
                            <span>Home</span>
                            <span>About</span>
                            <span>Contact</span>
                        </div>
                    </div>

                    <!-- Mini Hero -->
                    <div class="bg-slate-200/40 rounded-xl p-6 flex flex-col items-center justify-center text-center space-y-2 border border-slate-100">
                        <div id="mock-hero-bar" class="w-16 h-2 rounded transition-colors" style="background-color: <?php echo htmlspecialchars($settings['primary_color'] ?? '#39DE4F'); ?>"></div>
                        <div class="w-12 h-1 bg-slate-300/40 rounded"></div>
                    </div>

                    <!-- Mini Footer -->
                    <div id="mock-footer" class="text-white p-3 rounded-xl space-y-2 text-[6px] transition-all" style="background-color: <?php echo htmlspecialchars($settings['footer_bg_color'] ?? '#0a0a0a'); ?>">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center gap-1">
                                <img id="mock-logo-footer" src="<?php echo $base_url . ltrim($settings['logo_main'] ?? '/assets/kerea-logo-main.png', '/'); ?>" class="h-3 w-auto filter brightness-0 invert opacity-80">
                                <span class="font-black">KEREA</span>
                            </div>
                            <span id="mock-email-footer" class="text-slate-400 font-medium"><?php echo htmlspecialchars($settings['contact_email'] ?? 'info@kerea.org'); ?></span>
                        </div>
                        <div class="text-slate-400 text-[5px] truncate font-medium" id="mock-footer-text">
                            <?php echo htmlspecialchars($settings['footer_text'] ?? 'The primary representative body...'); ?>
                        </div>
                    </div>
                </div>

                <p class="text-[10px] text-slate-400 leading-relaxed italic text-center font-bold px-4">"Modifications made will adjust the site’s public appearance once saved."</p>
            </div>
        </div>
    </div>
</div>

<script>
let navStyleSelected = '<?php echo htmlspecialchars($settings["nav_style"] ?? "static"); ?>';

function syncColor(type) {
    const val = document.getElementById(type + '-color-picker').value;
    document.getElementById(type + '-color-text').value = val.toUpperCase();
    updatePreview();
}

function syncColorText(type) {
    let val = document.getElementById(type + '-color-text').value;
    if (val.charAt(0) !== '#') val = '#' + val;
    if (val.length === 7) {
        document.getElementById(type + '-color-picker').value = val;
        updatePreview();
    }
}

function syncFooterColor() {
    const val = document.getElementById('footer-bg-picker').value;
    document.getElementById('footer-bg-text').value = val.toUpperCase();
    updatePreview();
}

function syncFooterColorText() {
    let val = document.getElementById('footer-bg-text').value;
    if (val.charAt(0) !== '#') val = '#' + val;
    if (val.length === 7) {
        document.getElementById('footer-bg-picker').value = val;
        updatePreview();
    }
}

function previewImage(input, previewId, mockId1, mockId2) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById(previewId).src = e.target.result;
            if(mockId1) document.getElementById(mockId1).src = e.target.result;
            if(mockId2) document.getElementById(mockId2).src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function updatePreview() {
    const primary = document.getElementById('primary-color-picker').value;
    const footerBg = document.getElementById('footer-bg-picker').value;
    const announcement = document.getElementById('announcement_text').value;
    const headerEmail = document.getElementById('header_email').value;
    const contactEmail = document.getElementById('contact_email').value;
    const footerText = document.getElementById('footer_text').value;
    
    const mockHeroBar = document.getElementById('mock-hero-bar');
    if (mockHeroBar) mockHeroBar.style.backgroundColor = primary;

    const mockFooter = document.getElementById('mock-footer');
    if (mockFooter) mockFooter.style.backgroundColor = footerBg;
    
    const mockAnnounce = document.getElementById('mock-announce');
    if (mockAnnounce) mockAnnounce.innerText = announcement;
    
    const mockEmail = document.getElementById('mock-email');
    if (mockEmail) mockEmail.innerText = headerEmail;
    
    const mockEmailFooter = document.getElementById('mock-email-footer');
    if (mockEmailFooter) mockEmailFooter.innerText = contactEmail;
    
    const mockFooterText = document.getElementById('mock-footer-text');
    if (mockFooterText) mockFooterText.innerText = footerText;

    const mockNavbar = document.getElementById('mock-navbar');
    if (mockNavbar) {
        if (navStyleSelected === 'glass') {
            mockNavbar.className = "bg-white/70 backdrop-blur-md border border-slate-200/50 rounded-xl p-2.5 flex justify-between items-center transition-all shadow-md mx-2";
        } else {
            mockNavbar.className = "bg-white border border-slate-200/50 rounded-xl p-2.5 flex justify-between items-center transition-all";
        }
    }
}

function setStyle(type, style) {
    navStyleSelected = style;
    const glass = document.getElementById('nav-style-glass');
    const stat = document.getElementById('nav-style-static');
    
    if (style === 'glass') {
        glass.classList.add('border-primary', 'bg-primary/5');
        glass.classList.remove('border-slate-100', 'bg-white');
        stat.classList.remove('border-primary', 'bg-primary/5');
        stat.classList.add('border-slate-100', 'bg-white');
    } else {
        stat.classList.add('border-primary', 'bg-primary/5');
        stat.classList.remove('border-slate-100', 'bg-white');
        glass.classList.remove('border-primary', 'bg-primary/5');
        glass.classList.add('border-slate-100', 'bg-white');
    }
    UI.toast('Navigation style scheduled: ' + style, 'info');
    updatePreview();
}

let marketActive = <?php echo ($settings['show_market_counter'] ?? true) ? 'true' : 'false'; ?>;
function toggleSwitch(type) {
    marketActive = !marketActive;
    const box = document.getElementById('market-toggle');
    const thumb = document.getElementById('market-toggle-thumb');
    
    if (marketActive) {
        box.classList.remove('bg-slate-200');
        box.classList.add('bg-primary');
        thumb.classList.remove('ml-0');
        thumb.classList.add('ml-auto');
    } else {
        box.classList.remove('bg-primary');
        box.classList.add('bg-slate-200');
        thumb.classList.remove('ml-auto');
        thumb.classList.add('ml-0');
    }
    UI.toast('Marketplace counter ' + (marketActive ? 'enabled' : 'disabled'), 'info');
}

function saveBranding() {
    const btn = document.getElementById('save-branding-btn');
    const originalContent = btn.innerHTML;
    
    btn.disabled = true;
    btn.innerHTML = '<i data-lucide="loader-2" class="w-4 h-4 animate-spin"></i> Processing...';
    lucide.createIcons();
    
    const formData = new FormData();
    // Security: CSRF token required by the backend
    formData.append('csrf_token', window.CSRF_TOKEN);
    formData.append('primary_color', document.getElementById('primary-color-picker').value);
    formData.append('accent_color', document.getElementById('accent-color-picker').value);
    formData.append('font_family', document.getElementById('font-family-select').value);
    formData.append('nav_style', navStyleSelected);
    formData.append('announcement_text', document.getElementById('announcement_text').value);
    formData.append('show_market_counter', marketActive ? 'true' : 'false');

    formData.append('footer_bg_color', document.getElementById('footer-bg-picker').value);
    formData.append('footer_text', document.getElementById('footer_text').value);
    formData.append('header_email', document.getElementById('header_email').value);
    formData.append('header_phone', document.getElementById('header_phone').value);
    formData.append('contact_email', document.getElementById('contact_email').value);
    formData.append('contact_phone', document.getElementById('contact_phone').value);
    formData.append('contact_address', document.getElementById('contact_address').value);
    formData.append('social_facebook', document.getElementById('social_facebook').value);
    formData.append('social_twitter', document.getElementById('social_twitter').value);
    formData.append('social_linkedin', document.getElementById('social_linkedin').value);

    const logoMain = document.getElementById('logo-main-file').files[0];
    const logoLoad = document.getElementById('logo-load-file').files[0];
    if (logoMain) formData.append('logo_main', logoMain);
    if (logoLoad) formData.append('logo_load', logoLoad);
    
    fetch('?action=save', {
        method: 'POST',
        body: formData
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            btn.innerHTML = '<i data-lucide="check" class="w-4 h-4"></i> Synchronizing...';
            lucide.createIcons();
            
            setTimeout(() => {
                UI.toast(data.message, 'success');
                btn.innerHTML = originalContent;
                btn.disabled = false;
                lucide.createIcons();
                
                // Effect: Subtle "flash" of the preview
                gsap.fromTo('.lg\\:col-span-4 .card-bg', { scale: 1 }, { scale: 1.02, duration: 0.2, yoyo: true, repeat: 1 });
                
                // Reload window after brief success display
                setTimeout(() => window.location.reload(), 1000);
            }, 1000);
        } else {
            UI.toast('Error: ' + data.message, 'error');
            btn.innerHTML = originalContent;
            btn.disabled = false;
            lucide.createIcons();
        }
    })
    .catch(error => {
        console.error(error);
        UI.toast('An unexpected communications error occurred.', 'error');
        btn.innerHTML = originalContent;
        btn.disabled = false;
        lucide.createIcons();
    });
}

// Initial preview sync
document.addEventListener('DOMContentLoaded', () => {
    updatePreview();
});
</script>

<?php include 'includes/footer.php'; ?>
