<?= $this->extend('Render/index'); ?>

<?= $this->section('render'); ?>
<!-- title halaman -->
<h2 class="title-halaman"><i class="fas fa-user-check"></i> Data Anak Didik—Form Edit Data</h2>
<hr class="border-0 border-bottom border-secondary">
<!-- end title halaman -->

<!-- button tambah, jumlah -->
<div class="data-jumlah d-flex w-100 mt-4">
    <a class="data-jumlah-button py-2 rounded  text-decoration-none text-center text-light" href="<?= base_url('AnakDidik'); ?>"><i class="fas fa-home"></i>
        Kembali</a>
    <a class="data-jumlah-button py-2 rounded  text-decoration-none text-center text-light" href="<?= base_url('/AnakDidik/AnakDidikProcess/hapus/' . $getSpesificAnakDidik->user_id); ?>"><i class="fas fa-trash"></i>
        Hapus Anak Didik</a>

    <a class="text-decoration-none fw-bold rounded py-2 text-center"><?= $countAnakDidik; ?> Anak Didik Telah Dibuat</a>
</div>

<!-- Form dimulai -->
<form action="<?= base_url('AnakDidik/AnakDidikProcess/suntingAnakDidik'); ?>" method="POST" class="form-daftar-guru mt-5">
    <?= csrf_field() ?>
    <input type="hidden" name="user_id" value="<?= $getSpesificAnakDidik->user_id; ?>">
    <input type="hidden" name="old_password" value="<?= $getSpesificAnakDidik->password; ?>">

    <div class="gabung-1 d-flex justify-content-between">
        <div class="input-form mb-5">
            <label class="fw-bold d-block mb-3" for=""><i class="fas fa-user-graduate"></i> Nama Anak
                Didik</label>
            <input type="text" name="nama" value="<?= old('nama') ? old('nama') : $getSpesificAnakDidik->nama_wali; ?>" <?= $validation->hasError('nama') ? 'placeholder="' . $validation->getError('nama') . '"' : ''; ?> class="<?= $validation->hasError('nama') ? 'notice-red' : ''; ?> px-2 w-100">
        </div>
    </div>



    <div class="gabung-1 d-flex justify-content-between">
        <div class="input-form mb-5">
            <label class="fw-bold d-block mb-3" for=""><i class="fas fa-calendar"></i> Tanggal
                Lahir</label>
            <input type="date" name="tanggal_lahir" value="<?= old('tanggal_lahir   ') ? old('tanggal_lahir    ') : $getSpesificAnakDidik->tanggal_lahir; ?>" <?= $validation->hasError('tanggal_lahir ') ? 'placeholder="' . $validation->getError('tanggal_lahir  ') . '"' : ''; ?> class="<?= $validation->hasError('tanggal_lahir ') ? 'notice-red' : ''; ?> px-2 w-100">
        </div>

        <div class="input-form mb-5">
            <label class="fw-bold d-block mb-3" for=""><i class="fas fa-clock"></i> Jenis Kelamin</label>
            <select name="jenis_kelamin" id="" class="px-2 w-100">
                <?php if ($getSpesificAnakDidik->jenis_kelamin == 1) : ?>
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
            <input type="text" name="agama" value="<?= old('agama') ? old('agama') : $getSpesificAnakDidik->agama; ?>" <?= $validation->hasError('agama') ? 'placeholder="' . $validation->getError('agama') . '"' : ''; ?> class="<?= $validation->hasError('agama') ? 'notice-red' : ''; ?> px-2 w-100">
        </div>

        <div class="b input-form mb-5">
            <label class="fw-bold d-block mb-3" for=""><i class="fas fa-phone"></i> No. Telepon</label>
            <input type="text" name="no_telepon" value="<?= old('no_telepon') ? old('no_telepon') : $getSpesificAnakDidik->no_telepon; ?>" <?= $validation->hasError('no_telepon') ? 'placeholder="' . $validation->getError('no_telepon') . '"' : ''; ?> class="<?= $validation->hasError('no_telepon') ? 'notice-red' : ''; ?> px-2 w-100">
        </div>

        <div class="c input-form mb-5">
            <label class="fw-bold d-block mb-3" for=""><i class="fas fa-user-group"></i> Nama Orang Tua</label>
            <input type="text" disabled="disabled" value="<?= old('nama_wali') ? old('nama_wali') : $getSpesificAnakDidik->nama; ?>" <?= $validation->hasError('nama_wali') ? 'placeholder="' . $validation->getError('nama_wali') . '"' : ''; ?> class="<?= $validation->hasError('nama_wali') ? 'notice-red' : ''; ?> px-2 w-100">
        </div>
    </div>

    <div class="input-form mb-5 w-75">
        <label class="fw-bold d-block mb-3" for=""><i class="fas fa-address-card"></i> Alamat</label>
        <input type="text" name="alamat" value="<?= old('alamat') ? old('alamat') : $getSpesificAnakDidik->alamat; ?>" <?= $validation->hasError('alamat') ? 'placeholder="' . $validation->getError('alamat') . '"' : ''; ?> class="<?= $validation->hasError('alamat') ? 'notice-red' : ''; ?> px-2 w-100">
    </div>

    <h4><i class="text-danger fas fa-user-lock       mb-4"></i> Informasi Khusus Orang Tua Anak Didik</h4>

    <hr class="border-bottom border-secondary">

    <div class="row">
        <div class="col-lg-4">
            <div class="input-form mb-3 mt-4 ">
                <label class="fw-bold d-block mb-3" for=""><i class="fas fa-key"></i> Password Akun Orang Tua</label>
                <input type="password" name="password" class="px-2 w-100">
            </div>
            <small class="d-block mb-5 fw-bold"><i class="fas fa-triangle-exclamation text-danger"></i> Password Default: <span class="text-danger">123</span></small>
        </div>
        <div class="col-lg-5">
            <div class="input-form mb-3 mt-4 ">
                <label class="fw-bold d-block mb-3" for=""><i class="fas fa-user"></i> Username Akun Orang Tua</label>
                <input type="text" disabled="disabled" value="<?= $getSpesificAnakDidik->username; ?>" class="px-2 w-100">
            </div>
            <small class="d-block mb-5 fw-bold"><i class="fas fa-triangle-exclamation text-danger"></i> Username Ini Tidak Akan Bisa Diubah Kembali</small>
        </div>
    </div>



    <h4><i class="text-danger fas fa-landmark mb-4"></i> Pengaturan Tingkat Level Anak Didik</h4>

    <hr class="border-bottom border-secondary">

    <div class="input-form mb-3 mt-4 w-25">
        <label class="fw-bold d-block mb-3" for=""><i class="fas fa-key"></i> Tingkatan Level</label>
        <select name="level_id" id="" class="px-2 w-100">
            <?php foreach ($getLevel as $level) : ?>
                <?php if ($getSpesificAnakDidik->level_id == $level['level_id']) : ?>
                    <option selected="selected" value="<?= $level['level_id']; ?>"><?= $level['level_id']; ?> | <?= $level['nama_level']; ?></option>
                <?php else : ?>
                    <option value="<?= $level['level_id']; ?>"><?= $level['level_id']; ?> | <?= $level['nama_level']; ?></option>
                <?php endif; ?>

            <?php endforeach; ?>
        </select>
    </div>
    <small class="d-block mb-5 fw-bold"><i class="fas fa-triangle-exclamation text-danger"></i> Mengubah Level akan menghapus seluruh data nilai anak didik terkait. Mohon untuk bijak menentukan keputusan anda.</small>

    <h4><i class="text-danger fas fa-star mb-4"></i> Publikasi Nilai Rapot Kepada Orang Tua Anak Didik Bersangkutan</h4>

    <hr class="border-bottom border-secondary">

    <div class="input-form mb-3 mt-4 w-100">
        <label class="fw-bold d-block mb-3" for=""><i class="fas fa-book"></i> Catatan</label>
        <input type="text" name="catatan" value="<?= old('catatan') ? old('catatan') : $getSpesificAnakDidik->catatan; ?>" <?= $validation->hasError('catatan') ? 'placeholder="' . $validation->getError('catatan') . '"' : ''; ?> class="<?= $validation->hasError('catatan') ? 'notice-red' : ''; ?> px-2 w-100">
    </div>
    <small class="d-block mb-5 fw-bold"><i class="fas fa-triangle-exclamation text-danger"></i> Dengan Mengisi Catatan Ini, Anda Sepakat Untuk Mempublikasikan Hasil Rapot Anak Didik Ini.</small>



    <button class="buttonbro text-center text-light rounded border-0 fw-bold w-25"><i class="fas fa-pen-to-square"></i> Sunting Anak
        Didik</button>
