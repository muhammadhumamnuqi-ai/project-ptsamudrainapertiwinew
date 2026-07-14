<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Rekrutmen Calon ABK</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 12px;
            color: #333;
            line-height: 1.5;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #1e3a8a;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 20px;
            color: #1e3a8a;
            text-transform: uppercase;
        }
        .header p {
            margin: 5px 0 0;
            font-size: 12px;
            color: #666;
        }
        .summary {
            display: table;
            width: 100%;
            margin-bottom: 20px;
        }
        .summary-box {
            display: table-cell;
            width: 25%;
            padding: 10px;
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            text-align: center;
        }
        .summary-box .value {
            font-size: 18px;
            font-weight: bold;
            color: #0f172a;
            display: block;
        }
        .summary-box .label {
            font-size: 10px;
            color: #64748b;
            text-transform: uppercase;
        }
        table.data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table.data-table th, table.data-table td {
            border: 1px solid #cbd5e1;
            padding: 8px;
            text-align: left;
            font-size: 11px;
        }
        table.data-table th {
            background-color: #f1f5f9;
            color: #334155;
            font-weight: bold;
            text-transform: uppercase;
        }
        table.data-table tr:nth-child(even) {
            background-color: #f8fafc;
        }
        .footer {
            text-align: right;
            margin-top: 40px;
            font-size: 11px;
            color: #666;
        }
        .badge {
            padding: 2px 5px;
            border-radius: 3px;
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .bg-green { background-color: #d1fae5; color: #065f46; }
        .bg-blue { background-color: #dbeafe; color: #1e40af; }
        .bg-yellow { background-color: #fef3c7; color: #92400e; }
        .bg-red { background-color: #fee2e2; color: #b91c1c; }
    </style>
</head>
<body onload="window.print()">

    <div class="header">
        <h1>PT. Samudra Ina Pertiwi</h1>
        <p>Laporan Status Rekrutmen & Penempatan Calon ABK</p>
        <p>Tanggal Cetak: <?php echo e(\Carbon\Carbon::now()->format('d F Y, H:i')); ?></p>
    </div>

    <div class="summary">
        <div class="summary-box">
            <span class="value"><?php echo e($stats['total_abk']); ?></span>
            <span class="label">Total Calon ABK</span>
        </div>
        <div class="summary-box">
            <span class="value"><?php echo e($stats['abk_onboard']); ?></span>
            <span class="label">ABK On Board</span>
        </div>
        <div class="summary-box">
            <span class="value"><?php echo e($stats['abk_berangkat']); ?></span>
            <span class="label">Proses Keberangkatan</span>
        </div>
        <div class="summary-box">
            <span class="value"><?php echo e($stats['waiting_list']); ?></span>
            <span class="label">Waiting List Job</span>
        </div>
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kandidat</th>
                <th>Posisi / Job</th>
                <th>Tahap Saat Ini</th>
                <th>Status</th>
                <th>Terdaftar</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $candidates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $tahapLabel = [1=>'Administrasi',2=>'MCU',3=>'Diklat',4=>'Dok. Pelaut',5=>'Waiting List',6=>'Keberangkatan'];
                $lp = $c->prosesPendaftaran->sortByDesc('created_at')->first();
                $tAktif = $lp ? $lp->tahap : 1;
                $tStatus = $lp ? $lp->status : 'Dalam Proses';
                
                $badgeClass = 'bg-blue';
                if($tStatus === 'Selesai') $badgeClass = 'bg-green';
                elseif($tStatus === 'Revisi' || $tStatus === 'Pending') $badgeClass = 'bg-yellow';
                elseif($tStatus === 'Ditolak') $badgeClass = 'bg-red';
            ?>
            <tr>
                <td style="text-align: center;"><?php echo e($index + 1); ?></td>
                <td>
                    <strong><?php echo e($c->profilAbk ? $c->profilAbk->nama_lengkap : $c->name); ?></strong><br>
                    <span style="color:#64748b; font-size:9px;"><?php echo e($c->email); ?></span>
                </td>
                <td><?php echo e($c->profilAbk ? $c->profilAbk->posisi_dilamar : '-'); ?></td>
                <td>Tahap <?php echo e($tAktif); ?> - <?php echo e($tahapLabel[$tAktif] ?? ''); ?></td>
                <td><span class="badge <?php echo e($badgeClass); ?>"><?php echo e($tStatus); ?></span></td>
                <td><?php echo e($c->created_at->format('d-m-Y')); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    <div class="footer">
        <p>Dicetak oleh: <?php echo e(auth()->user()->name ?? 'Administrator'); ?></p>
        <p>Sistem Manajemen Rekrutmen - PT. Samudra Ina Pertiwi</p>
    </div>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\ptsamudrainapertiwi_sip\resources\views/reports/print_pdf.blade.php ENDPATH**/ ?>