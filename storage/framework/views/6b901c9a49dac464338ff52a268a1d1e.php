<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - <?php echo e($web['nama_aplikasi']); ?></title>
    <link rel="icon" href="<?php echo e($web['logo'] ? \App\Models\Pengaturan::logoUrl() : asset('favicon.svg')); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <?php echo $__env->make('layouts.theme', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <style>
        body { font-family: 'Inter', sans-serif; }
        @keyframes float1 { 0%,100% { transform: translate(0,0) scale(1); } 50% { transform: translate(30px,-40px) scale(1.1); } }
        @keyframes float2 { 0%,100% { transform: translate(0,0) scale(1); } 50% { transform: translate(-40px,30px) scale(1.15); } }
        @keyframes fadeUp { from { opacity: 0; transform: translateY(18px); } to { opacity: 1; transform: none; } }
        @keyframes bob { 0%,100% { transform: translateY(0); } 50% { transform: translateY(-6px); } }
        .blob1 { animation: float1 12s ease-in-out infinite; }
        .blob2 { animation: float2 15s ease-in-out infinite; }
        .rise { opacity: 0; animation: fadeUp .7s ease-out forwards; }
        .bob { animation: bob 3.2s ease-in-out infinite; }
        @media (prefers-reduced-motion: reduce) {
            .blob1,.blob2,.bob { animation: none; } .rise { opacity: 1; animation: none; }
        }
    </style>
</head>
<body class="relative bg-gradient-to-br from-brand-950 via-brand-900 to-brand-950 min-h-screen text-white antialiased">
<?php
    $nama = \App\Models\Pengaturan::namaTerpisah();
    $inp = 'w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm text-slate-800 focus:ring-2 focus:ring-brand-500 focus:border-brand-500 outline-none';
