<?= $this->extend('Render/index'); ?>

<?= $this->section('render'); ?>
<!-- title halaman -->
<h1 class="title-halaman"><i class="fas fa-users"></i> Data Motivator</h1>
<hr class="border-0 border-bottom border-secondary">
<!-- end title halaman -->

<!-- Search mode -->
<form action="<?= base_url('Motivator'); ?>" method="GET" class="search w-100">
    <?= csrf_field(); ?>
    <input name="search" class="rounded-start px-3" placeholder="Cari Berdasarkan Nama Motivator!" type="text">
    <button type="submit" class="rounded-end fw-bold text-light">Cari Data</button>
</form>
<!-- End search mode -->

<!-- Content start -->

<div class="halaman-data-guru mt-4">
    <!-- button tambah, jumlah -->
    <div class="data-jumlah d-flex w-75 mt-4">
        <a class="data-jumlah-button py-2 rounded  text-decoration-none text-center text-light" href="<?= base_url('Motivator/buat'); ?>"><i class="fas fa-plus"></i>
            Tambah
            Motivator</a>

        <a class="text-decoration-none fw-bold rounded py-2 text-center"><?= $countMotivator; ?> Motivator Tersedia</a>
    </div>

    <!-- informasi -->

    <!-- id nama jenis kelamin no t elp -->

    <div class="data-gurus d-flex justify-content-between flex-wrap mt-5">
        <?php foreach ($getMotivator as $motivator) : ?>
            <div class="data-guru rounded p-3 mb-5">
                <h3><span class="text-danger">ID: <?= $motivator['id']; ?></span>—<span class="data-guru-name"><?= $motivator['nama']; ?></span></h2>

                    <div class="data-guru-grid d-flex w-100 mt-3 px-3">
                        <?php if ($motivator['jenis_kelamin'] == 1) : ?>
                            <i class="fas fa-venus text-primary"></i>
                        <?php else : ?>
                            <i class="fas fa-mars text-danger"></i>
                        <?php endif; ?>
                        <div>
                            <h5>No. Telepon </h5>
                            <small><?= $motivator['no_telepon']; ?></small>
                        </div>

                        <a class="rounded text-light text-center text-decoration-none" href="<?= base_url('/Motivator/MotivatorPages/sunting/' . $motivator['user_id']); ?>">Sunting</a>
                    </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- akhir informasi -->
</div>
<!-- end content  -->

<?= $this->endSection(); ?>