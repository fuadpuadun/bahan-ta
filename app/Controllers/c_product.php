<?php 
 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\m_barang;

Class c_product extends Controller
{
    public function __construct() {
        helper('my_helper');
        $this->barang = new m_barang();
    }

    public function display()
    {
        $pager = \Config\Services::pager();
        $perPage = 8;
        $group = 'barang';
        $segment = 0;
        $page = 1;

        //Pagination
        if($this->request->getVar('page'))
            $page = $this->request->getVar('page');
        $total = $this->barang->countAllResults(false);      //count all or count search
        $this->barang->pager = $pager->store($group, $page, $perPage, $total, $segment);
        $perPage = $this->barang->pager->getPerPage($group);
        $offset = ($page - 1)* $perPage;

        //Pencarian
        $keyword = $this->request->getVar('cari');

        if ($keyword) {
            $total_cari = count($this->barang->searchBarang($total, 0, $keyword));
            $data = [
                'barang' => $this->barang->searchBarang($perPage, $offset, $keyword),
                'pager' => $this->barang->pager->makelinks($page, $perPage, $total_cari,'bootstrap_pagination')
            ]; 
        }else{
            $data = [
                'barang' => $this->barang->getAllBarang($perPage, $offset),
                'pager' => $this->barang->pager->makelinks($page, $perPage, $total,'bootstrap_pagination')
            ]; 
        }
        echo view('v_home', $data);
    }

}