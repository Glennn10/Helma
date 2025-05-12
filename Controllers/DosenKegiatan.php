<?php
require_once 'Config/Connection.php';

class DosenKegiatan
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function index()
    {
        $stmt = $this->pdo->query("SELECT 
            dk.id, 
            d.nama as nama_dosen, 
            k.nama as nama_kegiatan
            FROM dosen_kegiatan dk
            LEFT JOIN dosen d ON d.id = dk.dosen_id
            LEFT JOIN kegiatan k ON k.id = dk.kegiatan_id
        ");
        $data = $stmt->fetchAll();

        return $data;
    }

    public function show($id)
    {
        $stmt = $this->pdo->prepare("SELECT 
            dk.id, 
            d.nama as nama_dosen, 
            k.nama as nama_kegiatan
            FROM dosen_kegiatan dk
            LEFT JOIN dosen d ON d.id = dk.dosen_id
            LEFT JOIN kegiatan k ON k.id = dk.kegiatan_id
            WHERE dk.id = :id
        ");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetch();
        return $data;
    }

    public function create($data)
    {
        $sql = "INSERT INTO dosen_kegiatan (dosen_id, kegiatan_id) VALUES (?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $data['dosen_id'],
            $data['kegiatan_id']
        ]);
        return $this->pdo->lastInsertId();
    }

    public function delete($id)
    {
        try {
            // Validasi apakah ID ada di database
            $row = $this->show($id);
            if (!$row) {
                throw new Exception("Data dengan ID $id tidak ditemukan.");
            }

            // Hapus data
            $sql = "DELETE FROM dosen_kegiatan WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            return $row; // Kembalikan data yang dihapus (opsional)
        } catch (Exception $e) {
            // Tangani error
            return ['error' => $e->getMessage()];
        }
    }
}

// Inisialisasi objek
$dosenkegiatan = new DosenKegiatan($pdo);