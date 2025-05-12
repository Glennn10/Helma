<?php
require_once 'Controllers/Kegiatan.php';
require_once 'Helpers/helper.php';

$list_Kegiatan = $kegiatan->index();

?>
<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="mb-2">
                <a class="btn btn-success btn-sm" href="?url=Kegiatan-input">
                    Tambah Kegiatan
                </a>
            </div>

            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Tempat</th>
                        <th>Deskripsi</th>
                        <th>Jenis Kegiatan ID</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($list_Kegiatan as $row): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $row['tanggal_mulai'] ?></td>
                            <td><?= $row['tanggal_selesai'] ?></td>
                            <td><?= $row['tempat'] ?></td>
                            <td><?= $row['deskripsi'] ?></td>
                            <td><?= $row['jenis_kegiatan_id'] ?></td>
                            <td>
                                <div class="d-flex">
                                    <a href="?url=Kegiatan-input&id=<?= $row['id'] ?>"
                                        class="btn btn-sm btn-warning mr-2">Edit</a>
                                    <form action="" method="post"
                                        onsubmit="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                        <input type="hidden" name="type" value="delete">
                                        <button class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>