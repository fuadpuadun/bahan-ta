<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class m_user extends Model
{
    protected $table = "user";
    protected $allowedFields = ['username','password'];

    public function getUser($username)
    {
        $query = $this->db->query("SELECT * FROM user WHERE username='$username'");
        return $query->getFirstRow();
    }

}