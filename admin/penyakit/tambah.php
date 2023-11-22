<?php
session_start();
if (empty($_SESSION['login'])) {
    header("Location: ../../auth/login.php");
}
include '../../function.php';

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../../dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../dist/css/custom.css">
    <link rel="stylesheet" href="../../dist/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../../dist/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../../dist/fontawesome/css/regular.min.css">
    <link rel="stylesheet" href="../../dist/fontawesome/css/solid.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet" />
    <title>Sistem Pakar-Tanaman Karet</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
    <!-- <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" /> -->
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/select/1.3.0/css/select.dataTables.min.css" rel="stylesheet" />
    <script src="../../dist/js/sweetalert.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('../../dist/bg1.jpg');
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

<body>
    <!-- Header -->
    <div class="text-center py-2" style="background-color: #b7d5ac;">
        <h5>SISTEM PAKAR DIAGNOSA PENYAKIT PADA TANAMAN KARET<br />
            DENGAN METODE FOWARD CHAINING DAN<br />
            DEMPSTER SHAFER</h5>
    </div>
    <div class="navbar border border-dark">
        <div>
            <a href="../index.php" class="">Home</a>
        </div>
        <div>
            <a href="../gejala/" class="">Daftar
                Gejala</a>
        </div>
        <div>
            <a href="../penyakit/" class="activee">Daftar
                penyakit</a>
        </div>
        <div>
            <a href="../rule/" class="">Daftar
                Rules</a>
        </div>
        <div>
            <a href="../../auth/logout.php">Keluar</a>
        </div>
    </div>
    <!-- akhir header -->

    <!-- isianweb -->
    <div class="container mt-3">
        <div class="row mt-3">
            <div class="col-lg-10 offset-1">
                <div class="card">
                    <div class="card-heading p-3">
                        Tambah Penyakit
                    </div>
                    <div class="card-body">
                        <form method="POST" action="" autocomplete="off">
                            <div class="form-group">
                                <label for="kode_penyakit">Kode Penyakit</label>
                                <input type="text" name="kode_penyakit" class="form-control" id="kode_penyakit" placeholder="P0.." required>
                            </div>
                            <div class="form-group">
                                <label for="nama_penyakit">Nama Penyakit</label>
                                <input type="text" name="nama_penyakit" class="form-control" id="nama_penyakit" placeholder="Penyakit..." required>
                            </div>
                            <div class="form-group">
                                <label for="definisi">Definisi Penyakit</label>
                                <input type="text" name="definisi" class="form-control" id="definisi" placeholder="Penyakit ini ..." required>
                            </div>
                            <div class="form-group">
                                <label for="solusi">Solusi</label>
                                <input type="text" name="solusi" class="form-control" id="solusi" placeholder="Solusi nya..." required>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary mb-2">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    if (isset($_POST["submit"])) {

        // cek apakah data berhasil di tambahkan atau tidak
        if (tambahpenyakit($_POST) > 0) {
            echo "<script>
                    Swal.fire({
                        title: 'Berhasil',
                        text: 'Berhasil Menyimpan Penyakit!',
                        icon: 'success'
                    }).then(function() {
                        window.location.href = 'index.php';
                    });
                </script>";
        } else {
            echo "
                <script>
                    alert('data gagal ditambahkan!');
                    document.location.href = 'index.php';
                </script>
            ";
        }
    }
    ?>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="../../dist/js/bootstrap.js"></script>
    <script src="../../dist/js/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>
    <script src="../../dist/js/jquery.dataTables.min.js"></script>
    <script src="../../dist/fontawesome/js/all.min.js"></script>
    <script src="../../dist/fontawesome/js/fontawesome.min.js"></script>
    <script src="../../dist/fontawesome/js/regular.min.js"></script>
    <script src="../../dist/fontawesome/js/solid.min.js"></script>
    <script src="../../dist/js/main.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js">
    </script>
    <script>
        new DataTable('.datatable-Gejala');
    </script>
</body>

</html>