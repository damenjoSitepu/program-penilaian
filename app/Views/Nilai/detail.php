<?= $this->extend('Render/index'); ?>

<?= $this->section('render'); ?>
<!-- title halaman -->
<h2 class="title-halaman"><i class="fas fa-star"></i> Data Nilai—Visualisasi Performa Anak Didik</h2>
<hr class="border-0 border-bottom border-secondary">
<!-- end title halaman -->

<!-- Content start -->

<div class="halaman-data-guru mt-4">
    <!-- button tambah, jumlah -->
    <div class="data-jumlah d-flex w-100 mt-4">
        <a class="data-jumlah-button py-2 rounded  text-decoration-none text-center text-light" href="<?= base_url('Nilai'); ?>"><i class="fas fa-home"></i>
            Kembali</a>

        <a class="data-jumlah-button py-2 rounded  text-decoration-none text-center text-light" href="<?= base_url('/Nilai/NilaiPages/suntingNilai/' . $getNilaiId); ?>"><i class="fas fa-keyboard"></i>
            Sunting Nilai</a>

        <a class="data-jumlah-button py-2 rounded  text-decoration-none text-center text-light" href="<?= base_url('/Nilai/NilaiPages/kelolaPenilaian/' . $getNilaiId); ?>"><i class="fas fa-cogs"></i>
            Struktur Nilai</a>

        <?php if (session()->get('login')['kelas'] == 1) : ?>
            <a class="text-decoration-none fw-bold rounded py-2 text-center">
                <?= session()->get('login')['nama']; ?> - ( Akun Admin )</a>
        <?php else : ?>
            <a class="text-decoration-none fw-bold rounded py-2 text-center">Motivator Oleh:
                <?= session()->get('login')['nama']; ?></a>
        <?php endif; ?>
    </div>
</div>

<div class="data-absens mt-5 border rounded px-3 pt-3 pb-5">
    <?php foreach ($getRank as $rank) : ?>
        <div class="data-absen d-flex">
            <div class="data-absen-left">
                <div class="data-absen-header d-flex">
                    <div class="as1">
                        <h4 class="text-light rounded-circle text-center d-inline-block"><i class="fas fa-crown"></i></h4>
                    </div>
                    <h4 class="as2 d-inline-block"> <?= date('l, d-M-Y', strtotime($rank['header']['tanggal_penilaian'])); ?>—Tugas Harian <i class="fas fa-pen-to-square"></i></h4>
                </div>

                <div class="data-absen-body mt-4 d-block">
                    <?php $i = 1; ?>
                    <?php foreach ($rank['body'] as $anak) : ?>
                        <div class="body mb-3 d-flex">
                            <p><span><?= $i++; ?></span></p>
                            <p><?= $anak['nama_wali']; ?>: <span class="text-success">
                                    <?= visualizeStars($anak['skor_id']); ?>
                                </span></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="data-absen-right">
                <h5 class="buttonbro rounded">Diikuti <?= count($rank['body']); ?> Anak Didik</h5>
            </div>
        </div>
    <?php endforeach; ?>

</div>

<!-- end content  -->

<?= $this->endSection(); ?>