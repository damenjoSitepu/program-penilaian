<!-- title halaman -->
<h1 class="title-halaman"><i class="fas fa-door-open"></i> Beranda Orang Tua</h1>
<hr class="border-0 border-bottom border-secondary">
<!-- end title halaman -->

<div class="halaman-beranda-wali d-flex justify-content-between mt-5 rounded border p-3">
    <div class="img">
        <img src="<?= base_url('assets/img/welcome-wali.png'); ?>" alt="">
    </div>

    <div class="informasi">
        <h4><i class="fas fa-cloud-moon"></i> Selamat Datang Di Web <span>Bimba Aiueo</span> Kami</h4>

        <h4 class="ibu text-light w-50 d-inline-block rounded mt-3 text-center py-2 mb-4">

            Ibu / Bapak <?= $getUser->nama; ?>

        </h4>
        <h5>Dari Anak Didik</h5>
        <h3 class="text-danger"><?= $getUser->nama_wali; ?></h3>
    </div>
</div>