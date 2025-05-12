<?php
require_once 'Config/Connection.php';

class Kegiatan
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function index()
    {
        $stmt = $this->pdo->query("SELECT 
            p.*, jk.nama as nama_jenis_kegiatan
            FROM kegiatan p
            LEFT JOIN jenis_kegiatan jk ON jk.id = p.jenis_kegiatan_id
        ");
        $data = $stmt->fetchAll();

        return $data;
    }

    public function show($id)
    {
        $stmt = $this->pdo->query("SELECT 
            p.*, k.nama as nama_jenis_kegiatan
            FROM kegiatan p
            LEFT JOIN jenis_kegiatan k ON k.id = p.jenis_kegiatan_id
            WHERE p.id=$id
        ");
        $data = $stmt->fetch();
        return $data;
    }

    public function create($data)
    {
        $sql = "INSERT INTO kegiatan (tanggal_mulai, tanggal_selesai, tempat, deskripsi, jenis_kegiatan_id) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $data['tanggal_mulai'],
            $data['tanggal_selesai'],
            $data['tempat'],
            $data['deskripsi'],
            $data['jenis_kegiatan_id']
        ]);
        return $this->pdo->lastInsertId();
    }

    public function update($id, $data)
    {
        $sql = "UPDATE kegiatan SET tanggal_mulai=:tanggal_mulai, tanggal_selesai=:tanggal_selesai, tempat=:tempat, deskripsi=:deskripsi, jenis_kegiatan_id=:jenis_kegiatan_id WHERE id=:id";
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':tanggal_mulai', $data['tanggal_mulai']);
        $stmt->bindParam(':tanggal_selesai', $data['tanggal_selesai']);
        $stmt->bindParam(':tempat', $data['tempat']);
        $stmt->bindParam(':deskripsi', $data['deskripsi']);
        $stmt->bindParam(':jenis_kegiatan_id', $data['jenis_kegiatan_id']);
        $stmt->bindParam(':id', $id);

        $stmt->execute();
        return $this->show($id);
    }

    public function delete($id)
    {
        $row = $this->show($id);
        $sql = "DELETE FROM kegiatan WHERE id=:id";
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':id', $id);

        $stmt->execute();
        return $row;
    }
}

$kegiatan = new Kegiatan($pdo);
