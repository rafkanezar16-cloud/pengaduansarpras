<?php ($title = 'Profil Saya'); ?>
<?php ($subtitle = 'Kelola informasi akun dan kata sandi Anda'); ?>


<?php $__env->startSection('content'); ?>
<div class="max-w-2xl space-y-6">

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 sm:p-8">
        <h3 class="font-bold text-slate-800 mb-1">Informasi Akun</h3>
        <p class="text-sm text-slate-500 mb-5">
            <?php if($user->dataTerkunci()): ?>
                Data diri dikelola oleh admin sekolah. Anda hanya dapat mengubah nomor HP.
            <?php else: ?>
                Perbarui nama, email, dan data kontak Anda.
            <?php endif; ?>
        </p>

        <form method="POST" action="<?php echo e(route('profile.update')); ?>" class="space-y-4">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <?php if($user->dataTerkunci()): ?>
                
                <?php ($kunci = 'w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-500 cursor-not-allowed'); ?>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Lengkap</label>
                    <input type="text" value="<?php echo e($user->name); ?>" readonly tabindex="-1" class="<?php echo e($kunci); ?>">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Email</label>
                    <input type="email" value="<?php echo e($user->email); ?>" readonly tabindex="-1" class="<?php echo e($kunci); ?>">
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5"><?php echo e($user->isSiswa() ? 'NIS' : 'NIP / ID Pegawai'); ?></label>
                        <input type="text" value="<?php echo e($user->nis_nip ?: '-'); ?>" readonly tabindex="-1" class="<?php echo e($kunci); ?>">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5"><?php echo e($user->isSiswa() ? 'Kelas' : 'Peran'); ?></label>
                        <input type="text" value="<?php echo e($user->isSiswa() ? ($user->kelas ?: '-') : $user->roleLabel()); ?>" readonly tabindex="-1" class="<?php echo e($kunci); ?>">
                    </div>
                </div>
                <p class="text-xs text-slate-400">Jika ada data yang salah, hubungi admin sekolah untuk memperbaikinya.</p>
            <?php else: ?>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Lengkap</label>
                    <input type="text" name="name" value="<?php echo e(old('name', $user->name)); ?>" required
                           class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Email</label>
                    <input type="email" name="email" value="<?php echo e(old('email', $user->email)); ?>" required
                           class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 outline-none">
                </div>
            <?php endif; ?>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">No. HP <?php if($user->dataTerkunci()): ?> <span class="font-normal text-brand-600">(dapat diubah)</span> <?php endif; ?></label>
                <input type="text" name="no_hp" value="<?php echo e(old('no_hp', $user->no_hp)); ?>" inputmode="tel" maxlength="20" placeholder="Contoh: 081234567890"
                       class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 outline-none">
            </div>
            <button type="submit" class="bg-brand-600 hover:bg-brand-700 text-white font-semibold px-6 py-2.5 rounded-xl shadow-lg shadow-brand-600/30">
                Simpan Perubahan
            </button>
        </form>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 sm:p-8">
        <h3 class="font-bold text-slate-800 mb-1">Ubah Kata Sandi</h3>
        <p class="text-sm text-slate-500 mb-5">Gunakan kata sandi yang kuat dan tidak dipakai di tempat lain.</p>

        <form method="POST" action="<?php echo e(route('profile.password')); ?>" class="space-y-4">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Kata Sandi Saat Ini</label>
                <input type="password" name="current_password" required
                       class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 outline-none">
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Kata Sandi Baru</label>
                <input type="password" name="password" required minlength="8"
                       class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 outline-none">
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Konfirmasi Kata Sandi Baru</label>
                <input type="password" name="password_confirmation" required minlength="8"
                       class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 outline-none">
            </div>
            <button type="submit" class="bg-brand-600 hover:bg-brand-700 text-white font-semibold px-6 py-2.5 rounded-xl shadow-lg shadow-brand-600/30">
                Perbarui Kata Sandi
            </button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AduinAja-Laravel-v6\resources\views/profile/edit.blade.php ENDPATH**/ ?>