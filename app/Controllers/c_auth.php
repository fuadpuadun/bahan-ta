<?php 
 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\m_user;

Class c_auth extends Controller
{
    
    public function login()
    {
        helper(['form']);
        echo view('v_login');
    }

    public function login_auth()
    {
        $session = session();
        $this->user = new m_user();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $data = $this->user->getUser($username);

        if($data){
            $pass = $data->password;
            $verify_pass = strcmp($password, $pass);
            if($verify_pass==0){
                $ses_data = [
                    'id'       => $data->id,
                    'username'     => $data->username,
                    'logged_in'     => TRUE
                ];
                $session->set($ses_data);
                return redirect()->to('/beranda');
            }else{
                $session->setFlashdata('message', 'Password Salah');
                return redirect()->to('/masuk');
            }
        }else{
            $session->setFlashdata('message', 'Username tidak ditemukan');
            return redirect()->to('/masuk');
        }
    }
    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/masuk');
    }
} 