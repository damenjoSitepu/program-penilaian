<?= $this->extend('Render/index'); ?>

<?= $this->section('render'); ?>
<!-- title halaman -->
<h1 class="title-halaman"><i class="fas fa-calendar"></i> Data Jadwal—Form Tambah Data</h1>
<hr class="border-0 border-bottom border-secondary">
<!-- end title halaman -->

<!-- button tambah, jumlah -->
<div class="data-jumlah d-flex w-75 mt-4 mb-5">
    <a class="data-jumlah-button py-2 rounded  text-decoration-none text-center text-light" href="<?= base_url('Jadwal'); ?>"><i class="fas fa-home"></i>
        Kembali</a>

    <a class="text-decoration-none fw-bold rounded py-2 text-center"><?= $countJadwal; ?> Jadwal Telah Dibuat</a>
</div>

<!-- Form jadwal -->
<form action="<?= base_url('Jadwal/JadwalProcess/buatJadwal'); ?>" method="POST" class="jadwal-form">
    <?= csrf_field(); ?>
    <div class="input-form mb-5 w-50">
        <label class="fw-bold d-block mb-3" for=""><i class="fas fa-clock"></i> Tentukan Hari</label>
        <select name="hari_id" id="" class="px-2 w-100">
            <?php foreach ($getHari as $hari) : ?>
                <option value="<?= $hari['hari_id']; ?>"><?= $hari['nama_hari']; ?></option>
            <?php endforeach; ?>

        </select>
    </div>

    <div class="d-flex justify-content-between">
        <div class="input-form mb-5">
            <label class="fw-bold d-block mb-3" for=""><i class="fas fa-hourglass-start"></i> Jam
                Mulai</label>
            <input type="time" name="jam_mulai" value="<?= old('jam_mulai'); ?>" <?= $validation->hasError('jam_mulai') ? 'placeholder="' . $validation->getError('jam_mulai') . '"' : ''; ?> class="<?= $validation->hasError('jam_mulai') ? 'notice-red' : ''; ?> px-2 w-100">
        </div>

        <div class="input-form mb-5">
            <label class="fw-bold d-block mb-3" for=""><i class="fas fa-hourglass-end"></i> Jam
                Berakhir</label>
            <input type="time" name="jam_berakhir" value="<?= old('jam_berakhir'); ?>" <?= $validation->hasError('jam_berakhir') ? 'placeholder="' . $validation->getError('jam_berakhir') . '"' : ''; ?> class="<?= $validation->hasError('jam_berakhir') ? 'notice-red' : ''; ?> px-2 w-100">
        </div>
    </div>

    <div class="input-form mb-5 w-50">
        <label class="fw-bold d-block mb-3" for=""><i class="fas fa-clock"></i> Pilih Level</label>
        <select name="level_id" id="" class="px-2 w-100">
            <?php foreach ($getLevel as $level) : ?>
                <option value="<?= $level['level_id']; ?>"><?= $level['level_id']; ?> | <?= $level['nama_level']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <button class="buttonbro text-center text-light rounded border-0 fw-bold w-25">Simpan Jadwal</button>
</form>
<!-- End form jadwal -->
<?= $this->endSection(); ?>