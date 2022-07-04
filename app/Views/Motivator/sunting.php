<?= $this->extend('Render/index'); ?>

<?= $this->section('render'); ?>
<!-- title halaman -->
<h2 class="title-halaman"><i class="fas fa-users"></i> Data Motivator—Form Edit Data</h2>
<hr class="border-0 border-bottom border-secondary">
<!-- end title halaman -->

<!-- button tambah, jumlah -->
<div class="data-jumlah d-flex w-100 mt-4">
    <a class="data-jumlah-button py-2 rounded  text-decoration-none text-center text-light" href="<?= base_url('Motivator'); ?>"><i class="fas fa-home"></i>
        Kembali</a>
    <a class="data-jumlah-button py-2 rounded  text-decoration-none text-center text-light" href="<?= base_url('Motivator/MotivatorProcess/hapus/' . $getSpesificMotivator->user_id); ?>"><i class="fas fa-trash"></i>
        Hapus Motivator Ini</a>

    <a class="text-decoration-none fw-bold rounded py-2 text-center"><?= $countMotivator; ?> Motivator Telah Dibuat</a>
</div>

<!-- Form dimulai -->
<form action="<?= base_url('Motivator/MotivatorProcess/suntingMotivator'); ?>" method="POST" class="form-daftar-guru mt-5">
    <?= csrf_field(); ?>
    <input type="hidden" name="user_id" value="<?= $getSpesificMotivator->user_id; ?>">
    <input type="hidden" name="old_password" value="<?= $getSpesificMotivator->password; ?>">

    <div class="gabung-1 d-flex justify-content-between">
        <div class="input-form mb-5">
            <label class="fw-bold d-block mb-3" for=""><i class="fas fa-user"></i> Nama <span class="text-secondary">( Tidak Bisa Diubah )</span></label>
            <input type="text" disabled="disabled" value="<?= old('nama') ? old('nama') : $getSpesificMotivator->nama; ?>" <?= $validation->hasError('nama') ? 'placeholder="' . $validation->getError('nama') . '"' : ''; ?> class="<?= $validation->hasError('nama') ? 'notice-red' : ''; ?> px-2 w-100">
        </div>

        <div class="input-form mb-5">
            <label class="fw-bold d-block mb-3" for=""><i class="fas fa-address-card"></i> ID</label>
            <input type="text" name="id" value="<?= old('id') ? old('id') : $getSpesificMotivator->id; ?>" <?= $validation->hasError('id') ? 'placeholder="' . $validation->getError('id') . '"' : ''; ?> class="<?= $validation->hasError('id') ? 'notice-red' : ''; ?> px-2 w-100">
        </div>
    </div>


    <div class="gabung-1 d-flex justify-content-between">
        <div class="input-form mb-5">
            <label class="fw-bold d-block mb-3" for=""><i class="fas fa-calendar"></i> Tanggal
                Lahir</label>
            <input type="text" name="tanggal_lahir" value="<?= old('tanggal_lahir') ? old('tanggal_lahir') : $getSpesificMotivator->tanggal_lahir; ?>" <?= $validation->hasError('tanggal_lahir') ? 'placeholder="' . $validation->getError('tanggal_lahir') . '"' : ''; ?> class="<?= $validation->hasError('tanggal_lahir') ? 'notice-red' : ''; ?> px-2 w-100">
        </div>

        <div class="input-form mb-5">
            <label class="fw-bold d-block mb-3" for=""><i class="fas fa-clock"></i> Jenis Kelamin</label>
            <select name="jenis_kelamin" class="px-2 w-100">
                <?php if ($getSpesificMotivator->jenis_kelamin == 1) : ?>
                    <option value="1" selected="selected">Laki-Laki</option>
                    <option value="0">Perempuan</option>
                <?php else : ?>
                    <option value="1">Laki-Laki</option>
                    <option value="0" selected="selected">Perempuan</option>
                <?php endif; ?>

            </select>
        </div>
    </div>

    <div class="gabung-2 d-flex justify-content-between">
        <div class="a input-form mb-5">
            <label class="fw-bold d-block mb-3" for=""><i class="fas fa-book-quran"></i> Agama</label>
            <input type="text" name="agama" value="<?= old('agama') ? old('agama') : $getSpesificMotivator->agama; ?>" <?= $validation->hasError('agama') ? 'placeholder="' . $validation->getError('agama') . '"' : ''; ?> class="<?= $validation->hasError('agama') ? 'notice-red' : ''; ?> px-2 w-100">
        </div>

        <div class="b input-form mb-5">
            <label class="fw-bold d-block mb-3" for=""><i class="fas fa-phone"></i> No. Telepon</label>
            <input type="text" name="no_telepon" value="<?= old('no_telepon') ? old('no_telepon') : $getSpesificMotivator->no_telepon; ?>" <?= $validation->hasError('no_telepon') ? 'placeholder="' . $validation->getError('no_telepon') . '"' : ''; ?> class="<?= $validation->hasError('no_telepon') ? 'notice-red' : ''; ?> px-2 w-100">
        </div>

        <div class="c input-form mb-5">
            <label class="fw-bold d-block mb-3" for=""><i class="fas fa-envelope"></i> Email</label>
            <input type="text" name="email" value="<?= old('email') ? old('email') : $getSpesificMotivator->email; ?>" <?= $validation->hasError('email') ? 'placeholder="' . $validation->getError('email') . '"' : ''; ?> class="<?= $validation->hasError('email') ? 'notice-red' : ''; ?> px-2 w-100">
        </div>
    </div>

    <div class="input-form mb-5 w-75">
        <label class="fw-bold d-block mb-3" for=""><i class="fas fa-user"></i> Alamat</label>
        <input type="text" name="alamat" value="<?= old('alamat') ? old('alamat') : $getSpesificMotivator->alamat; ?>" <?= $validation->hasError('alamat') ? 'placeholder="' . $validation->getError('alamat') . '"' : ''; ?> class="<?= $validation->hasError('alamat') ? 'notice-red' : ''; ?> px-2 w-100">
    </div>

    <h4><i class="text-danger fas fa-pen-to-square mb-4"></i> Informasi Khusus</h4>

    <hr class="border-bottom border-secondary">

    <div class="input-form mb-3 mt-4 w-25">
        <label class="fw-bold d-block mb-3" for=""><i class="fas fa-key"></i> Password</label>
        <input type="password" name="password" placeholder="Ganti Password Baru" class="px-2 w-100">
    </div>
    <small class="d-block mb-5 fw-bold"><i class="fas fa-triangle-exclamation text-danger"></i> Password Default: <span class="text-danger">123</span></small>

    <div class="input-form mb-3 mt-4 w-50">
        <label class="fw-bold d-block mb-3" for=""><i class="fas fa-user-lock"></i> Username</label>
        <input type="text" value="<?= $getSpesificMotivator->username; ?>" disabled="disabled" placeholder="Ganti Password Baru" class="px-2 w-100">
    </div>
    <small class="d-block mb-5 fw-bold"><i class="fas fa-triangle-exclamation text-danger"></i> Username Tidak Bisa Dirubah Selamanya</small>

    <button type="submit" class="buttonbro text-center text-light rounded border-0 fw-bold w-25 mt-4"><i class="fas fa-pen-to-square"></i> Sunting
        Motivator</button>
</form>
<!-- Akhir form  -->

<!-- akhir informasi -->

<?= $this->endSection(); ?>