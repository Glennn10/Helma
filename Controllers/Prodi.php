<?php
require_once 'Config/Connection.php';

class Prodi
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function index()
    {
        $stmt = $this->pdo->query("SELECT * FROM prodi");
        $data = $stmt->fetchAll();
        return $data;
    }

    public function show($id)
    {
        $stmt = $this->pdo->query("SELECT * FROM prodi WHERE id=$id");
        $data = $stmt->fetch();
        return $data;
    }

    public function create($data)
    {
        $sql = "INSERT INTO prodi (id, kode, nama, alamat, telpon, ketua) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$data['id'], $data['kode'], $data['nama'], $data['alamat'], $data['telpon'], $data['ketua']]);
        return $this->pdo->lastInsertId();
    }

    public function update($id, $data)
    {
        $sql = "UPDATE prodi SET kode=:kode, nama=:nama, alamat=:alamat, telpon=:telpon, ketua=:ketua WHERE id=:id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':kode', $data['kode']);
        $stmt->bindParam(':nama', $data['nama']);
        $stmt->bindParam(':alamat', $data['alamat']);
        $stmt->bindParam(':telpon', $data['telpon']);
        $stmt->bindParam(':ketua', $data['ketua']);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $this->show($id);
    }

    public function delete($id)
    {
        $row = $this->show($id);
        $sql = "DELETE FROM prodi WHERE id=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $row;
    }
}

$prodi = new Prodi($pdo);
