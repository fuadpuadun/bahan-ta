<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class m_jual extends Model
{
    protected $table = "jual";
    protected $allowedFields = ['idPenjualan','kodebrg'.'harga','jumlah'];

    public function insertData($data)
    {
        $idPenjualan = $data['idPenjualan'];
        $kodebrg = $data['kodebrg'];
        $harga = $data['harga'];
        $jumlah = $data['jumlah'];
        
        return $this->db->query("INSERT INTO jual(idPenjualan, kodebrg, harga, jumlah) VALUES ('$idPenjualan','$kodebrg','$harga','$jumlah')");
    }

    public function getJualByIdPenjualan($idPenjualan)
    {
        $query = $this->db->query("SELECT * FROM jual INNER JOIN barang ON jual.kodebrg = barang.kodebrg WHERE idPenjualan='$idPenjualan'");
        return $query->getResultArray();
    }
}