<?= $this->extend('Render/index'); ?>

<?= $this->section('render'); ?>
<!-- title halaman -->
<h1 class="title-halaman"><i class="fas fa-star"></i> Data Nilai—Form Buat Penilaian</h1>
<hr class="border-0 border-bottom border-secondary">
<!-- end title halaman -->

<!-- Content start -->

<div class="halaman-data-guru mt-4">
    <!-- button tambah, jumlah -->
    <div class="data-jumlah d-flex w-75 mt-4">
        <a class="data-jumlah-button py-2 rounded  text-decoration-none text-center text-light" href="<?= base_url('Nilai'); ?>"><i class="fas fa-home"></i>
            Kembali</a>

        <?php if (session()->get('login')['kelas'] == 1) : ?>
            <a class="text-decoration-none fw-bold rounded py-2 text-center">Pembuat Penilaian:
                <?= session()->get('login')['nama']; ?> - ( Admin )</a>
        <?php else : ?>
            <a class="text-decoration-none fw-bold rounded py-2 text-center">Motivator Pembuat Penilaian:
                <?= session()->get('login')['nama']; ?></a>
        <?php endif; ?>

    </div>

    <!-- Form buat penilaian -->
    <form action="<?= base_url('Nilai/NilaiProcess/buatNilai'); ?>" method="POST" class="form-buat-penilaian mt-5">
        <?= csrf_field(); ?>
        <div class="gabung-1 d-flex justify-content-between">
            <div class="input-form mb-5">
                <label class="fw-bold d-block mb-3" for=""><i class="fas fa-user-pen"></i> Kategori
                    Penilaian</label>
                <select name="kategori_nilai_id" id="" class="px-2 w-100">
                    <?php foreach ($getKategori as $kategori) : ?>
                        <option value="<?= $kategori['kategori_nilai_id']; ?>"><?= $kategori['nama_kategori_nilai']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="input-form mb-5">
                <label class="fw-bold d-block mb-3" for=""><i class="fas fa-calendar"></i> Tanggal
                    Penilaian</label>
                <input type="date" name="tanggal_penilaian" value="<?= old('tanggal_penilaian'); ?>" <?= $validation->hasError('tanggal_penilaian') ? 'placeholder="' . $validation->getError('tanggal_penilaian') . '"' : ''; ?> class="<?= $validation->hasError('tanggal_penilaian') ? 'notice-red' : ''; ?> px-2 w-100">
            </div>
        </div>

        <div class="input-form mb-5 w-75">
            <label class="fw-bold d-block mb-3" for=""><i class="fas fa-signal"></i> Pilih Level</label>
            <select id="" name="level_id" class="px-2 w-100 kategori_nilai_change">
                <option value="0">Pilih Level</option>
                <?php foreach ($getLevel as $level) : ?>
                    <option value="<?= $level['level_id']; ?>"><?= $level['level_id']; ?> | <?= $level['nama_level']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="input-form mb-5 w-50 displayhidden">
            <label class="fw-bold d-block mb-3" for=""><i class="fas fa-user-lock"></i> Pilih Jadwal</label>
            <select name="jadwal_id" id="" class="px-2 w-100 fillJadwal">

            </select>
        </div>

        <div class="input-form mb-5 w-75">
            <label class="fw-bold d-block mb-3" for=""><i class="fas fa-book"></i> Mata Pelajaran</label>
            <input type="text" name="mata_pelajaran" value="<?= old('mata_pelajaran'); ?>" <?= $validation->hasError('mata_pelajaran') ? 'placeholder="' . $validation->getError('mata_pelajaran') . '"' : ''; ?> class="<?= $validation->hasError('mata_pelajaran') ? 'notice-red' : ''; ?> px-2 w-100">
        </div>

        <?php if (session()->get('login')['kelas'] == 1) : ?>
            <div class="input-form mb-5 w-75">
                <label class="fw-bold d-block mb-3" for=""><i class="fas fa-users"></i> Pilih Motivator</label>
                <select name="user_id" id="" class="px-2 w-100">
                    <?php foreach ($getMotivator as $motivator) : ?>
                        <option value="<?= $motivator['user_id']; ?>">ID: <?= $motivator['id']; ?> | <?= $motivator['nama']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        <?php endif; ?>

        <button type="submit" class="buttonbro text-center text-light rounded border-0 fw-bold w-25">Simpan Ruang
            Penilaian</button>
    </form>

    <!-- Akhir form buat penilaian -->



    <!-- end content  -->
</div>
<!-- End content -->

<?= $this->endSection(); ?>