<?php
require_once 'Config/Connection.php';

class Dosen
{
    private $pdo;
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }


    public function index()
    {
        $stmt = $this->pdo->query("SELECT
            p.*, pr.nama as nama_prodi
            FROM dosen p
            LEFT JOIN prodi pr ON pr.id = p.prodi_id
        ");
        $data = $stmt->fetchAll();

        return $data;
    }

    public function show($id)
    {
        $stmt = $this->pdo->query("SELECT
            p.*, pr.nama as nama_prodi
            FROM dosen p
            LEFT JOIN prodi pr ON pr.id = p.prodi_id
            WHERE p.id=$id
        ");
        $data = $stmt->fetch();
        return $data;
    }

    public function create($data)
    {
        $sql = "INSERT INTO dosen (nidn, nama, gelar_belakang, gelar_depan, jenis_kelamin, tempat_lahir, tanggal_lahir, alamat, email, tahun_masuk, prodi_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $data['nidn'],
            $data['nama'],
            $data['gelar_belakang'],
            $data['gelar_depan'],
            $data['jenis_kelamin'],
            $data['tempat_lahir'],
            $data['tanggal_lahir'],
            $data['alamat'],
            $data['email'],
            $data['tahun_masuk'],
            $data['prodi_id']
        ]);
        return $this->pdo->lastInsertId();
    }

    public function update($id, $data)
    {
        $sql = "UPDATE dosen SET nidn=:nidn, nama=:nama, gelar_belakang=:gelar_belakang, gelar_depan=:gelar_depan, jenis_kelamin=:jenis_kelamin, tempat_lahir=:tempat_lahir, tanggal_lahir=:tanggal_lahir, alamat=:alamat, email=:email, tahun_masuk=:tahun_masuk, prodi_id=:prodi_id WHERE id=:id";
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':nidn', $data['nidn']);
        $stmt->bindParam(':nama', $data['nama']);
        $stmt->bindParam(':gelar_belakang', $data['gelar_belakang']);
        $stmt->bindParam(':gelar_depan', $data['gelar_depan']);
        $stmt->bindParam(':jenis_kelamin', $data['jenis_kelamin']);
        $stmt->bindParam(':tempat_lahir', $data['tempat_lahir']);
        $stmt->bindParam(':tanggal_lahir', $data['tanggal_lahir']);
        $stmt->bindParam(':alamat', $data['alamat']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':tahun_masuk', $data['tahun_masuk']);
        $stmt->bindParam(':prodi_id', $data['prodi_id']);
        $stmt->bindParam(':id', $id);

        $stmt->execute();
        return $this->show($id);
    }

    public function delete($id)
    {
        $row = $this->show($id);
        $sql = "DELETE FROM dosen WHERE id=:id";
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':id', $id);

        $stmt->execute();
        return $row;
    }

    public function getLatestDosen()
    {
        $stmt = $this->pdo->query("SELECT
            p.*, pr.nama as nama_prodi
            FROM dosen p
            LEFT JOIN prodi pr ON pr.id = p.prodi_id
            ORDER BY p.id DESC LIMIT 1
            ");
        $data = $stmt->fetch();
        return $data;
    }
}

$dosen = new Dosen($pdo);
