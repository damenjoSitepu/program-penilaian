<?= $this->extend('Render/index'); ?>

<?= $this->section('render'); ?>

<!-- title halaman -->
<h2 class="title-halaman"><i class="fas fa-calendar"></i> Data Jadwal—Anak Didik: <span class="text-danger">Damenjo Sitepu</span></h2>
<hr class="border-0 border-bottom border-secondary">
<!-- end title halaman -->

<!-- info -->
<div class="wali-jadwal d-flex justify-content-between mt-5 border rounded px-4">
    <div class="sisi-kiri">
        <?php if (empty($getJadwal)) :  ?>
            <h3 class="text-light bg-danger p-3 rounded my-4 fw-bold fs-2 text-center"><i class="fas fa-circle-exclamation d-block mb-4 fs-1"></i> Belum Ada Jadwal Tersedia Untuk Anak Didik Anda</h3>
        <?php else : ?>
            <h3 class="text-danger my-4 fw-bold fs-2 text-center"><?= $getJadwal[0]['header']['nama_level']; ?></h3>
            <?php $i = 1; ?>
            <?php foreach ($getJadwal[0]['body'] as $jadwal) : ?>
                <div class="list">
                    <h3><?= $i++; ?></h3>
                    <div>
                        <h3><?= $jadwal['nama_hari']; ?></h3>
                        <h4><?= $jadwal['jam_mulai']; ?> - <?= $jadwal['jam_berakhir']; ?></h4>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <div class="sisi-kanan">
        <img src="<?= base_url('assets/img/teacher.png'); ?>" alt="">
    </div>
</div>
<!-- end info -->

<?= $this->endSection(); ?>