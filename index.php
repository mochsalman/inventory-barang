<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Barang</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Inventory Barang</h2>
    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addModal">Tambah Barang</button>
    <table id="barangTable" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Jumlah Barang</th>
                <th>Satuan Barang</th>
                <th>Harga Beli</th>
                <th>Status Barang</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $conn = new mysqli("localhost", "root", "", "inventory");

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM tabelbarang";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id_barang']}</td>
                            <td>{$row['kode_barang']}</td>
                            <td>{$row['nama_barang']}</td>
                            <td>{$row['jumlah_barang']}</td>
                            <td>{$row['satuan_barang']}</td>
                            <td>{$row['harga_beli']}</td>
                            <td>" . ($row['status_barang'] ? 'Available' : 'Not Available') . "</td>
                            <td>
                                <button class='btn btn-info btn-sm editBtn' data-id='{$row['id_barang']}' data-toggle='modal' data-target='#editModal'>Edit</button>
                                <button class='btn btn-danger btn-sm deleteBtn' data-id='{$row['id_barang']}'>Hapus</button>
                                <button class='btn btn-warning btn-sm useBtn' data-id='{$row['id_barang']}'>Pakai</button>
                                <button class='btn btn-success btn-sm addQtyBtn' data-id='{$row['id_barang']}'>Tambah Jumlah</button>
                            </td>
                          </tr>";
                }
            }
            $conn->close();
            ?>
        </tbody>
    </table>
</div>

<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="addForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="kode_barang">Kode Barang</label>
                        <input type="text" class="form-control" id="kode_barang" name="kode_barang" required>
                    </div>
                    <div class="form-group">
                        <label for="nama_barang">Nama Barang</label>
                        <input type="text" class="form-control" id="nama_barang" name="nama_barang" required>
                    </div>
                    <div class="form-group">
                        <label for="jumlah_barang">Jumlah Barang</label>
                        <input type="number" class="form-control" id="jumlah_barang" name="jumlah_barang" required>
                    </div>
                    <div class="form-group">
                        <label for="satuan_barang">Satuan Barang</label>
                        <select class="form-control" id="satuan_barang" name="satuan_barang">
                            <option value="kg">Kg</option>
                            <option value="pcs">Pcs</option>
                            <option value="liter">Liter</option>
                            <option value="meter">Meter</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="harga_beli">Harga Beli</label>
                        <input type="number" step="0.01" class="form-control" id="harga_beli" name="harga_beli" required>
                    </div>
                    <div class="form-group">
                        <label for="status_barang">Status Barang</label>
                        <select class="form-control" id="status_barang" name="status_barang">
                            <option value="1">Available</option>
                            <option value="0">Not Available</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="editForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="edit_id_barang" name="id_barang">
                    <div class="form-group">
                        <label for="edit_kode_barang">Kode Barang</label>
                        <input type="text" class="form-control" id="edit_kode_barang" name="kode_barang" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_nama_barang">Nama Barang</label>
                        <input type="text" class="form-control" id="edit_nama_barang" name="nama_barang" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_jumlah_barang">Jumlah Barang</label>
                        <input type="number" class="form-control" id="edit_jumlah_barang" name="jumlah_barang" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_satuan_barang">Satuan Barang</label>
                        <select class="form-control" id="edit_satuan_barang" name="satuan_barang">
                            <option value="kg">Kg</option>
                            <option value="pcs">Pcs</option>
                            <option value="liter">Liter</option>
                            <option value="meter">Meter</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_harga_beli">Harga Beli</label>
                        <input type="number" step="0.01" class="form-control" id="edit_harga_beli" name="harga_beli" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_status_barang">Status Barang</label>
                        <select class="form-control" id="edit_status_barang" name="status_barang">
                            <option value="1">Available</option>
                            <option value="0">Not Available</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="script.js"></script>
</body>
</html>
