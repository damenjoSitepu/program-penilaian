<?= $this->extend('Render/index'); ?>

<?= $this->section('render'); ?>
<!-- title halaman -->
<h2 class="title-halaman"><i class="fas fa-star"></i> Data Nilai—Anak Didik: <span class="text-decoration-underline text-danger"><?= $getUser->nama_wali; ?></span></h2>
<hr class="border-0 border-bottom border-secondary">
<!-- end title halaman -->

<!-- Search mode -->
<form action="<?= base_url('Wali/Nilai'); ?>" method="GET" class="search w-100">
    <?= csrf_field(); ?>
    <select class="rounded-start px-3" name="search" placeholder="Cari Berdasarkan Tanggal Dimulainya Absen">
        <option value="1">Semua Nilai</option>
        <option value="2">Evaluasi</option>
        <option value="3">Tugas Harian</option>
    </select>
    <button type="submit" class="rounded-end fw-bold text-light">Cari Data</button>
</form>
<!-- End search mode -->

<?php if ($getUser->catatan !== 'default') : ?>
    <a href="<?= base_url('OrangTua/Rapot'); ?>" target="_blank" class="buttonbro text-light text-center px-4 rounded text-decoration-none fw-bold mt-4 d-block">Cetak Rapot Nilai Anak Didik Anda</a>
<?php else : ?>
    <a href="<?= base_url('OrangTua/Nilai'); ?>" class="buttonbro text-light text-center px-4 rounded text-decoration-none fw-bold mt-4 d-block">Belum Ada Rapot Tersedia Saat Ini</a>
<?php endif; ?>


<!-- Halaman wali nilai -->
<div class="halaman-wali-nilai mt-5">
    <?php if ($search == '' || $search == '1') : ?>
        <?= $this->include('Wali/nilai-evaluasi'); ?>
        <?= $this->include('Wali/nilai-tugas-harian'); ?>
    <?php elseif ($search == '2') : ?>
        <?= $this->include('Wali/nilai-evaluasi'); ?>
    <?php else : ?>
        <?= $this->include('Wali/nilai-tugas-harian'); ?>
    <?php endif; ?>
</div>
<!-- Akhir halaman wali nilai -->

<?= $this->endSection(); ?>