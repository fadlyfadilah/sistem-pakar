<?php
session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="dist/css/custom.css">
    <link rel="stylesheet" href="dist/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="dist/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="dist/fontawesome/css/regular.min.css">
    <link rel="stylesheet" href="dist/fontawesome/css/solid.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet" />
    <title>Sistem Pakar-Tanaman Karet</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
    <!-- <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" /> -->
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/select/1.3.0/css/select.dataTables.min.css" rel="stylesheet" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('dist/bg1.jpg');
            background-size: cover;
            background-repeat: no-repeat;
        }

        .navbar {
            overflow: hidden;
            background-color: #fff;
        }

        .navbar a {
            float: left;
            display: block;
            color: black;
            text-align: center;
            padding: 8px;
            text-decoration: none;
        }

        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }

        .activee {
            background-color: #ddd;
            color: black;
        }
    </style>
</head>

<body class="vh-100">
    <!-- Header -->
    <!-- <div class="text-center py-2" style="background-color: #b7d5ac;">
        <h5>SISTEM PAKAR DIAGNOSA PENYAKIT PADA TANAMAN KARET<br />
            DENGAN METODE FOWARD CHAINING DAN<br />
            DEMPSTER SHAFER</h5>
    </div> -->
    <!-- <div class="navbar border border-dark">
        <div>
            <a href="index.php" class="activee">Home</a>
        </div>
        <div>
            <a href="admin/gejala/index.php" class="">Daftar
                Gejala</a>
        </div>
        <div>
            <a href="#" class="">Daftar
                penyakit</a>
        </div>
        <div>
            <a href="#" class="">Daftar
                Rules</a>
        </div>
        <div>
            <a href="auth/logout.php">Keluar</a>
        </div>
    </div> -->
    <!-- akhir header -->

    <!-- isianweb -->
    <div class="d-flex align-items-center justify-content-center h-100">
        <div class="card text-center ">
            <div class="card-body">
                <p>Selamat Datang di Sistem Pakar Diagnosa <br /> Penyakit Pada Tanaman</p>
                <p>Silahkan Pilih Menu Halaman</p>

                <a class="btn btn-light border border-dark" href="user/" role="button">Pengguna</a>
                <a class="btn btn-light border border-dark" href="admin/" role="button">Admin</a>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="dist/js/bootstrap.js"></script>
    <script src="dist/js/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>
    <script src="dist/js/jquery.dataTables.min.js"></script>
    <script src="dist/fontawesome/js/all.min.js"></script>
    <script src="dist/fontawesome/js/fontawesome.min.js"></script>
    <script src="dist/fontawesome/js/regular.min.js"></script>
    <script src="dist/fontawesome/js/solid.min.js"></script>
    <script src="dist/js/main.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js">
    </script>
    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"
        integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous">
    </script>
    -->
</body>

</html>