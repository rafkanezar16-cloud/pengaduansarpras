<?php ($title = 'Riwayat Pengaduan'); ?>
<?php ($subtitle = 'Daftar seluruh pengaduan yang pernah Anda ajukan'); ?>


<?php $__env->startSection('content'); ?>
<div class="anim-up bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <?php if($pengaduans->isEmpty()): ?>
        <div class="px-6 py-14 text-center text-slate-400 text-sm">
            Belum ada riwayat pengaduan.
            <a href="<?php echo e(route('siswa.pengaduan.create')); ?>" class="text-brand-600 font-semibold hover:underline">Ajukan sekarang &rarr;</a>
            <span class="mx-1">&middot;</span><a href="<?php echo e(route('siswa.panduan')); ?>" class="text-brand-600 font-semibold hover:underline">Lihat panduan</a>
        </div>
    <?php else: ?>
        
        <div class="md:hidden divide-y divide-slate-100">
            <?php $__currentLoopData = $pengaduans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('siswa.pengaduan.show', $item)); ?>" class="block px-4 py-4 hover:bg-slate-50">
                    <div class="flex items-start justify-between gap-3">
                        <p class="text-xs font-semibold text-brand-600"><?php echo e($item->kode); ?></p>
                        <?php if (isset($component)) { $__componentOriginal8c81617a70e11bcf247c4db924ab1b62 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8c81617a70e11bcf247c4db924ab1b62 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.status-badge','data' => ['status' => $item->status,'label' => $item->statusLabel()]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('status-badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item->status),'label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item->statusLabel())]); ?>
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
                    <p class="font-semibold text-slate-800 mt-1.5"><?php echo e($item->kategori->nama); ?></p>
                    <p class="text-sm text-slate-500"><?php echo e($item->lokasi_nama); ?> &middot; <?php echo e($item->tanggal_kejadian->translatedFormat('d M Y')); ?></p>
                    <?php if($item->foto || $item->video): ?>
                        <p class="text-xs text-slate-400 mt-1.5 inline-flex items-center gap-1">
                            <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'photo','class' => 'w-3.5 h-3.5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'photo','class' => 'w-3.5 h-3.5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?> <?php echo e($item->foto ? 'Foto' : ''); ?><?php echo e($item->foto && $item->video ? ' + ' : ''); ?><?php echo e($item->video ? 'Video' : ''); ?>

                        </p>
                    <?php endif; ?>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50 text-slate-500">
                    <tr>
                        <th class="text-left font-medium px-6 py-3">Kode</th>
                        <th class="text-left font-medium px-6 py-3">Tanggal</th>
                        <th class="text-left font-medium px-6 py-3">Kategori / Lokasi</th>
                        <th class="text-left font-medium px-6 py-3">Bukti</th>
                        <th class="text-right font-medium px-6 py-3">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <?php $__currentLoopData = $pengaduans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4"><a href="<?php echo e(route('siswa.pengaduan.show', $item)); ?>" class="font-semibold text-brand-600 hover:underline"><?php echo e($item->kode); ?></a></td>
                            <td class="px-6 py-4 text-slate-600"><?php echo e($item->tanggal_kejadian->translatedFormat('d M Y')); ?></td>
                            <td class="px-6 py-4 text-slate-800 font-medium"><?php echo e($item->kategori->nama); ?> <span class="text-slate-400 font-normal">&middot; <?php echo e($item->lokasi_nama); ?></span></td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <?php if($item->foto): ?>
                                        <button type="button" data-lightbox="<?php echo e(asset($item->foto)); ?>" data-type="image" aria-label="Perbesar foto">
                                            <img src="<?php echo e(asset($item->foto)); ?>" alt="" loading="lazy" class="w-10 h-10 rounded-lg object-cover border border-slate-200">
                                        </button>
                                    <?php endif; ?>
                                    <?php if($item->video): ?>
                                        <button type="button" data-lightbox="<?php echo e(asset($item->video)); ?>" data-type="video" aria-label="Putar video"
                                                class="w-10 h-10 rounded-lg bg-slate-100 text-slate-500 hover:bg-brand-50 hover:text-brand-600 flex items-center justify-center">
                                            <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'video','class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'video','class' => 'w-5 h-5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
                                        </button>
                                    <?php endif; ?>
                                    <?php if (! ($item->foto || $item->video)): ?> <span class="text-slate-300">-</span> <?php endif; ?>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right"><?php if (isset($component)) { $__componentOriginal8c81617a70e11bcf247c4db924ab1b62 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8c81617a70e11bcf247c4db924ab1b62 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.status-badge','data' => ['status' => $item->status,'label' => $item->statusLabel()]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('status-badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item->status),'label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item->statusLabel())]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8c81617a70e11bcf247c4db924ab1b62)): ?>
<?php $attributes = $__attributesOriginal8c81617a70e11bcf247c4db924ab1b62; ?>
<?php unset($__attributesOriginal8c81617a70e11bcf247c4db924ab1b62); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8c81617a70e11bcf247c4db924ab1b62)): ?>
<?php $component = $__componentOriginal8c81617a70e11bcf247c4db924ab1b62; ?>
<?php unset($__componentOriginal8c81617a70e11bcf247c4db924ab1b62); ?>
<?php endif; ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        <div class="px-4 sm:px-6 py-4 border-t border-slate-100"><?php echo e($pengaduans->links()); ?></div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AduinAja-Laravel-v6\resources\views/siswa/pengaduan/index.blade.php ENDPATH**/ ?>