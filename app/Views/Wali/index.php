<?= $this->extend('Render/index'); ?>

<?= $this->section('render'); ?>
<!-- title halaman -->
<h1 class="title-halaman"><i class="fas fa-user-graduate"></i> Data Anak Didik</h1>
<hr class="border-0 border-bottom border-secondary">
<!-- end title halaman -->

<!-- Content start -->

<div class="data-anak-anda mt-4">
    <h2><i class="fas fa-address-card mb-4"></i> Informasi Umum</h2>

    <div class="row">
        <div class="col-lg-4">
            <h6><i class="fas fa-user"></i> Nama Anak—</h6>
            <h5 class="text-secondary"><?= $getUser->nama_wali; ?></h5>
        </div>

        <div class="col-lg-4">
            <h6><i class="fas fa-mars"></i>Jenis Kelamin—</h6>
            <?php if ($getUser->jenis_kelamin == 1) : ?>
                <h5 class="text-secondary">Laki-Laki</h5>
            <?php else : ?>
                <h5 class="text-secondary">Perempuan</h5>
            <?php endif; ?>
        </div>

        <div class="col-lg-4">
            <h6><i class="fas fa-calendar"></i> Tanggal Lahir—</h6>
            <h5 class="text-secondary"><?= date('l, j-M-Y', strtotime($getUser->tanggal_lahir)); ?></h5>
        </div>
    </div>

    <hr class="border-bottom border-secondary">

    <div class="row">
        <div class="col-lg-5 border-end">
            <h6 class="mt-3"><i class="fas fa-book-quran"></i> Agama</h6>
            <h5 class="text-secondary"><?= $getUser->agama; ?></h5>

            <h6 class="mt-4"><i class="fas fa-phone"></i> No. Telepon</h6>
            <h5 class="text-secondary"><?= $getUser->no_telepon; ?></h5>
        </div>

        <div class="col-lg-7">
            <h6 class="mt-3"><i class="fas fa-users"></i> Nama Orang Tua</h6>
            <h5 class="text-secondary"><?= $getUser->nama; ?></h5>

            <h6 class="mt-4"><i class="fas fa-address-card"></i> Alamat</h6>
            <h5 class="text-secondary"><?= $getUser->alamat; ?></h5>
        </div>
    </div>

    <hr class="border-bottom border-secondary">

    <h6 class="mt-4"><i class="fas fa-star"></i> Level ID</h6>
    <h4 class="text-danger"><?= $getUser->level_id; ?> - <?= $getUser->nama_level; ?></h4>
    <hr class="border-bottom border-secondary">

    <!-- manipulasi gambar -->
    <h3 class="d-block m-auto text-center text-danger my-4">Daftar Sertifikat Kamu</h3>
    <div class="lefts d-flex flex-wrap justify-content-center">
        <?php if ($getUser->photo1 != 'default.png') : ?>
            <a class="buttonbro text-decoration-none text-center d-block me-3 w-25 rounded mt-4 fw-bold" href="<?= base_url('/AnakDidik/AnakDidikProcess/sertifikat/' . $getUser->photo1); ?>"><i class="fas fa-scroll text-light"></i>Sertifikat Level 1!</a>
        <?php endif; ?>

        <?php if ($getUser->photo2 != 'default.png') : ?>
            <a class="buttonbro text-decoration-none text-center d-block me-3 w-25 rounded mt-4 fw-bold" href="<?= base_url('/AnakDidik/AnakDidikProcess/sertifikat/' . $getUser->photo2); ?>"><i class="fas fa-scroll text-light"></i> Sertifikat Level 2!</a>
        <?php endif; ?>

        <?php if ($getUser->photo3 != 'default.png') : ?>
            <a class="buttonbro text-decoration-none text-center d-block me-3 w-25 rounded mt-4 fw-bold" href="<?= base_url('/AnakDidik/AnakDidikProcess/sertifikat/' . $getUser->photo3); ?>"><i class="fas fa-scroll text-light"></i> Sertifikat Level 3!</a>
        <?php endif; ?>

        <?php if ($getUser->photo4 != 'default.png') : ?>
            <a class="buttonbro text-decoration-none text-center d-block me-3 w-25 rounded mt-4 fw-bold" href="<?= base_url('/AnakDidik/AnakDidikProcess/sertifikat/' . $getUser->photo4); ?>"><i class="fas fa-scroll text-light"></i> Sertifikat Level 4!</a>
        <?php endif; ?>
    </div>

</div>
<!-- end content  -->

<?= $this->endSection(); ?>