<?php
require_once 'Controllers/JenisKegiatan.php';
require_once 'Helpers/helper.php';

$jeniskegiatan_id = isset($_GET['id']) ? $_GET['id'] : null;
$show_jeniskegiatan = $jeniskegiatan_id ? $jeniskegiatan->show($jeniskegiatan_id) : [];

if (isset($_POST['type'])) {
  if ($_POST['type'] == 'create') {
    $id = $jeniskegiatan->create($_POST);
    echo "<script>alert('Data berhasil ditambahkan')</script>";
    echo "<script>window.location='?url=jenis_kegiatan'</script>";
  } else if ($_POST['type'] == 'update') {
    $row = $jeniskegiatan->update($jeniskegiatan_id, $_POST);
    echo "<script>alert('Data $row[nama] berhasil diperbarui')</script>";
    echo "<script>window.location='?url=jenis_kegiatan'</script>";
  }
}
?>

<div class="container">
  <form method="post">

    <div class="card">
      <div class="card-header">
        <div class="card-title">
          Tambah Jenis Kegiatan
        </div>
      </div>
      <div class="card-body">

        <div class="form-group">
          <label for="nama">Nama Kegiatan</label>
          <input type="text" name="nama" id="nama" class="form-control" value="<?= $show_jeniskegiatan['nama'] ?? '' ?>">
        </div>

      </div>

      <div class="card-footer text-right">
        <input type="hidden" name="type" value="<?= $jeniskegiatan_id ? 'update' : 'create' ?>">
        <input type="hidden" name="id" value="<?= $jeniskegiatan_id ?>">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </div>

  </form>
</div>