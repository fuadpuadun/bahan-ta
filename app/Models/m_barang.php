<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class m_barang extends Model
{
    protected $table = "barang";
    protected $allowedFields = ['kodebrg','namabrg'.'harga','stok','berat','fileGambar'];
 
    public function getAllBarang($limit, $offset)
    {
        $query = $this->db->query("SELECT * FROM barang LIMIT $limit OFFSET $offset");
        return $query->getResultArray();
    }

    
    public function searchBarang($limit, $offset, $keyword)
    {
        $query = $this->db->query("SELECT * FROM barang WHERE namabrg LIKE '%$keyword%' LIMIT $limit OFFSET $offset");
        return $query->getResultArray();
    }

    public function getBarangByKode($kodebrg)
    {
        $query = $this->db->query("SELECT * FROM barang WHERE kodebrg='$kodebrg'");
        return $query->getRowArray();
    }

    public function setStokBarang($stok, $kodebrg)
    {
        //return $this->db->query("UPDATE barang SET status_kursi=1 where kodebrg='$kodebrg' ");
    }

    public function setStatusKursi($kodebrg)
    {
        
    }
}