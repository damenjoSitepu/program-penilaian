<?= $this->extend('Render/index'); ?>

<?= $this->section('render'); ?>
<!-- title halaman -->
<h2 class="title-halaman"><i class="fas fa-users"></i> Data Motivator—Form Tambah Data</h2>
<hr class="border-0 border-bottom border-secondary">
<!-- end title halaman -->

<!-- button tambah, jumlah -->
<div class="data-jumlah d-flex w-75 mt-4">
    <a class="data-jumlah-button py-2 rounded  text-decoration-none text-center text-light" href="<?= base_url('Motivator'); ?>"><i class="fas fa-home"></i>
        Kembali</a>

    <a class="text-decoration-none fw-bold rounded py-2 text-center"><?= $countMotivator; ?> Motivator Telah Dibuat</a>
</div>

<!-- Form dimulai -->
<form action="<?= base_url('Motivator/MotivatorProcess/buatMotivator'); ?>" method="POST" class="form-daftar-guru mt-5">
    <?= csrf_field(); ?>

    <div class="gabung-1 d-flex justify-content-between">
        <div class="input-form mb-5">
            <label class="fw-bold d-block mb-3" for=""><i class="fas fa-user"></i> Nama</label>
            <input type="text" name="nama" value="<?= old('nama'); ?>" <?= $validation->hasError('nama') ? 'placeholder="' . $validation->getError('nama') . '"' : ''; ?> class="<?= $validation->hasError('nama') ? 'notice-red' : ''; ?> px-2 w-100">
        </div>


        <div class="input-form mb-5">
            <label class="fw-bold d-block mb-3" for=""><i class="fas fa-key"></i> ID</label>
            <input type="text" name="id" value="<?= old('id'); ?>" <?= $validation->hasError('id') ? 'placeholder="' . $validation->getError('id') . '"' : ''; ?> class="<?= $validation->hasError('id') ? 'notice-red' : ''; ?> px-2 w-100">
        </div>
    </div>


    <div class="gabung-1 d-flex justify-content-between">
        <div class="input-form mb-5">
            <label class="fw-bold d-block mb-3" for=""><i class="fas fa-calendar"></i> Tanggal
                Lahir</label>
            <input type="date" name="tanggal_lahir" value="<?= old('tanggal_lahir'); ?>" <?= $validation->hasError('tanggal_lahir') ? 'placeholder="' . $validation->getError('tanggal_lahir') . '"' : ''; ?> class="<?= $validation->hasError('tanggal_lahir') ? 'notice-red' : ''; ?> px-2 w-100">
        </div>

        <div class="input-form mb-5">
            <label class="fw-bold d-block mb-3" for=""><i class="fas fa-clock"></i> Jenis Kelamin</label>
            <select name="jenis_kelamin" id="" class="px-2 w-100">
                <option value="1">Laki-Laki</option>
                <option value="0">Perempuan</option>
            </select>
        </div>
    </div>

    <div class="gabung-2 d-flex justify-content-between">
        <div class="a input-form mb-5">
            <label class="fw-bold d-block mb-3" for=""><i class="fas fa-book-quran"></i> Agama</label>
            <input type="text" name="agama" value="<?= old('agama'); ?>" <?= $validation->hasError('agama') ? 'placeholder="' . $validation->getError('agama') . '"' : ''; ?> class="<?= $validation->hasError('agama') ? 'notice-red' : ''; ?> px-2 w-100">
        </div>
        <div class="b input-form mb-5">
            <label class="fw-bold d-block mb-3" for=""><i class="fas fa-phone"></i> No. Telepon</label>
            <input type="text" name="no_telepon" value="<?= old('no_telepon'); ?>" <?= $validation->hasError('no_telepon') ? 'placeholder="' . $validation->getError('no_telepon') . '"' : ''; ?> class="<?= $validation->hasError('no_telepon') ? 'notice-red' : ''; ?> px-2 w-100">
        </div>
        <div class="c input-form mb-5">
            <label class="fw-bold d-block mb-3" for=""><i class="fas fa-envelope"></i> Email</label>
            <input type="text" name="email" value="<?= old('email'); ?>" <?= $validation->hasError('email') ? 'placeholder="' . $validation->getError('email') . '"' : ''; ?> class="<?= $validation->hasError('email') ? 'notice-red' : ''; ?> px-2 w-100">
        </div>
    </div>

    <div class="input-form mb-5 w-75">
        <label class="fw-bold d-block mb-3" for=""><i class="fas fa-user"></i> Alamat</label>
        <input type="text" name="alamat" value="<?= old('alamat'); ?>" <?= $validation->hasError('alamat') ? 'placeholder="' . $validation->getError('alamat') . '"' : ''; ?> class="<?= $validation->hasError('alamat') ? 'notice-red' : ''; ?> px-2 w-100">
    </div>

    <button type="submit" class="buttonbro text-center text-light rounded border-0 fw-bold w-25">Simpan Motivator</button>
</form>
<!-- Akhir form  -->

<!-- akhir informasi -->

<?= $this->endSection(); ?>