<?php 
 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\m_mahasiswa;

Class c_mahasiswa extends Controller
{
    public function __construct() {
 
        // Memanggil form helper
        helper('form');
        $this->mahasiswa = new m_mahasiswa();
        $this->form_validation = \Config\Services::validation();
    }
 
    public function display()
    {
        $pager = \Config\Services::pager();
        $perPage = 3;
        $group = 'mahasiswa';
        $segment = 0;
        $page = 1;

        //Pagination
        if($this->request->getVar('page'))
            $page = $this->request->getVar('page');
        $total = $this->mahasiswa->countAllResults(false);      //count all or count search
        $this->mahasiswa->pager = $pager->store($group, $page, $perPage, $total, $segment);
        $perPage = $this->mahasiswa->pager->getPerPage($group);
        $offset = ($page - 1)* $perPage;

        //Pencarian
        $keyword = $this->request->getVar('cari');

        if ($keyword) {
            $total_cari = count($this->mahasiswa->searchMahasiswa($total, 0, $keyword));
            $data = [
                'mahasiswa' => $this->mahasiswa->searchMahasiswa($perPage, $offset, $keyword),
                'pager' => $this->mahasiswa->pager->makelinks($page, $perPage, $total_cari,'bootstrap_pagination')
            ]; 
        }else{
            $data = [
                'mahasiswa' => $this->mahasiswa->getAllMahasiswa($perPage, $offset),
                'pager' => $this->mahasiswa->pager->makelinks($page, $perPage, $total,'bootstrap_pagination')
            ]; 
        }
        echo view('v_mahasiswa', $data);
    }

    public function add()
    {
        return view('v_mahasiswa_tambah');
    }

    public function store()
    {
        $nim = $this->request->getPost('NIM');
        $nama = $this->request->getPost('NAMA');
        $umur = $this->request->getPost('UMUR');
    
        $data = [
            'NIM' => $nim,
            'NAMA' => $nama,
            'UMUR' => $umur
        ];

        $simpan = $this->mahasiswa->insertData($data);

        if($simpan)
        {
            session()->setFlashdata('success', 'Mahasiswa berhasil ditambahkan');
            return redirect()->to(base_url('mahasiswa')); 
        }
    }

    public function detail($nim)
    {
        $data['mahasiswa'] = $this->mahasiswa->getMahasiswaByNim($nim);
        return view('v_mahasiswa_detail', $data);
    }

    //********** IMPORT EXCEL **********
    public function importExcel()
    {
        // Jika melakukan import
        if($this->request->getMethod() == 'post')
        {
            $file = $this->request->getFile('file_upload');
            // ambil extension dari file excel
            $extension = $file->getClientExtension();
            
            // format excel 2007 ke bawah
            if('xls' == $extension){
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
            // format excel 2010 ke atas
            } else {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }
            $spreadsheet = $reader->load($file);
            $data = $spreadsheet->getActiveSheet()->toArray();
            $data_excel = [
                "mahasiswa" => $data
            ];

        // Jika tidak melakukan import
        }else{
            $data_excel = [''];
        }
        echo view('v_mahasiswa', $data_excel);
    }

    //********** FORM VALIDASI **********
    public function formulir()
    {
        return view('v_mahasiswa_form');
    }

    public function validasi()
    {
        $nim        = $this->request->getPost('nim');
        $nama       = $this->request->getPost('nama');
        $gender     = $this->request->getPost('gender');
        $pendidikan = $this->request->getPost('pendidikan');
        $email      = $this->request->getPost('email');
        $hobi       = $this->request->getPost('hobi');
        $data = [
            'nim'       => $nim,
            'nama'      => $nama,
            'gender'    => $gender,
            'pendidikan'=> $pendidikan,
            'email'     => $email,
            'hobi'      => $hobi
        ];
        if($this->form_validation->run($data, 'register') == FALSE){
            // mengembalikan nilai input yang sudah dimasukan sebelumnya
            session()->setFlashdata('inputs', $this->request->getPost());
            // memberikan pesan error pada saat input data
            session()->setFlashdata('errors', $this->form_validation->getErrors());
            // kembali ke halaman form
            return redirect()->to(base_url('mahasiswa/formulir'));
        } else {
            return view('v_mahasiswa_success', $data);
        }
    }
}