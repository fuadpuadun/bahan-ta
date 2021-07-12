<?php 
 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\m_barang;
use App\Models\m_penjualan;
use App\Models\m_jual;
use App\Models\m_ongkir;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

Class c_purchase extends Controller
{
    protected $barang;
 
    public function __construct() {
 
        helper('my_helper');
        $this->barang = new m_barang();
        $this->penjualan = new m_penjualan();
        $this->jual = new m_jual();
        $this->ongkir = new m_ongkir();
    }

    public function display_form_checkout()
    {
        $session = \Config\Services::session(); 
        $cart = $session->get('cart');

        //Cart kosong
        if(!$cart){
            return redirect()->to(base_url('keranjang')); 
        }
        echo view("v_form_checkout");
    }

    public function checkout()
    {
        $session = \Config\Services::session();

        $cart['barang'] = $session->get('cart');
        $totalHarga = 0;
        $subHarga = 0;
        $totalBerat = 0;
        $subBerat = 0;

        //Total Harga dan Berat
        foreach($cart['barang'] as $key => $barang)
        {
            $subHarga = $barang['harga'] * $barang['kuantitas'];
            $totalHarga = $totalHarga + $subHarga;
            $subBerat = $barang['berat'] * $barang['kuantitas'];
            $totalBerat = $totalBerat + $subBerat;
        }

        //Get Post
        $nama = $this->request->getPost('nama');
        $alamat = $this->request->getPost('alamat');
        $hp = $this->request->getPost('hp');
        $kecamatanTujuan = $this->request->getPost('kecamatanTujuan');
        $dataOngkir = $this->ongkir->getOngkir($kecamatanTujuan);

        //Pembulatan
        if(fmod($totalBerat,1) < 0.31){
            $roundBerat = floor($totalBerat);
        } else{
            $roundBerat = ceil($totalBerat);
        }
        if($roundBerat == 0){
            $roundBerat=1;
        }
        $tarif = $dataOngkir['tarif'] * $roundBerat;

        //Insert tabel Penjualan
        $dataPenjualan = [
            'totalHarga' => $totalHarga,
            'tarif' => $tarif,
            'nama' => $nama,
            'alamat' => $alamat,
            'kecamatanTujuan' => $kecamatanTujuan,
            'hp' => $hp
        ];
        $simpan = $this->penjualan->insertData($dataPenjualan);

        //Insert tabel Jual
        $idPenjualan = $this->penjualan->insertID();
        if($simpan)
        {
            foreach($cart['barang'] as $key => $barang)
            {
                $harga = $barang['harga'];
                $jumlah = $barang['kuantitas'];
                $dbbarang = $this->barang->getBarangByKode($key);

                $newjumlah = $dbbarang['stok'] - $jumlah;
                $this->barang->setStokBarang($newjumlah, $key);

                $dataJual = [
                    'idPenjualan' => $idPenjualan,
                    'kodebrg' => $key,
                    'harga' => $harga,
                    'jumlah' => $jumlah
                ];
                $simpan = $this->jual->insertData($dataJual);
            }
        }
        $session->remove('cart');
        return redirect()->to(base_url('invoice/'.$idPenjualan)); 
    }

    public function display_invoice()
    {
        $data = [
            'penjualan' => $this->penjualan->getAllPenjualan()
        ];
        echo view("v_invoice", $data);
    }

    public function konfirm()
    {
        $data = [
            'penjualan' => $this->penjualan->getAllPenjualan()
        ];
    }

    public function invoice_detail($idPenjualan)
    {
        $data = [
            'penjualan' => $this->penjualan->getPenjualanByIdPenjualan($idPenjualan),
            'jual' => $this->jual->getJualByIdPenjualan($idPenjualan)
        ];
        echo view("v_invoice_detail", $data);
    }

    public function exportPdf()
    {
        $query = $this->penjualan->getAllPenjualan();
        $table ='';
        $no=1;
        
        foreach ($query as $row)
        {           
            $table .='<tr>
                        <td>'.$no++.'</td>
                        <td>'.$row['idPenjualan'].'</td>
                        <td>'.$row['nama'].'</td>
                        <td>Rp'.format_rupiah($row['total']).'</td>
                        <td>Rp'.format_rupiah($row['ongkir']).'</td>                           
                    </tr>';
        }

        $mpdf = new \Mpdf\Mpdf(['debug'=>FALSE,'mode' => 'utf-8', 'orientation' => 'L']);
        $mpdf->WriteHTML('
        <img src="web/logo.png" width="100">
        <h2>Laporan Penjualan</h2>
        <br>
        <table border="1" id="datatable" class="table table-striped table-bordered" style="width:100%; border-collapse: collapse;">
            <thead>
                    <tr>
                        <th>No</th>
                        <th>Id Penjualan</th>
                        <th>Nama</th>
                        <th>Total Penjualan</th>
                        <th>Total Ongkir</th>
                    </tr>
            </thead>
            <tbody>
                '.$table.'                       
            </tbody>
        </table>');
        $mpdf->Output('Laporan_penjualan.pdf','I');
        exit;
    }

    public function exportExcel()
    {                       
        $spreadsheet = new Spreadsheet();
        $no=1;
        $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A1', 'NO')
                ->setCellValue('B1', 'ID PENJUALAN')
                ->setCellValue('C1', 'NAMA')
                ->setCellValue('D1', 'TOTAL PENJUALAN')
                ->setCellValue('E1', 'TOTAL ONGKIR');
    
        $column = 2;
        $query = $this->penjualan->getAllPenjualan();
        foreach ($query as $row)
        {
            $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A' . $column, $no++)
                    ->setCellValue('B' . $column, $row['idPenjualan'])
                    ->setCellValue('C' . $column, $row['nama'])
                    ->setCellValue('D' . $column, format_rupiah($row['total']))
                    ->setCellValue('E' . $column, format_rupiah($row['ongkir']));
            $column++;
        }
        
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Laporan_penjualan';

        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename='.$fileName.'.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}
 