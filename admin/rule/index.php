<?php
session_start();
if (empty($_SESSION['login'])) {
    header("Location: ../../auth/login.php");
}
include '../../function.php';
$rules = query("SELECT g.kode_gejala, g.nama_gejala, p.kode_penyakit, p.nama_penyakit, p.solusi, r.id, r.gejala_id, r.penyakit_id, r.value FROM penyakits AS p
    JOIN rules AS r ON(r.penyakit_id = p.id)
    JOIN gejalas AS g on(g.id = r.gejala_id)");
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
            <a href="../penyakit/" class="">Daftar
                penyakit</a>
        </div>
        <div>
            <a href="../rule/" class="activee">Daftar
                Rules</a>
        </div>
        <div>
            <a href="../hasildiagnosa/" class="">Daftar
                Hasil Diagnosa</a>
        </div>
        <div>
            <a href="../../auth/logout.php">Keluar</a>
        </div>
    </div>
    <!-- akhir header -->

    <!-- isianweb -->
    <div class="container mt-3">
        <div class="row mt-3">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-heading p-3">
                        Daftar Rule/Aturan
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class=" table table-bordered table-striped table-hover datatable datatable-gejala">
                                <thead>
                                    <tr>
                                        <th width="10">

                                        </th>
                                        <th>
                                            Kode Gejala - Nama Gejala
                                        </th>
                                        <th>
                                            Kode Penyakit - Nama Penyakit
                                        </th>
                                        <th>
                                            Nilai CF/Belief
                                        </th>
                                        <th>
                                            <a class="btn btn-info" href="tambah.php">
                                                <i class="fa-solid fa-plus"></i>Tambah Rule/Aturan
                                            </a>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1 ?>
                                    <?php foreach ($rules as $rule) : ?>
                                        <tr data-entry-id="<?= $rule['id'] ?>">
                                            <td>
                                                <?= $no++ ?>
                                            </td>
                                            <td>
                                                <?= $rule['kode_gejala'] ?> | <?= $rule['nama_gejala'] ?>
                                            </td>
                                            <td>
                                                <?= $rule['kode_penyakit'] ?> | <?= $rule['nama_penyakit'] ?>
                                            </td>
                                            <td>
                                                <?= $rule['value'] ?>
                                            </td>
                                            <td>
                                                <a class="btn btn-xs btn-success" href="edit.php?id=<?= $rule["id"]; ?>">
                                                    <i class="fa-solid fa-pen-to-square"></i>Ubah
                                                </a>
                                                <a class="btn btn-xs btn-danger" href="#" onclick="confirmDelete(<?= $rule["id"]; ?>);">
                                                    <i class="fa-solid fa-trash"></i> Hapus
                                                </a>
                                            </td>
                                        <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->
    <script>
        function confirmDelete(id) {
            // Display a confirmation dialog
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda tidak dapat mengembalikan tindakan ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If the user confirms, redirect to the delete script
                    window.location.href = 'hapus.php?id=' + id;
                }
            });
        }
    </script>
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
        new DataTable('.datatable-gejala');
    </script>
</body>

</html>