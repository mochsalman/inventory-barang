$(document).ready(function() {
    $('#barangTable').DataTable();

    $('#addForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "process.php",
            data: $(this).serialize() + "&action=add",
            success: function(response) {
                location.reload();
            }
        });
    });

    $('.editBtn').on('click', function() {
        var id = $(this).data('id');
        $.ajax({
            type: "GET",
            url: "process.php",
            data: { id: id, action: 'get' },
            success: function(response) {
                var data = JSON.parse(response);
                $('#edit_id_barang').val(data.id_barang);
                $('#edit_kode_barang').val(data.kode_barang);
                $('#edit_nama_barang').val(data.nama_barang);
                $('#edit_jumlah_barang').val(data.jumlah_barang);
                $('#edit_satuan_barang').val(data.satuan_barang);
                $('#edit_harga_beli').val(data.harga_beli);
                $('#edit_status_barang').val(data.status_barang);
            }
        });
    });

    $('#editForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "process.php",
            data: $(this).serialize() + "&action=edit",
            success: function(response) {
                location.reload();
            }
        });
    });

    $('.deleteBtn').on('click', function() {
        var id = $(this).data('id');
        if (confirm('Yakin ingin menghapus barang ini?')) {
            $.ajax({
                type: "POST",
                url: "process.php",
                data: { id: id, action: 'delete' },
                success: function(response) {
                    location.reload();
                }
            });
        }
    });

    $('.useBtn').on('click', function() {
        var id = $(this).data('id');
        if (confirm('Yakin ingin menggunakan barang ini?')) {
            $.ajax({
                type: "POST",
                url: "process.php",
                data: { id: id, action: 'use' },
                success: function(response) {
                    location.reload();
                }
            });
        }
    });

    $('.addQtyBtn').on('click', function() {
        var id = $(this).data('id');
        var qty = prompt('Masukkan jumlah yang ingin ditambahkan:');
        if (qty) {
            $.ajax({
                type: "POST",
                url: "process.php",
                data: { id: id, qty: qty, action: 'addQty' },
                success: function(response) {
                    location.reload();
                }
            });
        }
    });
});
