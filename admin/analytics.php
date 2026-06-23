<?php include 'includes/header.php'; ?>

<div class="space-y-12">
    <div class="flex items-center justify-between">
        <div class="gsap-reveal">
            <h2 class="text-3xl font-black text-slate-800 tracking-tight">Sector Intelligence</h2>
            <p class="text-sm font-bold text-slate-400 uppercase tracking-widest mt-1">Growth Metrics & Green Impact Data</p>
        </div>
        <div class="flex gap-4 gsap-reveal">
             <button onclick="downloadReport()" class="px-6 py-3 bg-white border border-slate-100 rounded-2xl text-[10px] font-black uppercase tracking-widest text-slate-400 shadow-sm hover:bg-slate-900 hover:text-white transition-all flex items-center gap-2">
                <i data-lucide="download" class="w-3.5 h-3.5"></i> Annual Report
             </button>
             <button onclick="runAudit()" class="px-6 py-3 bg-primary text-black rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-xl shadow-primary/20 hover:scale-105 transition-all flex items-center gap-2">
                <i data-lucide="shield-check" class="w-3.5 h-3.5"></i> Custom Audit
             </button>
        </div>
    </div>

    <!-- Impact Metrics Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
        <div class="gsap-reveal card-bg p-8 rounded-[3rem] shadow-premium relative overflow-hidden group">
            <div class="absolute -right-4 -top-4 w-24 h-24 bg-primary/5 rounded-full group-hover:scale-150 transition-transform duration-700"></div>
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest leading-none mb-4">Carbon Offset</p>
            <div class="flex items-baseline gap-1">
                <h4 class="text-4xl font-black text-slate-800 counter-val" data-target="12.4">0</h4>
                <span class="text-xl font-bold text-slate-400 font-mono italic">k</span>
            </div>
            <p class="text-[10px] font-black text-primary uppercase mt-2 tracking-widest">Tons CO2 / Year</p>
        </div>
        <div class="gsap-reveal card-bg p-8 rounded-[3rem] shadow-premium relative overflow-hidden group">
             <div class="absolute -right-4 -top-4 w-24 h-24 bg-blue-50 rounded-full group-hover:scale-150 transition-transform duration-700"></div>
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest leading-none mb-4">Energy access</p>
            <div class="flex items-baseline gap-1">
                <h4 class="text-4xl font-black text-slate-800 counter-val" data-target="45">0</h4>
                <span class="text-xl font-bold text-slate-400 font-mono italic">k+</span>
            </div>
            <p class="text-[10px] font-black text-blue-500 uppercase mt-2 tracking-widest">Households impacted</p>
        </div>
        <div class="gsap-reveal card-bg p-8 rounded-[3rem] shadow-premium relative overflow-hidden group">
             <div class="absolute -right-4 -top-4 w-24 h-24 bg-amber-50 rounded-full group-hover:scale-150 transition-transform duration-700"></div>
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest leading-none mb-4">Market value</p>
            <div class="flex items-baseline gap-2">
                <span class="text-lg font-black text-amber-500">KSh</span>
                <h4 class="text-4xl font-black text-slate-800 counter-val" data-target="1.2">0</h4>
                <span class="text-xl font-bold text-slate-400 font-mono italic">B</span>
            </div>
            <p class="text-[10px] font-black text-amber-500 uppercase mt-2 tracking-widest">Sector Circulation</p>
        </div>
        <div class="gsap-reveal card-bg p-8 rounded-[3rem] shadow-premium relative overflow-hidden group">
             <div class="absolute -right-4 -top-4 w-24 h-24 bg-emerald-50 rounded-full group-hover:scale-150 transition-transform duration-700"></div>
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest leading-none mb-4">Standards Rate</p>
            <div class="flex items-baseline gap-1">
                <h4 class="text-4xl font-black text-slate-800 counter-val" data-target="98.4">0</h4>
                <span class="text-xl font-bold text-slate-400 font-mono italic">%</span>
            </div>
            <p class="text-[10px] font-black text-emerald-500 uppercase mt-2 tracking-widest">KEREA Compliance</p>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
        <div class="gsap-reveal card-bg p-10 rounded-[3rem] shadow-premium space-y-8">
            <div class="flex items-center justify-between">
                <h3 class="text-xl font-black">Vendor Growth Trends</h3>
                <div class="flex gap-2">
                    <button onclick="updateChart('growth', '6m')" class="px-3 py-1 bg-slate-50 border border-slate-100 rounded-lg text-[8px] font-black uppercase text-slate-400 hover:bg-primary hover:text-black transition-all">6M</button>
                    <button onclick="updateChart('growth', '1y')" class="px-3 py-1 bg-primary text-black rounded-lg text-[8px] font-black uppercase">1Y</button>
                </div>
            </div>
            <div class="h-80 bg-slate-50/50 rounded-3xl border border-dashed border-slate-200 flex items-center justify-center relative overflow-hidden group">
                <canvas id="vendorGrowthChart" class="w-full h-full p-4 relative z-10"></canvas>
                <div class="absolute inset-0 flex items-center justify-center pointer-events-none opacity-5 group-hover:opacity-10 transition-opacity">
                    <i data-lucide="line-chart" class="w-32 h-32"></i>
                </div>
            </div>
        </div>

        <div class="gsap-reveal card-bg p-10 rounded-[3rem] shadow-premium space-y-8">
            <div class="flex items-center justify-between">
                <h3 class="text-xl font-black">Category Distribution</h3>
                <div class="flex items-center gap-3">
                    <span class="w-2.5 h-2.5 rounded-full bg-primary bg-pulse opacity-50"></span>
                    <span class="text-[9px] font-black uppercase text-slate-400 tracking-widest">Real-time Catalog</span>
                </div>
            </div>
            <div class="h-80 bg-slate-50/50 rounded-3xl border border-dashed border-slate-200 flex items-center justify-center relative overflow-hidden group">
                <canvas id="categoryDistChart" class="w-full h-full p-4 relative z-10"></canvas>
                <div class="absolute inset-0 flex items-center justify-center pointer-events-none opacity-5 group-hover:opacity-10 transition-opacity">
                    <i data-lucide="pie-chart" class="w-32 h-32"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Advanced Metrics Table (Mock) -->
    <div class="gsap-reveal card-bg rounded-[3rem] shadow-premium overflow-hidden">
        <div class="p-8 border-b border-slate-50 flex items-center justify-between">
            <h3 class="text-xl font-black">Regional Impact Breakdown</h3>
            <div class="flex items-center gap-2 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                <span class="w-2 h-2 bg-emerald-500 rounded-full"></span> Top Performer: Nairobi
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-slate-50 text-left border-b border-slate-100">
                        <th class="px-8 py-4 text-[10px] font-black uppercase tracking-widest text-slate-400">County Entity</th>
                        <th class="px-8 py-4 text-[10px] font-black uppercase tracking-widest text-slate-400 text-center">Active Partners</th>
                        <th class="px-8 py-4 text-[10px] font-black uppercase tracking-widest text-slate-400 text-center">Energy Offset</th>
                        <th class="px-8 py-4 text-[10px] font-black uppercase tracking-widest text-slate-400 text-right">Market Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    <tr class="hover:bg-slate-50/50 transition-all cursor-default">
                        <td class="px-8 py-6 text-sm font-black text-slate-800">Nairobi Metropolis</td>
                        <td class="px-8 py-6 text-sm font-bold text-slate-600 text-center">142</td>
                        <td class="px-8 py-6 text-sm font-bold text-emerald-600 text-center">8.2k Tons</td>
                        <td class="px-8 py-6 text-right">
                            <span class="px-3 py-1 bg-emerald-50 text-emerald-600 rounded-xl text-[9px] font-black uppercase shadow-sm">Elite Growth</span>
                        </td>
                    </tr>
                    <tr class="hover:bg-slate-50/50 transition-all cursor-default">
                        <td class="px-8 py-6 text-sm font-black text-slate-800">Mombasa Coastal</td>
                        <td class="px-8 py-6 text-sm font-bold text-slate-600 text-center">54</td>
                        <td class="px-8 py-6 text-sm font-bold text-emerald-600 text-center">3.1k Tons</td>
                        <td class="px-8 py-6 text-right">
                            <span class="px-3 py-1 bg-blue-50 text-blue-600 rounded-xl text-[9px] font-black uppercase shadow-sm">Stable Market</span>
                        </td>
                    </tr>
                    <tr class="hover:bg-slate-50/50 transition-all cursor-default">
                        <td class="px-8 py-6 text-sm font-black text-slate-800">Nakuru Rift</td>
                        <td class="px-8 py-6 text-sm font-bold text-slate-600 text-center">88</td>
                        <td class="px-8 py-6 text-sm font-bold text-emerald-600 text-center">5.4k Tons</td>
                        <td class="px-8 py-6 text-right">
                            <span class="px-3 py-1 bg-emerald-50 text-emerald-600 rounded-xl text-[9px] font-black uppercase shadow-sm">Rapid Expansion</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    let growthChart, distChart;

    function downloadReport() {
        UI.toast('Compiling Sector Intelligence Report...', 'info');
        setTimeout(() => UI.toast('Report Generated: KEREA_Growth_2026.pdf ✓', 'success'), 2000);
    }

    function runAudit() {
        UI.toast('Initiating sector-wide audit protocol...', 'warning');
        setTimeout(() => UI.toast('Audit Data Synchronized with Secretariat', 'success'), 1500);
    }

    function updateChart(type, span) {
        if (type === 'growth') {
            const data = span === '6m' ? [8, 12, 15, 22, 19, 30] : [12, 19, 3, 5, 2, 30, 45, 50, 48, 55, 60, 72];
            const labels = span === '6m' ? ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'] : ['J','F','M','A','M','J','J','A','S','O','N','D'];
            growthChart.data.labels = labels;
            growthChart.data.datasets[0].data = data;
            growthChart.update();
            UI.toast('Growth trend view updated to ' + span, 'info');
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        // Count-up animations for metrics
        document.querySelectorAll('.counter-val').forEach(el => {
            const target = parseFloat(el.dataset.target);
            const obj = { val: 0 };
            gsap.to(obj, {
                val: target,
                duration: 2,
                ease: "power2.out",
                onUpdate: () => {
                    el.innerText = obj.val.toFixed(target % 1 === 0 ? 0 : 1);
                }
            });
        });

        // Vendor Growth Chart
        const ctxGrowth = document.getElementById('vendorGrowthChart').getContext('2d');
        growthChart = new Chart(ctxGrowth, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Registrations',
                    data: [12, 19, 3, 5, 2, 30],
                    borderColor: '#39DE4F',
                    backgroundColor: 'rgba(57, 222, 79, 0.1)',
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#39DE4F',
                    pointBorderWidth: 2,
                    pointRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: { 
                    y: { display: false }, 
                    x: { 
                        grid: { display: false },
                        ticks: { font: { size: 9, weight: 'bold' }, color: '#94a3b8' } 
                    } 
                }
            }
        });

        // Category Dist Chart
        const ctxDist = document.getElementById('categoryDistChart').getContext('2d');
        distChart = new Chart(ctxDist, {
            type: 'doughnut',
            data: {
                labels: ['Solar', 'Bio', 'Wind', 'Biomass'],
                datasets: [{
                    data: [45, 25, 15, 15],
                    backgroundColor: ['#39DE4F', '#F59E0B', '#3b82f6', '#f43f5e'],
                    borderWidth: 8,
                    borderColor: '#fff',
                    hoverOffset: 15
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: { 
                    legend: { 
                        position: 'bottom',
                        labels: { font: { size: 10, weight: 'bold' }, usePointStyle: true, padding: 25 }
                    } 
                }
            }
        });
    });
</script>

<?php include 'includes/footer.php'; ?>

