<?php
require_once 'Config/Connection.php';

class TimPenelitian
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function index()
    {
        $stmt = $this->pdo->query("SELECT 
            p.id, p.peran,
            d.nama as nama_dosen, k.nama as nama_penelitian
            FROM tim_penelitian p
            LEFT JOIN dosen d ON d.id = p.dosen_id
            LEFT JOIN penelitian k ON k.id = p.penelitian_id
        ");
        $data = $stmt->fetchAll();

        return $data;
    }

    public function show($id)
    {
        $stmt = $this->pdo->query("SELECT 
            p.id, p.peran,
            d.nama as nama_dosen, k.nama as nama_penelitian
            FROM tim_penelitian p
            LEFT JOIN dosen d ON d.id = p.dosen_id
            LEFT JOIN penelitian k ON k.id = p.penelitian_id
            WHERE p.id=$id
        ");
        $data = $stmt->fetch();
        return $data;
    }

    public function create($data)
    {
        $sql = "INSERT INTO tim_penelitian (dosen_id, penelitian_id, peran) VALUES (?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $data['dosen_id'],
            $data['penelitian_id'],
            $data['peran']
        ]);
        return $this->pdo->lastInsertId();
    }

    public function update($id, $data)
    {
        $sql = "UPDATE tim_penelitian SET dosen_id=:dosen_id, penelitian_id=:penelitian_id, peran=:peran WHERE id=:id";
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':dosen_id', $data['dosen_id']);
        $stmt->bindParam(':penelitian_id', $data['penelitian_id']);
        $stmt->bindParam(':peran', $data['peran']);
        $stmt->bindParam(':id', $id);
        
        $stmt->execute();
        return $this->show($id);
    }

    public function delete($id)
    {
        $row = $this->show($id);
        $sql = "DELETE FROM tim_penelitian WHERE id=:id";
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':id', $id);

        $stmt->execute();
        return $row;
    }
}

$timpenelitian = new TimPenelitian($pdo);
