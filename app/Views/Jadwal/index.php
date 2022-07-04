<?= $this->extend('Render/index'); ?>

<?= $this->section('render'); ?>

<!-- title halaman -->
<h1 class="title-halaman"><i class="fas fa-calendar"></i> Data Jadwal</h1>
<hr class="border-0 border-bottom border-secondary">
<!-- end title halaman -->
<!-- Search mode -->
<form action="<?= base_url('Jadwal'); ?>" method="GET" class="search w-100">
    <?= csrf_field(); ?>
    <select class="rounded-start px-3" name="search">
        <?php foreach ($getLevel as $level) : ?>
            <?php if ($search == $level['level_id']) : ?>
                <option selected="selected" value="<?= $level['level_id']; ?>"><?= $level['level_id']; ?> | <?= $level['nama_level']; ?></option>
            <?php else : ?>
                <option value="<?= $level['level_id']; ?>"><?= $level['level_id']; ?> | <?= $level['nama_level']; ?></option>
            <?php endif; ?>
        <?php endforeach; ?>
    </select>
    <button type="submit" class="rounded-end fw-bold text-light">Cari Data</button>
</form>
<!-- End search mode -->

<div class="halaman-data-guru mt-4">
    <!-- button tambah, jumlah -->
    <div class="data-jumlah d-flex w-75 mt-4 mb-5">
        <a class="data-jumlah-button py-2 rounded  text-decoration-none text-center text-light" href="<?= base_url('Jadwal/buat'); ?>"><i class="fas fa-plus"></i>
            Tambah
            Jadwal</a>

        <a class="text-decoration-none fw-bold rounded py-2 text-center"><?= $countJadwal; ?> Jadwal Tersedia</a>
    </div>

    <!-- informasi -->

    <!-- id nama jenis kelamin no t elp -->

    <?php for ($i = 0; $i < count($getJadwal); $i++) : ?>
        <div class="data-inti-gurus mx-4 mb-5">
            <h3>Bimbingan: <span class="text-danger"><?= $getJadwal[$i]['header']['nama_level']; ?></span></h3>
            <hr class="border-bottom border-secondary">

            <div class="data-gurus d-flex justify-content-between flex-wrap mt-4">
                <?php $j = 1; ?>
                <?php foreach ($getJadwal[$i]['body'] as $jadwals) : ?>
                    <div class="data-guru rounded p-3 mb-5">
                        <h3><span class="text-danger"><?= $jadwals['nama_hari']; ?></span>—<small class="data-guru-name bg-danger text-light d-inline-block w-25 text-center rounded"><?= $j++; ?>
                            </small>
                            </h2>
                            <div class="data-guru-grid d-flex w-100 mt-3 px-3">
                                <i class="fas fa-clock text-danger"></i>
                                <div>
                                    <h5>Jam Belajar </h5>
                                    <small><?= date("H:i", strtotime($jadwals['jam_mulai'])); ?> - <?= date("H:i", strtotime($jadwals['jam_berakhir'])); ?></small>
                                </div>

                                <a class="rounded text-light text-center text-decoration-none" href="<?= base_url('/Jadwal/JadwalPages/sunting/' . $jadwals['jadwal_id']); ?>">Sunting
                                    Data</a>
                            </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endfor; ?>


    <!-- akhir informasi -->
</div>

<?= $this->endSection(); ?>