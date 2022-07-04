<?= $this->extend('Render/index'); ?>

<?= $this->section('render'); ?>
<!-- title halaman -->
<h1 class="title-halaman"><i class="fas fa-calendar"></i> Data Jadwal—Form Edit Data</h1>
<hr class="border-0 border-bottom border-secondary">
<!-- end title halaman -->

<!-- button tambah, jumlah -->
<div class="data-jumlah d-flex w-100 mt-4">
    <a class="data-jumlah-button py-2 rounded  text-decoration-none text-center text-light" href="<?= base_url('Jadwal'); ?>"><i class="fas fa-home"></i>
        Kembali</a>
    <a class="data-jumlah-button py-2 rounded  text-decoration-none text-center text-light" href="<?= base_url('Jadwal/JadwalProcess/hapus/' . $getSpesificJadwal->jadwal_id); ?>"><i class="fas fa-trash"></i>
        Hapus Jadwal</a>

</div>

<!-- Form jadwal -->
<form action="<?= base_url('Jadwal/JadwalProcess/suntingJadwal'); ?>" method="POST" class="jadwal-form mt-5">
    <h2 class="text-danger mb-5"><?= $getSpesificJadwal->nama_level; ?>—Hari <?= $getSpesificJadwal->nama_hari; ?></h2>

    <?= csrf_field(); ?>
    <input type="hidden" name="jadwal_id" value="<?= $getSpesificJadwal->jadwal_id; ?>">

    <div class="input-form mb-5 w-50">
        <label class="fw-bold d-block mb-3" for=""><i class="fas fa-clock"></i> Tentukan Hari</label>
        <select name="hari_id" id="" class="px-2 w-100">
            <?php foreach ($getHari as $hari) : ?>
                <?php if ($hari['hari_id'] == $getSpesificJadwal->hari_id) : ?>
                    <option selected="selected" value="<?= $hari['hari_id']; ?>"><?= $hari['nama_hari']; ?></option>
                <?php else : ?>
                    <option value="<?= $hari['hari_id']; ?>"><?= $hari['nama_hari']; ?></option>
                <?php endif; ?>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="d-flex justify-content-between">
        <div class="input-form mb-5">
            <label class="fw-bold d-block mb-3" for=""><i class="fas fa-hourglass-start"></i> Jam
                Mulai</label>
            <input type="time" name="jam_mulai" value="<?= old('jam_mulai') ? old('jam_mulai') : $getSpesificJadwal->jam_mulai; ?>" <?= $validation->hasError('jam_mulai') ? 'placeholder="' . $validation->getError('jam_mulai') . '"' : ''; ?> class="<?= $validation->hasError('jam_mulai') ? 'notice-red' : ''; ?> px-2 w-100">
        </div>

        <div class="input-form mb-5">
            <label class="fw-bold d-block mb-3" for=""><i class="fas fa-hourglass-end"></i> Jam
                Berakhir</label>
            <input type="time" name="jam_berakhir" value="<?= old('jam_berakhir') ? old('jam_berakhir') : $getSpesificJadwal->jam_berakhir; ?>" <?= $validation->hasError('jam_berakhir') ? 'placeholder="' . $validation->getError('jam_berakhir') . '"' : ''; ?> class="<?= $validation->hasError('jam_berakhir') ? 'notice-red' : ''; ?> px-2 w-100">
        </div>
    </div>

    <div class="input-form mb-5 w-50">
        <label class="fw-bold d-block mb-3" for=""><i class="fas fa-clock"></i> Pilih Level</label>
        <select name="level_id" id="" class="px-2 w-100">
            <?php foreach ($getLevel as $level) : ?>
                <?php if ($level['level_id'] == $getSpesificJadwal->level_id) : ?>
                    <option selected="selected" value="<?= $level['level_id']; ?>"><?= $level['level_id']; ?> | <?= $level['nama_level']; ?></option>
                <?php else : ?>
                    <option value="<?= $level['level_id']; ?>"> <?= $level['level_id']; ?> |<?= $level['nama_level']; ?></option>
                <?php endif; ?>
            <?php endforeach; ?>
        </select>
    </div>

    <button type="submit" class="buttonbro text-center text-light rounded border-0 fw-bold w-25">Simpan Jadwal</button>
</form>
<!-- End form jadwal -->


<!-- Bagian pendaftaran anak didik -->
<hr class="border-bottom border-secondary mt-5">

<?php if (count($getAnakDidik) == 0) : ?>
    <h5 class="my-5 bg-danger text-light rounded p-3 text-center w-50 m-auto"><i style="font-size: 50px;" class="fas fa-circle-exclamation text-light d-block mb-4"></i> Tidak Ada Anak Didik Yang Mencapai Level Ini. Mohon Untuk Membuatnya Terlebih Dahulu.</h5>
<?php else : ?>
    <div class="pendaftaran-anak-didik mt-5">
        <h3 class="mb-5"><i class="fas fa-user-pen text-danger"></i> Tambahkan Data Anak Didik Di Jadwal Ini <span class="fs-4 text-danger">( <?= count($getJadwalDetail); ?> Anak Didik Termuat )</span></h3>

        <form action="<?= base_url('Jadwal/JadwalProcess/suntingJadwalMurid'); ?>" method="POST" class="gabung-3 d-flex justify-content-between mb-5">
            <?= csrf_field(); ?>
            <input type="hidden" name="jadwal_id" value="<?= $getSpesificJadwal->jadwal_id; ?>">

            <div class="a">
                <div class="input-form">
                    <label class="fw-bold d-block mb-3" for=""><i class="fas fa-plus-circle"></i> Tambah
                        Anak
                        Didik</label>
                    <select name="user_id" id="" class="px-2 w-100">
                        <?php foreach ($getAnakDidik as $anakDidik) : ?>
                            <option value="<?= $anakDidik['user_id']; ?>"><?= $anakDidik['nama_wali']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <button type="submit" class="mt-5 buttonbro text-center text-light rounded border-0 fw-bold w-100"><i class="fas fa-plus-circle"></i> Tambah
                    Anak Didik</button>
            </div>

            <!-- peringatan -->
            <div class="b d-flex justify-content-between flex-wrap">
                <?php $i = 1; ?>
                <?php foreach ($getJadwalDetail as $jadwalDetail) : ?>
                    <div class="bs rounded border p-3">
                        <div>
                            <h4><i class="fas fa-user"></i> <?= $jadwalDetail['nama_wali']; ?></h4>
                            <small><?= $i++; ?></small>
                        </div>

                        <a href="<?= base_url('Jadwal/JadwalProcess/hapusJadwalMurid/' . $jadwalDetail['user_id']) . '/' . $getSpesificJadwal->jadwal_id; ?>">Hapus!</a>
                    </div>
                <?php endforeach; ?>
            </div>
        </form>
    </div>
<?php endif; ?>


<!-- Akhir bagian pendaftaran anak didik -->

<?= $this->endSection(); ?>