?>

    
    <div class="fixed inset-0 overflow-hidden pointer-events-none" aria-hidden="true">
        <div class="blob1 absolute -top-24 -left-24 w-80 h-80 rounded-full bg-brand-500/30 blur-3xl"></div>
        <div class="blob2 absolute -bottom-28 -right-20 w-96 h-96 rounded-full bg-amber-400/20 blur-3xl"></div>
        <div class="absolute top-1/3 left-1/2 w-72 h-72 rounded-full bg-brand-400/10 blur-3xl"></div>
    </div>

    <div class="relative max-w-6xl mx-auto px-5 sm:px-8 py-6 sm:py-10">

        
        <header class="flex items-center justify-between gap-3 rise">
            <div class="flex items-center gap-3 min-w-0">
                <img src="<?php echo e(\App\Models\Pengaturan::logoUrl()); ?>" alt="Logo <?php echo e($web['nama_aplikasi']); ?>" class="bob w-11 h-11 object-contain shrink-0">
                <div class="min-w-0">
                    <p class="text-xl font-extrabold leading-tight"><?php echo e($nama[0]); ?><span class="text-amber-400"><?php echo e($nama[1]); ?></span></p>
                    <p class="text-[11px] text-brand-200 truncate"><?php echo e($web['nama_sekolah']); ?></p>
                </div>
            </div>
            <a href="#masuk" class="lg:hidden shrink-0 rounded-full bg-white/10 hover:bg-white/20 px-4 py-2 text-sm font-semibold transition">Masuk</a>
        </header>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12 mt-8 sm:mt-12 lg:mt-16 items-start">

            
            <div class="lg:col-span-7">
                <div class="rise" style="animation-delay:.1s">
                    <span class="inline-flex items-center gap-2 rounded-full bg-white/10 px-3.5 py-1.5 text-xs font-semibold text-brand-100 ring-1 ring-white/15">
                        <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span> <?php echo e($web['slogan']); ?>

                    </span>
                    <h1 class="mt-5 text-4xl sm:text-5xl lg:text-6xl font-extrabold leading-[1.05] tracking-tight">
                        Lapor kerusakan,<br><span class="text-amber-400">pantau sampai tuntas.</span>
                    </h1>
                    <p class="mt-5 text-base sm:text-lg text-brand-100/90 max-w-xl leading-relaxed">
                        <?php echo e($web['nama_aplikasi']); ?> adalah website pengaduan sarana dan prasarana <?php echo e($web['nama_sekolah']); ?>.
                        Siswa melaporkan kerusakan lengkap dengan foto, admin memverifikasi, dan teknisi memperbaikinya
                        &mdash; seluruh perkembangannya tercatat dan bisa dipantau.
                    </p>

                    <div class="mt-7 flex flex-wrap gap-3">
                        <a href="#masuk" class="inline-flex items-center gap-2 rounded-full bg-amber-400 hover:bg-amber-300 text-brand-950 font-bold px-6 py-3 transition shadow-lg shadow-amber-400/20">
                            Masuk Sekarang <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'arrow-right','class' => 'w-4 h-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'arrow-right','class' => 'w-4 h-4']); ?>
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
                        </a>
                        <a href="#fitur" class="inline-flex items-center rounded-full border-2 border-white/30 hover:bg-white/10 font-semibold px-6 py-3 transition">Pelajari Lebih Lanjut</a>
                    </div>

                    
                    <dl class="mt-9 grid grid-cols-3 gap-3 max-w-md">
                        <?php $__currentLoopData = [['Pengaduan masuk', $info['total']], ['Selesai diperbaiki', $info['selesai']], ['Teknisi aktif', $info['teknisi']]]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as [$label, $angka]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="rounded-2xl bg-white/5 ring-1 ring-white/10 px-4 py-3">
                                <dd class="text-2xl font-extrabold"><?php echo e($angka); ?></dd>
                                <dt class="text-[11px] text-brand-200 leading-tight mt-0.5"><?php echo e($label); ?></dt>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </dl>
                </div>
            </div>

            
            <div id="masuk" class="lg:col-span-5 scroll-mt-6 rise" style="animation-delay:.2s">
                <div class="bg-white text-slate-800 rounded-3xl shadow-2xl p-6 sm:p-8 lg:sticky lg:top-8">
                    <h2 class="text-xl font-bold text-slate-800 mb-1">Masuk ke akun Anda</h2>
                    <p class="text-sm text-slate-500 mb-6"><?php echo e($web['teks_login']); ?></p>

                    <?php if($errors->any()): ?>
                        <div class="mb-5 rounded-xl px-4 py-3 text-sm font-medium bg-red-50 text-red-700 border border-red-200"><?php echo e($errors->first()); ?></div>
                    <?php endif; ?>

                    <form method="POST" action="<?php echo e(route('login')); ?>" class="space-y-4">
                        <?php echo csrf_field(); ?>
                        <div>
                            <label for="email" class="block text-sm font-medium text-slate-700 mb-1.5">Email</label>
                            <input id="email" type="email" name="email" value="<?php echo e(old('email')); ?>" required autocomplete="email" class="<?php echo e($inp); ?>">
                        </div>
                        <div>
                            <label for="password" class="block text-sm font-medium text-slate-700 mb-1.5">Kata sandi</label>
                            <div class="relative">
                                <input id="password" type="password" name="password" required autocomplete="current-password" class="<?php echo e($inp); ?> pr-16">
                                <button type="button" id="toggle-pw" class="absolute right-3 top-1/2 -translate-y-1/2 text-xs font-semibold text-brand-600 hover:underline">Lihat</button>
                            </div>
                        </div>
                        <label class="flex items-center gap-2 text-sm text-slate-600">
                            <input type="checkbox" name="remember" class="rounded border-slate-300 text-brand-600 focus:ring-brand-500"> Ingat saya
                        </label>
                        <button type="submit" class="w-full bg-brand-600 hover:bg-brand-700 active:scale-[.98] transition text-white font-semibold py-2.5 rounded-xl shadow-lg shadow-brand-600/30">Masuk</button>
                    </form>

                    <div class="mt-6 pt-5 border-t border-slate-100 text-xs text-slate-400">
                        <p class="font-semibold text-slate-500 mb-1.5">Akun demo (kata sandi: password)</p>
                        <ul class="space-y-0.5">
                            <li>Admin &nbsp;: admin@aduinaja.sch.id</li>
                            <li>Siswa &nbsp;&nbsp;: andi@siswa.sch.id</li>
                            <li>Teknisi : bambang@teknisi.sch.id</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        
        <section id="fitur" class="mt-16 sm:mt-24 scroll-mt-6">
            <div class="max-w-2xl">
                <p class="text-sm font-bold text-amber-400 uppercase tracking-wider">Fitur</p>
                <h2 class="mt-2 text-2xl sm:text-4xl font-extrabold">Semua yang dibutuhkan untuk menangani kerusakan</h2>
            </div>
            <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <?php $__currentLoopData = [
                    ['camera', 'Lapor dengan foto', 'Pilih kategori dan lokasi dari 17 ruangan, tulis deskripsi, lalu unggah foto bukti. Video bersifat opsional.'],
                    ['clipboard', 'Verifikasi admin', 'Admin menerima atau menolak laporan dengan alasan yang jelas, lalu menugaskan teknisi.'],
                    ['wrench', 'Perbaikan oleh teknisi', 'Teknisi mencatat progres, bahan yang dipakai, dan foto hasil perbaikan sampai selesai.'],
                    ['history', 'Riwayat tersimpan', 'Setiap langkah tercatat sebagai riwayat, sehingga siswa dapat memantau perkembangan laporannya.'],
                ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as [$ikon, $judul, $isi]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="rounded-2xl bg-white/5 ring-1 ring-white/10 p-5 hover:bg-white/10 transition">
                        <div class="w-11 h-11 rounded-xl bg-amber-400/15 text-amber-300 flex items-center justify-center mb-4"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => $ikon,'class' => 'w-6 h-6']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($ikon),'class' => 'w-6 h-6']); ?>
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
                        <h3 class="font-bold"><?php echo e($judul); ?></h3>
                        <p class="text-sm text-brand-100/80 mt-1.5 leading-relaxed"><?php echo e($isi); ?></p>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </section>

        
        <section class="mt-14 sm:mt-20">
            <p class="text-sm font-bold text-amber-400 uppercase tracking-wider">Alur Penanganan</p>
            <h2 class="mt-2 text-2xl sm:text-4xl font-extrabold">Dari laporan sampai selesai</h2>
            <ol class="mt-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <?php $__currentLoopData = [
                    ['Siswa melapor', 'Isi form pengaduan dan unggah foto bukti kerusakan.'],
                    ['Admin memverifikasi', 'Laporan diterima (Diproses) atau ditolak beserta alasannya.'],
                    ['Teknisi memperbaiki', 'Teknisi yang ditugaskan mengerjakan dan mencatat progres.'],
                    ['Selesai', 'Status berubah menjadi Selesai dan riwayat perbaikan tersimpan.'],
                ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => [$judul, $isi]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="relative rounded-2xl bg-gradient-to-b from-white/10 to-white/[.03] ring-1 ring-white/10 p-5">
                        <span class="inline-flex w-9 h-9 items-center justify-center rounded-full bg-amber-400 text-brand-950 font-extrabold mb-3"><?php echo e($i + 1); ?></span>
                        <h3 class="font-bold"><?php echo e($judul); ?></h3>
                        <p class="text-sm text-brand-100/80 mt-1.5 leading-relaxed"><?php echo e($isi); ?></p>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ol>
        </section>

        
        <section class="mt-14 sm:mt-20">
            <p class="text-sm font-bold text-amber-400 uppercase tracking-wider">Pengguna</p>
            <h2 class="mt-2 text-2xl sm:text-4xl font-extrabold">Tiga peran, satu sistem</h2>
            <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-4">
                <?php $__currentLoopData = [
                    ['user', 'Siswa', 'Mengajukan pengaduan, memantau status dan perkembangan perbaikan, serta melihat riwayat laporan.'],
                    ['shield', 'Admin', 'Memverifikasi laporan, menugaskan teknisi, mengelola data master, laporan Excel, dan tampilan website.'],
                    ['wrench', 'Teknisi', 'Mengerjakan tugas perbaikan, menulis catatan progres, dan menyimpan riwayat perbaikan.'],
                ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as [$ikon, $judul, $isi]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="rounded-2xl bg-white/5 ring-1 ring-white/10 p-5 flex gap-4">
                        <div class="w-11 h-11 rounded-xl bg-white/10 flex items-center justify-center shrink-0"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => $ikon,'class' => 'w-6 h-6']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($ikon),'class' => 'w-6 h-6']); ?>
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
                        <div><h3 class="font-bold"><?php echo e($judul); ?></h3><p class="text-sm text-brand-100/80 mt-1 leading-relaxed"><?php echo e($isi); ?></p></div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </section>

        <footer class="mt-14 pt-6 border-t border-white/10 text-center text-brand-300 text-xs">
            <?php echo e($web['nama_aplikasi']); ?> &middot; <?php echo e($web['nama_sekolah']); ?> &copy; <?php echo e(date('Y')); ?>

        </footer>
    </div>

<script>
    document.getElementById('toggle-pw').addEventListener('click', function () {
        var i = document.getElementById('password');
        var show = i.type === 'password';
        i.type = show ? 'text' : 'password';
        this.textContent = show ? 'Sembunyi' : 'Lihat';
    });
</script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\AduinAja-Laravel-v6\resources\views/auth/login.blade.php ENDPATH**/ ?>