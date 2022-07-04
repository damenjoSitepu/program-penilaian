<?= $this->extend('Render/index'); ?>

<?= $this->section('render'); ?>
<!-- title halaman -->
<h2 class="title-halaman"><i class="fas fa-star"></i> Data Nilai—Kelola Penilaian</h2>
<hr class="border-0 border-bottom border-secondary">
<!-- end title halaman -->

<!-- Content start -->

<div class="halaman-data-guru mt-4">
    <!-- button tambah, jumlah -->
    <div class="data-jumlah d-flex w-100 mt-4">
        <a class="data-jumlah-button py-2 rounded  text-decoration-none text-center text-light" href="<?= base_url('Nilai'); ?>"><i class="fas fa-home"></i>
            Kembali</a>
        <a class="data-jumlah-button py-2 rounded  text-decoration-none text-center text-light" href="<?= base_url('/Nilai/NilaiProcess/hapusNilai/' . $getNilai->nilai_id); ?>"><i class="fas fa-trash"></i>
            Hapus Penilaian Ini</a>

        <a class="data-jumlah-button py-2 rounded  text-decoration-none text-center text-light" href="<?= base_url('/Nilai/NilaiPages/suntingNilai/' . $getNilai->nilai_id); ?>"><i class="fas fa-star"></i>
            Sunting Nilai Anak Didik</a>
    </div>

    <!-- Informasi Utama Ruangan Ini -->
    <div class="informasi-utama-penilaian d-flex justify-content-between mt-4 rounded border">
        <img src="<?= base_url('assets/img/class.png'); ?>" alt="">
        <div class="desc">
            <h4>Kategori Penilaian / Jadwal</h4>
            <h3 class="mb-4"><i class="fas fa-highlighter"></i> <?= $getNilai->nama_kategori_nilai; ?>—<?= $getNilai->nama_level; ?>—<?= $getNilai->nama_hari; ?></h3>

            <h4>Tanggal Penilaian</h4>
            <h3><i class="fas fa-calendar"></i> <?= date('l, j-F-Y', strtotime($getNilai->tanggal_penilaian)); ?></h3>
        </div>
    </div>
    <!-- Akhir Informasi Utama Ruangan Ini -->

    <!-- Form buat penilaian -->
    <form action="<?= base_url('Nilai/NilaiProcess/suntingRuangNilai'); ?>" method="POST" class="form-buat-penilaian mt-5">
        <?= csrf_field(); ?>
        <input type="hidden" name="nilai_id" value="<?= $getNilai->nilai_id; ?>">
        <h3 class="mb-5"><i class="fas fa-pen-to-square text-danger"></i> Sunting Ruang Penilaian Anda</h3>

        <div class="gabung-2 d-flex justify-content-between mb-5">
            <div class="a border-end">
                <div class="input-form">
                    <label class="fw-bold d-block mb-3" for=""><i class="fas fa-user-pen"></i> Kategori
                        Penilaian</label>
                    <select name="kategori_nilai_id" id="" class="px-2 w-100">
                        <?php foreach ($getKategori as $kategori) : ?>
                            <?php if ($kategori['kategori_nilai_id'] == $getNilai->kategori_nilai_id) : ?>
                                <option selected="selected" value="<?= $kategori['kategori_nilai_id']; ?>"><?= $kategori['nama_kategori_nilai']; ?></option>
                            <?php else : ?>
                                <option value="<?= $kategori['kategori_nilai_id']; ?>"><?= $kategori['nama_kategori_nilai']; ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="input-form mb-5 w-75 mt-5">
                    <label class="fw-bold d-block mb-3" for=""><i class="fas fa-book"></i> Mata
                        Pelajaran</label>
                    <input type="text" name="mata_pelajaran" value="<?= old('mata_pelajaran') ? old('mata_pelajaran') : $getNilai->mata_pelajaran; ?>" <?= $validation->hasError('mata_pelajaran') ? 'placeholder="' . $validation->getError('mata_pelajaran') . '"' : ''; ?> class="<?= $validation->hasError('mata_pelajaran') ? 'notice-red' : ''; ?> px-2 w-100">

                </div>

                <?php if (session()->get('login')['kelas'] == 1) : ?>
                    <div class="input-form mb-5 w-75 mt-5">
                        <label class="fw-bold d-block mb-3" for=""><i class="fas fa-user"></i> Nama Motivator</label>
                        <select name="user_id" id="" class="px-2 w-100">
                            <?php foreach ($getMotivator as $motivator) : ?>
                                <?php if ($motivator['user_id'] == $getNilai->user_id) : ?>
                                    <option selected="selected" value="<?= $motivator['user_id']; ?>"><?= $motivator['nama']; ?></option>
                                <?php else : ?>
                                    <option value="<?= $motivator['user_id']; ?>"><?= $motivator['nama']; ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                <?php endif; ?>

                <button class="buttonbro text-center text-light rounded border-0 fw-bold w-75">Simpan
                    Ruang
                    Penilaian</button>
            </div>

            <!-- peringatan -->
            <div class="b">
                <div class="input-form">
                    <label class="fw-bold d-block mb-3" for=""><i class="fas fa-signal"></i> Pilih
                        Level</label>
                    <select id="" name="level_id" class="px-2 w-100 kategori_nilai_change">
                        <?php foreach ($getLevel as $level) : ?>
                            <?php if ($level['level_id'] == $getNilai->level_id) : ?>
                                <option selected="selected" value="<?= $level['level_id']; ?>"><?= $level['level_id']; ?> | <?= $level['nama_level']; ?></option>
                            <?php else : ?>
                                <option value="<?= $level['level_id']; ?>"><?= $level['level_id']; ?> | <?= $level['nama_level']; ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="input-form mt-5 displayhiddens">
                    <label class="fw-bold d-block mb-3" for=""><i class="fas fa-calendar"></i> Pilih
                        Jadwal</label>
                    <select name="jadwal_id" id="" class="px-2 w-100 fillJadwal">
                        <?php foreach ($getJadwal as $jadwal) : ?>
                            <?php if ($jadwal['jadwal_id'] == $getNilai->jadwal_id) : ?>
                                <option selected="selected" value="<?= $jadwal['jadwal_id']; ?>"><?= $jadwal['nama_hari']; ?> | <?= $jadwal['jam_mulai']; ?> - <?= $jadwal['jam_berakhir']; ?></option>
                            <?php else : ?>
                                <option value="<?= $jadwal['jadwal_id']; ?>"><?= $jadwal['nama_hari']; ?> | <?= $jadwal['jam_mulai']; ?> - <?= $jadwal['jam_berakhir']; ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>
    </form>
    <!-- Akhir form buat penilaian -->

    <hr class="pembatas border-secondary mt-4">

    <!-- Bagian pendaftaran anak didik -->
    <div class="pendaftaran-anak-didik mt-5">
        <h3 class="mb-5"><i class="fas fa-user-pen text-danger"></i> Tambahkan Data Anak Didik Di Ruang
            Nilai Ini</h3>

        <form action="<?= base_url('Nilai/NilaiProcess/suntingRuangMurid'); ?>" method="POST" class="gabung-3 d-flex justify-content-between mb-5">
            <?= csrf_field(); ?>
            <input type="hidden" name="nilai_id" value="<?= $getNilai->nilai_id; ?>">
            <div class="a">
                <div class="input-form">
                    <label class="fw-bold d-block mb-3" for=""><i class="fas fa-plus-circle"></i> Tambah
                        Anak
                        Didik</label>
                    <select name="user_id" id="" class="px-2 w-100">
                        <?php foreach ($getAnakDidik as $anakDidik) : ?>
                            <option value="<?= $anakDidik['user_id']; ?>"> <?= $anakDidik['nama_wali']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <button type="submit" class="mt-5 buttonbro text-center text-light rounded border-0 fw-bold w-100"><i class="fas fa-plus-circle"></i> Tambah
                    Anak Didik</button>
            </div>

            <!-- peringatan -->
            <div class="b d-flex justify-content-between flex-wrap">
                <?php $i = 1; ?>
                <?php foreach ($getNilaiDetail as $nilaiDetail) : ?>
                    <div class="bs rounded border p-3">
                        <div>
                            <h4><i class="fas fa-user"></i> <?= $nilaiDetail['nama_wali']; ?></h4>
                            <small><?= $i++; ?></small>
                        </div>

                        <a href="<?= base_url('Nilai/NilaiProcess/hapusRuangMurid/' . $nilaiDetail['user_id'] . '/' . $getNilai->nilai_id); ?>">Hapus!</a>
                    </div>
                <?php endforeach; ?>
            </div>
        </form>
    </div>

    <!-- Akhir bagian pendaftaran anak didik -->

    <!-- end content  -->
</div>
<!-- End content -->

<?= $this->endSection(); ?>