<!-- title halaman -->
<h2 class="title-halaman"><i class="fas fa-file"></i> Data Absen—Form Kehadiran Anak Didik</h1>
    <hr class="border-0 border-bottom border-secondary">
    <!-- end title halaman -->
    <?= $this->extend('Render/index'); ?>

    <?= $this->section('render'); ?>
    <!-- title halaman -->
    <h2 class="title-halaman"><i class="fas fa-file"></i> Data Absen—Form Kehadiran Anak Didik</h1>
        <hr class="border-0 border-bottom border-secondary">
        <!-- end title halaman -->

        <!-- button tambah, jumlah -->
        <div class="data-jumlah d-flex w-75 mt-4">
            <a class="data-jumlah-button py-2 rounded  text-decoration-none text-center text-light" href="<?= base_url('Absensi'); ?>"><i class="fas fa-home"></i>
                Kembali</a>
            <a class="text-decoration-none fw-bold rounded py-2 text-center">Hari Ini Tanggal: <?= date('F j, Y'); ?></a>
        </div>

        <!-- Form -->
        <form action="<?= base_url('Absensi/AbsensiProcess/buatAbsensi'); ?>" method="POST" class="form-absen mt-5">
            <?= csrf_field(); ?>

            <div class="gabung-1 d-flex justify-content-between w-75">
                <div class="input-form  w-50">
                    <label class="fw-bold d-block mb-3" for=""><i class="fas fa-calendar"></i>
                        Tanggal Absen</label>
                    <input type="date" name="tanggal_absen" value="<?= old('tanggal_absen'); ?>" <?= $validation->hasError('tanggal_absen') ? 'placeholder="' . $validation->getError('tanggal_absen') . '"' : ''; ?> class="<?= $validation->hasError('tanggal_absen') ? 'notice-red' : ''; ?> px-2 w-100">
                </div>

            </div>

            <div class="input-form mb-5 mt-5 w-50">
                <label class="fw-bold d-block mb-3" for=""><i class="fas fa-user-graduate"></i> Pilih Anak
                    Didik</label>
                <select name="user_id" id="" class="px-2 w-100">
                    <?php foreach ($getUser as $user) : ?>
                        <option value="<?= $user['user_id']; ?>"><?= $user['nama_wali']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="input-form mb-5 mt-5 w-50">
                <label class="fw-bold d-block mb-3" for=""><i class="fas fa-signal"></i> Status
                    Kehadiran</label>
                <select name="status_id" id="" class="px-2 w-100">
                    <?php foreach ($getStatus as $status) : ?>
                        <option value="<?= $status['status_id']; ?>"><?= $status['nama_status']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="buttonbro text-center border-0 rounded w-25 fw-bold">Simpan Absensi Harian</button>

        </form>
        <!-- End Form -->

        <?= $this->endSection(); ?>