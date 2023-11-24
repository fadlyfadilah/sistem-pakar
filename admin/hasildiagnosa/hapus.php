<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../../dist/js/sweetalert.js"></script>
    <title>Sistem Pakar-Tanaman Karet</title>
</head>

<body>

</body>

</html>
<?php
require '../../function.php';

$id = $_GET["id"];

if (hapusrule($id) > 0) {
    echo "
    <script>
        Swal.fire({
            title: 'Berhasil',
            text: 'Berhasil Menghapus Aturan!',
            icon: 'success'
        }).then(function() {
            window.location.href = 'index.php';
        });
    </script>
	";
} else {
    echo "
		<script>
			alert('data gagal ditambahkan!');
			document.location.href = 'index.php';
		</script>
	";
}
?>