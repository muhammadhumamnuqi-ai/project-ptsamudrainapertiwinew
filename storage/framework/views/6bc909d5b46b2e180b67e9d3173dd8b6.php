<?php $__env->startSection('page_title', 'Edit Pengguna'); ?>
<?php $__env->startSection('page_subtitle', 'Perbarui informasi akun, role, dan status pengguna'); ?>

<?php $__env->startSection('page_actions'); ?>
<a href="<?php echo e(route('admin.users')); ?>" class="inline-flex items-center text-sm font-semibold text-slate-600 hover:text-slate-900 transition">
    <i class="fa-solid fa-arrow-left mr-2"></i> Kembali
</a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-2xl">
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-8">
        <?php if($errors->any()): ?>
        <div class="mb-6 bg-red-50 border border-red-200 text-red-700 p-4 rounded-xl text-xs space-y-1">
            <p class="font-bold"><i class="fa-solid fa-triangle-exclamation mr-1.5"></i>Terjadi kesalahan:</p>
            <ul class="list-disc list-inside"><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($e); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul>
        </div>
        <?php endif; ?>

        <div class="flex items-center space-x-4 mb-6 pb-6 border-b border-slate-100">
            <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-slate-800 to-slate-700 flex items-center justify-center text-white text-lg font-bold">
                <?php echo e(strtoupper(substr($user->name, 0, 2))); ?>

            </div>
            <div>
                <h3 class="font-bold text-slate-900"><?php echo e($user->name); ?></h3>
                <p class="text-xs text-slate-500"><?php echo e($user->email); ?> • Bergabung <?php echo e($user->created_at->format('d M Y')); ?></p>
            </div>
        </div>

        <form action="<?php echo e(route('admin.users.update', $user->id)); ?>" method="POST" class="space-y-5">
            <?php echo csrf_field(); ?>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-500 mb-1.5">Nama Lengkap</label>
                    <input type="text" name="name" required value="<?php echo e(old('name', $user->name)); ?>" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-500 mb-1.5">Alamat Email</label>
                    <input type="email" name="email" required value="<?php echo e(old('email', $user->email)); ?>" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-500 mb-1.5">Password Baru <span class="text-slate-400 font-normal">(kosongkan jika tidak diganti)</span></label>
                    <input type="password" name="password" placeholder="••••••••" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-500 mb-1.5">Role Pengguna</label>
                    <select name="role" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-blue-500">
                        <option value="abk" <?php echo e($user->role==='abk'?'selected':''); ?>>Calon ABK</option>
                        <option value="operator" <?php echo e($user->role==='operator'?'selected':''); ?>>Operator</option>
                        <option value="super_admin" <?php echo e($user->role==='super_admin'?'selected':''); ?>>Super Admin</option>
                    </select>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-xs font-bold uppercase text-slate-500 mb-1.5">Status Akun</label>
                    <select name="status_akun" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-blue-500">
                        <option value="aktif" <?php echo e($user->status_akun==='aktif'?'selected':''); ?>>Aktif</option>
                        <option value="nonaktif" <?php echo e($user->status_akun==='nonaktif'?'selected':''); ?>>Non-Aktif</option>
                    </select>
                </div>
            </div>
            <div class="flex items-center space-x-3 pt-4 border-t border-slate-100">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-6 py-2.5 rounded-xl text-sm shadow-lg shadow-blue-600/25 transition">
                    <i class="fa-solid fa-floppy-disk mr-2"></i>Simpan Perubahan
                </button>
                <a href="<?php echo e(route('admin.users')); ?>" class="text-sm font-medium text-slate-500 hover:text-slate-900 transition">Batal</a>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\ptsamudrainapertiwi_sip\resources\views/admin/users_edit.blade.php ENDPATH**/ ?>