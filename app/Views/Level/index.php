<?= $this->extend('Render/index'); ?>

<?= $this->section('render'); ?>
<!-- title halaman -->
<h1 class="title-halaman"><i class="fas fa-database"></i> Data Level</h1>
<hr class="border-0 border-bottom border-secondary">
<!-- end title halaman -->


<!-- Content start -->

<div class="halaman-data-guru mt-4">


    <!-- informasi -->

    <!-- id nama jenis kelamin no t elp -->

    <div class="data-gurus d-flex justify-content-between flex-wrap mt-5">
        <?php $i = 1; ?>
        <?php foreach ($getLevel as $level) : ?>
            <div class="data-guru rounded p-3 mb-5">
                <div class="data-guru-grid d-flex w-100 mt-1 px-3">
                    <i class="fas fa-sun text-danger"></i>
                    <div>
                        <h5>Level #<?= $i++; ?></h5>
                        <!-- <small class="fw-bold text-danger"><?= $level['nama_level']; ?></small> -->
                    </div>

                    <!-- <a class="rounded text-light text-center text-decoration-none" href="<?= base_url('/Level/LevelPages/sunting/' . $level['level_id']); ?>">Sunting</a> -->
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- akhir informasi -->
</div>
<!-- end content  -->

<?= $this->endSection(); ?>