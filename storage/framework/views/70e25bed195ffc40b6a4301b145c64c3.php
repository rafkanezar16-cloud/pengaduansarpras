<?php ($title = 'Detail Pengaduan'); ?>
<?php ($subtitle = $pengaduan->kode); ?>


<?php $__env->startSection('content'); ?>
<div class="anim-up max-w-3xl space-y-6">
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 sm:p-8">
        <div class="flex items-start justify-between mb-6">
            <div>
                <p class="text-xs text-slate-400 mb-1">Kode Pengaduan</p>
                <p class="text-lg font-bold text-slate-800"><?php echo e($pengaduan->kode); ?></p>
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
            <div>
                <dt class="text-slate-400 mb-1">Pelapor</dt>
                <dd class="font-semibold text-slate-800"><?php echo e($pengaduan->user->name); ?> <?php if($pengaduan->user->kelas): ?> &middot; <?php echo e($pengaduan->user->kelas); ?> <?php endif; ?></dd>
            </div>
            <div>
                <dt class="text-slate-400 mb-1">Kategori Kerusakan</dt>
                <dd class="font-semibold text-slate-800"><?php echo e($pengaduan->kategori->nama); ?></dd>
            </div>
            <div>
                <dt class="text-slate-400 mb-1">Lokasi</dt>
                <dd class="font-semibold text-slate-800"><?php echo e($pengaduan->lokasi_nama); ?></dd>
            </div>
            <div>
                <dt class="text-slate-400 mb-1">Tanggal Kejadian</dt>
                <dd class="font-semibold text-slate-800"><?php echo e($pengaduan->tanggal_kejadian->translatedFormat('d F Y')); ?></dd>
            </div>
            <div class="sm:col-span-2">
                <dt class="text-slate-400 mb-1">Deskripsi</dt>
                <dd class="text-slate-700 whitespace-pre-line"><?php echo e($pengaduan->deskripsi); ?></dd>
            </div>
            <div class="sm:col-span-2">
                <dt class="text-slate-400 mb-2">Bukti Foto / Video</dt>
                <dd><?php if (isset($component)) { $__componentOriginal1c22b137ff54ac95ecddc00a7423e147 = $component; } ?>
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
<?php endif; ?></dd>
            </div>
        </dl>
    </div>

    
    <?php if(in_array($pengaduan->status, ['diproses', 'selesai'])): ?>
        <div id="penugasan" class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 sm:p-8">
            <div class="flex items-start justify-between gap-3 mb-4">
                <h3 class="font-bold text-slate-800">Teknisi Penanggung Jawab</h3>
                <?php if($pengaduan->tahapPerbaikan()): ?>
                    <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-600"><?php echo e($pengaduan->tahapPerbaikan()); ?></span>
                <?php endif; ?>
            </div>

            <?php if($pengaduan->teknisi): ?>
                <div class="flex items-center gap-3 mb-1">
                    <div class="w-11 h-11 rounded-full bg-amber-50 text-amber-700 flex items-center justify-center"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'wrench','class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'wrench','class' => 'w-5 h-5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?></div>
                    <div>
                        <p class="font-semibold text-slate-800"><?php echo e($pengaduan->teknisi->name); ?></p>
                        <p class="text-xs text-slate-500">
                            <?php if($pengaduan->teknisi->no_hp): ?> <?php echo e($pengaduan->teknisi->no_hp); ?> &middot; <?php endif; ?>
                            Target selesai: <?php echo e($pengaduan->target_selesai?->translatedFormat('d F Y') ?? 'belum ditentukan'); ?>

                            <?php if($pengaduan->terlambat()): ?> <span class="text-red-600 font-semibold">(terlambat)</span> <?php endif; ?>
                        </p>
                    </div>
                </div>
            <?php elseif($pengaduan->status === 'diproses'): ?>
                <p class="text-sm text-amber-700 bg-amber-50 border border-amber-100 rounded-xl px-4 py-3">Belum ada teknisi yang ditugaskan untuk pengaduan ini.</p>
            <?php else: ?>
                <p class="text-sm text-slate-500">Pengaduan ini diselesaikan tanpa penugasan teknisi.</p>
            <?php endif; ?>

            <?php if($pengaduan->status === 'diproses'): ?>
                <form method="POST" action="<?php echo e(route('admin.pengaduan.teknisi', $pengaduan)); ?>" class="mt-5 pt-5 border-t border-slate-100 grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                    <div>
                        <label class="block text-xs font-semibold text-slate-500 mb-1"><?php echo e($pengaduan->teknisi ? 'Ganti teknisi' : 'Pilih teknisi'); ?></label>
                        <select name="teknisi_id" required class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 outline-none">
                            <option value="">-- Pilih teknisi --</option>
                            <?php $__currentLoopData = $teknisis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($t->id); ?>" <?php if($pengaduan->teknisi_id === $t->id): echo 'selected'; endif; ?>><?php echo e($t->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-500 mb-1">Target selesai</label>
                        <input type="date" name="target_selesai" min="<?php echo e(now()->format('Y-m-d')); ?>" value="<?php echo e($pengaduan->target_selesai?->format('Y-m-d')); ?>"
                               class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 outline-none">
                    </div>
                    <input type="text" name="catatan" maxlength="500" placeholder="Arahan untuk teknisi (opsional)"
                           class="sm:col-span-2 w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 outline-none">
                    <div class="sm:col-span-2">
                        <button type="submit" class="bg-brand-600 hover:bg-brand-700 transition text-white font-semibold px-6 py-2.5 rounded-xl shadow-lg shadow-brand-600/30">
                            <?php echo e($pengaduan->teknisi ? 'Simpan Penugasan' : 'Tugaskan Teknisi'); ?>

                        </button>
                    </div>
                </form>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    
    <?php if(in_array($pengaduan->status, ['diproses', 'selesai'])): ?>
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 sm:p-8">
            <h3 class="font-bold text-slate-800 mb-5">Riwayat Perbaikan</h3>
            <?php if (isset($component)) { $__componentOriginalfab2c70d05fa6c25398da6a88fa3455e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfab2c70d05fa6c25398da6a88fa3455e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.perbaikan-timeline','data' => ['pengaduan' => $pengaduan,'kosong' => 'Belum ada riwayat perbaikan. Tugaskan teknisi agar progres tercatat di sini.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('perbaikan-timeline'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['pengaduan' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($pengaduan),'kosong' => 'Belum ada riwayat perbaikan. Tugaskan teknisi agar progres tercatat di sini.']); ?>
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
    <?php endif; ?>

    <?php if($pengaduan->status === 'diajukan'): ?>
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 sm:p-8">
            <h3 class="font-bold text-slate-800 mb-1">Tindak Lanjut</h3>
            <p class="text-sm text-slate-500 mb-5">Terima pengaduan (sekaligus tugaskan teknisi) atau tolak dengan alasan.</p>
            <div class="flex flex-col sm:flex-row gap-3">
                <button type="button" data-modal="modal-terima" data-action="<?php echo e(route('admin.pengaduan.status', $pengaduan)); ?>" data-nama="<?php echo e($pengaduan->kode); ?>"
                        class="bg-brand-600 hover:bg-brand-700 transition text-white font-semibold px-6 py-2.5 rounded-xl shadow-lg shadow-brand-600/30">Terima &amp; Tugaskan</button>
                <button type="button" data-modal="modal-tolak" data-action="<?php echo e(route('admin.pengaduan.status', $pengaduan)); ?>" data-nama="<?php echo e($pengaduan->kode); ?>"
                        class="border border-red-200 text-red-600 hover:bg-red-50 transition font-semibold px-6 py-2.5 rounded-xl">Tolak Pengaduan</button>
            </div>
        </div>
    <?php elseif($pengaduan->status === 'diproses'): ?>
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 sm:p-8">
            <h3 class="font-bold text-slate-800 mb-1">Selesaikan Langsung</h3>
            <p class="text-sm text-slate-500 mb-4">Biasanya teknisi yang menandai selesai. Admin juga dapat menyelesaikan langsung bila perlu.</p>
            <form method="POST" action="<?php echo e(route('admin.pengaduan.status', $pengaduan)); ?>" class="space-y-3">
                <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                <input type="hidden" name="status" value="selesai">
                <textarea name="catatan_admin" rows="2" placeholder="Catatan penyelesaian (opsional)..."
                          class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 outline-none"><?php echo e($pengaduan->catatan_admin); ?></textarea>
                <button type="submit" class="bg-green-600 hover:bg-green-700 transition text-white font-semibold px-6 py-2.5 rounded-xl shadow-lg shadow-green-600/30">Tandai Selesai</button>
            </form>
        </div>
    <?php endif; ?>

    <?php if($pengaduan->catatan_admin && $pengaduan->status !== 'diproses'): ?>
        <div class="bg-white rounded-2xl shadow-sm border <?php echo e($pengaduan->status === 'ditolak' ? 'border-red-100' : 'border-slate-100'); ?> p-5 sm:p-8">
            <h3 class="font-bold text-slate-800 mb-2"><?php echo e($pengaduan->status === 'ditolak' ? 'Alasan Penolakan' : 'Catatan Admin'); ?></h3>
            <p class="text-slate-700 text-sm whitespace-pre-line"><?php echo e($pengaduan->catatan_admin); ?></p>
        </div>
    <?php endif; ?>

    <a href="<?php echo e(route('admin.pengaduan.index')); ?>" class="text-sm font-semibold text-brand-600 hover:underline">&larr; Kembali ke daftar</a>
</div>
<?php echo $__env->make('admin.pengaduan._modals', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AduinAja-Laravel-v6\resources\views/admin/pengaduan/show.blade.php ENDPATH**/ ?>