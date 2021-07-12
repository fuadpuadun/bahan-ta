<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class m_ongkir extends Model
{
    protected $table = "ongkir";
    protected $allowedFields = ['kecamatanAsal','kecamatanTujuan'.'tarif'];
 
    public function getOngkir($kecamatanTujuan)
    {
        $query = $this->db->query("SELECT * FROM ongkir WHERE kecamatanTujuan='$kecamatanTujuan'");
        return $query->getRowArray();
    }
}