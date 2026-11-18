<?php ($title = 'Detail Tugas'); ?>
<?php ($subtitle = $pengaduan->kode); ?>


<?php $__env->startSection('content'); ?>
<?php ($inp = 'w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:border-brand-500 outline-none'); ?>
<div class="grid grid-cols-1 xl:grid-cols-5 gap-5 sm:gap-6 items-start">

    
    <div class="xl:col-span-3 space-y-5 sm:space-y-6">
        <div class="anim-up bg-white rounded-2xl shadow-sm border border-slate-100 p-5 sm:p-8">
            <div class="flex items-start justify-between gap-3 mb-6">
                <div class="min-w-0">
                    <p class="text-xs text-slate-400 mb-1">Kode Pengaduan</p>
                    <p class="text-lg font-bold text-slate-800 break-all"><?php echo e($pengaduan->kode); ?></p>
                </div>
                <?php if (isset($component)) { $__componentOriginal8c81617a70e11bcf247c4db924ab1b62 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8c81617a70e11bcf247c4db924ab1b62 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.status-badge','data' => ['status' => $pengaduan->status,'label' => $pengaduan->statusLabel()]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('status-badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($pengaduan->status),'label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($pengaduan->statusLabel())]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8c81617a70e11bcf247c4db924ab1b62)): ?>
<?php $attributes = $__attributesOriginal8c81617a70e11bcf247c4db924ab1b62; ?>
<?php unset($__attributesOriginal8c81617a70e11bcf247c4db924ab1b62); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8c81617a70e11bcf247c4db924ab1b62)): ?>
<?php $component = $__componentOriginal8c81617a70e11bcf247c4db924ab1b62; ?>
<?php unset($__componentOriginal8c81617a70e11bcf247c4db924ab1b62); ?>
<?php endif; ?>
            </div>
            <dl class="grid grid-cols-1 sm:grid-cols-2 gap-5 text-sm">
                <div><dt class="text-slate-400 mb-1">Kategori Kerusakan</dt><dd class="font-semibold text-slate-800"><?php echo e($pengaduan->kategori->nama); ?></dd></div>
                <div><dt class="text-slate-400 mb-1">Lokasi</dt><dd class="font-semibold text-slate-800"><?php echo e($pengaduan->lokasi_nama); ?></dd></div>
                <div><dt class="text-slate-400 mb-1">Pelapor</dt><dd class="font-semibold text-slate-800"><?php echo e($pengaduan->user->name); ?><?php if($pengaduan->user->kelas): ?> &middot; <?php echo e($pengaduan->user->kelas); ?><?php endif; ?></dd></div>
                <div>
                    <dt class="text-slate-400 mb-1">Target Selesai</dt>
                    <dd class="font-semibold <?php echo e($pengaduan->terlambat() ? 'text-red-600' : 'text-slate-800'); ?>">
                        <?php echo e($pengaduan->target_selesai?->translatedFormat('d F Y') ?? 'Tidak ditentukan'); ?><?php if($pengaduan->terlambat()): ?> <span class="text-xs">(terlambat)</span><?php endif; ?>
                    </dd>
                </div>
                <div class="sm:col-span-2"><dt class="text-slate-400 mb-1">Deskripsi Kerusakan</dt><dd class="text-slate-700 whitespace-pre-line"><?php echo e($pengaduan->deskripsi); ?></dd></div>
                <?php if($pengaduan->catatan_admin): ?>
                    <div class="sm:col-span-2 bg-slate-50 rounded-xl p-4 border border-slate-100">
                        <dt class="text-slate-400 mb-1">Catatan dari Admin</dt>
                        <dd class="text-slate-700"><?php echo e($pengaduan->catatan_admin); ?></dd>
                    </div>
                <?php endif; ?>
                <div class="sm:col-span-2"><dt class="text-slate-400 mb-2">Bukti dari Pelapor</dt><dd><?php if (isset($component)) { $__componentOriginal1c22b137ff54ac95ecddc00a7423e147 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1c22b137ff54ac95ecddc00a7423e147 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.media-evidence','data' => ['pengaduan' => $pengaduan]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('media-evidence'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['pengaduan' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($pengaduan)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal1c22b137ff54ac95ecddc00a7423e147)): ?>
<?php $attributes = $__attributesOriginal1c22b137ff54ac95ecddc00a7423e147; ?>
<?php unset($__attributesOriginal1c22b137ff54ac95ecddc00a7423e147); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1c22b137ff54ac95ecddc00a7423e147)): ?>
<?php $component = $__componentOriginal1c22b137ff54ac95ecddc00a7423e147; ?>
<?php unset($__componentOriginal1c22b137ff54ac95ecddc00a7423e147); ?>
<?php endif; ?></dd></div>
            </dl>
        </div>

        <div class="anim-up d2 bg-white rounded-2xl shadow-sm border border-slate-100 p-5 sm:p-8">
            <h3 class="font-bold text-slate-800 mb-5">Riwayat Perbaikan</h3>
            <?php if (isset($component)) { $__componentOriginalfab2c70d05fa6c25398da6a88fa3455e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfab2c70d05fa6c25398da6a88fa3455e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.perbaikan-timeline','data' => ['pengaduan' => $pengaduan]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('perbaikan-timeline'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['pengaduan' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($pengaduan)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfab2c70d05fa6c25398da6a88fa3455e)): ?>
<?php $attributes = $__attributesOriginalfab2c70d05fa6c25398da6a88fa3455e; ?>
<?php unset($__attributesOriginalfab2c70d05fa6c25398da6a88fa3455e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfab2c70d05fa6c25398da6a88fa3455e)): ?>
<?php $component = $__componentOriginalfab2c70d05fa6c25398da6a88fa3455e; ?>
<?php unset($__componentOriginalfab2c70d05fa6c25398da6a88fa3455e); ?>
<?php endif; ?>
        </div>
    </div>

    
    <div class="xl:col-span-2 space-y-5 sm:space-y-6">
        <?php if($aktif): ?>
            <?php if (! ($sudahMulai)): ?>
                <div class="anim-up d2 bg-white rounded-2xl shadow-sm border border-slate-100 p-5 sm:p-6">
                    <h3 class="font-bold text-slate-800 mb-1">Mulai Mengerjakan</h3>
                    <p class="text-sm text-slate-500 mb-4">Tandai bahwa Anda sudah mulai memeriksa dan memperbaiki. Pelapor dan admin dapat melihat progresnya.</p>
                    <form method="POST" action="<?php echo e(route('teknisi.tugas.mulai', $pengaduan)); ?>">
                        <?php echo csrf_field(); ?>
                        <button class="w-full bg-brand-600 hover:bg-brand-700 transition text-white font-semibold py-2.5 rounded-xl shadow-lg shadow-brand-600/30">Mulai Dikerjakan</button>
                    </form>
                </div>
            <?php endif; ?>

            <div class="anim-up d3 bg-white rounded-2xl shadow-sm border border-slate-100 p-5 sm:p-6">
                <h3 class="font-bold text-slate-800 mb-1">Tambah Catatan Progres</h3>
                <p class="text-sm text-slate-500 mb-4">Catat temuan, langkah yang dilakukan, atau kendala. Tersimpan di riwayat perbaikan.</p>
                <form method="POST" action="<?php echo e(route('teknisi.tugas.catatan', $pengaduan)); ?>" enctype="multipart/form-data" class="space-y-3">
                    <?php echo csrf_field(); ?>
                    <textarea name="catatan" rows="3" required minlength="5" placeholder="Contoh: kabel sudah diganti, tinggal pengujian." class="<?php echo e($inp); ?>"><?php echo e(old('catatan')); ?></textarea>
                    <input type="text" name="bahan" maxlength="150" value="<?php echo e(old('bahan')); ?>" placeholder="Bahan / suku cadang dipakai (opsional)" class="<?php echo e($inp); ?>">
                    <label class="block text-xs font-semibold text-slate-500">Foto progres (opsional, maks. 2 MB)
                        <input type="file" name="foto" accept="image/*" class="mt-1 block w-full text-sm text-slate-500 file:mr-3 file:rounded-lg file:border-0 file:bg-brand-50 file:text-brand-700 file:font-semibold file:px-3 file:py-2 hover:file:bg-brand-100">
                    </label>
                    <button class="w-full border border-brand-200 text-brand-700 hover:bg-brand-50 transition font-semibold py-2.5 rounded-xl">Simpan Catatan</button>
                </form>
            </div>

            <div class="anim-up d4 bg-white rounded-2xl shadow-sm border border-green-100 p-5 sm:p-6">
                <h3 class="font-bold text-slate-800 mb-1">Tandai Selesai Diperbaiki</h3>
                <p class="text-sm text-slate-500 mb-4">Status pengaduan otomatis menjadi <strong>Selesai</strong> dan pelapor dapat melihat hasilnya.</p>
                <form method="POST" action="<?php echo e(route('teknisi.tugas.selesai', $pengaduan)); ?>" enctype="multipart/form-data" class="space-y-3">
                    <?php echo csrf_field(); ?>
                    <textarea name="catatan" rows="3" required minlength="5" placeholder="Ringkasan hasil perbaikan..." class="<?php echo e($inp); ?>"></textarea>
                    <input type="text" name="bahan" maxlength="150" placeholder="Bahan / suku cadang dipakai (opsional)" class="<?php echo e($inp); ?>">
                    <label class="block text-xs font-semibold text-slate-500">Foto hasil perbaikan (opsional, maks. 2 MB)
                        <input type="file" name="foto" accept="image/*" class="mt-1 block w-full text-sm text-slate-500 file:mr-3 file:rounded-lg file:border-0 file:bg-green-50 file:text-green-700 file:font-semibold file:px-3 file:py-2 hover:file:bg-green-100">
                    </label>
                    <button class="w-full bg-green-600 hover:bg-green-700 transition text-white font-semibold py-2.5 rounded-xl shadow-lg shadow-green-600/30">Tandai Selesai</button>
                </form>
            </div>

            <div class="anim-up d5 bg-white rounded-2xl shadow-sm border border-slate-100 p-5 sm:p-6">
                <h3 class="font-bold text-slate-800 mb-1">Tidak Bisa Menangani?</h3>
                <p class="text-sm text-slate-500 mb-4">Kembalikan ke admin dengan alasan (misalnya perlu vendor atau suku cadang khusus).</p>
                <form method="POST" action="<?php echo e(route('teknisi.tugas.kembalikan', $pengaduan)); ?>" class="space-y-3"
                      onsubmit="return confirm('Kembalikan tugas ini ke admin?')">
                    <?php echo csrf_field(); ?>
                    <textarea name="catatan" rows="2" required minlength="5" placeholder="Alasan pengembalian tugas..." class="<?php echo e($inp); ?>"></textarea>
                    <button class="w-full border border-red-200 text-red-600 hover:bg-red-50 transition font-semibold py-2.5 rounded-xl">Kembalikan ke Admin</button>
                </form>
            </div>
        <?php else: ?>
            <div class="anim-up bg-green-50 border border-green-200 text-green-800 rounded-2xl p-5 sm:p-6 text-sm">
                <p class="font-bold mb-1">Perbaikan selesai</p>
                <p>Tugas ini sudah ditandai selesai<?php echo e($pengaduan->selesai_at ? ' pada '.$pengaduan->selesai_at->translatedFormat('d F Y, H:i') : ''); ?>. Riwayatnya tersimpan dan dapat dilihat kapan saja.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<a href="<?php echo e(route('teknisi.tugas.index')); ?>" class="inline-block mt-6 text-sm font-semibold text-brand-600 hover:underline">&larr; Kembali ke daftar tugas</a>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AduinAja-Laravel-v6\resources\views/teknisi/tugas/show.blade.php ENDPATH**/ ?>