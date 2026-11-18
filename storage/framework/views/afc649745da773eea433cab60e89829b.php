<?php
$tabs = [
    'kategori' => ['label' => 'Kategori Kerusakan', 'route' => 'admin.kategori.index'],
    'lokasi' => ['label' => 'Lokasi / Ruangan', 'route' => 'admin.lokasi.index'],
    'user' => ['label' => 'Data Pengguna', 'route' => 'admin.user.index'],
];
?>
<div class="flex gap-5 sm:gap-6 border-b border-slate-200 mb-6 overflow-x-auto whitespace-nowrap">
    <?php $__currentLoopData = $tabs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a href="<?php echo e(route($tab['route'])); ?>"
           class="pb-3 text-sm font-semibold border-b-2 -mb-px transition
                  <?php echo e($active === $key ? 'border-brand-600 text-slate-900' : 'border-transparent text-slate-400 hover:text-slate-600'); ?>">
            <?php echo e($tab['label']); ?>

        </a>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php /**PATH C:\xampp\htdocs\AduinAja-Laravel-v6\resources\views/admin/partials/master-tabs.blade.php ENDPATH**/ ?>