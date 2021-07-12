<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class m_mahasiswa extends Model
{
    protected $table = "mahasiswa";
    protected $allowedFields = ['NIM','NAMA'.'UMUR','namafilefoto'];
 
    public function getAllMahasiswa($limit, $offset)
    {
        $query = $this->db->query("SELECT * FROM mahasiswa order by NIM LIMIT $limit OFFSET $offset");
        return $query->getResultArray();
    }

    public function insertData($data)
    {
        $nim = $data['NIM'];
        $nama = $data['NAMA'];
        $umur = $data['UMUR'];

        return $this->db->query("INSERT INTO mahasiswa(NIM, NAMA, UMUR) VALUES ('$nim','$nama','$umur')");
    }

    public function searchMahasiswa($limit, $offset, $keyword)
    {
        $query = $this->db->query("SELECT * FROM mahasiswa WHERE NAMA LIKE '%$keyword%' LIMIT $limit OFFSET $offset");
        return $query->getResultArray();
    }

    public function getMahasiswaByNim($nim)
    {
        $query = $this->db->query("SELECT * FROM mahasiswa WHERE NIM='$nim'");
        return $query->getResult();
    }
}