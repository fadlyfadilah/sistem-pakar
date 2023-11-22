<?php
session_start();
include '../../function.php';
if (!$_POST['evidence']) {
    header("Location: index.php");
}
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

    <link href="../../dist/css/bootstrap-datepicker.min.css" rel="stylesheet" />
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
            <a href="../../user/" class="">Home</a>
        </div>
        <div>
            <a href="../../user/carapenggunaan.php" class="">Cara
                Penggunaan</a>
        </div>
        <div>
            <a href="../../user/infopenyakit.php" class="">Informasi
                Penyakit</a>
        </div>
        <div>
            <a href="../diagnosis/" class="">Dianosis</a>
        </div>
    </div>
    <!-- akhir header -->

    <!-- isianweb -->
    <div class="container mt-3">

        <div class="row mb-3">
            <div class="col-md-8 offset-2">
                <div class="card mt-4">
                    <div class="card-header">
                        <p>Hasil Diagnosa.</p>
                    </div>
                    <?php
                    if (count($_POST['evidence']) < 2) {
                        $gejala_id = intval($_POST['evidence'][0]);
                        $confirmedDiseases = forwardChaining($_POST['evidence']);
                        $frequencyCounter = array_count_values($confirmedDiseases);
                        $mostFrequentDisease = array_search(max($frequencyCounter), $frequencyCounter);
                        $penyakits = query("SELECT * FROM penyakits WHERE id = $mostFrequentDisease")[0];
                        $penyakit_id = $penyakits['id'];
                        $value = query("SELECT value FROM rules WHERE gejala_id = $gejala_id AND penyakit_id = $penyakit_id")[0];
                        $value = round($value['value'] * 100, 2);
                        // var_dump($value['value']);
                        // die;
                    } else {
                        include '../../koneksi1.php';
                        $sql = "SELECT GROUP_CONCAT(penyakits.kode_penyakit) 
                                AS kdpenyakit,
                                    ROUND(AVG(rules.value), 1) AS average_cf,
                                    rules.gejala_id
                                    FROM rules
                                    JOIN penyakits ON rules.penyakit_id = penyakits.id
                                    WHERE rules.gejala_id IN (" . implode(',', $_POST['evidence']) . ")
                                    GROUP BY rules.gejala_id
                                    ORDER BY rules.gejala_id DESC";
                        $result = $db->query($sql);
                        $evidence = array();
                        $gejalaSelect = array();
                        while ($row = $result->fetch_row()) {
                            $evidence[] = $row;
                        }
                        //--- menentukan environement
                        $sql = "SELECT GROUP_CONCAT(kode_penyakit) FROM penyakits ";
                        $result = $db->query($sql);
                        $row = $result->fetch_row();
                        $fod = $row[0];
                        $densitas_baru = array();
                        while (!empty($evidence)) {
                            $densitas1[0] = array_shift($evidence);
                            $densitas1[1] = array($fod, 1 - $densitas1[0][1]);
                            $Y2 = 1 - $densitas1[0][1];
                            $densitas2 = array();
                            if (empty($densitas_baru)) {
                                $densitas2[0] = array_shift($evidence);
                            } else {
                                foreach ($densitas_baru as $k => $r) {
                                    if ($k != "&theta;") {
                                        $densitas2[] = array($k, $r);
                                    }
                                }
                            }
                            $theta = 1;
                            foreach ($densitas2 as $d) $theta -= $d[1];
                            $densitas2[] = array($fod, $theta);
							$m = count($densitas2);
                            $densitas_baru = array();
                            for ($y = 0; $y < $m; $y++) {
                                for ($x = 0; $x < 2; $x++) {
                                    if (!($y == $m - 1 && $x == 1)) {
                                        $v = explode(',', $densitas1[$x][0]);
                                        $w = explode(',', $densitas2[$y][0]);
                                        sort($v);
                                        sort($w);
                                        $vw = array_intersect($v, $w);  //mencari nilai irisan	
                                        if (empty($vw)) {
                                            $k = "&theta;";
                                        } else {
                                            $k = implode(',', $vw); //echo "{".print_r($k)."}= $nilaiX1Y1"; 
                                            $nilaiX1Y1 = $densitas1[$x][1] * $densitas2[$y][1];
                                        }
                                        if (!isset($densitas_baru[$k])) {
                                            $densitas_baru[$k] = $densitas1[$x][1] * $densitas2[$y][1];
                                            $k = implode(',', $vw); //echo $k. "<br>"; 
                                        } else {
                                            $densitas_baru[$k] += $densitas1[$x][1] * $densitas2[$y][1];
                                        }
                                    }
                                }
                            }
                            $dataX2 = $theta;
                            $dataY2 = $Y2;
                            $Y3 = $dataX2 * $dataY2;
                            foreach ($densitas_baru as $k => $d) {
                                if ($k != "&theta;") {
                                    $densitas_baru[$k] = $d / (1 - (isset($densitas_baru["&theta;"]) ? $densitas_baru["&theta;"] : 0));
                                }
                            }
                            unset($densitas_baru["&theta;"]);
                            arsort($densitas_baru);
                            $arrPenyakit = array();
                            $queryPasien = $db->query("SELECT * FROM penggunas ORDER BY id DESC");
                            $dataPasien = $queryPasien->fetch_assoc();
                            $queryP = $db->query("SELECT * FROM penyakits");
                            while ($dataP = $queryP->fetch_assoc()) {
                                $arrPenyakit[$dataP['kode_penyakit']] = $dataP['nama_penyakit'];
                            }
                            $highestDensity = 0;
                            $selectedPenyakit = '';
                            foreach ($densitas_baru as $kdpenyakit => $density) {
                                if ($density > $highestDensity) {
                                    $highestDensity = $density;
                                    $selectedPenyakit = $kdpenyakit;
                                }
                            }
                            if ($selectedPenyakit != '') {
                                // Mengambil solusi penyakit
                                $strS = $db->query("SELECT * FROM penyakits WHERE kode_penyakit='$selectedPenyakit'");
                                $dataS = $strS->fetch_assoc();
                                $persen = round($highestDensity * 100, 2);
                                // $idPasien = $dataPasien['idpasien'];
                                // $querySimpanP = $db->query("INSERT INTO hasil (pengguna_id, kode_penyakit, persentase) VALUES ('$idPasien', '$selectedPenyakit', '$persen')");
                            }
                        }
                    }
                    ?>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-3 col-form-label">Nama penyakit</label>
                            <div class="col-sm-9">
                                <p type="text" class="form-control-plaintext"><?= $penyakits['nama_penyakit'] ?? $dataS['nama_penyakit'] ?? '' ?></p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-3 col-form-label">Gejala</label>
                            <div class="col-sm-9">
                                <?php
                                include '../../koneksi1.php';
                                foreach ($_POST['evidence'] as $kdGSelect) {
                                    $queryG = $db->prepare("SELECT * FROM gejalas WHERE id = ?");
                                    $queryG->bind_param("i", $kdGSelect);
                                    $queryG->execute();
                                    $result = $queryG->get_result();
                                    $dataG = $result->fetch_assoc();
                                ?>
                                    <p type="text" class="form-control-plaintext"><?= $kdGSelect ?> | <?= $dataG['nama_gejala'] ?></p>
                                <?php
                                } ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-3 col-form-label">Densitas</label>
                            <div class="col-sm-9">
                                <p type="text" class="form-control-plaintext"><?= $value ?? $persen ?? '0' ?>%</p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-3 col-form-label">Solusi</label>
                            <div class="col-sm-9">
                                <p type="text" class="form-control-plaintext"><?= $penyakits['solusi'] ?? $dataS['solusi'] ?? "Solusi belum di temukan." ?></p>
                            </div>
                        </div>
                        <a class="btn btn-secondary" href="pertanyaan.php" role="button">Diagnosa Lagi!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
    <script src="../../dist/js/bootstrap-datepicker.min.js">
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
    <script>
        $('.datepicker').datepicker({
            format: 'yyyy/mm/dd',
        });
    </script>
</body>

</html>