<?= $this->extend('Render/index'); ?>

<?= $this->section('render'); ?>
<!-- title halaman -->
<h2 class="title-halaman"><i class="fas fa-file"></i> Data Absen—Anak Didik: <span class="text-decoration-underline text-danger"><?= $getUser->nama_wali; ?></span></h2>
<hr class="border-0 border-bottom border-secondary">
<!-- end title halaman -->


<!-- Search mode -->
<form action="<?= base_url('Wali/Absensi'); ?>" method="GET" class="search w-100">
    <?= csrf_field(); ?>
    <input class="rounded-start px-3" name="search" placeholder="Cari Berdasarkan Tanggal Dimulainya Absen" type="date">
    <button type="submit" class="rounded-end fw-bold text-light">Cari Data</button>
</form>
<!-- End search mode -->



<div class="data-absens-wali mt-5 border rounded px-3 pt-3 pb-5">
    <?php $i = 1; ?>
    <?php foreach ($getAbsensi as $absensi) : ?>
        <div class="data-absen d-flex border-bottom mt-3 pb-4">
            <div class="data-absen-left">
                <div class="data-absen-header d-flex">
                    <div class="as1">
                        <h4 class="text-light rounded-circle text-center d-inline-block"><?= $i++; ?></h4>
                    </div>
                    <h4 class="as2 d-inline-block"> <?= date("l, j-M-Y", strtotime($absensi['tanggal_absen'])); ?> <i class="fas fa-calendar"></i></h4>
                </div>

            </div>

            <div class="data-absen-right">
                <?php if ($absensi['status_id'] != 1) : ?>
                    <h6 class="buttonbro rounded"><i class="fas fa-x"></i> <?= $absensi['nama_status']; ?></h6>
                <?php else : ?>
                    <h6 class="buttonbro rounded"><i class="fas fa-check"></i> <?= $absensi['nama_status']; ?></h6>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?= $this->endSection(); ?>