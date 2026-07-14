<?php $__env->startSection('page_title', 'Log Aktivitas Sistem'); ?>
<?php $__env->startSection('page_subtitle', 'Rekam jejak audit trail (Audit Log) seluruh aktivitas pengguna dalam sistem'); ?>

<?php $__env->startSection('page_actions'); ?>
<a href="<?php echo e(route('dashboard.admin')); ?>" class="inline-flex items-center text-sm font-semibold text-slate-600 hover:text-slate-900 transition">
    <i class="fa-solid fa-arrow-left mr-2"></i> Kembali ke Dashboard
</a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
    
    
    <div class="p-6 border-b border-slate-100 flex flex-col md:flex-row md:items-end justify-between gap-4 bg-slate-50/50">
        <form method="GET" action="<?php echo e(route('admin.logs')); ?>" class="flex flex-col md:flex-row items-end gap-3 w-full md:w-auto">
            <div>
                <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Tanggal Mulai</label>
                <input type="date" name="start_date" value="<?php echo e(request('start_date')); ?>" class="w-full md:w-auto bg-white border border-slate-300 rounded-xl px-3 py-2 text-xs focus:outline-none focus:border-blue-500">
            </div>
            <div>
                <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Tanggal Akhir</label>
                <input type="date" name="end_date" value="<?php echo e(request('end_date')); ?>" class="w-full md:w-auto bg-white border border-slate-300 rounded-xl px-3 py-2 text-xs focus:outline-none focus:border-blue-500">
            </div>
            <div>
                <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Pencarian</label>
                <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Cari aktivitas atau nama..." class="w-full md:w-auto bg-white border border-slate-300 rounded-xl px-3 py-2 text-xs focus:outline-none focus:border-blue-500">
            </div>
            <button type="submit" class="bg-slate-900 hover:bg-slate-800 text-white font-bold px-4 py-2 rounded-xl text-xs shadow-lg transition">Filter</button>
            <?php if(request()->hasAny(['start_date','end_date','search'])): ?>
                <a href="<?php echo e(route('admin.logs')); ?>" class="text-xs font-semibold text-red-600 hover:underline px-2 py-2">Reset</a>
            <?php endif; ?>
        </form>
    </div>

    
    <div class="divide-y divide-slate-100">
        <?php $__empty_1 = true; $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="p-5 hover:bg-slate-50 transition flex items-start space-x-4">
            <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 flex-shrink-0 mt-0.5">
                <i class="fa-solid fa-clock-rotate-left"></i>
            </div>
            <div class="min-w-0 flex-1">
                <p class="text-sm text-slate-800 leading-relaxed">
                    <strong class="font-bold text-slate-900"><?php echo e($log->user ? $log->user->name : 'Sistem'); ?></strong> 
                    <span class="px-1.5 py-0.5 rounded text-[9px] font-bold uppercase tracking-wide bg-slate-200 text-slate-600 ml-1 mr-1">
                        <?php echo e($log->user ? $log->user->role : 'Sistem'); ?>

                    </span>
                    — <?php echo e($log->aktivitas); ?>

                </p>
                <div class="mt-1 flex items-center text-xs text-slate-500 space-x-4">
                    <span><i class="fa-regular fa-calendar mr-1"></i><?php echo e($log->created_at->format('d M Y, H:i')); ?></span>
                    <span><i class="fa-solid fa-globe mr-1"></i><?php echo e($log->ip_address ?: 'Unknown IP'); ?></span>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="p-10 text-center text-slate-500">
            <i class="fa-solid fa-inbox text-3xl mb-3 text-slate-300"></i>
            <p class="text-sm font-semibold">Belum ada log aktivitas yang ditemukan.</p>
        </div>
        <?php endif; ?>
    </div>
    
    
    <div class="p-4 border-t border-slate-100 bg-slate-50/50">
        <?php echo e($logs->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\ptsamudrainapertiwi_sip\resources\views/admin/logs.blade.php ENDPATH**/ ?>