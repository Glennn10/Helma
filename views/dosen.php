<?php
require_once 'Controllers/Dosen.php';
require_once 'Helpers/helper.php';

$list_Dosen = $dosen->index();

if (isset($_POST['type'])) {
    if ($_POST['type'] == 'delete') {
        $row = $dosen->delete($_POST['id']);
        echo "<script>alert('Data $row[nama] berhasil dihapus')</script>";
        echo "<script>window.location='?url=dosen'</script>";
    }
}
?>

<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="mb-2">
                <a class="btn btn-success btn-sm" href="?url=dosen-input">
                    Tambah Dosen
                </a>
            </div>

            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIDN</th>
                        <th>Nama</th>
                        <th>Gelar Belakang</th>
                        <th>Gelar Depan</th>
                        <th>Tempat Lahir</th>
                        <th>Tanggal Lahir</th>
                        <th>Alamat</th>
                        <th>Email</th>
                        <th>Tahun Masuk</th>
                        <th>Prodi ID</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($list_Dosen as $row): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $row['nidn'] ?></td>
                            <td><?= $row['nama'] ?></td>
                            <td><?= $row['gelar_belakang'] ?></td>
                            <td><?= $row['gelar_depan'] ?></td>
                            <td><?= $row['tempat_lahir'] ?></td>
                            <td><?= $row['tanggal_lahir'] ?></td>
                            <td><?= $row['alamat'] ?></td>
                            <td><?= $row['email'] ?></td>
                            <td><?= $row['tahun_masuk'] ?></td>
                            <td><?= $row['prodi_id'] ?></td>
                            <td>
                                <div class="d-flex">
                                    <a href="?url=dosen-input&id=<?= $row['id'] ?>"
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