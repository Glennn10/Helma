<?php
require_once 'Controllers/Dosen.php';
require_once 'Controllers/Prodi.php';
require_once 'Helpers/helper.php';

$dosen_id = isset($_GET['id']) ? $_GET['id'] : null;
$show_dosen = $dosen_id ? $dosen->show($dosen_id) : [];
$latest_dosen = $dosen->getLatestDosen();

$list_prodi = $prodi->index();

if (isset($_POST['type'])) {
    if ($_POST['type'] == 'create') {
        $id = $dosen->create($_POST);
        echo "<script>alert('Data berhasil ditambahkan')</script>";
        echo "<script>window.location='?url=dosen'</script>";
    } else if ($_POST['type'] == 'update') {
        $row = $dosen->update($dosen_id, $_POST);
        echo "<script>alert('Data $row[nama] berhasil diperbarui')</script>";
        echo "<script>window.location='?url=dosen'</script>";
    }
}
?>

<div class="container">
    <form method="post">

        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    Tambah Dosen
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="telpon">NIDN</label>
                    <input type="text" class="form-control" id="nidn" name="nidn" value="<?= getSafeFormValue($show_dosen, 'nidn') ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="<?= getSafeFormValue($show_dosen, 'nama') ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Gelar Belakang</label>
                    <input type="text" class="form-control" id="gelar_belakang" name="gelar_belakang" value="<?= getSafeFormValue($show_dosen, 'gelar_belakang') ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Gelar Depan</label>
                    <input type="text" class="form-control" id="gelar_depan" name="gelar_depan" value="<?= getSafeFormValue($show_dosen, 'gelar_depan') ?>" required>
                </div>
                <div class="form-group">
                        <label for="gender">Jenis Kelamin</label>
                        <select class="form-control" id="gender" name="gender" required>
                            <option value="L" <?= getSafeFormValue($show_dosen, 'gender') == 'L' ? 'selected' : '' ?>>Laki-laki</option>
                        <option value="P" <?= getSafeFormValue($show_dosen, 'gender') == 'P' ? 'selected' : '' ?>>Perempuan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="email">Tempat Lahir</label>
                    <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="<?= getSafeFormValue($show_dosen, 'tempat_lahir') ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Tanggal Lahir</label>
                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?= getSafeFormValue($show_dosen, 'tanggal_lahir') ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Alamat</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" value="<?= getSafeFormValue($show_dosen, 'alamat') ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= getSafeFormValue($show_dosen, 'email') ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Tahun Masuk</label>
                    <input type="text" class="form-control" id="tahun_masuk" name="tahun_masuk" value="<?= getSafeFormValue($show_dosen, 'tahun_masuk') ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Prodi</label>
                    <select class="form-control" id="prodi_id" name="prodi_id" required>
                        <?php foreach ($list_prodi as $prodi): ?>
                            <option value="<?= $prodi['id'] ?>" <?= getSafeFormValue($show_dosen, 'prodi_id') == $prodi['id'] ? 'selected' : '' ?>>
                                <?= $prodi['nama'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
                

            <div class="card-footer text-right">
                <input type="hidden" name="type" value="<?= $dosen_id ? 'update' : 'create' ?>">
                <input type="hidden" name="id" value="<?= $dosen_id ?>">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

    </form>
</div>