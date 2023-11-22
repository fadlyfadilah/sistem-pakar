<?php

// Koneksi data base
$conn = mysqli_connect("localhost", "root", "", "sistempakar");

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}
function registrasi($data)
{
    global $conn;

    $username = ($data["username"]);
    $password = mysqli_real_escape_string($conn, $data["password"]);
    // cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");

    if (mysqli_fetch_assoc($result)) {
        echo "<script>
                        alert('username sudah terdaftar!')
                    </script>";
        return false;
    }

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambahkan userbaru ke database
    mysqli_query($conn, "INSERT INTO users VALUES('', '$username', '$password', '', '')");

    return mysqli_affected_rows($conn);
}
//gejala
function tambahgejala($data)
{
    global $conn;

    $kode_gejala = htmlspecialchars($data["kode_gejala"]);
    $nama_gejala = htmlspecialchars($data["nama_gejala"]);

    $query = "INSERT INTO gejalas
                    VALUES
                ('', '$kode_gejala', '$nama_gejala', '', '')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
function hapusgejala($id)
{
    global $conn;

    $query = "DELETE FROM gejalas WHERE id = '$id'";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
function editgejala($data)
{
    global $conn;

    $id = $data['id'];
    $kode_gejala = htmlspecialchars($data["kode_gejala"]);
    $nama_gejala = htmlspecialchars($data["nama_gejala"]);

    $query = "UPDATE gejalas SET
                        id = '$id',
                        kode_gejala = '$kode_gejala',
                        nama_gejala = '$nama_gejala'
                    WHERE id = '$id'";
    // var_dump($conn); die;
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
function tambahpenyakit($data)
{
    global $conn;

    $kode_penyakit = htmlspecialchars($data["kode_penyakit"]);
    $nama_penyakit = htmlspecialchars($data["nama_penyakit"]);
    $definisi = htmlspecialchars($data["definisi"]);
    $solusi = htmlspecialchars($data["solusi"]);

    $query = "INSERT INTO penyakits
                    VALUES
                ('', '$kode_penyakit', '$nama_penyakit', '$definisi', '$solusi', '', '')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
function hapuspenyakit($id)
{
    global $conn;

    $query = "DELETE FROM penyakits WHERE id = '$id'";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
function editpenyakit($data)
{
    global $conn;

    $id = $data['id'];
    $kode_penyakit = htmlspecialchars($data["kode_penyakit"]);
    $nama_penyakit = htmlspecialchars($data["nama_penyakit"]);
    $definisi = htmlspecialchars($data["definisi"]);
    $solusi = htmlspecialchars($data["solusi"]);

    $query = "UPDATE penyakits SET
                        id = '$id',
                        kode_penyakit = '$kode_penyakit',
                        nama_penyakit = '$nama_penyakit',
                        definisi = '$definisi',
                        solusi = '$solusi'
                    WHERE id = '$id'";
    // var_dump($conn); die;
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function tambahrule($data)
{
    global $conn;

    $gejala_id = htmlspecialchars($data["gejala_id"]);
    $penyakit_id = htmlspecialchars($data["penyakit_id"]);
    $value = htmlspecialchars($data["value"]);

    $query = "INSERT INTO rules
                    VALUES
                ('', '$gejala_id', '$penyakit_id', $value, '', '')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
function hapusrule($id)
{
    global $conn;

    $query = "DELETE FROM rules WHERE id = '$id'";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
function editrule($data)
{
    global $conn;

    $id = $data['id'];
    $gejala_id = htmlspecialchars($data["gejala_id"]);
    $penyakit_id = htmlspecialchars($data["penyakit_id"]);
    $value = htmlspecialchars($data["value"]);

    $query = "UPDATE rules SET
                        id = '$id',
                        gejala_id = '$gejala_id',
                        penyakit_id = '$penyakit_id',
                        value = '$value'
                    WHERE id = '$id'";
    // var_dump($conn); die;
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function tambahpengguna($data)
{
    global $conn;

    $nama = htmlspecialchars($data["nama"]);
    $umur = htmlspecialchars($data["umur"]);
    $jenis_kelamin = htmlspecialchars($data["jenis_kelamin"]);
    $tanggal_diagnosis = htmlspecialchars($data["tanggal_diagnosis"]);

    $query = "INSERT INTO penggunas
                    VALUES
                ('', '$nama', '$umur', '$jenis_kelamin', '$tanggal_diagnosis')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function forwardChaining($symptoms)
{
    // Initialize confirmed diseases
    $confirmedDiseases = [];

    // Assuming $rules is an array of rules, you may need to replace it with appropriate code in native PHP.
    $rules = query("SELECT * FROM rules");

    foreach ($rules as $rule) {
        $requiredSymptoms = explode(',', $rule['gejala_id']);

        // Check if all required symptoms are present in the observed symptoms
        if (count(array_intersect($requiredSymptoms, $symptoms)) === count($requiredSymptoms)) {
            // Rule is satisfied, add the disease to the list of confirmed diseases
            $confirmedDiseases[] = $rule['penyakit_id'];
        }
    }

    return $confirmedDiseases;
}
