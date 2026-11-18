<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Pengaduan - <?php echo e($web['nama_aplikasi']); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <?php echo $__env->make('layouts.theme', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <style>
        body { font-family: Arial, Helvetica, sans-serif; }
        @media print {
            .no-print { display: none; }
            body { padding: 0; }
        }
    </style>
</head>
<body class="p-8 text-slate-800">
    <div class="no-print mb-6 flex justify-end">
        <button onclick="window.print()" class="px-4 py-2 rounded-lg bg-brand-600 text-white text-sm font-semibold">Cetak / Simpan sebagai PDF</button>
    </div>

    <div class="text-center mb-6">
        <h1 class="text-xl font-extrabold">LAPORAN REKAP PENGADUAN SARANA SEKOLAH</h1>
        <p class="text-sm text-slate-500"><?php echo e($web['nama_aplikasi']); ?> &mdash; <?php echo e($web['nama_sekolah']); ?></p>
        <p class="text-xs text-slate-400 mt-1">Dicetak pada <?php echo e($generatedAt->translatedFormat('d F Y, H:i')); ?> WIB</p>
    </div>

    <table class="w-full text-sm border-collapse">
        <thead>
            <tr class="bg-slate-100">
                <th class="border border-slate-300 px-3 py-2 text-left">No</th>
                <th class="border border-slate-300 px-3 py-2 text-left">Kode</th>
                <th class="border border-slate-300 px-3 py-2 text-left">Tanggal</th>
                <th class="border border-slate-300 px-3 py-2 text-left">Kategori</th>
                <th class="border border-slate-300 px-3 py-2 text-left">Lokasi</th>
                <th class="border border-slate-300 px-3 py-2 text-left">Pelapor</th>
                <th class="border border-slate-300 px-3 py-2 text-left">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td class="border border-slate-300 px-3 py-2"><?php echo e($i + 1); ?></td>
                    <td class="border border-slate-300 px-3 py-2"><?php echo e($row->kode); ?></td>
                    <td class="border border-slate-300 px-3 py-2"><?php echo e($row->tanggal_kejadian->translatedFormat('d M Y')); ?></td>
                    <td class="border border-slate-300 px-3 py-2"><?php echo e($row->kategori->nama); ?></td>
                    <td class="border border-slate-300 px-3 py-2"><?php echo e($row->lokasi_nama); ?></td>
                    <td class="border border-slate-300 px-3 py-2"><?php echo e($row->user->name); ?></td>
                    <td class="border border-slate-300 px-3 py-2"><?php echo e($row->statusLabel()); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="7" class="border border-slate-300 px-3 py-6 text-center text-slate-400">Tidak ada data.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

    <p class="text-xs text-slate-400 mt-6">Total data: <?php echo e($rows->count()); ?> pengaduan.</p>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\AduinAja-Laravel-v6\resources\views/admin/laporan/print.blade.php ENDPATH**/ ?>