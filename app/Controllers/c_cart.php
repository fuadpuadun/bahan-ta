<?php 
 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\m_barang;

Class c_cart extends Controller
{
    public function __construct() {
        helper('my_helper');
        $this->barang = new m_barang();
    }

	public function cart()
	{
        $session = \Config\Services::session(); 

        $data['barang'] = $session->get('cart');
        
        echo view("v_cart", $data);
    }
    
    public function addToCart($kodebrg)
	{
        $session = \Config\Services::session(); 
        $barang = $this->barang->getBarangByKode($kodebrg);

        $cart = $session->get('cart');

        //Cart kosong
        if(!$cart) {
            $cart = [
                    $kodebrg => [
                        "namabrg" => $barang['namabrg'],
                        "kuantitas" => 1,
                        "harga" => $barang['harga'],
                        "berat" => $barang['berat'],
                        "fileGambar" => $barang['fileGambar']
                    ]
            ];
            $session->set('cart', $cart);
            return redirect()->to(base_url('keranjang')); 
        }

        //Sudah ada produk di cart
        if(isset($cart[$kodebrg])){
            $cart[$kodebrg]['kuantitas']++;
            $session->set('cart', $cart);

            return redirect()->to(base_url('keranjang')); 
        }

        //Belum ada produk di cart
        $cart[$kodebrg] = [
            "namabrg" => $barang['namabrg'],
            "kuantitas" => 1,
            "harga" => $barang['harga'],
            "berat" => $barang['berat'],
            "fileGambar" => $barang['fileGambar']
        ];
        $session->set('cart', $cart);

		return redirect()->to(base_url('keranjang')); 
    }

    public function updateItemCart($kodebrg)
    {
        $session = \Config\Services::session();
        $kuantitas = $this->request->getPost('kuantitas');
        
        $cart = $session->get('cart');
        if(isset($cart[$kodebrg])) {
            $cart[$kodebrg]["kuantitas"] = $kuantitas;
            $session->set('cart', $cart);
        }
        return redirect()->to(base_url('keranjang'));
    }

    
    public function removeItemCart($kodebrg)
    {
        $session = \Config\Services::session();

        $cart = $session->get('cart');
        if(isset($cart[$kodebrg])) {
            unset($cart[$kodebrg]);
            $session->set('cart', $cart);
        }
        return redirect()->to(base_url('keranjang'));
    }

    public function clearCart()
    {
        $session = \Config\Services::session();
        $session->remove('cart');
        return redirect()->to(base_url('keranjang'));
    }
}
