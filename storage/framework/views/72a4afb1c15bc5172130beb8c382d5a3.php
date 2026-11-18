<?php if($item->status === 'diajukan'): ?>
    <button type="button" data-modal="modal-terima" data-action="<?php echo e(route('admin.pengaduan.status', $item)); ?>" data-nama="<?php echo e($item->kode); ?>"
            class="px-3 py-1.5 rounded-lg border border-brand-200 text-brand-600 text-xs font-semibold hover:bg-brand-50">Terima</button>
    <button type="button" data-modal="modal-tolak" data-action="<?php echo e(route('admin.pengaduan.status', $item)); ?>" data-nama="<?php echo e($item->kode); ?>"
            class="px-3 py-1.5 rounded-lg border border-red-200 text-red-600 text-xs font-semibold hover:bg-red-50">Tolak</button>
<?php elseif($item->status === 'diproses'): ?>
    <?php if(! $item->teknisi_id): ?>
        <a href="<?php echo e(route('admin.pengaduan.show', $item)); ?>#penugasan" class="px-3 py-1.5 rounded-lg border border-amber-200 text-amber-700 text-xs font-semibold hover:bg-amber-50">Tugaskan</a>
    <?php endif; ?>
    <form method="POST" action="<?php echo e(route('admin.pengaduan.status', $item)); ?>">
        <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
        <input type="hidden" name="status" value="selesai">
        <button class="px-3 py-1.5 rounded-lg border border-green-200 text-green-600 text-xs font-semibold hover:bg-green-50">Selesaikan</button>
    </form>
<?php endif; ?>
<a href="<?php echo e(route('admin.pengaduan.show', $item)); ?>" class="px-3 py-1.5 rounded-lg border border-slate-200 text-slate-600 text-xs font-semibold hover:bg-slate-50">Lihat</a>
<?php /**PATH C:\xampp\htdocs\AduinAja-Laravel-v6\resources\views/admin/pengaduan/_actions.blade.php ENDPATH**/ ?>