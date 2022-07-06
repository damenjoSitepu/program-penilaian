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

    <!-- Halaman login -->
    <div class="halaman-login  d-flex justify-content-between">
        <img src="<?= base_url('assets/img/logo.jpg'); ?>" alt="">
        <form action="<?= base_url('Auth/AuthProcess'); ?>" method="POST" class="halaman-login-container m-auto  border-start p-4">


            <div class="title text-center mb-4">
                <h4 class="text-danger">Login Page</h4>
                <img src="<?= base_url('assets/img/bimba-logo.png'); ?>" alt="">
                <h2 class="text-danger">Bimba AIUEO</h2>
            </div>

            <div class="input-form mb-5">
                <label class="fw-bold d-block mb-3" for=""><i class="fas fa-user-check"></i> Username</label>
                <input type="text" autocomplete="off" name="username" value="<?= old('username'); ?>" <?= $validation->hasError('username') ? 'placeholder="' . $validation->getError('username') . '"' : ''; ?> class="<?= $validation->hasError('username') ? 'notice-red' : ''; ?> px-2 w-100">
            </div>

            <div class="input-form mb-5">
                <label class="fw-bold d-block mb-3" for=""><i class="fas fa-key"></i> Password</label>
                <input type="password" name="password" value="<?= old('password'); ?>" <?= $validation->hasError('password') ? 'placeholder="' . $validation->getError('password') . '"' : ''; ?> class="<?= $validation->hasError('password') ? 'notice-red' : ''; ?> px-2 w-100">
            </div>

            <div class="end m-auto w-50">
                <button type="submit" class="buttonbro d-block text-center text-light rounded w-100 border-0 fw-bold">Login</button>

                <small class="text-secondary text-center d-block my-4">Web App Made By Intan &copy; 2022</small>
            </div>
        </form>
    </div>
    <!-- End halaman login -->


    <!-- Validation -->
    <?php if ($validation->hasError('username') || $validation->hasError('password')) : ?>
        <!-- The Modal -->
        <div id="myModals" class="modals">
            <div class="modal-contents rounded shadow-lg">
                <span class="close"><i class="fas fa-bell"></i></span>
                <div class="modal-contentss mt-5">
                    <div class="circle"></div>
                    <p class="text-center fw-bold d-block mt-5"><?= session()->getFlashdata('messageError'); ?></p>
                </div>
            </div>
        </div>
    <?php endif; ?>

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







    <!-- Bottom Source -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/fbc67db110.js" crossorigin="anonymous"></script>
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
    </script>
</body>

</html>