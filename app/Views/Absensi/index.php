<?= $this->extend('Render/index'); ?>

<?= $this->section('render'); ?>
<!-- title halaman -->
<h1 class="title-halaman"><i class="fas fa-file"></i> Data Absen</h1>
<hr class="border-0 border-bottom border-secondary">
<!-- end title halaman -->

<!-- Search mode -->
<form action="<?= base_url('Absensi'); ?>" method="GET" class="search w-100">
    <?= csrf_field(); ?>
    <input name="search" value="<?= $tanggal; ?>" class="rounded-start px-3" type="date">
    <button class="rounded-end fw-bold text-light">Cari Data</button>
</form>
<!-- End search mode -->

<!-- button tambah, jumlah -->
<div class="data-jumlah d-flex w-75 mt-4">
    <a class="data-jumlah-button py-2 rounded  text-decoration-none text-center text-light" href="<?= base_url('/Absensi/buat'); ?>"><i class="fas fa-plus"></i>
        Tambah
        Absen</a>

    <a class="text-decoration-none fw-bold rounded py-2 text-center"><?= $countAbsensi; ?> Hari Sejak Berjalannya Absen</a>
</div>

<div class="data-absens mt-5 border rounded px-3 pt-3 pb-5">
    <?php $no = 1; ?>
    <?php for ($i = 0; $i < count($getAbsensi); $i++) : ?>
        <?php $statusAbsen = 0; ?>
        <div class="data-absen d-flex">
            <div class="data-absen-left">
                <div class="data-absen-header d-flex">
                    <div class="as1">
                        <h4 class="text-light rounded-circle text-center d-inline-block"><?= $no++; ?></h4>
                    </div>


                    <h4 class="as2 d-inline-block"> <?= date("F j, Y", strtotime($getAbsensi[$i]['header']['tanggal_absen'])); ?> <i class="fas fa-calendar"></i></h4>
                </div>

                <div class="data-absen-body mt-4 d-block">
                    <?php $no_nest = 1; ?>
                    <?php foreach ($getAbsensi[$i]['body'] as $absensi) : ?>
                        <div class="body mb-3 d-flex">
                            <p><span><?= $no_nest++; ?></span></p>
                            <p><?= $absensi['nama_wali']; ?>:
                                <!-- Menghitung Absen Yang Hadir -->
                                <?php if ($absensi['status_id'] == 1) : ?>
                                    <span class="text-success">Hadir</span>
                                    <?php $statusAbsen++; ?>
                                <?php elseif ($absensi['status_id'] == 2) : ?>
                                    <span class="text-primary">Izin</span>
                                <?php elseif ($absensi['status_id'] == 3) : ?>
                                    <span class="text-warning">Sakit</span>
                                <?php else : ?>
                                    <span class="text-danger">Lain-Lain</span>
                                <?php endif; ?>

                            </p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="data-absen-right">
                <h5 class="buttonbro rounded"><?= $statusAbsen; ?> Orang Telah Hadir Di Kelas</h5>

                <a href="<?= base_url('/Absensi/AbsensiProcess/hapus/' . $getAbsensi[$i]['header']['tanggal_absen']); ?>" class="text-center w-100 text-danger mt-4 d-block fw-bold"><i class="fas fa-trash"></i> Hapus Absensi Tanggal
                    Ini</a>
            </div>
        </div>
    <?php endfor; ?>
</div>

<?= $this->endSection(); ?>