<?php
$conn = new mysqli("localhost", "root", "", "inventory");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$action = $_POST['action'] ?? $_GET['action'] ?? '';

if ($action == 'add') {
    $kode_barang = $_POST['kode_barang'];
    $nama_barang = $_POST['nama_barang'];
    $jumlah_barang = $_POST['jumlah_barang'];
    $satuan_barang = $_POST['satuan_barang'];
    $harga_beli = $_POST['harga_beli'];
    $status_barang = $_POST['status_barang'];

    $sql = "INSERT INTO tabelbarang (kode_barang, nama_barang, jumlah_barang, satuan_barang, harga_beli, status_barang)
            VALUES ('$kode_barang', '$nama_barang', $jumlah_barang, '$satuan_barang', $harga_beli, $status_barang)";
    $conn->query($sql);

} elseif ($action == 'edit') {
    $id_barang = $_POST['id_barang'];
    $kode_barang = $_POST['kode_barang'];
    $nama_barang = $_POST['nama_barang'];
    $jumlah_barang = $_POST['jumlah_barang'];
    $satuan_barang = $_POST['satuan_barang'];
    $harga_beli = $_POST['harga_beli'];
    $status_barang = $_POST['status_barang'];

    $sql = "UPDATE tabelbarang SET
            kode_barang='$kode_barang',
            nama_barang='$nama_barang',
            jumlah_barang=$jumlah_barang,
            satuan_barang='$satuan_barang',
            harga_beli=$harga_beli,
            status_barang=$status_barang
            WHERE id_barang=$id_barang";
    $conn->query($sql);

} elseif ($action == 'delete') {
    $id_barang = $_POST['id'];
    $sql = "DELETE FROM tabelbarang WHERE id_barang=$id_barang";
    $conn->query($sql);

} elseif ($action == 'use') {
    $id_barang = $_POST['id'];
    $sql = "UPDATE tabelbarang SET jumlah_barang = jumlah_barang - 1 WHERE id_barang=$id_barang";
    $conn->query($sql);

} elseif ($action == 'addQty') {
    $id_barang = $_POST['id'];
    $qty = $_POST['qty'];
    $sql = "UPDATE tabelbarang SET jumlah_barang = jumlah_barang + $qty WHERE id_barang=$id_barang";
    $conn->query($sql);

} elseif ($action == 'get') {
    $id_barang = $_GET['id'];
    $sql = "SELECT * FROM tabelbarang WHERE id_barang=$id_barang";
    $result = $conn->query($sql);
    echo json_encode($result->fetch_assoc());
}

$conn->close();
?>
