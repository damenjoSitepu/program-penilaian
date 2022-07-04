<?= $this->extend('Render/index'); ?>

<?= $this->section('render'); ?>
<!-- title halaman -->
<h1 class="title-halaman"><i class="fas fa-star"></i> Data Nilai</h1>
<hr class="border-0 border-bottom border-secondary">
<!-- end title halaman -->

<!-- Search mode -->
<form action="<?= base_url('Nilai'); ?>" method="GET" class="search w-100">
    <?= csrf_field(); ?>
    <input class="rounded-start px-3" name="search" type="date">
    <button class="rounded-end fw-bold text-light">Cari Data</button>
</form>
<!-- End search mode -->

<!-- Content start -->

<div class="halaman-data-guru mt-4">
    <!-- button tambah, jumlah -->
    <div class="data-jumlah d-flex w-75 mt-4">
        <a class="data-jumlah-button py-2 rounded  text-decoration-none text-center text-light" href="<?= base_url('/Nilai/buat'); ?>"><i class="fas fa-plus"></i>
            Buat Penilaian</a>

        <a class="text-decoration-none fw-bold rounded py-2 text-center"><?= $countNilai; ?> Ruang Penilaian Tersedia</a>
    </div>

    <!-- informasi -->

    <!-- id nama jenis kelamin no t elp -->

    <div class="data-gurus d-flex justify-content-between flex-wrap mt-5">

        <?php foreach ($getNilai as $nilai) : ?>
            <div class="data-guru rounded p-3 mb-5">
                <h5><span class="text-danger"><?= $nilai['header']['tanggal_penilaian']; ?></span>—<span class="data-guru-name"><?= $nilai['header']['mata_pelajaran']; ?></span>
                    </h2>

                    <div class="data-guru-grid d-flex w-100 mt-3 px-3">
                        <i class="fas fa-star text-danger"></i>
                        <div>
                            <h5><?= $nilai['header']['nama_level']; ?>: <span class="text-primary"><?= $nilai['header']['nama_hari']; ?></span> </h5>
                            <h6 class="bg-danger text-light p-2 rounded w-75 text-center my-3"><?= $nilai['header']['nama_kategori_nilai']; ?></h6>
                            <small>Diikuti <span class="text-danger fw-bold"><?= count($nilai['body']); ?></span> Anak Didik</small>

                            <hr class="border-bottom border-danger w-75">
                            <small class="d-block mt-3 fw-bold"><i class="fas fa-chalkboard-user text-primary"></i>&nbsp; <?= $nilai['header']['nama_motivator']; ?></small>
                        </div>

                        <a class="rounded text-light py-2 text-center text-decoration-none" href="<?= base_url('/Nilai/NilaiPages/kelolaPenilaian/' . $nilai['header']['nilai_id_real']); ?>">Sunting</a>
                    </div>
            </div>
        <?php endforeach; ?>

    </div>

    <!-- akhir informasi -->
</div>



<!-- end content  -->

<?= $this->endSection(); ?>