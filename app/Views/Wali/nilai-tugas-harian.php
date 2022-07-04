<div class="bottom mt-5">
    <h4 class="mb-4 title text-center"><i class="fas fa-list-check"></i> Tugas Harian</h4>
    <hr class="border-bottom border-secondary">

    <div class="bottom-contents d-flex justify-content-between flex-wrap mt-4">
        <?php $i = 1; ?>
        <?php foreach ($getTugasHarian as $harian) : ?>
            <div class="bottom-content mb-4 d-flex border rounded p-2">
                <div class="no">
                    <p class="px-3 fw-bold py-1 rounded-pill text-light text-center"><?= $i++; ?></p>
                </div>
                <div class="info">
                    <h6 class="text"><?= date('l, j-M-Y', strtotime($harian['tanggal_penilaian'])); ?> <i class="fas fa-calendar"></i></h6>
                    <h5> <?= $harian['nama_level']; ?></h5>
                    <hr class="border-bottom border-secondary">
                    <h2 class="text-success"><?= visualizeStars($harian['skor_id']); ?></h2>
                    <hr class="border-bottom border-secondary">
                    <small class="fw-bold text-secondary"><span class="text-success"><i class="fas fa-chalkboard-user"></i> Motivator</span>:
                        <?= $harian['nama']; ?></small>
                    <small class="mt-3 d-block  fw-bold"><i class="fas fa-list"></i> Materi: <span class="text-danger"><i><?= $harian['mata_pelajaran']; ?></i></span></small>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>