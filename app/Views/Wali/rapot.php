<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>

    <style>
        .ceklist {
            position: relative;
            transform: translateX(33px) translateY(20px);
        }

        .ceklist::before {
            position: absolute;
            content: '';
            width: 2px;
            height: 10px;
            background-color: black;
            border-bottom-left-radius: 2px;
            transform: skewX(15deg) translateX(6px) translateY(1px);

        }

        .ceklist::after {
            position: absolute;
            content: '';
            width: 4px;
            border-bottom-right-radius: 2px;
            border-bottom-left-radius: 2px;
            height: 10px;
            background-color: black;
            transform: translateX(15.9px) translateY(1px) skewX(-60deg);
        }
    </style>
</head>

<body>
    <!-- Rapot -->
    <div>

        <h1 style="text-align: center; margin-bottom: 50px;">Laporan Perkembangan Anak Bimba AIUEO</h1>
        <h2 style="text-align: center; color: #fa6900;">Unit Bojong Indah</h2>
        <hr style="color: rgb(215, 215, 215);">

        <h2 style=" color: red;">Nama: <?= $getUser->nama_wali; ?></h2>
        <hr style="color: rgb(215, 215, 215);">

        <?php foreach ($getNilai as $nilai) : ?>
            <h2>Level: <?= $nilai['header']['level_id']; ?></h2>
            <table style="margin-bottom: 50px; width: 100%; margin-top: 25px;" cellspacing="0" class="knalpot-table">

                <tr>
                    <td style="width: 7%; border: 1px solid black; color:black; font-weight:bold; height: 50px; text-align: center;">No</td>
                    <td style="width: 35%; border: 1px solid black; color:black; font-weight:bold; height: 50px; text-align: center;">Materi Kegiatan</td>
                    <td style="border: 1px solid black; width: 14%; font-size: 15px; color:black; font-weight:bold; height: 50px; text-align: center;">Belum Terampil</td>
                    <td style="border: 1px solid black; width: 14%; font-size: 15px; color:black; font-weight:bold; height: 50px; text-align: center;">Awal Pengenalan</td>
                    <td style="border: 1px solid black; width: 14%; font-size: 15px; color:black; font-weight:bold; height: 50px; text-align: center;">Proses Pembiasaan</td>
                    <td style="border: 1px solid black; width: 14%; font-size: 15px; color:black; font-weight:bold; height: 50px; text-align: center;">Pemahaman Materi</td>
                    <td style="border: 1px solid black; width: 14%; font-size: 15px; color:black; font-weight:bold; height: 50px; text-align: center;">Terampil</td>
                </tr>



                <?php $i = 1;
                $skorTotal = 0; ?>
                <?php foreach ($nilai['body'] as $nilais) : ?>
                    <tr style="border-bottom: 1px solid black; border-top: 1px solid black;">
                        <td style="border-left: 1px solid black; border-right: 1px solid black; color:black; font-weight:bold; height: 50px; text-align: center;">P.<?= $i++; ?></td>
                        <td style="border-left: 1px solid black; border-right: 1px solid black;  padding-left:10px; box-sizing: border-box; color:black; font-weight:bold; height: 50px; text-align: left;"><?= $nilais['mata_pelajaran']; ?></td>
                        <?php if ($nilais['skor_id'] == '1') : ?>
                            <td style="border-right: 1px solid black;  color:black; font-weight:bold; height: 50px; text-align: center;"><i class="fas fa-check"></i><span class="ceklist"></span></td>
                            <td style="border-right: 1px solid black;  color:black; font-weight:bold; height: 50px; text-align: center;"><i class="fas fa-x"></i></td>
                            <td style="border-right: 1px solid black;  color:black; font-weight:bold; height: 50px; text-align: center;"><i class="fas fa-x"></i></td>
                            <td style="border-right: 1px solid black;  color:black; font-weight:bold; height: 50px; text-align: center;"><i class="fas fa-x"></i></td>
                            <td style="border-right: 1px solid black;  color:black; font-weight:bold; height: 50px; text-align: center;"><i class="fas fa-x"></i></td>
                        <?php elseif ($nilais['skor_id'] == '2') : ?>
                            <td style="border-right: 1px solid black;  color:black; font-weight:bold; height: 50px; text-align: center;"><i class="fas fa-x"></i></td>
                            <td style="border-right: 1px solid black;  color:black; font-weight:bold; height: 50px; text-align: center;"><i class="fas fa-check"></i><span class="ceklist"></span></td>
                            <td style="border-right: 1px solid black;  color:black; font-weight:bold; height: 50px; text-align: center;"><i class="fas fa-x"></i></td>
                            <td style="border-right: 1px solid black;  color:black; font-weight:bold; height: 50px; text-align: center;"><i class="fas fa-x"></i></td>
                            <td style="border-right: 1px solid black;  color:black; font-weight:bold; height: 50px; text-align: center;"><i class="fas fa-x"></i></td>
                        <?php elseif ($nilais['skor_id'] == '3') : ?>
                            <td style="border-right: 1px solid black;  color:black; font-weight:bold; height: 50px; text-align: center;"><i class="fas fa-x"></i></td>
                            <td style="border-right: 1px solid black;  color:black; font-weight:bold; height: 50px; text-align: center;"><i class="fas fa-x"></i></td>
                            <td style="border-right: 1px solid black;  color:black; font-weight:bold; height: 50px; text-align: center;"><i class="fas fa-check"></i><span class="ceklist"></span></td>
                            <td style="border-right: 1px solid black;  color:black; font-weight:bold; height: 50px; text-align: center;"><i class="fas fa-x"></i></td>
                            <td style="border-right: 1px solid black;  color:black; font-weight:bold; height: 50px; text-align: center;"><i class="fas fa-x"></i></td>
                        <?php elseif ($nilais['skor_id'] == '4') : ?>
                            <td style="border-right: 1px solid black;  color:black; font-weight:bold; height: 50px; text-align: center;"><i class="fas fa-x"></i></td>
                            <td style="border-right: 1px solid black;  color:black; font-weight:bold; height: 50px; text-align: center;"><i class="fas fa-x"></i></td>
                            <td style="border-right: 1px solid black;  color:black; font-weight:bold; height: 50px; text-align: center;"><i class="fas fa-x"></i></td>
                            <td style="border-right: 1px solid black;  color:black; font-weight:bold; height: 50px; text-align: center;"><i class="fas fa-check"></i><span class="ceklist"></span></td>
                            <td style="border-right: 1px solid black;  color:black; font-weight:bold; height: 50px; text-align: center;"><i class="fas fa-x"></i></td>
                        <?php elseif ($nilais['skor_id'] == '5') : ?>
                            <td style="border-right: 1px solid black;  color:black; font-weight:bold; height: 50px; text-align: center;"><i class="fas fa-x"></i></td>
                            <td style="border-right: 1px solid black;  color:black; font-weight:bold; height: 50px; text-align: center;"><i class="fas fa-x"></i></td>
                            <td style="border-right: 1px solid black;  color:black; font-weight:bold; height: 50px; text-align: center;"><i class="fas fa-x"></i></td>
                            <td style="border-right: 1px solid black;  color:black; font-weight:bold; height: 50px; text-align: center;"><i class="fas fa-x"></i></td>
                            <td style="border-right: 1px solid black;  color:black; font-weight:bold; height: 50px; text-align: center;"><i class="fas fa-check"></i><span class="ceklist"></span></td>
                        <?php else : ?>
                            <td style="border-right: 1px solid black;  color:black; font-weight:bold; height: 50px; text-align: center;"><i class="fas fa-x"></i></td>
                            <td style="border-right: 1px solid black;  color:black; font-weight:bold; height: 50px; text-align: center;"><i class="fas fa-x"></i></td>
                            <td style="border-right: 1px solid black;  color:black; font-weight:bold; height: 50px; text-align: center;"><i class="fas fa-x"></i></td>
                            <td style="border-right: 1px solid black;  color:black; font-weight:bold; height: 50px; text-align: center;"><i class="fas fa-check"></i></td>
                        <?php endif; ?>
                    </tr>
                    <?php
                    $skorTotal += $nilais['skor_id'];
                    ?>
                <?php endforeach; ?>

                <?php
                $rataRata = floor($skorTotal / count($nilai['body']));
                ?>
                <tr style="border-bottom: 1px solid black; border-top: 1px solid black;">
                    <td colspan="1" style="width: 25%; border-left: 1px solid black; border-right: 1px solid black; color:black; font-weight:bold; height: 50px; text-align: center;">Nilai Rata-Rata</td>

                    <td colspan="6" style="border-left: 1px solid black; border-right: 1px solid black; color:black; font-weight:bold; height: 50px; text-align: center;">
                        <?php if ($rataRata >= 0 && $rataRata <= 1) : ?>
                            Belum Terampil Di Dalam Mengerjakan Materi Pembelajaran
                        <?php elseif ($rataRata >= 1 && $rataRata <= 2) : ?>
                            Awal Pengenalan Pembelajaran
                        <?php elseif ($rataRata >= 2 && $rataRata <= 3) : ?>
                            Proses Pembiasaan Dalam Melakukan Pembelajaran
                        <?php elseif ($rataRata >= 3 && $rataRata <= 4) : ?>
                            Telah Memiliki Materi Pemahaman Terhadap Materi Pembelajaran
                        <?php else : ?>
                            Terampil Di Dalam Mengerjakan Materi Pembelajaran
                        <?php endif; ?>

                    </td>
                </tr>

                <tr style="border-bottom: 1px solid black; border-top: 1px solid black;">
                    <td colspan="1" style="width: 25%; border-left: 1px solid black; border-right: 1px solid black; color:black; font-weight:bold; height: 50px; text-align: center;">Nilai Rata-Rata Murni</td>

                    <td colspan="6" style="border-left: 1px solid black; border-right: 1px solid black; color:black; font-weight:bold; height: 50px; text-align: center;">
                        <?= $rataRata; ?>
                    </td>
                </tr>

            </table>
        <?php endforeach; ?>

        <!-- Catatan -->
        <div style="padding: 0 20px 0 20px; margin-top: 50px; border: 1px solid black;">
            <h3 style="font-weight: bold;">Catatan: ( Berdasarkan Kegiatan Anak Didik Di Kelas )</h3>

            <p><?= $getUser->catatan; ?></p>

            <h4 style="margin-top: 25px; font-weight: bold;">"Tetap Semangat & Terus Belajar"</h4>
            <h4 style="margin-top: 25px; font-weight: bold;">Salam,</h4>
            <h4 style="margin-top: 25px; font-weight: bold;">Bimba AIUEO Unit Bojong Indah</h4>
        </div>
        <!-- End Catatan -->
    </div>
</body>

</html>