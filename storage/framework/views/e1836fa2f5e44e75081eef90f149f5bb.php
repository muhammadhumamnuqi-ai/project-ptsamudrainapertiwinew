<?php $__env->startSection('page_title', 'Dashboard Super Admin'); ?>
<?php $__env->startSection('page_subtitle', 'Monitoring keseluruhan sistem rekrutmen dan penempatan calon ABK PT. Samudra Ina Pertiwi'); ?>

<?php $__env->startSection('styles'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-8">

    
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">
        <?php
            $statCards = [
                ['label'=>'Total Calon ABK', 'value'=>$stats['total_abk'], 'icon'=>'fa-users', 'color'=>'blue'],
                ['label'=>'Total Operator', 'value'=>$stats['total_operator'], 'icon'=>'fa-user-tie', 'color'=>'violet'],
                ['label'=>'Berkas Pending', 'value'=>$stats['dokumen_pending'], 'icon'=>'fa-file-signature', 'color'=>'amber'],
                ['label'=>'MCU Diverifikasi', 'value'=>$stats['mcu_pending'], 'icon'=>'fa-notes-medical', 'color'=>'purple'],
                ['label'=>'Peserta Diklat', 'value'=>$stats['diklat_aktif'], 'icon'=>'fa-graduation-cap', 'color'=>'cyan'],
                ['label'=>'Waiting List Job', 'value'=>$stats['waiting_list'], 'icon'=>'fa-anchor', 'color'=>'indigo'],
                ['label'=>'ABK Berangkat', 'value'=>$stats['abk_berangkat'], 'icon'=>'fa-plane-departure', 'color'=>'emerald'],
                ['label'=>'ABK On Board', 'value'=>$stats['abk_onboard'], 'icon'=>'fa-ship', 'color'=>'teal'],
            ];
        ?>

        <?php $__currentLoopData = $statCards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $colorMap = [
                'blue'   => 'bg-blue-100 text-blue-600',
                'violet' => 'bg-violet-100 text-violet-600',
                'amber'  => 'bg-amber-100 text-amber-600',
                'purple' => 'bg-purple-100 text-purple-600',
                'cyan'   => 'bg-cyan-100 text-cyan-600',
                'indigo' => 'bg-indigo-100 text-indigo-600',
                'emerald'=> 'bg-emerald-100 text-emerald-600',
                'teal'   => 'bg-teal-100 text-teal-600',
            ];
        ?>
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center space-x-4 hover:shadow-md transition">
            <div class="w-12 h-12 rounded-xl <?php echo e($colorMap[$card['color']]); ?> flex items-center justify-center text-lg flex-shrink-0">
                <i class="fa-solid <?php echo e($card['icon']); ?>"></i>
            </div>
            <div class="min-w-0">
                <span class="text-[10px] font-semibold text-slate-400 block uppercase tracking-wider truncate"><?php echo e($card['label']); ?></span>
                <strong class="text-2xl font-extrabold text-slate-900"><?php echo e($card['value']); ?></strong>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

        
        <div class="lg:col-span-7 bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-base font-bold text-slate-900">Grafik Pendaftaran Bulanan</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Jumlah calon ABK yang mendaftar setiap bulan di tahun <?php echo e(date('Y')); ?></p>
                </div>
                <span class="px-3 py-1 bg-blue-50 text-blue-700 text-xs font-bold rounded-full"><?php echo e(date('Y')); ?></span>
            </div>
            <canvas id="registrationChart" height="140"></canvas>
        </div>

        
        <div class="lg:col-span-5 bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
            <div class="mb-6">
                <h3 class="text-base font-bold text-slate-900">Statistik Hasil MCU</h3>
                <p class="text-xs text-slate-500 mt-0.5">Distribusi hasil medical check-up seluruh kandidat</p>
            </div>
            <div class="flex items-center justify-center">
                <canvas id="mcuChart" height="180" style="max-width:220px"></canvas>
            </div>
            <div class="mt-4 flex items-center justify-center space-x-6 text-xs">
                <span class="flex items-center"><span class="w-3 h-3 rounded-full bg-emerald-500 mr-1.5"></span>Lulus: <?php echo e($mcuStats['Lulus']); ?></span>
                <span class="flex items-center"><span class="w-3 h-3 rounded-full bg-amber-400 mr-1.5"></span>Pending: <?php echo e($mcuStats['Pending']); ?></span>
                <span class="flex items-center"><span class="w-3 h-3 rounded-full bg-red-500 mr-1.5"></span>Gagal: <?php echo e($mcuStats['Gagal']); ?></span>
            </div>
        </div>
    </div>

    
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

        
        <div class="lg:col-span-6 bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
            <div class="mb-6">
                <h3 class="text-base font-bold text-slate-900">Statistik Hasil Diklat</h3>
                <p class="text-xs text-slate-500 mt-0.5">Jumlah kandidat per status pelatihan offline Pemalang</p>
            </div>
            <canvas id="diklatChart" height="180"></canvas>
        </div>

        
        <div class="lg:col-span-6 bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
            <div class="mb-6">
                <h3 class="text-base font-bold text-slate-900">Penempatan Berdasarkan Negara Tujuan</h3>
                <p class="text-xs text-slate-500 mt-0.5">Distribusi penempatan kapal berdasarkan wilayah</p>
            </div>
            <canvas id="placementChart" height="180"></canvas>
        </div>
    </div>

    
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

        
        <div class="lg:col-span-7 bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-slate-100 flex items-center justify-between">
                <div>
                    <h3 class="text-base font-bold text-slate-900">Monitoring Calon ABK Terkini</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Daftar terbaru beserta tahapan rekrutmen aktif</p>
                </div>
                <a href="<?php echo e(route('dashboard.operator')); ?>" class="text-xs font-semibold text-blue-600 hover:text-blue-800">Lihat Semua &rarr;</a>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-100">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-5 py-3 text-left text-[10px] font-bold text-slate-400 uppercase">Nama ABK</th>
                            <th class="px-5 py-3 text-left text-[10px] font-bold text-slate-400 uppercase">Tahap Aktif</th>
                            <th class="px-5 py-3 text-left text-[10px] font-bold text-slate-400 uppercase">Status</th>
                            <th class="px-5 py-3 text-left text-[10px] font-bold text-slate-400 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        <?php
                            use App\Models\User;
                            $recentCandidates = User::role('abk')
                                ->with(['profilAbk','prosesPendaftaran'])
                                ->latest()
                                ->take(8)
                                ->get();
                            $tahapLabel = [1=>'Administrasi',2=>'MCU',3=>'Diklat',4=>'Dok. Pelaut',5=>'Waiting List',6=>'Keberangkatan'];
                        ?>
                        <?php $__currentLoopData = $recentCandidates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $lp = $c->prosesPendaftaran->sortByDesc('created_at')->first();
                            $tAktif = $lp ? $lp->tahap : 1;
                            $tStatus = $lp ? $lp->status : 'Dalam Proses';
                        ?>
                        <tr class="hover:bg-slate-50/50 transition">
                            <td class="px-5 py-3.5 text-sm font-semibold text-slate-900">
                                <?php echo e($c->profilAbk ? $c->profilAbk->nama_lengkap : $c->name); ?>

                            </td>
                            <td class="px-5 py-3.5 text-xs text-slate-700">
                                <span class="font-semibold text-blue-700"><?php echo e($tAktif); ?>.</span>
                                <?php echo e($tahapLabel[$tAktif] ?? 'Tahap '.$tAktif); ?>

                            </td>
                            <td class="px-5 py-3.5">
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold uppercase
                                    <?php echo e($tStatus==='Selesai' ? 'bg-emerald-100 text-emerald-800' : ''); ?>

                                    <?php echo e($tStatus==='Dalam Proses' ? 'bg-blue-100 text-blue-800' : ''); ?>

                                    <?php echo e($tStatus==='Revisi' ? 'bg-amber-100 text-amber-800' : ''); ?>

                                    <?php echo e($tStatus==='Terjadwal' ? 'bg-cyan-100 text-cyan-800' : ''); ?>

                                    <?php echo e($tStatus==='Ditolak' ? 'bg-red-100 text-red-800' : ''); ?>

                                "><?php echo e($tStatus); ?></span>
                            </td>
                            <td class="px-5 py-3.5">
                                <a href="<?php echo e(route('operator.abk.show', $c->id)); ?>" class="text-xs font-semibold text-slate-600 hover:text-blue-600 transition">
                                    <i class="fa-regular fa-folder-open mr-1"></i>Detail
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>

        
        <div class="lg:col-span-5 bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-slate-100 flex items-center justify-between">
                <div>
                    <h3 class="text-base font-bold text-slate-900">Log Aktivitas Sistem</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Rekam jejak audit trail terkini</p>
                </div>
                <a href="<?php echo e(route('admin.logs')); ?>" class="text-xs font-semibold text-blue-600 hover:text-blue-800">Lihat Semua &rarr;</a>
            </div>
            <div class="divide-y divide-slate-50 overflow-y-auto max-h-96">
                <?php $__empty_1 = true; $__currentLoopData = $logs->take(12); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="flex items-start space-x-3 px-5 py-4 hover:bg-slate-50/50 transition">
                    <div class="w-8 h-8 rounded-full bg-slate-900 flex items-center justify-center text-white text-[10px] font-bold flex-shrink-0 mt-0.5">
                        <?php echo e($log->user ? strtoupper(substr($log->user->name, 0, 2)) : '??'); ?>

                    </div>
                    <div class="min-w-0">
                        <p class="text-xs text-slate-800 leading-relaxed">
                            <strong class="font-semibold"><?php echo e($log->user ? $log->user->name : 'Sistem'); ?></strong>
                            — <?php echo e($log->aktivitas); ?>

                        </p>
                        <span class="text-[10px] text-slate-400"><?php echo e($log->created_at->diffForHumans()); ?></span>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="px-5 py-8 text-center text-xs text-slate-400 italic">Belum ada aktivitas tercatat</div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <a href="<?php echo e(route('admin.users')); ?>" class="bg-slate-900 hover:bg-slate-800 text-white p-5 rounded-2xl flex items-center space-x-4 shadow-lg transition group">
            <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center group-hover:bg-white/20 transition"><i class="fa-solid fa-users-gear text-lg"></i></div>
            <div>
                <p class="text-xs font-semibold text-slate-300">Manajemen</p>
                <p class="text-sm font-bold">Kelola Pengguna</p>
            </div>
        </a>
        <a href="<?php echo e(route('admin.logs')); ?>" class="bg-gradient-to-br from-blue-700 to-blue-900 hover:from-blue-600 hover:to-blue-800 text-white p-5 rounded-2xl flex items-center space-x-4 shadow-lg transition group">
            <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center group-hover:bg-white/20 transition"><i class="fa-solid fa-clock-rotate-left text-lg"></i></div>
            <div>
                <p class="text-xs font-semibold text-blue-200">Audit</p>
                <p class="text-sm font-bold">Log Aktivitas</p>
            </div>
        </a>
        <a href="<?php echo e(route('reports.export.pdf')); ?>" target="_blank" class="bg-gradient-to-br from-emerald-700 to-emerald-900 hover:from-emerald-600 hover:to-emerald-800 text-white p-5 rounded-2xl flex items-center space-x-4 shadow-lg transition group">
            <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center group-hover:bg-white/20 transition"><i class="fa-solid fa-print text-lg"></i></div>
            <div>
                <p class="text-xs font-semibold text-emerald-200">Laporan</p>
                <p class="text-sm font-bold">Cetak PDF</p>
            </div>
        </a>
        <a href="<?php echo e(route('reports.export.csv')); ?>" class="bg-gradient-to-br from-violet-700 to-violet-900 hover:from-violet-600 hover:to-violet-800 text-white p-5 rounded-2xl flex items-center space-x-4 shadow-lg transition group">
            <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center group-hover:bg-white/20 transition"><i class="fa-solid fa-file-excel text-lg"></i></div>
            <div>
                <p class="text-xs font-semibold text-violet-200">Export</p>
                <p class="text-sm font-bold">Download Excel</p>
            </div>
        </a>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
// ---- Monthly Registrations Line Chart ----
const regCtx = document.getElementById('registrationChart').getContext('2d');
new Chart(regCtx, {
    type: 'line',
    data: {
        labels: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des'],
        datasets: [{
            label: 'Pendaftar Baru',
            data: <?php echo e(json_encode(array_values($registrationsChartData))); ?>,
            fill: true,
            backgroundColor: 'rgba(37,99,235,0.08)',
            borderColor: '#2563eb',
            tension: 0.4,
            pointBackgroundColor: '#2563eb',
            pointRadius: 4,
            pointHoverRadius: 6,
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: {
            y: { beginAtZero: true, ticks: { precision: 0, color:'#94a3b8', font:{size:11} }, grid: { color:'#f1f5f9' } },
            x: { ticks: { color:'#94a3b8', font:{size:11} }, grid: { display: false } }
        }
    }
});

// ---- MCU Doughnut Chart ----
const mcuCtx = document.getElementById('mcuChart').getContext('2d');
new Chart(mcuCtx, {
    type: 'doughnut',
    data: {
        labels: ['Lulus MCU','Pending MCU','Tidak Lulus'],
        datasets: [{
            data: [<?php echo e($mcuStats['Lulus']); ?>, <?php echo e($mcuStats['Pending']); ?>, <?php echo e($mcuStats['Gagal']); ?>],
            backgroundColor: ['#10b981','#f59e0b','#ef4444'],
            borderWidth: 0,
            hoverOffset: 6,
        }]
    },
    options: {
        cutout: '70%',
        plugins: { legend: { display: false } }
    }
});

// ---- Diklat Bar Chart ----
const diklatCtx = document.getElementById('diklatChart').getContext('2d');
new Chart(diklatCtx, {
    type: 'bar',
    data: {
        labels: ['Lulus Diklat','Tidak Lulus','Aktif/Terjadwal'],
        datasets: [{
            label: 'Peserta',
            data: [<?php echo e($diklatStats['Lulus']); ?>, <?php echo e($diklatStats['Gagal']); ?>, <?php echo e($diklatStats['Aktif']); ?>],
            backgroundColor: ['#10b981','#ef4444','#06b6d4'],
            borderRadius: 8,
            barThickness: 40,
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: {
            y: { beginAtZero: true, ticks: { precision:0, color:'#94a3b8', font:{size:11} }, grid:{color:'#f1f5f9'} },
            x: { ticks: { color:'#94a3b8', font:{size:11} }, grid:{display:false} }
        }
    }
});

// ---- Placement Horizontal Bar Chart ----
const placCtx = document.getElementById('placementChart').getContext('2d');
new Chart(placCtx, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode(array_keys($placements)); ?>,
        datasets: [{
            label: 'ABK Ditempatkan',
            data: <?php echo json_encode(array_values($placements)); ?>,
            backgroundColor: '#6366f1',
            borderRadius: 6,
            barThickness: 24,
        }]
    },
    options: {
        indexAxis: 'y',
        responsive: true,
        plugins: { legend: { display: false } },
        scales: {
            x: { beginAtZero: true, ticks: { precision:0, color:'#94a3b8', font:{size:11} }, grid:{color:'#f1f5f9'} },
            y: { ticks: { color:'#334155', font:{size:11, weight:'600'} }, grid:{display:false} }
        }
    }
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\ptsamudrainapertiwi_sip\resources\views/dashboard/admin.blade.php ENDPATH**/ ?>