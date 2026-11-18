<?php ($title = 'Panduan Mengadu'); ?>
<?php ($subtitle = 'Cara melaporkan kerusakan sarana & prasarana sekolah'); ?>


<?php $__env->startSection('content'); ?>
<div class="max-w-4xl space-y-6 sm:space-y-8">

    
    <div class="anim-up relative overflow-hidden rounded-2xl bg-gradient-to-br from-brand-700 to-brand-900 text-white p-6 sm:p-8">
        <div class="absolute -right-10 -top-10 w-48 h-48 rounded-full bg-white/10 blur-2xl pointer-events-none"></div>
        <p class="text-xs font-bold uppercase tracking-wider text-amber-300">Panduan Siswa</p>
        <h2 class="mt-2 text-2xl sm:text-3xl font-extrabold leading-tight">Mengadu itu mudah, cukup 4 langkah.</h2>
        <p class="mt-3 text-brand-100/90 text-sm sm:text-base max-w-xl">
            Lihat kerusakan di sekolah? Laporkan lewat <?php echo e(\App\Models\Pengaturan::semua()['nama_aplikasi']); ?> dengan foto, lalu pantau sendiri
            sampai teknisi menyelesaikannya. Perkiraan waktu mengisi form: <strong>kurang dari 2 menit</strong>.
        </p>
        <div class="mt-5 flex flex-wrap gap-3">
            <a href="<?php echo e(route('siswa.pengaduan.create')); ?>" class="inline-flex items-center gap-2 rounded-full bg-amber-400 hover:bg-amber-300 text-brand-950 font-bold px-5 py-2.5 text-sm transition">
                <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'plus','class' => 'w-4 h-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'plus','class' => 'w-4 h-4']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?> Mulai Mengadu
            </a>
            <a href="#faq" class="inline-flex items-center rounded-full border border-white/30 hover:bg-white/10 font-semibold px-5 py-2.5 text-sm transition">Ada pertanyaan?</a>
        </div>
    </div>

    
    <section>
        <h3 class="text-lg font-bold text-slate-800 mb-4">Langkah-langkah</h3>
        <ol class="space-y-4">

            
            <li class="anim-up bg-white rounded-2xl border border-slate-100 shadow-sm p-5 sm:p-6 flex gap-4">
                <span class="shrink-0 w-9 h-9 rounded-full bg-brand-600 text-white font-extrabold flex items-center justify-center">1</span>
                <div class="min-w-0 flex-1">
                    <h4 class="font-bold text-slate-800">Buka menu &ldquo;Ajukan Pengaduan&rdquo;</h4>
                    <p class="text-sm text-slate-600 mt-1">Klik <strong>Ajukan Pengaduan</strong> di menu samping (di HP, ketuk ikon <span class="inline-block align-middle"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'menu','class' => 'w-4 h-4 inline']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'menu','class' => 'w-4 h-4 inline']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?></span> di kiri atas lebih dulu), atau tombol <em>Ajukan Pengaduan Baru</em> di Dashboard.</p>
                </div>
            </li>

            
            <li class="anim-up bg-white rounded-2xl border border-slate-100 shadow-sm p-5 sm:p-6 flex gap-4">
                <span class="shrink-0 w-9 h-9 rounded-full bg-brand-600 text-white font-extrabold flex items-center justify-center">2</span>
                <div class="min-w-0 flex-1">
                    <h4 class="font-bold text-slate-800">Isi data kerusakan</h4>
                    <div class="mt-3 overflow-x-auto">
                        <table class="w-full text-sm">
                            <tbody class="divide-y divide-slate-100">
                                <tr><td class="py-2 pr-4 font-semibold text-slate-700 whitespace-nowrap align-top">Kategori</td><td class="py-2 text-slate-600">Pilih jenis kerusakan yang paling cocok.</td></tr>
                                <tr><td class="py-2 pr-4 font-semibold text-slate-700 whitespace-nowrap align-top">Lokasi</td><td class="py-2 text-slate-600">Pilih ruangan. Kalau tidak ada di daftar, pilih <em>Lainnya</em> lalu ketik nama tempatnya.</td></tr>
                                <tr><td class="py-2 pr-4 font-semibold text-slate-700 whitespace-nowrap align-top">Tanggal</td><td class="py-2 text-slate-600">Kapan kerusakan terjadi atau ditemukan.</td></tr>
                                <tr><td class="py-2 pr-4 font-semibold text-slate-700 whitespace-nowrap align-top">Deskripsi</td><td class="py-2 text-slate-600">Ceritakan apa yang rusak dan bagaimana kondisinya (minimal 10 huruf).</td></tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div class="rounded-xl bg-green-50 border border-green-200 p-4">
                            <p class="text-xs font-bold text-green-700 uppercase tracking-wide flex items-center gap-1.5"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'check','class' => 'w-4 h-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'check','class' => 'w-4 h-4']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?> Deskripsi yang baik</p>
                            <p class="text-sm text-green-900 mt-1.5">&ldquo;Keran wastafel di toilet putra lantai 1 bocor terus-menerus sejak Senin, air menggenang di lantai.&rdquo;</p>
                        </div>
                        <div class="rounded-xl bg-red-50 border border-red-200 p-4">
                            <p class="text-xs font-bold text-red-700 uppercase tracking-wide flex items-center gap-1.5"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'x','class' => 'w-4 h-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'x','class' => 'w-4 h-4']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?> Kurang jelas</p>
                            <p class="text-sm text-red-900 mt-1.5">&ldquo;Rusak.&rdquo; &mdash; tidak tahu apa, di mana, dan sejak kapan.</p>
                        </div>
                    </div>
                    <p class="text-xs text-slate-500 mt-3">Tips: sebut <strong>apa</strong> yang rusak, <strong>di mana</strong> tepatnya, dan <strong>seberapa parah</strong>.</p>
                </div>
            </li>

            
            <li class="anim-up bg-white rounded-2xl border border-slate-100 shadow-sm p-5 sm:p-6 flex gap-4">
                <span class="shrink-0 w-9 h-9 rounded-full bg-brand-600 text-white font-extrabold flex items-center justify-center">3</span>
                <div class="min-w-0 flex-1">
                    <h4 class="font-bold text-slate-800">Unggah foto bukti <span class="text-red-500 text-sm">(wajib)</span></h4>
                    <p class="text-sm text-slate-600 mt-1">Foto maksimal <strong>2 MB</strong>. Video singkat boleh ditambahkan (opsional, MP4/WebM/MOV maksimal <strong>10 MB</strong>).</p>
                    <ul class="mt-3 grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-2 text-sm">
                        <li class="flex gap-2 text-slate-600"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'check','class' => 'w-4 h-4 text-green-600 mt-0.5 shrink-0']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'check','class' => 'w-4 h-4 text-green-600 mt-0.5 shrink-0']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?> Foto terang dan tidak buram</li>
                        <li class="flex gap-2 text-slate-600"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'check','class' => 'w-4 h-4 text-green-600 mt-0.5 shrink-0']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'check','class' => 'w-4 h-4 text-green-600 mt-0.5 shrink-0']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?> Kerusakan terlihat jelas di tengah foto</li>
                        <li class="flex gap-2 text-slate-600"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'check','class' => 'w-4 h-4 text-green-600 mt-0.5 shrink-0']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'check','class' => 'w-4 h-4 text-green-600 mt-0.5 shrink-0']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?> Ambil dari dekat dan dari jauh agar lokasi dikenali</li>
                        <li class="flex gap-2 text-slate-600"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'x','class' => 'w-4 h-4 text-red-500 mt-0.5 shrink-0']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'x','class' => 'w-4 h-4 text-red-500 mt-0.5 shrink-0']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?> Jangan foto orang atau wajah teman</li>
                    </ul>
                </div>
            </li>

            
            <li class="anim-up bg-white rounded-2xl border border-slate-100 shadow-sm p-5 sm:p-6 flex gap-4">
                <span class="shrink-0 w-9 h-9 rounded-full bg-brand-600 text-white font-extrabold flex items-center justify-center">4</span>
                <div class="min-w-0 flex-1">
                    <h4 class="font-bold text-slate-800">Kirim, lalu pantau statusnya</h4>
                    <p class="text-sm text-slate-600 mt-1">Tekan <strong>Kirim Pengaduan</strong>. Laporanmu masuk ke <strong>Riwayat Pengaduan</strong> dengan status <em>Diajukan</em>. Buka laporan itu kapan saja untuk melihat perkembangannya.</p>
                </div>
            </li>
        </ol>
    </section>

    
    <section>
        <h3 class="text-lg font-bold text-slate-800 mb-1">Arti status pengaduan</h3>
        <p class="text-sm text-slate-500 mb-4">Setelah dikirim, laporanmu akan melalui tahap berikut.</p>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
            <?php $__currentLoopData = [
                ['diajukan', 'Diajukan', 'Laporan sudah masuk dan menunggu diperiksa admin.', 'Tunggu saja. Pastikan foto dan deskripsinya jelas.'],
                ['diproses', 'Diproses', 'Admin menerima laporan dan menugaskan teknisi.', 'Lihat linimasa "Perkembangan Perbaikan" di detail laporan.'],
                ['selesai', 'Selesai', 'Teknisi sudah memperbaiki kerusakan.', 'Riwayat perbaikan tetap bisa dilihat.'],
                ['ditolak', 'Ditolak', 'Admin tidak dapat memproses laporan, alasannya ditulis di detail laporan.', 'Baca alasannya. Bila perlu, ajukan lagi dengan data yang lebih lengkap.'],
            ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as [$key, $nama, $arti, $aksi]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="rounded-2xl bg-white border border-slate-100 shadow-sm p-4">
                    <?php if (isset($component)) { $__componentOriginal8c81617a70e11bcf247c4db924ab1b62 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8c81617a70e11bcf247c4db924ab1b62 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.status-badge','data' => ['status' => $key,'label' => $nama]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('status-badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($key),'label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($nama)]); ?>
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
                    <p class="text-sm text-slate-700 mt-2.5"><?php echo e($arti); ?></p>
                    <p class="text-xs text-slate-500 mt-1.5"><span class="font-semibold">Yang bisa kamu lakukan:</span> <?php echo e($aksi); ?></p>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </section>

    
    <section>
        <h3 class="text-lg font-bold text-slate-800 mb-4">Apa saja yang bisa dilaporkan?</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="rounded-2xl bg-white border border-slate-100 shadow-sm p-5">
                <p class="text-sm font-bold text-slate-700 mb-3">Kategori kerusakan</p>
                <div class="flex flex-wrap gap-2">
                    <?php $__empty_1 = true; $__currentLoopData = $kategoris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <span class="rounded-full bg-brand-50 text-brand-700 text-xs font-semibold px-3 py-1"><?php echo e($k->nama); ?></span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <span class="text-sm text-slate-400">Belum ada kategori.</span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="rounded-2xl bg-white border border-slate-100 shadow-sm p-5">
                <p class="text-sm font-bold text-slate-700 mb-3">Lokasi yang tersedia</p>
                <div class="flex flex-wrap gap-2">
                    <?php $__empty_1 = true; $__currentLoopData = $lokasis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $l): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <span class="rounded-full bg-slate-100 text-slate-600 text-xs font-medium px-3 py-1"><?php echo e($l->nama); ?></span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <span class="text-sm text-slate-400">Belum ada lokasi.</span>
                    <?php endif; ?>
                    <span class="rounded-full bg-amber-50 text-amber-700 text-xs font-semibold px-3 py-1">Lainnya (ketik sendiri)</span>
                </div>
            </div>
        </div>
    </section>

    
    <section id="faq" class="scroll-mt-6">
        <h3 class="text-lg font-bold text-slate-800 mb-4">Pertanyaan yang sering muncul</h3>
        <div class="space-y-2.5">
            <?php $__currentLoopData = [
                ['Berapa lama laporan saya diproses?', 'Admin memeriksa laporan yang masuk terlebih dulu. Begitu diterima, statusnya menjadi Diproses dan teknisi mulai mengerjakannya. Lama pengerjaan bergantung pada tingkat kerusakan dan ketersediaan bahan; pantau terus lewat linimasa di detail laporanmu.'],
                ['Kenapa pengaduan saya ditolak?', 'Alasan penolakan selalu ditulis admin di detail laporan, misalnya laporan sudah pernah dibuat, foto kurang jelas, atau bukan kerusakan sarana sekolah. Kamu boleh mengajukan lagi dengan data yang lebih lengkap.'],
                ['Foto atau video saya gagal diunggah.', 'Pastikan foto tidak lebih dari 2 MB dan video tidak lebih dari 10 MB (MP4, WebM, atau MOV). Foto dari kamera HP yang terlalu besar bisa dikecilkan dulu, atau ambil ulang lewat tombol unggah.'],
                ['Lokasi kerusakannya tidak ada di daftar.', 'Pilih Lainnya pada kolom Lokasi, lalu ketik nama tempatnya, misalnya "Parkiran belakang".'],
                ['Bisakah saya mengubah atau menghapus laporan yang sudah dikirim?', 'Belum. Bila ada yang salah, ajukan laporan baru dengan keterangan yang benar.'],
                ['Bagaimana tahu laporan saya sudah dikerjakan?', 'Buka Riwayat Pengaduan lalu pilih laporanmu. Di sana ada status terbaru dan linimasa catatan dari teknisi, termasuk bahan yang dipakai dan foto hasil perbaikan.'],
                ['Saya lupa kata sandi atau ingin mengganti No. HP.', 'Buka Profil Saya. Nama, email, NIS, dan kelas dikunci, sedangkan No. HP dan kata sandi bisa kamu ubah sendiri.'],
            ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as [$tanya, $jawab]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <details class="group bg-white rounded-xl border border-slate-100 shadow-sm">
                    <summary class="flex items-center justify-between gap-3 cursor-pointer list-none px-4 sm:px-5 py-3.5 font-semibold text-sm text-slate-800">
                        <span><?php echo e($tanya); ?></span>
                        <svg class="w-4 h-4 text-slate-400 shrink-0 transition group-open:rotate-180" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                    </summary>
                    <p class="px-4 sm:px-5 pb-4 text-sm text-slate-600 leading-relaxed"><?php echo e($jawab); ?></p>
                </details>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </section>

    
    <div class="rounded-2xl bg-brand-50 border border-brand-100 p-5 sm:p-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <p class="font-bold text-slate-800"><?php echo e($sudahPernah ? 'Menemukan kerusakan lagi?' : 'Siap membuat pengaduan pertamamu?'); ?></p>
            <p class="text-sm text-slate-600 mt-0.5">Laporanmu membantu sekolah tetap nyaman dipakai semua orang.</p>
        </div>
        <a href="<?php echo e(route('siswa.pengaduan.create')); ?>" class="inline-flex justify-center items-center gap-2 bg-brand-600 hover:bg-brand-700 transition text-white font-semibold px-5 py-3 rounded-xl shadow-lg shadow-brand-600/30 whitespace-nowrap">
            <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'plus','class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'plus','class' => 'w-5 h-5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?> Ajukan Pengaduan
        </a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AduinAja-Laravel-v6\resources\views/siswa/panduan.blade.php ENDPATH**/ ?>