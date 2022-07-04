<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= base_url('assets/css/admin/index.css'); ?>">
    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ultra&display=swap" rel="stylesheet">
</head>

<body>
    <!-- Flashmessage -->
    <?php if (session()->get('message')) : ?>
        <!-- The Modal -->
        <div id="myModals" class="modals">
            <div class="modal-contents rounded shadow-lg">
                <span class="close"><i class="fas fa-bell"></i></span>
                <div class="modal-contentss mt-5">
                    <div class="circle"></div>
                    <p class="text-center fw-bold d-block mt-5"><?= session()->getFlashdata('message'); ?></p>
                </div>
            </div>
        </div>
    <?php endif; ?>


    <div class="my-container">

        <!-- Menu Bar -->
        <div class="left border-end">
            <!-- Nama perusahaan -->
            <h2 class="text-center  py-3">Bimba <span class="d-block">AIUEO</span></h2>
            <!-- End nama perusahaan -->

            <!-- Nama admin -->
            <div class="nama-admin mx-4 py-2 px-3 rounded text-light">
                <h3><?= session()->get('login')['nama']; ?></h3>
                <small><i class="fas fa-circle d-inline-block mt-2"></i> Online Sebagai
                    <?php if (session()->get('login')['kelas'] == 1) : ?>
                        <span class="fw-bold">Admin</span>
                    <?php elseif (session()->get('login')['kelas'] == 2) : ?>
                        <span class="fw-bold">Motivator</span>
                    <?php else : ?>
                        <span class="fw-bold">Wali Didik</span>
                    <?php endif; ?>
                </small>
            </div>
            <!-- End nama admin -->

            <!-- Menu List -->
            <div class="menu-lists mt-4 pb-5">
                <?php if (session()->get('login')['kelas'] == 1 || session()->get('login')['kelas'] == 2) : ?>
                    <?= $this->include('Menubar/admin-motivator'); ?>
                <?php else : ?>
                    <?= $this->include('Menubar/wali'); ?>
                <?php endif; ?>

                <a href="<?= base_url('Auth/AuthProcess/logout'); ?>" class="menu-list text-decoration-none d-block py-2 mx-4">
                    <div class="menu-list-flex">
                        <span>Logout</span> <i class="fas fa-arrow-right-from-bracket"></i>
                    </div>
                    <span class="d-block"><i class="fas fa-circle"></i></span>
                </a>

            </div>
            <!-- End menu list -->
        </div>
        <!-- End menu bar -->


        <!-- Content -->
        <div class="right p-4 mt-3">
            <?= $this->renderSection('render'); ?>
        </div>
        <!-- End content -->


    </div>



    <!-- Bottom Source -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/fbc67db110.js" crossorigin="anonymous"></script>
    <script src="<?= base_url('assets/js/logic.js'); ?>"></script>
    <script>
        // Get the modal
        var modal = document.getElementById("myModals");

        // Get the button that opens the modal
        var btn = document.getElementById("myBtn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        function changeSertifikat(editsertifikat = '', imgpreview = '') {
            let imgPreview = document.querySelector("." + imgpreview);
            let gambarData = document.querySelector("#" + editsertifikat);

            let fileGambar = new FileReader();
            fileGambar.readAsDataURL(gambarData.files[0]);

            fileGambar.onload = function(e) {
                imgPreview.src = e.target.result;
            };
        }
    </script>
</body>

</html>