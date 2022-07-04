<?= $this->extend('Render/index'); ?>

<?= $this->section('render'); ?>
<!-- Halaman Admin Home -->

<!-- Content start -->

<?php if (session()->get('login')['kelas'] == 1 || session()->get('login')['kelas'] == 2) : ?>
    <?= $this->include('Home/home-admin-motivator'); ?>
<?php else : ?>
    <?= $this->include('Home/home-wali'); ?>
<?php endif; ?>
<!-- end content  -->

<!-- End Halaman Admin Home -->
<?= $this->endSection(); ?>