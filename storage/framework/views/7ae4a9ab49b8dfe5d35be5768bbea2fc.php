<?php ($title = 'Riwayat Perbaikan'); ?>
<?php ($subtitle = 'Seluruh catatan perbaikan yang pernah Anda simpan'); ?>


<?php $__env->startSection('content'); ?>
<div class="anim-up bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <div class="px-4 sm:px-6 py-4 border-b border-slate-100">
        <form method="GET" class="flex flex-col sm:flex-row gap-2">
            <select name="jenis" onchange="this.form.submit()" class="px-3 py-2 rounded-lg border border-slate-200 text-sm focus:ring-2 focus:ring-brand-500 outline-none">
                <option value="">Semua jenis catatan</option>
                <?php $__currentLoopData = \App\Models\Perbaikan::JENIS; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($k); ?>" <?php if(request('jenis') === $k): echo 'selected'; endif; ?>><?php echo e($j['label']); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </form>
    </div>

    <?php if($riwayat->isEmpty()): ?>
        <div class="px-6 py-14 text-center text-slate-400 text-sm">Belum ada riwayat perbaikan.</div>
    <?php else: ?>
        <div class="divide-y divide-slate-100">
            <?php $__currentLoopData = $riwayat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="px-4 sm:px-6 py-4 flex gap-4">
                    <span class="mt-1.5 w-3 h-3 rounded-full shrink-0 <?php echo e($log->dotClass()); ?>"></span>
                    <div class="min-w-0 flex-1">
                        <div class="flex flex-wrap items-center gap-x-2 gap-y-1">
                            <span class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-semibold <?php echo e($log->chipClass()); ?>"><?php echo e($log->label()); ?></span>
                            <a href="<?php echo e(route('teknisi.tugas.show', $log->pengaduan)); ?>" class="text-sm font-semibold text-slate-800 hover:text-brand-600"><?php echo e($log->pengaduan->kategori->nama); ?> &middot; <?php echo e($log->pengaduan->lokasi_nama); ?></a>
                        </div>
                        <p class="text-xs text-slate-400 mt-0.5"><?php echo e($log->pengaduan->kode); ?> &middot; <?php echo e($log->created_at->translatedFormat('d M Y, H:i')); ?></p>
                        <?php if($log->catatan): ?> <p class="text-sm text-slate-600 mt-1.5 whitespace-pre-line"><?php echo e($log->catatan); ?></p> <?php endif; ?>
                        <?php if($log->bahan): ?> <p class="text-xs text-slate-500 mt-1"><span class="font-semibold">Bahan:</span> <?php echo e($log->bahan); ?></p> <?php endif; ?>
                    </div>
                    <?php if($log->foto): ?>
                        <button type="button" data-lightbox="<?php echo e(asset($log->foto)); ?>" data-type="image" class="shrink-0" aria-label="Perbesar foto">
                            <img src="<?php echo e(asset($log->foto)); ?>" alt="" loading="lazy" class="w-16 h-16 rounded-lg object-cover border border-slate-200">
                        </button>
                    <?php endif; ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="px-4 sm:px-6 py-4 border-t border-slate-100"><?php echo e($riwayat->links()); ?></div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AduinAja-Laravel-v6\resources\views/teknisi/riwayat.blade.php ENDPATH**/ ?>