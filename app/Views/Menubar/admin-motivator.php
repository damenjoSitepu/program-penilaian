<a href="<?= base_url('/'); ?>" class="menu-list text-decoration-none d-block py-2 mx-4">
    <div class="menu-list-flex">
        <span>Beranda</span> <i class="fas fa-home"></i>
    </div>
    <span class="d-block"><i class="fas fa-circle"></i></span>
</a>

<?php if (session()->get('login')['kelas'] == 1) : ?>
    <a href="<?= base_url('Motivator'); ?>" class="menu-list text-decoration-none d-block py-2 mx-4">
        <div class="menu-list-flex">
            <span>Data Motivator</span> <i class="fas fa-users"></i>
        </div>
        <span class="d-block"><i class="fas fa-circle"></i></span>
    </a>
<?php endif; ?>

<a href="<?= base_url('AnakDidik'); ?>" class="menu-list text-decoration-none d-block py-2 mx-4">
    <div class="menu-list-flex">
        <span>Data Anak Didik</span> <i class="fas fa-user-check"></i>
    </div>
    <span class="d-block"><i class="fas fa-circle"></i></span>
</a>

<?php if (session()->get('login')['kelas'] == 1) : ?>
    <a href="<?= base_url('Level'); ?>" class="menu-list text-decoration-none d-block py-2 mx-4">
        <div class="menu-list-flex">
            <span>Data Level</span> <i class="fas fa-database"></i>
        </div>
        <span class="d-block"><i class="fas fa-circle"></i></span>
    </a>
<?php endif; ?>

<a href="<?= base_url('Jadwal'); ?>" class="menu-list text-decoration-none d-block py-2 mx-4">
    <div class="menu-list-flex">
        <span>Data Jadwal</span> <i class="fas fa-calendar"></i>
    </div>
    <span class="d-block"><i class="fas fa-circle"></i></span>
</a>

<a href="<?= base_url('Absensi'); ?>" class="menu-list text-decoration-none d-block py-2 mx-4">
    <div class="menu-list-flex">
        <span>Data Absensi</span> <i class="fas fa-file"></i>
    </div>
    <span class="d-block"><i class="fas fa-circle"></i></span>
</a>

<a href="<?= base_url('Nilai'); ?>" class="menu-list text-decoration-none d-block py-2 mx-4">
    <div class="menu-list-flex">
        <span>Data Nilai</span> <i class="fas fa-star"></i>
    </div>
    <span class="d-block"><i class="fas fa-circle"></i></span>
</a>