<?= $this->extend('Render/index'); ?>

<?= $this->section('render'); ?>
<!-- title halaman -->
<h1 class="title-halaman"><i class="fas fa-database"></i> Data Level—Form Edit Data</h1>
<hr class="border-0 border-bottom border-secondary">
<!-- end title halaman -->

<!-- button tambah, jumlah -->
<div class="data-jumlah d-flex w-100 mt-4">
    <a class="data-jumlah-button py-2 rounded  text-decoration-none text-center text-light" href="<?= base_url('Level'); ?>"><i class="fas fa-home"></i>
        Kembali</a>
    <a class="data-jumlah-button py-2 rounded  text-decoration-none text-center text-light" href="<?= base_url('Level/LevelProcess/hapus/' . $getSpesificLevel->level_id); ?>"><i class="fas fa-trash"></i>
        Hapus Level Ini</a>

    <a class="text-decoration-none fw-bold rounded py-2 text-center"><?= $countLevel; ?> Level Telah Dibuat</a>
</div>

<!-- Form jadwal -->
<form action="<?= base_url('Level/LevelProcess/suntingLevel'); ?>" method="POST" class="jadwal-form">
    <?= csrf_field(); ?>

    <input type="hidden" name="level_id" value="<?= $getSpesificLevel->level_id; ?>">

    <div class="input-form mb-5 mt-5">
        <label class="fw-bold d-block mb-3" for=""><i class="fas fa-window-maximize"></i> Nama
            Level</label>
        <input type="text" name="nama_level" value="<?= old('nama_level') ? old('nama_level') : $getSpesificLevel->nama_level; ?>" <?= $validation->hasError('nama_level') ? 'placeholder="' . $validation->getError('nama_level') . '"' : ''; ?> class="<?= $validation->hasError('nama_level') ? 'notice-red' : ''; ?> px-2 w-100">
    </div>

    <button type="submit" class="buttonbro text-center text-light rounded border-0 fw-bold w-25">Simpan Level</button>
</form>
<!-- End form jadwal -->

<?= $this->endSection(); ?>