<?php
require_once 'Config/Connection.php';

class Penelitian
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function index()
    {
        $stmt = $this->pdo->query("SELECT 
            p.*, bi.nama as nama_bidang_ilmu
            FROM penelitian p
            LEFT JOIN bidang_ilmu bi ON bi.id = p.bidang_ilmu_id
        ");
        $data = $stmt->fetchAll();

        return $data;
    }

    public function show($id)
    {
        $stmt = $this->pdo->query("SELECT 
            p.*, bi.nama as nama_bidang_ilmu
            FROM penelitian p
            LEFT JOIN bidang_ilmu bi ON bi.id = p.bidang_ilmu_id
            WHERE p.id=$id
        ");
        $data = $stmt->fetch();
        return $data;
    }

    public function create($data)
    {
        $sql = "INSERT INTO penelitian (judul, mulai, akhir, tahun_ajaran, bidang_ilmu_id) VALUES (?, ?, ?, ?, ?)"; 
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $data['judul'],
            $data['mulai'],
            $data['akhir'],
            $data['tahun_ajaran'],
            $data['bidang_ilmu_id']
        ]);
        return $this->pdo->lastInsertId();
    }

    public function update($id, $data)
    {
        $sql = "UPDATE penelitian SET judul=:judul, mulai=:mulai, akhir=:akhir, tahun_ajaran=:tahun_ajaran, bidang_ilmu_id=:bidang_ilmu_id WHERE id=:id";
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':judul', $data['judul']);
        $stmt->bindParam(':mulai', $data['mulai']);
        $stmt->bindParam(':akhir', $data['akhir']);
        $stmt->bindParam(':tahun_ajaran', $data['tahun_ajaran']);
        $stmt->bindParam(':bidang_ilmu_id', $data['bidang_ilmu_id']);
        $stmt->bindParam(':id', $id);

        $stmt->execute();
        return $this->show($id);
    }

    public function delete($id)
    {
        $row = $this->show($id);
        $sql = "DELETE FROM penelitian WHERE id=:id";
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':id', $id);

        $stmt->execute();
        return $row;
    }
}

$penelitian = new Penelitian($pdo);