</form>
<!-- Akhir form  -->

<!-- form upload sertifikat -->
<h4><i class="text-danger fas fa-scroll mt-5 mb-4"></i> Upload Sertifikat Anak Didik Ini</h4>

<div class="row justify-content-between">
    <div class="col-lg-5">
        <form class="form-daftar-sertifikat mb-5" action="<?= base_url('AnakDidik/AnakDidikProcess/suntingSertifikat1'); ?>" method="POST" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <input type="hidden" name="anakdidik_id" value="<?= $getSpesificAnakDidik->user_id; ?>">
            <input type="hidden" name="old_photo" value="<?= $getSpesificAnakDidik->photo1; ?>">

            <hr class="border-bottom border-secondary">

            <!-- manipulasi gambar -->
            <div class="lefts">
                <?php  ?>
                <!-- <img class="img-preview1" src="<?= base_url('assets/sertifikat_img/' . $getSpesificAnakDidik->photo1); ?>" alt=""> -->
                <!-- https://res.cloudinary.com/ddvcelpwp/image/upload/v1657081148/1657081142_f05842328ddd62db3616.png.png -->
                <img class="img-preview1" src="https://res.cloudinary.com/ddvcelpwp/image/upload/v1657081148/<?= $getSpesificAnakDidik->photo1; ?>" alt="">

                <div class="inputs">
                    <label for="editsertifikat1">Tambahkan Sertifikat Lv.1</label>
                    <input type="file" name="photo" id="editsertifikat1" onchange="changeSertifikat('editsertifikat1','img-preview1')">
                </div>
            </div>
            <button class="mt-4 buttonbro text-center text-light rounded border-0 fw-bold w-100"><i class="fas fa-pen-to-square"></i> Tambahkan Sertifikat Lv.1</button>
        </form>
    </div>

    <div class="col-lg-5">
        <form class="form-daftar-sertifikat mb-5" action="<?= base_url('AnakDidik/AnakDidikProcess/suntingSertifikat2'); ?>" method="POST" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <input type="hidden" name="anakdidik_id" value="<?= $getSpesificAnakDidik->user_id; ?>">
            <input type="hidden" name="old_photo" value="<?= $getSpesificAnakDidik->photo2; ?>">

            <hr class="border-bottom border-secondary">

            <!-- manipulasi gambar -->
            <div class="lefts">
                <?php  ?>
                <img class="img-preview2" src="<?= base_url('assets/sertifikat_img/' . $getSpesificAnakDidik->photo2); ?>" alt="">

                <div class="inputs">
                    <label for="editsertifikat2">Tambahkan Sertifikat Lv.2</label>
                    <input type="file" name="photo" id="editsertifikat2" onchange="changeSertifikat('editsertifikat2','img-preview2')">
                </div>
            </div>
            <button class="mt-4 buttonbro text-center text-light rounded border-0 fw-bold w-100"><i class="fas fa-pen-to-square"></i> Tambahkan Sertifikat Lv.2</button>
        </form>
    </div>
