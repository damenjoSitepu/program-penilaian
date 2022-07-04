<?= $this->extend('Render/index'); ?>

<?= $this->section('render'); ?>
<!-- title halaman -->
<h2 class="title-halaman"><i class="fas fa-star"></i> Data Nilai—Sunting Nilai Anak Didik</h2>
<hr class="border-0 border-bottom border-secondary">
<!-- end title halaman -->

<!-- Content start -->
<div class="halaman-data-guru mt-4">
    <!-- button tambah, jumlah -->
    <div class="data-jumlah d-flex w-100 mt-4">
        <a class="data-jumlah-button py-2 rounded  text-decoration-none text-center text-light" href="<?= base_url('/Nilai'); ?>"><i class="fas fa-home"></i>
            Kembali Ke Halaman Nilai</a>
        <a class="data-jumlah-button py-2 rounded  text-decoration-none text-center text-light" href="<?= base_url('/Nilai/NilaiPages/kelolaPenilaian/' . $getNilaiId); ?>"><i class="fas fa-cog"></i>
            Kembali Ke Struktur Nilai</a>

        <a class="data-jumlah-button py-2 rounded  text-decoration-none text-center text-light" href="<?= base_url('/Nilai/NilaiPages/detail/' . $getNilaiId); ?>"><i class="fas fa-user-graduate"></i>
            Visualisasi Performa Nilai Anak Didik</a>
    </div>
</div>

<!-- Form daftar murid nilai -->
<form action="<?= base_url('Nilai/NilaiProcess/simpanNilai'); ?>" method="POST" class="form-daftar-nilai mt-5 ">
    <?= csrf_field(); ?>
    <input type="hidden" name="nilai_id" value="<?= $getNilaiId; ?>">
    <div class="d-flex justify-content-between flex-wrap">
        <?php foreach ($getNilaiDetail as $detail) : ?>
            <div class="input-form mb-5">
                <label class="fw-bold d-block mb-3" for=""><i class="fas fa-user-graduate"></i>
                    <?= $detail['nama_wali']; ?></label>
                <select name="info[]" id="" class="px-2 w-100">
                    <?php foreach ($getSkor as $skor) : ?>
                        <?php if ($skor['skor_id'] == $detail['skor_id']) : ?>
                            <option selected="selected" value="<?= $detail['user_id'] . '|' . $skor['skor_id']; ?>"><?= $skor['skor_id']; ?> | <?= $skor['nama_skor']; ?></option>
                        <?php else : ?>
                            <option value="<?= $detail['user_id'] . '|' . $skor['skor_id']; ?>"><?= $skor['skor_id']; ?> | <?= $skor['nama_skor']; ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>
        <?php endforeach; ?>


    </div>

    <button type="submit" class="buttonbro text-center rounded border-0 w-50 fw-bold">Simpan Nilai Seluruh Anak
        Didik</button>
</form>

<!-- End form daftar murid nilai -->

<!-- end content  -->

<?= $this->endSection(); ?>