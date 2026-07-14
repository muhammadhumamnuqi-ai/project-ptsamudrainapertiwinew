<?php $__env->startSection('page_title', 'Tambah Pengguna Baru'); ?>
<?php $__env->startSection('page_subtitle', 'Buat akun operator, calon ABK, atau administrator sistem'); ?>

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

        <form action="<?php echo e(route('admin.users.store')); ?>" method="POST" class="space-y-5">
            <?php echo csrf_field(); ?>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-500 mb-1.5">Nama Lengkap</label>
                    <input type="text" name="name" required value="<?php echo e(old('name')); ?>" placeholder="Ahmad Budi" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-500 mb-1.5">Alamat Email</label>
                    <input type="email" name="email" required value="<?php echo e(old('email')); ?>" placeholder="email@domain.com" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-500 mb-1.5">Password</label>
                    <input type="password" name="password" required placeholder="Minimal 6 karakter" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-500 mb-1.5">Role Pengguna</label>
                    <select name="role" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-blue-500">
                        <option value="abk" <?php echo e(old('role')==='abk'?'selected':''); ?>>Calon ABK</option>
                        <option value="operator" <?php echo e(old('role')==='operator'?'selected':''); ?>>Operator</option>
                        <option value="super_admin" <?php echo e(old('role')==='super_admin'?'selected':''); ?>>Super Admin</option>
                    </select>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-xs font-bold uppercase text-slate-500 mb-1.5">Status Akun</label>
                    <select name="status_akun" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-blue-500">
                        <option value="aktif">Aktif</option>
                        <option value="nonaktif">Non-Aktif</option>
                    </select>
                </div>
            </div>
            <div class="flex items-center space-x-3 pt-4 border-t border-slate-100">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-6 py-2.5 rounded-xl text-sm shadow-lg shadow-blue-600/25 transition">
                    <i class="fa-solid fa-user-plus mr-2"></i>Tambahkan Pengguna
                </button>
                <a href="<?php echo e(route('admin.users')); ?>" class="text-sm font-medium text-slate-500 hover:text-slate-900 transition">Batal</a>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\ptsamudrainapertiwi_sip\resources\views/admin/users_create.blade.php ENDPATH**/ ?>