</div>


<div class="row justify-content-between">
    <div class="col-lg-5">
        <form class="form-daftar-sertifikat mb-5" action="<?= base_url('AnakDidik/AnakDidikProcess/suntingSertifikat3'); ?>" method="POST" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <input type="hidden" name="anakdidik_id" value="<?= $getSpesificAnakDidik->user_id; ?>">
            <input type="hidden" name="old_photo" value="<?= $getSpesificAnakDidik->photo3; ?>">

            <hr class="border-bottom border-secondary">

            <!-- manipulasi gambar -->
            <div class="lefts">
                <?php  ?>
                <img class="img-preview3" src="<?= base_url('assets/sertifikat_img/' . $getSpesificAnakDidik->photo3); ?>" alt="">

                <div class="inputs">
                    <label for="editsertifikat3">Tambahkan Sertifikat Lv.3</label>
                    <input type="file" name="photo" id="editsertifikat3" onchange="changeSertifikat('editsertifikat3','img-preview3')">
                </div>
            </div>
            <button class="mt-4 buttonbro text-center text-light rounded border-0 fw-bold w-100"><i class="fas fa-pen-to-square"></i> Tambahkan Sertifikat Lv.3</button>
        </form>
    </div>
    <div class="col-lg-5">
        <form class="form-daftar-sertifikat mb-5" action="<?= base_url('AnakDidik/AnakDidikProcess/suntingSertifikat4'); ?>" method="POST" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <input type="hidden" name="anakdidik_id" value="<?= $getSpesificAnakDidik->user_id; ?>">
            <input type="hidden" name="old_photo" value="<?= $getSpesificAnakDidik->photo4; ?>">

            <hr class="border-bottom border-secondary">

            <!-- manipulasi gambar -->
            <div class="lefts">
                <?php  ?>
                <img class="img-preview4" src="<?= base_url('assets/sertifikat_img/' . $getSpesificAnakDidik->photo4); ?>" alt="">

                <div class="inputs">
                    <label for="editsertifikat4">Tambahkan Sertifikat Lv.4</label>
                    <input type="file" name="photo" id="editsertifikat4" onchange="changeSertifikat('editsertifikat4','img-preview4')">
                </div>
            </div>
            <button class="mt-4 buttonbro text-center text-light rounded border-0 fw-bold w-100"><i class="fas fa-pen-to-square"></i> Tambahkan Sertifikat Lv.4</button>
        </form>
    </div>
</div>
<!-- end form upload sertifikat -->

<!-- akhir informasi -->

<?= $this->endSection(); ?>