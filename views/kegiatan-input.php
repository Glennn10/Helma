<?php
require_once 'Controllers/Kegiatan.php';
require_once 'Controllers/JenisKegiatan.php';
require_once 'Helpers/helper.php';

$kegiatan_id = isset($_GET['id']) ? $_GET['id'] : null;
$show_kegiatan = $kegiatan_id ? $kegiatan->show($kegiatan_id) : [];

$list_jeniskegiatan = $jeniskegiatan->index();

if (isset($_POST['type'])) {
    if ($_POST['type'] == 'create') {
        $id = $kegiatan->create($_POST);
        echo "<script>alert('Data berhasil ditambahkan')</script>";
        echo "<script>window.location='?url=kegiatan'</script>";
    } else if ($_POST['type'] == 'update') {
        $row = $kegiatan->update($kegiatan_id, $_POST);
        echo "<script>alert('Data $row[nama] berhasil diperbarui')</script>";
        echo "<script>window.location='?url=kegiatan'</script>";
    }
}
?>

<div class="container">
    <form method="post">

        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    Tambah Kegiatan
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="tgl_lahir">Tanggal Mulai</label>
                    <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" value="<?= getSafeFormValue($show_kegiatan, 'tgl_mulai') ?>" required>
                </div>
                <div class="form-group">
                    <label for="tgl_lahir">Tanggal Selesai</label>
                    <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai" value="<?= getSafeFormValue($show_kegiatan, 'tgl_selesai') ?>" required>
                </div>
                <div class="form-group">
                    <label for="tempat">Tempat</label>
                    <input type="text" class="form-control" id="tempat" name="tempat" value="<?= getSafeFormValue($show_kegiatan, 'tempat') ?>" required>
                </div>
                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="<?= getSafeFormValue($show_kegiatan, 'deskripsi') ?>" required>
                </div>
                <div class="form-group">
                    <label for="jenis_kegiatan_id">Jenis Kegiatan</label>
                    <select class="form-control" id="jenis_kegiatan_id" name="jenis_kegiatan_id" required>
                        <option value="">Pilih Jenis Kegiatan</option>
                        <?php foreach ($list_jeniskegiatan as $kegiatan) : ?>
                            <option value="<?= $kegiatan['id'] ?>" <?= $kegiatan['id'] == getSafeFormValue($show_kegiatan, 'jenis_kegiatan_id') ? 'selected' : '' ?>><?= $kegiatan['nama'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>


            <div class="card-footer text-right">
                <input type="hidden" name="type" value="<?= $kegiatan_id ? 'update' : 'create' ?>">
                <input type="hidden" name="id" value="<?= $kegiatan_id ?>">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

    </form>
</div>